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
</head>
<body>
    {{-- <div class=""></div>
    <div class="bg-white lg:pb-12">
      <div class="mx-auto max-w-screen-2xl px-4 md:px-8"> --}}
        <header class="flex items-center justify-between py-4 md:p-8 bg-green-50">
            <!-- logo - start -->
            <a href="/" class="inline-flex items-center gap-2.5 text-2xl font-bold text-black md:text-3xl" aria-label="logo">
                Read Tracker
            </a>
            <!-- logo - end -->

            <!-- nav - start -->
            <nav class="hidden gap-12 lg:flex">
                <a href="#" class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">ダッシュボード</a>
                <a href="/books" class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">My 本棚</a>
                <a href="#" class="text-lg font-semibold text-gray-600 transition duration-100 hover:text-indigo-500 active:text-indigo-700">読書ログ</a>
            </nav>
            <!-- nav - end -->
    </header>
    <main class="p-10 bg-slate-50 min-h-screen">
