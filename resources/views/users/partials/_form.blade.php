<div class="row">
    <div class="mb-3 col-md-6">
        <label for="user_mobile" class="form-label">{{ __('Mobile Number') }}</label>
        <input type="text" name="user_mobile" placeholder="{{ __('Enter mobile number') }}" class="form-control @error('user_mobile') is-invalid @enderror" value="{{ old('user_mobile', $user->user_mobile ?? '') }}">
        @error('user_mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text" name="name" placeholder="{{ __('Enter full name') }}" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name ?? '') }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="city" class="form-label">{{ __('City') }}</label>
        <input type="text" name="city" placeholder="{{ __('Enter city') }}" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $user->city ?? '') }}">
        @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="state" class="form-label">{{ __('State') }}</label>
        <input type="text" name="state" placeholder="{{ __('Enter state') }}" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $user->state ?? '') }}">
        @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="pincode" class="form-label">{{ __('Pincode') }}</label>
        <input type="text" name="pincode" placeholder="{{ __('Enter pincode') }}" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode', $user->pincode ?? '') }}">
        @error('pincode') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="register_date" class="form-label">{{ __('Register Date') }}</label>
        <input type="date" name="register_date" placeholder="{{ __('Select register date') }}" class="form-control @error('register_date') is-invalid @enderror" value="{{ old('register_date', $user->register_date ?? '') }}">
        @error('register_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="bank_ifsc" class="form-label">{{ __('Bank IFSC') }}</label>
        <input type="text" name="bank_ifsc" placeholder="{{ __('Enter bank IFSC code') }}" class="form-control @error('bank_ifsc') is-invalid @enderror" value="{{ old('bank_ifsc', $user->bank_ifsc ?? '') }}">
        @error('bank_ifsc') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="account_number" class="form-label">{{ __('Account Number') }}</label>
        <input type="text" name="account_number" placeholder="{{ __('Enter account number') }}" class="form-control @error('account_number') is-invalid @enderror" value="{{ old('account_number', $user->account_number ?? '') }}">
        @error('account_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="upi_code" class="form-label">{{ __('UPI Code') }}</label>
        <input type="text" name="upi_code" placeholder="{{ __('Enter UPI code') }}" class="form-control @error('upi_code') is-invalid @enderror" value="{{ old('upi_code', $user->upi_code ?? '') }}">
        @error('upi_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="mobile_notification_code" class="form-label">{{ __('Mobile Notification Code') }}</label>
        <input type="text" name="mobile_notification_code" placeholder="{{ __('Enter mobile notification code') }}" class="form-control @error('mobile_notification_code') is-invalid @enderror" value="{{ old('mobile_notification_code', $user->mobile_notification_code ?? '') }}">
        @error('mobile_notification_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="account_balance" class="form-label">{{ __('Account Balance') }}</label>
        <input type="number" step="0.01" name="account_balance" placeholder="{{ __('Enter account balance') }}" class="form-control @error('account_balance') is-invalid @enderror" value="{{ old('account_balance', $user->account_balance ?? '') }}">
        @error('account_balance') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="address" class="form-label">{{ __('Address') }}</label>
        <textarea name="address" placeholder="{{ __('Enter address') }}" class="form-control @error('address') is-invalid @enderror">{{ old('address', $user->address ?? '') }}</textarea>
        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-12">
        <button type="submit" class="btn btn-success">{{ isset($user) && $user->exists ? __('Update User') : __('Create User') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>
