<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;

use App\Http\Requests\UpdateCustomerRequest;

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
    // public function index()
    // {
    //     //    $customers=CustomersCustomer::with(["address","notes"])->get()->orderBy("id","desc")->paginate(10);;

    //     $customers = Customer::with(['address', 'notes'])
    //     ->orderBy('id', 'desc')
    //     ->paginate(10);
    //     return view("pages.people.customer.index", compact("customers"));
    // }

    public function index(Request $request)
{

    $perPage = $request->input('per_page', 10);


    $customers = Customer::with(['address', 'notes'])
        ->when($request->search, function ($query) use ($request) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        })
        ->orderBy('id', 'desc')

        ->paginate($perPage)
        ->withQueryString();

    return view('pages.people.customer.index', compact('customers', 'perPage'));
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
            //  Image Upload
            $imagePath = null;
            if ($request->hasFile('photo')) {
                $imageName = 'customer_' . Str::uuid() . '.' . $request->photo->extension();
                $imagePath = $request->photo->storeAs('customers', $imageName, 'public');
            }

            // Customer Profile Save
            $customer = Customer::create([
                'customer_name' => $request->customer_name,
                'email'         => $request->email,
                'gender'        => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'phone'         => $request->phone,
                'password'      => Hash::make($request->password),
                'photos'        => $imagePath,
            ]);

            //  Address Save
            $customer->address()->create([
                 'type'        => $request->address_type, // shipping or billing
                'country'     => $request->country,
                'city'        => $request->city,
                'address'     => $request->address,
                'postal_code' => $request->postal_code,
            ]);

            //  Note Save
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
         $customer->load(['address', 'notes']);
        return view('pages.people.customer.view', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Customer $customer)
    // {
    //     //
    // }

    public function edit(Customer $customer)
{
    $customer->load(['address', 'notes']);

    return view('pages.people.customer.edit', compact('customer'));
}


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Customer $customer)
    // {
    //     //
    // }

    public function update(UpdateCustomerRequest $request, Customer $customer)
{



    DB::beginTransaction();

    try {

        $imagePath = $customer->photos;

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            // ensure uploaded file is valid
            if (!$file->isValid()) {
                return back()->withInput()->with('error', 'Uploaded photo is invalid.');
            }

            // delete old photo if exists
            if ($customer->photos && Storage::disk('public')->exists($customer->photos)) {
                Storage::disk('public')->delete($customer->photos);
            }

            // ensure customers directory exists
            if (!Storage::disk('public')->exists('customers')) {
                Storage::disk('public')->makeDirectory('customers');
            }

            $imageName = 'customer_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('customers', $imageName, 'public');
        }


        $customer->update([
            'customer_name' => $request->customer_name,
            'email'         => $request->email,
            'gender'        => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'phone'         => $request->phone,
            'photos'        => $imagePath,
        ]);


        if ($request->filled('password')) {
            $customer->update([
                'password' => Hash::make($request->password),
            ]);
        }


        $customer->address()->updateOrCreate(
            ['type' => $request->address_type], // condition
            [
                'country'     => $request->country,
                'city'        => $request->city,
                'address'     => $request->address,
                'postal_code' => $request->postal_code,
            ]
        );


        if ($request->filled('note')) {
            $customer->notes()->updateOrCreate(
                [],
                ['note' => $request->note]
            );
        }

        DB::commit();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer updated successfully');

    } catch (\Exception $e) {

        DB::rollBack();


        if ($request->hasFile('photo') && isset($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        return back()->withErrors($e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {


    if ($customer->photos && Storage::exists($customer->photos)) {
        Storage::delete($customer->photos);
    }


    $customer->delete();


    return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
