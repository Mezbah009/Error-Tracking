<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
        // Get the users data with the required calculations
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
