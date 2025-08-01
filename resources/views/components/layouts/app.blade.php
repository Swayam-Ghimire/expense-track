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
    @vite(['resources/css/home.css', 'resources/css/createform.css'])
</head>

<body>
    <div class="wrapper">
        <x-sidebar />
        <section class="main-right">
            {{ $slot }}
        </section>
    </div>
    <x-footer />

</body>

</html>