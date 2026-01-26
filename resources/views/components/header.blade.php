<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Noto+Sans+JP:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>
    <header class="header">
        <div class="logo">Read Tracker</div>
        <nav class="nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="#">ダッシュボード</a></li>
                <li class="nav-item"><a href="/books/" >My 本棚</a></li>
                <li class="nav-item"><a href="#" >読書ログ</a></li>
            </ul>
        </nav>
    </header>
    <main class="p-10 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
