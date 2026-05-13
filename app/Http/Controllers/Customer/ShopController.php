<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Gold;

class ShopController extends Controller
{
    public function index()
    {
        $golds = Gold::where('stock', '>', 0)->orderBy('name')->get();

        return view('customer.shop.index', compact('golds'));
    }
}
