<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('lazadasOrder.index');
    }

    public function detail($order_number, $token)
    {
        return view('lazadasOrder.detail', ['order_number' => $order_number, 'token' => $token]);
    }
}
