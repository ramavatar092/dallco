<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScanLog;
use App\DataTables\ScanLogssDataTable;

class ScanLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ScanLogssDataTable $dataTable)
    {
        return $dataTable->render('scan-logs.index', ['dataTable' => $dataTable]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ScanLog $scanLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScanLog $scanLog)
    {
        $coupon->delete();
        return response()->json(['success' => true, 'message' => trans('panel.message.delete')], 200);
    }
}
