<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

final readonly class IndexCustomerController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $recent_customers = Customer::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $all_customers = Customer::all();

        return Inertia::render('welcome', [
            'recent_customers' => $recent_customers,
            'all_customers' => $all_customers,
        ]);
    }
}
