<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Makhana Sell</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1a4d2e',
                        secondary: '#4f6f52',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 flex overflow-hidden">
    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 bg-primary text-white w-64 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col">
        <div class="p-6 border-b border-white/10 flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-lg">
                <i class="fas fa-cube text-xl"></i>
            </div>
            <span class="font-black text-lg tracking-tight uppercase">Admin Panel</span>
        </div>

        <nav class="flex-1 overflow-y-auto p-4 space-y-2 mt-4">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white font-bold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-chart-line text-sm w-5"></i>
                <span class="text-sm">Dashboard</span>
            </a>
            <div class="pt-4 pb-2">
                <span class="px-4 text-[10px] font-bold text-white/30 uppercase tracking-widest">Inventory
                    Management</span>
            </div>
            <a href="{{ route('admin.categories') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.categories*') ? 'bg-white/10 text-white font-bold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-folder-tree text-sm w-5"></i>
                <span class="text-sm">Categories</span>
            </a>
            <a href="{{ route('admin.products') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.products*') ? 'bg-white/10 text-white font-bold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-shopping-basket text-sm w-5"></i>
                <span class="text-sm">Products</span>
            </a>
            <div class="pt-4 pb-2">
                <span class="px-4 text-[10px] font-bold text-white/30 uppercase tracking-widest">Sales & Orders</span>
            </div>
            <a href="{{ route('admin.orders') }}"
                class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.orders*') ? 'bg-white/10 text-white font-bold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <i class="fas fa-truck-loading text-sm w-5"></i>
                <span class="text-sm">Orders</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-all text-white/60 hover:bg-red-500/20 hover:text-red-400 font-bold">
                    <i class="fas fa-sign-out-alt text-sm w-5"></i>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 lg:ml-64 h-screen">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between sticky top-0 z-40">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h2 class="text-lg font-bold text-gray-800">@yield('title')</h2>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-xs font-bold text-primary hover:underline" target="_blank">
                    <i class="fas fa-eye mr-1"></i> View Shop
                </a>
                <div
                    class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary text-xs font-bold uppercase border border-primary/20">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            @if(session('success'))
                <div
                    class="mb-6 p-4 bg-green-50 border border-green-100 text-primary text-sm font-bold rounded-lg flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div
                    class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 text-sm font-bold rounded-lg flex items-center gap-3">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('admin_content')
        </div>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }
    </script>
</body>

</html>