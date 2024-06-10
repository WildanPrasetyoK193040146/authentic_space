<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateTransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create(CreateTransactionRequest $request){
    // Memulai transaksi database
    DB::beginTransaction();
    try{
    $transaction = Transaction::create([
    'customer_name' => $request-> customer_name,
    'table_number' => $request-> table_number,
    'quantity' => $request-> quantity,
    'total' => $request-> total,
    'token' => $request-> token
    ]);
    $menus = [];
    foreach ($request->input('menus') as $menu) {
        $transactionMenu = TransactionMenu::create([
             'menu_id' => $menu['menu_id'],
             'quantity' => $menu['quantity'],
             'note' => $menu['note'],
             'transaction_id' => $transaction->id,
         ]);
         $menus[] = $transactionMenu;
        }
         // Commit transaksi jika berhasil
         DB::commit();
         if(!$transaction && !$transactionMenu){
            throw new Exception('Data Transaction not created');
        }
        return ResponseFormatter::success(['transaction' => $transaction, 'menus' => $menus], 'Data Transaction created');
    }catch(Exception $e){
        DB::rollback();
        return ResponseFormatter::error($e->getMessage(), 500);
    }
    }

    public function fetch(){
        try {
            $transactions = Transaction::with('transaction_menu.menu')->get();

            return ResponseFormatter::success($transactions, 'Data Transaction Found');
        } catch (Exception $e) {
            return ResponseFormatter::error(null, 'Data Transaction Not Found', 500);
        }
    }
}
