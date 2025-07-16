<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class UpdateCustomerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $validated = $request->validated();

        $customer = Customer::where('reference', $reference)->firstOrFail();
        $customer->update($validated);

        return redirect()->to('customers')->with(['message' => 'Update customer success']);
    }
}
