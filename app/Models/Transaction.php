<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionMenu;

class Transaction extends Model
{
    use HasFactory;
    public $table = "transactions";
    protected $fillable = [
        'customer_name',
        'table_number',
        'quantity',
        'total',
        'status',
        'status_pesanan',
        'token'
    ];

    public function transaction_menu(){
        return $this->hasMany(TransactionMenu::class,'transaction_id','id');
    }
}
