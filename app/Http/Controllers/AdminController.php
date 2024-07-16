<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function dashboard(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        $menuCounts = Menu::select('category', DB::raw('count(*) as total'))
                          ->groupBy('category')
                          ->pluck('total', 'category');
        return view('admin.index',compact('adminData', 'menuCounts'));
    }

    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function editprofile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }

    public function storeprofile(Request $request){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        $adminData->name = $request->name;
        $adminData->email = $request->email;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            @unlink(public_path('upload/admin_images/'.$adminData->profile_image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);

            $adminData['profile_image'] = $filename;
        }
        $adminData->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changepassword(){
        return view('admin.admin_change_password');
    }

    public function updatepassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $users = User::find(Auth::id());
            $users->password =  Hash::make($request->newpassword);
            $users->save();

            $notification = array(
                'message' => 'Password Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Old password is not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function allMenu(){
        $allMenu = Menu::all();
        return view('admin.menu.menu_all', compact('allMenu'));
    }

    public function addMenu(){
        return view('admin.menu.menu_add');
    }

    public function storeMenu(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'image' => 'required',
        ], [
            'name.required' => 'Name is Required',
            'price.required' => 'Price is Required',
            'category.required' => 'Category is Required',
            'image.required' => 'Image is Required',
        ]);

             //  Image
             $image = $request->file('image');
             if ($image->getClientOriginalExtension() !== 'jpg' && $image->getClientOriginalExtension() !== 'png') {
                $notification = [
                    'message' =>'Please upload a jpg or png  file for your image',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
             $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

             // Menyimpan gambar baru
             $image->move('upload/menu/', $name_gen);

             $save_url = 'upload/menu/' . $name_gen;

             Menu::insert([
                'name' => $request->name,
                'price' => $request->price,
                'category' => $request->category,
                'image' => $save_url,
            ]);

        $notification = [
            'message' => 'Menu Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.menu')->with($notification);
    }

    public function editMenu($id){
        $menu = Menu::findOrFail($id);
        return view('admin.menu.menu_edit', compact('menu'));
    }

    public function updateMenu(Request $request){
        $menu_id = $request->id;
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required'
        ], [
            'name.required' => 'Name is Required',
            'price.required' => 'Price is Required',
            'category.required' => 'Category is Required'
        ]);

        if($request->file('image')){
            if ($request->file('image')->getClientOriginalExtension() !== 'jpg' && $request->file('image')->getClientOriginalExtension() !== 'png') {
                $notification = [
                    'message' =>'Please upload a jpg or png  file for your image',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
             // Menghapus gambar sebelumnya dari sistem file
             $previousImage = Menu::findOrFail($menu_id)->image;
             @unlink(public_path($previousImage));


            //  Image
             $image = $request->file('image');
             $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

             // Menyimpan gambar baru
             $image->move('upload/menu/', $name_gen);

             $save_url = 'upload/menu/' . $name_gen;


             Menu::findOrFail($menu_id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'category' => $request->category,
                'image' => $save_url,
             ]);

             $notification = [
                'message' => 'Menu Updated With Image Successfully',
                'alert-type' => 'success'
             ];
             return redirect()->route('all.menu')->with($notification);
        }else{
            Menu::findOrFail($menu_id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'category' => $request->category,
            ]);
            $notification = [
               'message' => 'Menu Updated without Image Successfully',
               'alert-type' => 'success'
            ];
            return redirect()->route('all.menu')->with($notification);
        }
    }
    public function deleteMenu($id){
        $menu = Menu::findOrFail($id);
        $img = $menu->image;
        unlink($img);

        // Delete related transaction_menu records
        $menu->transaction_menu()->delete();

        // Delete the menu
        $menu->delete();


         $notification = array(
            'message' => 'Menu Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        }

    public function allPesanan(){
        $allTransaction = Transaction::all();
        return view('admin.pesanan.pesanan_all', compact('allTransaction'));
    }

    public function updateSuccess(Request $request){
     // Validate the request
     $request->validate([
        'transaction_id' => 'required|exists:transactions,id',
    ]);

    // Find the transaction and update its status
    $transaction = Transaction::findOrFail($request->transaction_id);
    $transaction->status = 'success';
    $transaction->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Transaction status updated to success.');
    }

    public function updateReject(Request $request){
        // Validate the request
        $request->validate([
           'transaction_id' => 'required|exists:transactions,id',
       ]);

       // Find the transaction and update its status
       $transaction = Transaction::findOrFail($request->transaction_id);
       $transaction->status = 'reject';
       $transaction->save();

       // Redirect back with a success message
       return redirect()->back()->with('success', 'Transaction status updated to reject.');
       }

    public function updateDiterima(Request $request){
        // Validate the request
        $request->validate([
           'transaction_id' => 'required|exists:transactions,id',
       ]);

       // Find the transaction and update its status
       $transaction = Transaction::findOrFail($request->transaction_id);
       $transaction->status_pesanan = 'diterima';
       $transaction->save();

       // Redirect back with a success message
       return redirect()->back()->with('success', 'Transaction status updated to diterima.');
    }

    public function updateBelumDiterima(Request $request){
        // Validate the request
        $request->validate([
           'transaction_id' => 'required|exists:transactions,id',
       ]);

       // Find the transaction and update its status
       $transaction = Transaction::findOrFail($request->transaction_id);
       $transaction->status_pesanan = 'belum diterima';
       $transaction->save();

       // Redirect back with a success message
       return redirect()->back()->with('success', 'Transaction status updated to belum diterima.');
    }
    public function detailPesanan($id){
        $transaction = Transaction::findOrFail($id);
        return view('admin.pesanan.pesanan_detail', compact('transaction'));
    }
}
