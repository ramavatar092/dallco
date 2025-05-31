<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'user_mobile'     => $this->user_mobile,
            'name'            => $this->name,
            'city'            => $this->city,
            'state'           => $this->state,
            'pincode'         => $this->pincode,
            'address'         => $this->address,
            'register_date'   => $this->register_date,
            'bank_ifsc'       => $this->bank_ifsc,
            'account_number'  => $this->account_number,
            'upi_code'        => $this->upi_code,
            'account_balance' => $this->account_balance,
            'total_payout'    => $this->total_payout,
            'total_earnings'  => $this->total_earnings,
            'remarks'         => $this->remarks,
            'status'          => $this->status,
            'created'         => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
