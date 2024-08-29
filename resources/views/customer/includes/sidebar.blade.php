<div class="customer-leftside-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenux -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('home') }}" class="side-nav-link">
                    <i class="dripicons-view-thumb"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-itemcc">
                <a href="{{ route('customer.policies') }}" class="side-nav-link">
                    <i class="dripicons-suitcase"></i>
                    <span> Policies </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{ route('customer.claims') }}" class="side-nav-link">
                    <i class="dripicons-to-do"></i>
                    <span> Claims </span>
                </a>
            </li>

            <li class="side-nav-item {{ request()->is('transactions') || request()->is('transactions/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('customer.transactions') }}" class="side-nav-link">
                    <i class="dripicons-card"></i>
                    <span> Transactions </span>
                </a>
            </li>
            <li class="side-nav-item {{ request()->is('profile') || request()->is('profile/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('customer.profile') }}" class="side-nav-link">
                    <i class="dripicons-user"></i>
                    <span> Profile </span>
                </a>
            </li>
            <li class="side-nav-item {{ request()->is('change-password') || request()->is('change-password/*') ? 'menuitem-active' : '' }}">
                <a href="{{ route('customer.change-password') }}" class="side-nav-link">
                    <i class="dripicons-preview"></i>
                    <span> Change Password </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="{{ route('logout') }}" class="side-nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="dripicons-power"></i>
                    <span> Logout </span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                </form>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
