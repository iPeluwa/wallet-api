<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
// use App\ClassModel;
class Transaction extends Model
{
    // use HasFactory;
    protected $fillable = [
        'transaction_id', 'sender_id', 'receiver_id', 'amount', 'description', 'title', 'transaction_type' 
    ];
}