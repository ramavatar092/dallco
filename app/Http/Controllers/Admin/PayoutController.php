<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PayoutsDataTable;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payout;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PayoutsDataTable $dataTable)
    {
        return $dataTable->render('payouts.index', ['dataTable' => $dataTable]);
    }

    /**
     * payout update
     */
    public function update(Request $request)
    {   
        $userIds = $request->user_ids;
        if(isset($userIds)){
            DB::transaction(function () use ($userIds) {
                $users = User::whereIn('id', $userIds)->get();

                foreach ($users as $user) {
                    $currentBalance = $user->account_balance;

                    // Only process users with non-zero balance
                    if ($currentBalance > 0) {
                        $user->total_payout += $currentBalance;
                        $user->account_balance = 0;
                        $user->save();

                        Payout::create([
                            'user_id' => $user->id,
                            'amount'   => $currentBalance,
                            'payout_date' => now(),
                        ]);
                    }
                }
            });
        }
    }
}
