<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = auth()->user()->transactions;
 
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }
 
    public function show($id)
    {
        $transaction = auth()->user()->transactions()->find($id);
 
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $transaction->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'reciever_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'title' => 'required',
            'transaction_type' => 'required'
        ]);
        
        $transaction = new Transaction();
        $transaction->transaction_id = rand(2,5000);
        // $transaction->sender_id = Auth()->id();
        $transaction->reciever_id = $request->reciever_id;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->title = $request->title;
        $transaction->transaction_type = $request->transaction_type;
 
        if (auth()->user()->transactions()->save($transaction))
            return response()->json([
                'success' => true,
                'data' => $transaction->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Transaction not added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $transaction = auth()->user()->transactions()->find($id);
 
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 400);
        }
 
        $updated = $transaction->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Transaction can not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $transaction = auth()->user()->transactions()->find($id);
 
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'transaction not found'
            ], 400);
        }
 
        if ($transaction->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'transaction can not be deleted'
            ], 500);
        }
    }
}