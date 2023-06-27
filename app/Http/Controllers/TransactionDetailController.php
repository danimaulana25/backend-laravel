<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Models\Transaction;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->json(TransactionDetail::with('cars')
                ->get(), 200);
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
     * @param  \App\Http\Requests\StoreTransactionDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionDetailRequest $request)
    {
        $length = is_array($request->transactionDetail) ? count($request->transactionDetail) : 0;
        $orderData = $request->order;
        $orderData['total_price'] = 0;
        Transaction::create($orderData);
        $order = Transaction::latest()->first();
        for ($i = 0; $i < $length; $i++) {
            $transactionDetail = $request->transactionDetail[$i];
            $transactionDetail['transactions_id'] = $order->id;
            $transactionDetail['total_price'] = $transactionDetail['quantity'] * $transactionDetail['price'];
            TransactionDetail::create($transactionDetail);
            $order->total_price += $transactionDetail['total_price'];
            $order->save();
        }
        return response()
            ->json(
                $order
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionDetail $transactionDetail)
    {
        $detail = TransactionDetail::with('cars')
            ->where('transactions_id', $transactionDetail->transactions_id)
            ->get();
        $order = Transaction::find($transactionDetail);
        return response()
            ->json([
                'order' => $order ? $order : null,
                'detail' => $detail ? $detail : null,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionDetailRequest  $request
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionDetailRequest $request, TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionDetail  $transactionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        //
    }
}
