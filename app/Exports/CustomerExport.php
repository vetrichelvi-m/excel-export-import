<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;


class CustomerExport implements FromView
// FromCollection, WithHeadings
{


    public function view() : View
    {
        return view('user.export', [
            'users' => User::where('is_active',1)->get()

        ]);
    }

    // public function collection()
    // {
    //     //
    //     $user = User::select('name','email','mobile','address')->get();
    //     return $user ;

    // }

    // public function headings(): array
    // {
    //     return [
    //         'No',
    //         'Name',
    //         'Email',
    //         'Mobile',
    //         'Address',
    //     ];
    // }
}
