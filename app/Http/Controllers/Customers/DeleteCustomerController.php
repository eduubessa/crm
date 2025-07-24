<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

final readonly class DeleteCustomerController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $reference)
    {
        //
        Customer::where('reference', $reference)->firstOrFail()->delete();

        return redirect()->to('customers')->with('success', 'Customer deleted successfully!');
    }
}
