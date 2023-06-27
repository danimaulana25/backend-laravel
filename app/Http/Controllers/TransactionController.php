<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "transactions" => Transaction::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $validateData = $request->validate([
            "car_quantity" => "integer",
            "total_price" => "integer",
            "customer_name" => "string",
            "payment" => "string"
        ]);
        Transaction::create($validateData);
        return response()->json([
            "message" => "Transaction created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $orderDetail = TransactionDetail::with('cars')
            ->where('transactions_id', $transaction->id)
            ->first();
        $detail = TransactionDetail::with('cars')
            ->where('transactions_id', $orderDetail->transactions_id)
            ->get();
        return response()->json([
            "transaction" => $transaction,
            "details" => $detail ? $detail : null,
        ]);
        // return response()->json($transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $validateData = $request->validate([
            "car_quantity" => "integer",
            "total_price" => "integer",
            "customer_name" => "string",
            "payment" => "string"
        ]);
        $transaction->update($validateData);
        return response()->json([
            "message" => "Transaction updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return response()->json([
            "message" => "transaction deleted successfully"
        ]);
    }
}
