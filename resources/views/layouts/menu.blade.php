{{-- Dashboard --}}
<li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}" class="d-flex align-items-center">
        <i data-feather="home"></i>
        <span class="menu-title text-truncate">{{ __('layout.dashboard') }}</span>
    </a>
</li>

{{-- Sales --}}
<li class="nav-item has-sub {{ Request::is('sale-invoices*') ? 'open' : '' }}">
    <a href="javascript:void(0)" class="d-flex align-items-center">
        <i data-feather="shopping-cart"></i>
        <span class="menu-title text-truncate">{{ __('layout.sales') }}</span>
    </a>
    <ul class="menu-content">
        <li class="{{ Request::is('sale-invoices/create') ? 'active' : '' }}">
            <a href="{{ route('saleInvoices.create') }}" class="d-flex align-items-center">
                <i data-feather="plus-circle"></i>
                <span class="menu-item text-truncate">{{ __('layout.new_sale_invoice') }}</span>
            </a>
        </li>
        <li class="{{ Request::is('sale-invoices') ? 'active' : '' }}">
            <a href="{{ route('saleInvoices.index') }}" class="d-flex align-items-center">
                <i data-feather="list"></i>
                <span class="menu-item text-truncate">{{ __('layout.sales_history') }}</span>
            </a>
        </li>
    </ul>
</li>

{{-- Purchases --}}
<li class="nav-item has-sub {{ Request::is('purchase-invoices*') ? 'open' : '' }}">
    <a href="javascript:void(0)" class="d-flex align-items-center">
        <i data-feather="truck"></i>
        <span class="menu-title text-truncate">{{ __('layout.purchases') }}</span>
    </a>
    <ul class="menu-content">
        <li class="{{ Request::is('purchase-invoices/create') ? 'active' : '' }}">
            <a href="{{ route('purchaseInvoices.create') }}" class="d-flex align-items-center">
                <i data-feather="plus-circle"></i>
                <span class="menu-item text-truncate">{{ __('layout.new_purchase_invoice') }}</span>
            </a>
        </li>
        <li class="{{ Request::is('purchase-invoices') ? 'active' : '' }}">
            <a href="{{ route('purchaseInvoices.index') }}" class="d-flex align-items-center">
                <i data-feather="list"></i>
                <span class="menu-item text-truncate">{{ __('layout.purchase_history') }}</span>
            </a>
        </li>
    </ul>
</li>

{{-- Customers --}}
<li class="nav-item {{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{{ route('customers.index') }}" class="d-flex align-items-center">
        <i data-feather="users"></i>
        <span class="menu-title text-truncate">{{ __('layout.customers') }}</span>
    </a>
</li>

{{-- Suppliers --}}
<li class="nav-item {{ Request::is('suppliers*') ? 'active' : '' }}">
    <a href="{{ route('suppliers.index') }}" class="d-flex align-items-center">
        <i data-feather="briefcase"></i>
        <span class="menu-title text-truncate">{{ __('layout.suppliers') }}</span>
    </a>
</li>

{{-- Inventory --}}
<li class="nav-item has-sub {{ Request::is('products*', 'categories*') ? 'open' : '' }}">
    <a href="javascript:void(0)" class="d-flex align-items-center">
        <i data-feather="archive"></i>
        <span class="menu-title text-truncate">{{ __('layout.inventory') }}</span>
    </a>
    <ul class="menu-content">
        <li class="{{ Request::is('products*') ? 'active' : '' }}">
            <a href="{{ route('products.index') }}" class="d-flex align-items-center">
                <i data-feather="package"></i>
                <span class="menu-item text-truncate">{{ __('layout.products') }}</span>
            </a>
        </li>
        <li class="{{ Request::is('categories*') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}" class="d-flex align-items-center">
                <i data-feather="tag"></i>
                <span class="menu-item text-truncate">{{ __('layout.categories') }}</span>
            </a>
        </li>
    </ul>
</li>

{{-- Treasury --}}
<li class="nav-item has-sub {{ Request::is('treasury-transactions*', 'installments*') ? 'open' : '' }}">
    <a href="javascript:void(0)" class="d-flex align-items-center">
        <i data-feather="dollar-sign"></i>
        <span class="menu-title text-truncate">{{ __('layout.treasury') }}</span>
    </a>
    <ul class="menu-content">
        <li class="{{ Request::is('treasury-transactions') ? 'active' : '' }}">
            <a href="{{ route('treasuryTransactions.index') }}" class="d-flex align-items-center">
                <i data-feather="repeat"></i>
                <span class="menu-item text-truncate">{{ __('layout.transactions') }}</span>
            </a>
        </li>
        <li class="{{ Request::is('treasury-transactions/create') ? 'active' : '' }}">
            <a href="{{ route('treasuryTransactions.create') }}" class="d-flex align-items-center">
                <i data-feather="arrow-down-circle"></i>
                <span class="menu-item text-truncate">{{ __('layout.deposit_withdraw') }}</span>
            </a>
        </li>
        <li class="{{ Request::is('installments') ? 'active' : '' }}">
            <a href="{{ route('installments.index') }}" class="d-flex align-items-center">
                <i data-feather="credit-card"></i>
                <span class="menu-item text-truncate">{{ __('layout.installments') }}</span>
            </a>
        </li>
        <li class="{{ Request::is('installments/overdue*') ? 'active' : '' }}">
            <a href="{{ route('installments.overdue') }}" class="d-flex align-items-center">
                <i data-feather="alert-circle"></i>
                <span class="menu-item text-truncate">{{ __('layout.overdue_installments') }}</span>
            </a>
        </li>
    </ul>
</li>

{{-- User Management --}}
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a href="{{ route('users.index') }}" class="d-flex align-items-center">
        <i data-feather="user-check"></i>
        <span class="menu-title text-truncate">{{ __('layout.user_management') }}</span>
    </a>
</li>
