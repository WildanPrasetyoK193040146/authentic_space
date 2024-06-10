<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionMenu;

class Menu extends Model
{
    use HasFactory;
    public $table = "menus";
    protected $fillable = [
        'name',
        'price',
        'image',
        'category'
    ];

    public function transaction_menu(){
        return $this->hasMany(TransactionMenu::class,'menu_id','id');
    }
}
