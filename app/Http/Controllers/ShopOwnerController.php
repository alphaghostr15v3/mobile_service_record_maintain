<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopOwner;
use App\Exports\ShopOwnerExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ShopOwnerController extends Controller
{
    public function index(Request $request)
    {
        $query = ShopOwner::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('mobile_number', 'like', "%$search%")
                  ->orWhere('imei_number', 'like', "%$search%")
                  ->orWhere('aadhar_number', 'like', "%$search%")
                  ->orWhere('mobile_name', 'like', "%$search%")
                  ->orWhere('work', 'like', "%$search%");
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

        $shopOwners = $query->latest()->paginate(10)->withQueryString();
        return view('shop_owners.index', compact('shopOwners'));
    }

    public function create()
    {
        return view('shop_owners.create');
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
        ]);

        ShopOwner::create($request->all());

        return redirect()->route('shop-owners.index')->with('success', 'Shop Owner record created successfully.');
    }

    public function show(ShopOwner $shopOwner)
    {
        return view('shop_owners.show', compact('shopOwner'));
    }

    public function edit(ShopOwner $shopOwner)
    {
        return view('shop_owners.edit', compact('shopOwner'));
    }

    public function update(Request $request, ShopOwner $shopOwner)
    {
        $validated = $request->validate([
            'name' => 'required',
            'mobile_number' => 'required',
            'mobile_name' => 'required',
            'work' => 'nullable',
            'date' => 'required|date',
            'device_status' => 'required',
        ]);

        $shopOwner->update($request->all());

        return redirect()->route('shop-owners.index')->with('success', 'Shop Owner record updated successfully.');
    }

    public function destroy(ShopOwner $shopOwner)
    {
        $shopOwner->delete();

        return redirect()->route('shop-owners.index')->with('success', 'Shop Owner record deleted successfully.');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new ShopOwnerExport($request), 'shop_owners_' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $query = ShopOwner::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('mobile_number', 'like', "%$search%")
                  ->orWhere('imei_number', 'like', "%$search%")
                  ->orWhere('aadhar_number', 'like', "%$search%")
                  ->orWhere('mobile_name', 'like', "%$search%")
                  ->orWhere('work', 'like', "%$search%");
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
        $pdf = Pdf::loadView('shop_owners.pdf', compact('records'));
        return $pdf->download('shop_owners_' . date('Y-m-d') . '.pdf');
    }
}
