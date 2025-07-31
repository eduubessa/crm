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
        $customers = Customer::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return Inertia::render('welcome', [
            'customers' => $customers
        ]);
    }
}
