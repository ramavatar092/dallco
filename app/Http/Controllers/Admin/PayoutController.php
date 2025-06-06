<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PayoutsDataTable;
use App\DataTables\PaidPayoutsDataTable;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payout;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserPaymentImport;

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
     * Display a listing of the paid payout.
     */
    public function paidPayoutList(PaidPayoutsDataTable $dataTable)
    {
        return $dataTable->render('payouts.paid_payout', ['dataTable' => $dataTable]);
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

     /**
     * import payment
     */
    public function paymentImport(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        try {
            Excel::import(new UserPaymentImport, $request->file('file'));

            $notification = array(
                'message' => 'User payment imported successfully!',
                'alert-type' =>  trans('panel.alert-type.success')
            );

            return back()->with($notification);

        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
