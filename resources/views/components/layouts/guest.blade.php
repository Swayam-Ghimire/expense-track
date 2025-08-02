<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Track, Expenses, Finance Tracker, Students, Employee, Expense Trend">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Expense Track' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/form.css', 'resources/js/app.js'])
</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <header class="header">
            <nav class="navbar">
                <div class="logo">
                    <img src="{{ asset('images/expense-track-high-resolution-logo-transparent.png') }}" alt="Expense">
                    <h1>Expense Track</h1>
                </div>
                <livewire:navigation.menu />
                <ul class="nav-links">
                    @guest
                        <li><a wire:navigate @class(['nav-btn', 'active'=>request()->is('/')]) href="/">Home</a></li>
                        <li><a wire:navigate @class(['nav-btn', 'active'=>request()->is('login')]) href="/login"
                                class="nav-btn">Login</a></li>
                        <li><a wire:navigate @class(['nav-btn', 'active'=>request()->is('register')]) href="/register"
                                class="nav-btn">Get Started</a></li>
                    @endguest
                    @auth
                        <li><a wire:navigate class='nav-btn' href="/dashboard">Dashboard</a></li>
                    @endauth
                </ul>
            </nav>
        </header>
        <livewire:notification.message />
        <main>
            {{ $slot }}
        </main>
        <!-- Footer -->
        <x-footer />
    </div>
</body>

</html>