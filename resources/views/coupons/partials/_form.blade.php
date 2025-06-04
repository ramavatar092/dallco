<div class="row">
    <div class="mb-3 col-md-6">
        <label for="coupon_code" class="form-label">{{ __('Coupon Code') }}</label>
        <input type="text" name="coupon_code" placeholder="{{ __('Enter coupon code') }}" class="form-control @error('coupon_code') is-invalid @enderror" value="{{ old('coupon_code', $coupon->coupon_code ?? '') }}">
        @error('coupon_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="coupon_value" class="form-label">{{ __('Coupon Value') }}</label>
        <input type="number" name="coupon_value" step="0.01" placeholder="{{ __('Enter coupon value') }}" class="form-control @error('coupon_value') is-invalid @enderror" value="{{ old('coupon_value', $coupon->coupon_value ?? '') }}">
        @error('coupon_value') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="coupon_date" class="form-label">{{ __('Coupon Date') }}</label>
        <input type="date" name="coupon_date" class="form-control datepicker @error('coupon_date') is-invalid @enderror" value="{{ old('coupon_date', $coupon->coupon_date ?? '') }}">
        @error('coupon_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="coupon_expiry" class="form-label">{{ __('Coupon Expiry') }}</label>
        <input type="date" name="coupon_expiry" class="form-control @error('coupon_expiry') is-invalid @enderror" value="{{ old('coupon_expiry', $coupon->coupon_expiry ?? '') }}">
        @error('coupon_expiry') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="status_date" class="form-label">{{ __('Status Date') }}</label>
        <input type="date" name="status_date" class="form-control datepicker @error('status_date') is-invalid @enderror" value="{{ old('status_date', $coupon->status_date ?? '') }}">
        @error('status_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="remarks" class="form-label">{{ __('Remarks') }}</label>
        <input type="text" name="remarks" placeholder="{{ __('Enter remarks') }}" class="form-control @error('remarks') is-invalid @enderror" value="{{ old('remarks', $coupon->remarks ?? '') }}">
        @error('remarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-12">
        <button type="submit" class="btn btn-success">
            {{ isset($coupon) && $coupon->exists ? __('Update') : __('Save') }}
        </button>
        <a href="{{ route('coupons.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>
