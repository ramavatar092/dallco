<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PayoutsDataTable;
use App\DataTables\PaidPayoutsDataTable;
use App\DataTables\PendingPayoutsDataTable;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payout;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserPaymentImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
    public function paidPayoutList(User $user, PaidPayoutsDataTable $dataTable)
    {
        $dataTable->setUserId($user->id);
        return $dataTable->render('payouts.paid_payout', ['user' => $user]);
    }

      /**
     * Display a listing of the paid payout.
     */
   public function pendingPayoutList(PendingPayoutsDataTable $dataTable)
    {
        return $dataTable->render('payouts.pending_payout', ['dataTable' => $dataTable]);
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
        try {
            // Check if file exists
            if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
                return back()->with('error', 'No valid file uploaded.');
            }

            // Get the file
            $file = $request->file('file');

            // Validate extension
            $allowedExtensions = ['xlsx', 'xls', 'csv'];
            $extension = strtolower($file->getClientOriginalExtension());
            if (!in_array($extension, $allowedExtensions)) {
                return back()->with('error', 'Invalid file format. Only xlsx, xls, and csv are allowed.');
            }

            // Validate file size (10MB = 10 * 1024 * 1024 bytes)
            if ($file->getSize() > 10 * 1024 * 1024) {
                return back()->with('error', 'File size exceeds 10MB limit.');
            }

            // Proceed with import
            Excel::import(new UserPaymentImport, $file);

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
