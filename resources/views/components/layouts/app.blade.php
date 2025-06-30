<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }   
        .sidebar-active {
            @apply bg-primary/10 text-primary font-medium;
        }
        .menu-item-hover {
            @apply hover:bg-base-200 transition-all duration-200;
        }
    </style>
</head>
<body class="min-h-screen font-sans antialiased bg-gray-50">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden bg-white border-b border-gray-200 shadow-sm z-50">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer h-6 w-6 text-gray-700" />
            </label>
        </x-slot:actions> 
    </x-nav>

    {{-- MAIN --}}
    <x-main>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-white border-r border-gray-200 shadow-sm lg:shadow-none lg:bg-inherit pl-0">

            {{-- BRAND --}}
            <div class="py-6 pr-5 border-b border-gray-200">
                
                <img src="{{ asset('storage/images/user/logo.png') }}" alt="Logo" class="h-10 mb-2">
                <p class="text-xs text-gray-500 mt-2">Borrowing Management System</p>
            </div>

            {{-- MENU --}}
            <x-menu activate-by-route class="pt-4 pr-3 pl-0">

                <div class="mb-2 pr-3">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Main</h3>
                </div>

                <x-menu-item title="View Items" icon="o-rectangle-stack" link="/fetch" class="menu-item-hover rounded-lg mb-1 py-2" active-class="sidebar-active" />
                <x-menu-item title="Create Item" icon="o-plus-circle" link="/form" class="menu-item-hover rounded-lg mb-1 py-2" active-class="sidebar-active" />
                <x-menu-item title="View History" icon="o-clock" link="/logs" class="menu-item-hover rounded-lg mb-1 py-2" active-class="sidebar-active" />

                <div class="my-3 pr-3">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Administration</h3>
                </div>

                <x-menu-item title="Create Admin" icon="o-user-plus" link="/register" class="menu-item-hover rounded-lg mb-1 py-2" active-class="sidebar-active" />
                <x-menu-item title="Reports" icon="o-chart-bar" link="/reports" class="menu-item-hover rounded-lg mb-1 py-2" active-class="sidebar-active" />
                

                {{-- User --}}
                @if($user = auth()->user())
                    <div class="mt-auto pt-5">
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <x-list-item :item="$user" value="name" sub-value="email" no-separator class="bg-gray-100 rounded-lg shadow-sm p-2">
                                <x-slot:avatar>
                                    <div class="bg-primary/20 text-primary font-semibold w-10 h-10 rounded-full flex items-center justify-center">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                </x-slot:avatar>
                                <x-slot:actions>
                                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-circle btn-ghost btn-sm" title="Log out">
                                            <x-icon name="o-power" class="h-5 w-5 text-red-500" />
                                        </button>
                                    </form>
                                </x-slot:actions>
                            </x-list-item>
                        </div>
                    </div>
                @endif
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            <div class="flex flex-col min-h-[calc(100vh-64px)]">
                <div class="flex-grow p-4 lg:p-6">
                    {{ $slot }}
                </div>
                
                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200 p-4 text-center text-sm text-gray-500 w-full">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </footer>
            </div>
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast position="bottom-right" />
@stack('scripts')
</body>
</html>