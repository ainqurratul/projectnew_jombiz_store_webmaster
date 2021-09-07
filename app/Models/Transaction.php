<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code_payment',
        'code_transaction',
        'total_item',
        'total_price',
        'code_unique',
        'status',
        'resit',
        'courier',
        'phone',
        'name',
        'detail_location',
        'description',
        'method',
        'expired_at',
        'ship_method',
        'total_transfer',
        'bank'

    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class, "transaction_id","id");
    }

    public function users(){
        return $this->belongsTo(User::class, "user_id","id");
    }
    
}
