<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'categoryCount' => Category::count(),
            'productCount'  => Product::count(),
            'customerCount' => Customer::count(),
            'petCount'      => Pet::count(),
        ]);
    }
}