<?php

namespace App\Exports;

use App\Models\ShopOwner;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ShopOwnerExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = ShopOwner::query();

        if ($this->request->filled('search')) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('mobile_number', 'like', "%$search%")
                  ->orWhere('imei_number', 'like', "%$search%")
                  ->orWhere('aadhar_number', 'like', "%$search%")
                  ->orWhere('mobile_name', 'like', "%$search%")
                  ->orWhere('work', 'like', "%$search%");
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
            'Mobile Name',
            'Work',
            'IMEI Number',
            'Date',
            'Device Status',
            'Created At'
        ];
    }

    public function map($owner): array
    {
        return [
            $owner->id,
            $owner->name,
            $owner->aadhar_number,
            $owner->mobile_number,
            $owner->mobile_name,
            $owner->work,
            $owner->imei_number,
            $owner->date,
            $owner->device_status,
            $owner->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
