<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A simple overview of your tasks, schedule, and profile.">
    <title>@yield('title', 'Welcome') | Tasks for Today</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('welcome') }}">
                <span class="brand-icon" aria-hidden="true">T</span>
                <span>Tasks for Today<span class="brand-subtitle">A little structure for your day.</span></span>
            </a>
            <nav class="navigation" aria-label="Main navigation">
                <a href="{{ route('welcome') }}" @if(request()->routeIs('welcome')) aria-current="page" @endif>Welcome</a>
                <a href="{{ route('tasks.index') }}" @if(request()->routeIs('tasks.index')) aria-current="page" @endif>Task List</a>
                <a href="{{ route('profile') }}" @if(request()->routeIs('profile')) aria-current="page" @endif>Profile</a>
                <a href="{{ route('about') }}" @if(request()->routeIs('about')) aria-current="page" @endif>About</a>
            </nav>
        </div>
    </header>

    <main id="main" class="container main-content">
        @yield('content')
    </main>

    <footer class="container site-footer">
        <span>Tasks for Today</span>
        <span>Developed by Carl Vincent Tenorio &middot; {{ date('Y') }}</span>
    </footer>
</body>
</html>
