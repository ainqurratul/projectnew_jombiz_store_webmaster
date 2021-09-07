<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'product_id',
        'total_item',
        'messages',
        'promo_code',
        'ori_price',
        'total_price',
        
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class, "transaction_id", "id");
    }
    public function product(){
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
