<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

final readonly class UpdateCustomerController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateCustomerRequest $request, string $reference)
    {
        //
        $request->validated();

        $customer = Customer::where('reference', $reference)->firstOrFail();
        $customer->update($request->all());

        return redirect()->to('customers')->with(['success' => 'Update customer success']);
    }
}
