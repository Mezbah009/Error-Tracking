<?php

namespace App\Exports;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BalanceExport implements FromView //FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return User::all();
    // }

    // public function headings(): array
    // {
    //     return [
    //         '#',
    //         'User',
    //         'Date',
    //     ];
    // }

    public function view(): View
    {
        $users = User::where('role', 1)
            ->where('serial', '!=', 0)
            ->orderBy('serial', 'asc')
            ->get();

        foreach ($users as $user) {
            $user->numberOfDates = Booking::where('user_id', $user->id)->count();
            $user->paid = Payment::where('user_id', $user->id)->sum('amount');
            $user->cost = $user->numberOfDates * 100;
            $user->due = $user->cost - $user->paid;
        }

        return view('admin.reports.balanceExcel', compact('users'));
    }
}
