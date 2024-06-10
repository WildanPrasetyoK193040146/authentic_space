<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use App\Models\Transaction;

class TransactionMenu extends Model
{
    use HasFactory;
    public $table = "transactions_menus";
    protected $fillable = [
        'transaction_id',
        'menu_id',
        'quantity',
        'note'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id','id');
    }
    public function transaction(){
        return $this->belongsTo(Transaction::class,'transaction_id','id');
    }
}
