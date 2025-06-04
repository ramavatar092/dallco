<?php

namespace App\Imports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BulkCancelCouponsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Sanitize input
        $couponCode = trim($row['couponcode'] ?? '');

        if (empty($couponCode)) {
            return null;
        }

        // Find and update the coupon if status is 'notused'
        $coupon = Coupon::where('coupon_code', $couponCode)->first();

        if ($coupon && $coupon->coupon_status === 'notused') {
            $coupon->coupon_status = 'cancelled';
            $coupon->remarks = $row['remarks'] ?? null;
            $coupon->save();
        }

        return null; // No new model is returned because we only update
    }
}
