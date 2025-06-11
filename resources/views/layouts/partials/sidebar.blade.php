<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/logo.png" /></div>
                    <h2 class="brand-text mb-0">{{ config('app.name') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="bx bx-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="bx-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('users.*') || request()->routeIs('messages.*') ? 'active open' : '' }}">
                <a href="#"><i class="bx bx-user-plus"></i><span class="menu-title">User</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}"><span class="menu-item">List</span></a>
                    </li>
                    <li class="{{ request()->routeIs('users.details.export') ? 'active' : '' }}">
                        <a href="{{ route('users.details.export') }}"><span class="menu-item">User Details Export</span></a>
                    </li>
                    <li class="{{ request()->routeIs('messages.index') ? 'active' : '' }}">
                        <a href="{{ route('messages.index') }}"><span class="menu-item">User Message List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->routeIs('coupons.*') ? 'active open' : '' }}">
                <a href="#"><i class="bx bx-lock-open-alt"></i><span class="menu-title">Coupon Management</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('coupons.index') ? 'active' : '' }}">
                        <a href="{{ route('coupons.index') }}"><span class="menu-item">List</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->routeIs('payouts') || request()->routeIs('pending.payouts') || request()->routeIs('previous.payouts') ? 'active open' : '' }}">
                <a href="#"><i class="bx bx-building"></i><span class="menu-title">Payouts</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('payouts') ? 'active' : '' }}">
                        <a href="{{ route('payouts') }}"><span class="menu-item">List</span></a>
                    </li>
                    <li class="{{ request()->routeIs('pending.payouts') ? 'active' : '' }}">
                        <a href="{{ route('pending.payouts') }}"><span class="menu-item">Pending Payouts</span></a>
                    </li>
                    <li class="{{ request()->routeIs('previous.payouts') ? 'active' : '' }}">
                        <a href="{{ route('previous.payouts') }}"><span class="menu-item">Previous Payouts</span></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ request()->routeIs('scan-logs.*') ? 'active open' : '' }}">
                <a href="#"><i class="bx bx-lock-open-alt"></i><span class="menu-title">Scan Logs</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('scan-logs.index') ? 'active' : '' }}">
                        <a href="{{ route('scan-logs.index') }}"><span class="menu-item">List</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
