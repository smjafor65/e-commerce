<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customers\Customer ;
use App\Models\Customers\CustomerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //    $customers=CustomersCustomer::with(["address","notes"])->get()->orderBy("id","desc")->paginate(10);;

        $customers = Customer::with(['address', 'notes'])
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view("pages.people.customer.index", compact("customers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('pages.people.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function store(StoreCustomerRequest $request)
    {
        DB::beginTransaction();

        try {
            // 🖼 Image Upload
            $imagePath = null;
            if ($request->hasFile('photo')) {
                $imageName = 'customer_' . Str::uuid() . '.' . $request->photo->extension();
                $imagePath = $request->photo->storeAs('customers', $imageName, 'public');
            }

            // 1️⃣ Customer Profile Save
            $customer = Customer::create([
                'customer_name' => $request->customer_name,
                'email'         => $request->email,
                'gender'        => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone'         => $request->phone,
                'password'      => Hash::make($request->password),
                'photos'        => $imagePath,
            ]);

            // 2️⃣ Address Save
            $customer->address()->create([
                'type'        => 'shipping',
                'country'     => $request->country,
                'city'        => $request->city,
                'address'     => $request->address,
                'postal_code' => $request->postal_code,
            ]);

            // 3️⃣ Note Save
            if ($request->filled('note')) {
                $customer->notes()->create([
                    'note' => $request->note,
                ]);
            }

            DB::commit();

            return redirect()->route('customers.index')->with('success', 'Customer created successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            // Rollback image if uploaded
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
