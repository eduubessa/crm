<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreCustomerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreCustomerRequest $request)
    {
        //
        $validated = $request->validated();

        $reference = "C". Str::random(12);

        $request->merge([
            "reference" => $reference]);

        $customer = Customer::create($request->all());

        if(!$customer){
            return back()->withInput($request->all())->withErrors([$validated]);
        }

        return redirect()->to('/customers')->with(['success' => 'Create customer success']);
    }
}
