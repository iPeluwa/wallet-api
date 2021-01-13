<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id', 'sender_id', 'receiver_id', 'amount', 'description', 'title', 'transaction_type' 
    ];
}
