<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PayoutsDataTable;
use App\Models\User;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PayoutsDataTable $dataTable)
    {
        return $dataTable->render('payouts.index', ['dataTable' => $dataTable]);
    }
}
