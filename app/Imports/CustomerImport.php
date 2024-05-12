<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CustomerImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $customer = User::where('email', $row['email'])->first();
            if ($customer) {
                $customer->update([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'mobile' => $row['mobile'],
                    'address' => $row['address'],
                ]);
            } else {
                User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'mobile' => $row['mobile'],
                    'address' => $row['address'],
                ]);
            }
        }
    }
}
