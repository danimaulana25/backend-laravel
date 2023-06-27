<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function cars()
    {
        return $this->belongsTo(Car::class, 'cars_id', 'id');
    }
    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }
}
