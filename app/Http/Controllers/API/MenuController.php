<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function fetch(Request $request)
    {
        $name = $request->input('name');
        $price = $request->input('price');
        $category = $request->input('category');

        $menuQuery = Menu::query();

        // Filter by attributes if provided
        if ($name) {
            $menuQuery->where('name', 'like', '%' . $name . '%');
        }
        if ($price) {
            $menuQuery->where('price', 'like', '%' . $price . '%');
        }
        if (in_array($category, ['Makanan Berat', 'Makanan Ringan', 'Minuman Kopi', 'Minuman Non Kopi'])) {
            $menuQuery->where('category', $category);
        }

        // Execute query and get the results
        $menus = $menuQuery->get();

        return ResponseFormatter::success(
            $menus,
            'Data Menus Have Been Found'
        );
    }
    public function fetchById($id){
        $menu = Menu::find($id);

        if(!$menu){
            return ResponseFormatter::error($menu, 'Data Menu Has Been Not Found',404);
        }else{
            return ResponseFormatter::success($menu, 'Data Menu Has Been Found');
        }
    }
}
