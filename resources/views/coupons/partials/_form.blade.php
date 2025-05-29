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
        <input type="date" name="coupon_date" class="form-control @error('coupon_date') is-invalid @enderror" value="{{ old('coupon_date', $coupon->coupon_date ?? '') }}">
        @error('coupon_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="coupon_expiry" class="form-label">{{ __('Coupon Expiry') }}</label>
        <input type="date" name="coupon_expiry" class="form-control @error('coupon_expiry') is-invalid @enderror" value="{{ old('coupon_expiry', $coupon->coupon_expiry ?? '') }}">
        @error('coupon_expiry') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="coupon_status" class="form-label">{{ __('Coupon Status') }}</label>
        <select name="coupon_status" class="form-control @error('coupon_status') is-invalid @enderror" id="basicSelect">
            <option value="">Select</option>
            <option value="used" {{ old('coupon_status', $coupon->coupon_status ?? '') == 'used' ? 'selected' : '' }}>{{ __('Used') }}</option>
            <option value="notused" {{ old('coupon_status', $coupon->coupon_status ?? '') == 'notused' ? 'selected' : '' }}>{{ __('Not Used') }}</option>
            <option value="cancelled" {{ old('coupon_status', $coupon->coupon_status ?? '') == 'cancelled' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
        </select>
        @error('coupon_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="used_by" class="form-label">{{ __('Used By') }}</label>
        <input type="number" name="used_by" placeholder="{{ __('Enter user mobile') }}" class="form-control @error('used_by') is-invalid @enderror" value="{{ old('used_by', $coupon->used_by ?? '') }}">
        @error('used_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="status_date" class="form-label">{{ __('Status Date') }}</label>
        <input type="date" name="status_date" class="form-control @error('status_date') is-invalid @enderror" value="{{ old('status_date', $coupon->status_date ?? '') }}">
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
