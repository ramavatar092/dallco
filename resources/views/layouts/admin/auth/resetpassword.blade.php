@extends('layouts.base')
@section('content')
<!-- BEGIN: Content-->
<section class="row flexbox-container">
    <div class="col-xl-7 col-10">
        <div class="card bg-authentication mb-0">
            <div class="row m-0">
                <!-- left section-login -->
                <div class="col-md-6 col-12 px-0">
                    <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="text-center mb-2">Reset your Password</h4>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="mb-2" method="POST" action="{{ route('change-password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="text-bold-600" for="currentPassword">Current Password</label>
                                        <input type="password" name="current_password" class="form-control" id="currentPassword" placeholder="Enter your current password" required autocomplete="current-password">
                                        @error('current_password') 
                                            <small class="text-danger">{{ $message }}</small> 
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="text-bold-600" for="newPassword">New Password</label>
                                        <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="Enter a new password" required autocomplete="new-password">
                                        @error('new_password') 
                                            <small class="text-danger">{{ $message }}</small> 
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2">
                                        <label class="text-bold-600" for="confirmPassword">Confirm New Password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control" id="confirmPassword" placeholder="Confirm your new password" required autocomplete="new-password">
                                        @error('new_password_confirmation') 
                                            <small class="text-danger">{{ $message }}</small> 
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary glow position-relative w-100">
                                        Reset my password
                                        <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <img class="img-fluid" src="../../../app-assets/images/pages/reset-password.png" alt="branding logo">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END: Content-->
@endsection
