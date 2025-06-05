<?php

namespace App\Imports;

use App\Models\Coupon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CouponsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Coupon([
            'coupon_code'     => $row['couponcode'],
            'coupon_value'    => $row['coupon_value'],
            'coupon_expiry'   => $this->transformDate($row['coupon_expiry']),
            'remarks'         => $row['remarks'],
            'coupon_date'     => now(),
        ]);
    }

    private function transformDate($value)
    {
        // Try parsing DD-MM-YYYY format to YYYY-MM-DD
        $date = \DateTime::createFromFormat('d-m-Y', $value);

        return $date ? $date->format('Y-m-d') : null;
    }
}
