<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Coupon\StoreRequest;
use App\Http\Requests\Coupon\UpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\DataTables\CouponsDataTable;
use App\Models\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponsDataTable $dataTable)
    {
        return $dataTable->render('coupons.index', ['dataTable' => $dataTable]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
      {
        $inputs = $request->all();
        Coupon::create($inputs);

        $notification = array(
            'message' => trans('panel.message.store'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('coupons.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $update = $request->all();
        $coupon->update($request->all());

        $notification = array(
            'message' => trans('panel.message.update'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('coupons.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return response()->json(['success' => true, 'message' => trans('panel.message.delete')], 200);
    }

    /**
     * update the status
     * @param  request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupon_id' => 'required|exists:coupons,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validation error occurred!',
            ], 422);
        }

        $coupon = Coupon::find($request->coupon_id);
        $coupon->coupon_status = 'cancelled';
        $coupon->save();

        return response()->json([
            'success' => true,
            'message' => trans('panel.message.status') ?? 'Status updated successfully!',
            'status'  => $coupon->coupon_status
        ]);
    }
}
