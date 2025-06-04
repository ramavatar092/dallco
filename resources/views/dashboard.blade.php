{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Dashboard</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="card text-white bg-primary shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Users</h6>
                                        <h4 class="card-text mb-0">{{ $totalUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Scans</h6>
                                        <h4 class="card-text mb-0">{{ $totalScans }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Scan Amount</h6>
                                        <h4 class="card-text mb-0">₹{{ $totalScanAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-primary shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Payout</h6>
                                        <h4 class="card-text mb-0">₹{{ $totalPayout }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-4 mb-3">Last 30 Days</h4>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-white bg-info shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">New Users</h6>
                                        <h4 class="card-text mb-0">{{ $newUsers }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-info shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Scans</h6>
                                        <h4 class="card-text mb-0">{{ $scansLast30 }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-info shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Scan Amount</h6>
                                        <h4 class="card-text mb-0">₹{{ $amountLast30 }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white bg-info shadow-sm">
                                    <div class="card-body text-center">
                                        <h6 class="card-title">Total Payout</h6>
                                        <h4 class="card-text mb-0">₹{{ $payoutLast30 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Dashboard Analytics end -->
@endsection
