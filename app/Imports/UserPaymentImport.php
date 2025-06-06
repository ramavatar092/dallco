<?php

namespace App\Imports;

use App\Models\Payout;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserPaymentImport implements ToModel, WithHeadingRow
{
    /**
     * Process each row from the Excel file.
     */
    public function model(array $row)
    {
        $id = $row['id'];

        // Skip if no ID
        if (empty($id)) {
            return null;
        }

        // Fetch payout by ID
        $payout = Payout::find($id);

        // Update only if the payout exists and is unpaid
        if ($payout) {
            $payout->transfer_date = $this->transformDate($row['transfer_date']);
            $payout->transfer_mode = $row['transfer_mode'] ?? null;
            $payout->transfer_remarks = $row['remarks'] ?? null;
            $payout->status = 'paid';
            $payout->save();
        }

        return null; // No new model created
    }

    /**
     * Convert date from DD-MM-YYYY to YYYY-MM-DD.
     */
    private function transformDate(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        $date = \DateTime::createFromFormat('d-m-Y', trim($value));
        return $date ? $date->format('Y-m-d') : null;
    }
}
