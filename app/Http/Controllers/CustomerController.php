<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Exports\CustomerExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('mobile_number', 'like', "%$search%")
                  ->orWhere('imei_number', 'like', "%$search%")
                  ->orWhere('aadhar_number', 'like', "%$search%")
                  ->orWhere('mobile_name', 'like', "%$search%")
                  ->orWhere('work', 'like', "%$search%")
                  ->orWhere('invoice_bill', 'like', "%$search%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        if ($request->filled('device_status')) {
            $query->where('device_status', $request->device_status);
        }

        $customers = $query->latest()->paginate(10)->withQueryString();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'mobile_name' => 'required',
            'work' => 'nullable',
            'date' => 'required|date',
            'device_status' => 'required',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->all();
        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('documents', 'public');
        }

        Customer::create($data);

        return redirect()->route('customers.index')->with('success', 'Customer record created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'mobile_name' => 'required',
            'work' => 'nullable',
            'date' => 'required|date',
            'device_status' => 'required',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $data = $request->all();
        if ($request->hasFile('document')) {
            if ($customer->document) {
                Storage::disk('public')->delete($customer->document);
            }
            $data['document'] = $request->file('document')->store('documents', 'public');
        }

        $customer->update($data);

        return redirect()->route('customers.index')->with('success', 'Customer record updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->document) {
            Storage::disk('public')->delete($customer->document);
        }
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer record deleted successfully.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new CustomerExport($request), 'customers_' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('mobile_number', 'like', "%$search%")
                  ->orWhere('imei_number', 'like', "%$search%")
                  ->orWhere('aadhar_number', 'like', "%$search%")
                  ->orWhere('mobile_name', 'like', "%$search%")
                  ->orWhere('work', 'like', "%$search%")
                  ->orWhere('invoice_bill', 'like', "%$search%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        if ($request->filled('device_status')) {
            $query->where('device_status', $request->device_status);
        }

        $records = $query->latest()->get();
        $pdf = Pdf::loadView('customers.pdf', compact('records'));
        return $pdf->download('customers_' . date('Y-m-d') . '.pdf');
    }
}
