<?php

namespace App\Http\Controllers\Admin;

class OrdersController extends AdminController
{
    /**
     * List all orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin/orders/index');
    }
}