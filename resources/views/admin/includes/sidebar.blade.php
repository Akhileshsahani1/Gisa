<div class="leftside-menu">

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/gisa-logo.png') }}" alt="logo" height="60">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/gisa-logo-icon.jpg') }}" alt="logo" height="60">
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('admin.dashboard') }}" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm.png') }}" alt="logo" height="60">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            @can('Dashboard')
                <li class="side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                        <i class="dripicons-view-thumb"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
            @endcan

            @can('Leads')
                <li
                    class="side-nav-item {{ request()->is('admin/leads') || request()->is('admin/leads/*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin.leads.index') }}" class="side-nav-link">
                        <i class="dripicons-headset"></i>
                        <span> Leads</span>
                    </a>
                </li>
            @endcan

            @can('Customers')
                <li
                    class="side-nav-item {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin.customers.index') }}" class="side-nav-link">
                        <i class="dripicons-user"></i>
                        <span> Customers</span>
                    </a>
                </li>
            @endcan
            @can('Quoted Request')
                <li
                    class="side-nav-item {{ request()->is('admin/quoted-request') || request()->is('admin/quoted-request/*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin.quotations.quoted-request',['status'=>'quoted-request']) }}" class="side-nav-link">
                        <i class="dripicons-blog"></i>
                        <span> Quoted Request</span>
                    </a>
                </li>
            @endcan
            @can('Quotations')
                <li
                    class="side-nav-item {{ request()->is('admin/quotations') || request()->is('admin/quotations/*') ? 'menuitem-active' : '' }}">
                    <a href="{{ route('admin.quotations.index') }}" class="side-nav-link">
                        <i class="dripicons-blog"></i>
                        <span> Quotations</span>
                    </a>
                </li>
            @endcan

            @can('Policies')
                <li class="side-nav-item">
                    <a href="{{ route('admin.list.quotation-policies') }}" class="side-nav-link">
                        <i class="dripicons-list"></i>
                        <span> Policies</span>
                    </a>
                </li>
            @endcan

            @can('Dispatch Policies')
                <li class="side-nav-item">
                    <a href="{{ route('admin.dispatch.list') }}" class="side-nav-link">
                        <i class="dripicons-box"></i>
                        <span>Dispatch Policies</span>
                    </a>
                </li>
            @endcan

            @can('Renewal Policies')
                <li class="side-nav-item">
                    <a href="{{ route('admin.renewal.list') }}" class="side-nav-link">
                        <i class="dripicons-broadcast"></i>
                        <span>Renewal Policies</span>
                    </a>
                </li>
            @endcan

            @can('Claims')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarClaims" aria-expanded="false" aria-controls="sidebarClaims"
                        class="side-nav-link">
                        <i class="mdi mdi-folder-outline"></i>
                        <span> Claims </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarClaims">
                        <ul class="side-nav-second-level">


                            <li
                                class="side-nav-item {{ request()->is('admin/claims') || request()->is('admin/claims/*') ? 'menuitem-active' : '' }}">
                                <a href="{{ route('admin.claims.list', ['type' => 'motor']) }}" class="side-nav-link">
                                    <i class="dripicons-minus"></i>
                                    <span> Motor </span>
                                </a>
                            </li>

                            <li
                                class="side-nav-item {{ request()->is('admin/claims') || request()->is('admin/claims/*') ? 'menuitem-active' : '' }}">
                                <a href="{{ route('admin.claims.list', ['type' => 'non-motor']) }}" class="side-nav-link">
                                    <i class="dripicons-minus"></i>
                                    <span> Non Motor </span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
            @endcan

            @can('Defaults')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarDefault" aria-expanded="false" aria-controls="sidebarDefault"
                        class="side-nav-link">
                        <i class="dripicons-stack"></i>
                        <span> Master </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarDefault">
                        <ul class="side-nav-second-level">

                            @can('Policy')
                                <li
                                    class="side-nav-item {{ request()->is('admin/policies') || request()->is('admin/policies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.policies.index') }}" class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Product Type </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Insurance companies')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.insurance-companies.index') }}" class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Insurance Companies</span>
                                    </a>
                                </li>
                            @endcan

                            @can('Lead Status')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lead-status.index', ['type' => 'lead-status']) }}"
                                        class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Lead status </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Lead Type')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lead-status.index', ['type' => 'lead-type']) }}"
                                        class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Lead Type</span>
                                    </a>
                                </li>
                            @endcan

                            @can('Lead Source')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lead-status.index', ['type' => 'lead-source']) }}"
                                        class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Lead Source</span>
                                    </a>
                                </li>
                            @endcan

                            @can('Agencies')
                                <li
                                    class="side-nav-item {{ request()->is('admin/agency') || request()->is('admin/agency/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.agency.index') }}" class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Agencies</span>
                                    </a>
                                </li>
                            @endcan

                            @can('Lead Status')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lead-status.index', ['type' => 'ncb']) }}"
                                        class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> NCB </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Lead Status')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lead-status.index', ['type' => 'previous-ncb']) }}"
                                        class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Previous NCB </span>
                                    </a>
                                </li>
                            @endcan

                             @can('Courier Company')
                                <li
                                    class="side-nav-item {{ request()->is('admin/insurance-companies') || request()->is('admin/insurance-companies/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.lead-status.index', ['type' => 'courier-company']) }}"
                                        class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Courier Company </span>
                                    </a>
                                </li>
                            @endcan

                            @can('Expense Categories')
                            <li
                                class="side-nav-item {{ request()->is('admin/expense-categories') || request()->is('admin/expense-categories/*') ? 'menuitem-active' : '' }}">
                                <a href="{{ route('admin.expense-categories.index') }}" class="side-nav-link">
                                    <i class="dripicons-minus"></i>
                                    <span>Expense Categories</span>
                                </a>
                            </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endcan


            @can('Sales')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarSales" aria-expanded="false" aria-controls="sidebarSales"
                        class="side-nav-link">
                        <i class="mdi mdi-cash"></i>
                        <span> Accounts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSales">
                        <ul class="side-nav-second-level">

                            @can('Receipts')
                                <li
                                    class="side-nav-item {{ request()->is('admin/sales') || request()->is('admin/sales/*') ? 'menuitem-active' : '' }}">
                                    <a href="{{ route('admin.receipts.index') }}" class="side-nav-link">
                                        <i class="dripicons-minus"></i>
                                        <span> Receipts </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endcan

            @can('User Management')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarUserManagement" aria-expanded="false"
                        aria-controls="sidebarUserManagement" class="side-nav-link">
                        <i class="dripicons-user"></i>
                        <span> User Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarUserManagement">
                        <ul class="side-nav-second-level">
                            @can('Users')
                                <li>
                                    <a href="{{ route('admin.users.index') }}">Users</a>
                                </li>
                            @endcan

                            @can('Online Users')
                                <li>
                                    <a href="{{ route('admin.online.users') }}">Online Users</a>
                                </li>
                            @endcan

                            @can('Roles')
                                <li>
                                    <a href="{{ route('admin.roles.index') }}">Roles</a>
                                </li>
                            @endcan

                            @can('Permissions')
                                <li>
                                    <a href="{{ route('admin.permissions.index') }}">Permissions</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcan


            @can('Support')
                <li class="side-nav-item">
                    <a href="{{ route('admin.grievance.index') }}" class="side-nav-link">
                        <i class="dripicons-box"></i>
                        <span>Grievance</span>
                    </a>
                </li>
            @endcan


            @can('Reports')
            <li class="side-nav-item">
                <a href="{{ route('admin.reports.index') }}" class="side-nav-link">
                    <i class="dripicons-box"></i>
                    <span>Reports</span>
                </a>
            </li>
            @endcan

            @can('Expenses')
            <li class="side-nav-item">
                <a href="{{ route('admin.expenses.index') }}" class="side-nav-link">
                    <i class="dripicons-box"></i>
                    <span>Expenses</span>
                </a>
            </li>
            @endcan

            @can('Settings')
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarSettings" aria-expanded="false"
                        aria-controls="sidebarSettings" class="side-nav-link">
                        <i class="dripicons-gear"></i>
                        <span> Settings </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarSettings">
                        <ul class="side-nav-second-level">
                            @can('My Account Settings')
                                <li>
                                    <a href="{{ route('admin.password.form') }}">Change Password</a>
                                </li>
                            @endcan

                            @can('Change Password Settings')
                                <li>
                                    <a href="{{ route('admin.my-account.edit', Auth::guard('administrator')->id()) }}">My Account</a>
                                </li>
                            @endcan

                            @can('Company Detail Settings')
                                <li>
                                    <a href="{{ route('admin.company-details.form') }}">Company Setting</a>
                                </li>
                            @endcan

                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
        <div class="clearfix"></div>
    </div>

</div>
