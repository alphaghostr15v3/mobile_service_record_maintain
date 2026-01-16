<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomerExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Customer::query();

        if ($this->request->filled('search')) {
            $search = $this->request->search;
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

        if ($this->request->filled('date_from')) {
            $query->whereDate('date', '>=', $this->request->date_from);
        }

        if ($this->request->filled('date_to')) {
            $query->whereDate('date', '<=', $this->request->date_to);
        }

        if ($this->request->filled('device_status')) {
            $query->where('device_status', $this->request->device_status);
        }

        return $query->latest();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Aadhar Number',
            'Mobile Number',
            'Device',
            'Work',
            'IMEI',
            'Document',
            'Invoice Bill',
            'Date',
            'Status',
            'Created At'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->aadhar_number,
            $customer->mobile_number,
            $customer->mobile_name,
            $customer->work,
            $customer->imei_number,
            $customer->document ? 'Uploaded' : 'None',
            $customer->invoice_bill,
            $customer->date,
            $customer->device_status,
            $customer->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
