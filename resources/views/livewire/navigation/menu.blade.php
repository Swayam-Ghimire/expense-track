<div>
    <button class="mobile-menu-toggle" wire:click="toggleMenu">
        <i class="fas fa-bars"></i>
    </button>
    @if($showMobileMenu)
        <div class="show">
            <ul class="nav-links">
                    <li><a wire:navigate @class(['nav-btn', 'active'=>request()->is('/')]) href="/">Home</a></li>
                    <li><a wire:navigate @class(['nav-btn', 'active'=>request()->is('login')]) href="/login"
                            class="nav-btn">Login</a></li>
                    <li><a wire:navigate @class(['nav-btn', 'active'=>request()->is('register')]) href="/register"
                            class="nav-btn">Get Started</a></li>

            </ul>
        </div>
    @endif
</div>
