<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | NexFix</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 fixed top-0 left-0 h-full bg-white shadow-lg hidden md:block">
        <div class="p-4 text-2xl font-bold text-blue-600">NexFix</div>
        <nav class="mt-6 space-y-2">
            @yield('sidebar')
        </nav>
    </aside>

    <!-- Main content area -->
    <div class="md:ml-64">
        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">@yield('page_title')</h1>
            <div>
                <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-blue-600">Profile</a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
