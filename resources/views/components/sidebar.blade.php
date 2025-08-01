<aside class="sidebar-left">
    <!-- Branding Section -->
    <div class="logo-branding">
        <img src="{{ asset('images/expense-track-high-resolution-logo-transparent.png') }}" alt="Expense Track Logo">
        <h1>Expense Track</h1>
    </div>

    <!-- Navigation Section -->
    <nav class="navigation-links">
        <div class="links">
            <a wire:navigate @class(['active'=>request()->is('dashboard')]) href="/dashboard">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </div>
        <div class="links">
            <a wire:navigate @class(['active'=>request()->is('transaction')]) href="/transaction">
                <i class="fas fa-wallet"></i>
                Transaction
            </a>

        </div>
        <a wire:navigate @class(['profile-link', 'active'=>request()->is('profile')]) href="/profile">
            @if(Auth::user()->img_path)
                <img src="{{ asset('storage/' . Auth::user()->img_path) }}" alt="User Profile Image">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=FFFFFF&background=dc2626" alt="Profile photo">
            @endif
                <span>{{ Auth::user()->name }}</span>
        </a>

        <div class="links">
            <a href="/logout">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </nav>
    <div class="user-role">
        <span><i class="fas fa-user-tag"></i>{{ Auth::user()->type }}</span>
    </div>
</aside>