<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ env('APP_NAME', 'Makhana Store') }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#064e3b', // Dark Green
                        secondary: '#f9fafb', // White/Off-white
                    },
                    fontFamily: {
                        outfit: ['Outfit', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>

<body class="bg-secondary text-gray-800 pb-20 md:pb-0">

    <!-- Sticky Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-primary flex items-center">
                        <i class="fas fa-leaf mr-2 text-xl"></i>
                        <span>Makhana<span class="text-gray-400 font-light italic">Store</span></span>
                    </a>
                </div>
                <!-- Desktop Nav -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}"
                        class="text-gray-600 hover:text-primary font-medium transition-colors">Home</a>
                    <a href="{{ route('items') }}"
                        class="text-gray-600 hover:text-primary font-medium transition-colors">Products</a>
                    @auth
                        <a href="{{ route('cart') }}"
                            class="text-gray-600 hover:text-primary font-medium transition-colors">Cart</a>
                        <div class="relative group">
                            <button class="flex items-center text-gray-600 hover:text-primary font-medium">
                                <i class="fas fa-user-circle mr-2 text-lg"></i>
                                {{ Auth::user()->name }}
                            </button>
                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 w-48 mt-2 py-2 bg-white rounded-md shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                                <a href="{{ route('profile') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">My Profile</a>
                                <a href="{{ route('my.orders') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">My Orders</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="px-5 py-2 bg-primary text-white rounded-md font-bold hover:bg-green-800 transition-colors">Sign
                            Up</a>
                    @endauth
                </div>
                <div class="flex items-center space-x-4 md:hidden">
                    @auth
                        <a href="{{ route('cart') }}" class="relative text-gray-600 hover:text-primary transition-colors">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span
                                class="absolute -top-2 -right-2 bg-primary text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">
                                {{ \App\Models\CartItem::where('user_id', Auth::id())->where('type', 'cart')->count() }}
                            </span>
                        </a>
                        <a href="{{ route('account.mobile') }}"
                            class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary text-xs font-bold uppercase transition-colors">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary transition-colors">
                            <i class="fas fa-user text-xl"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-12 hidden md:block mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <h3 class="text-lg font-bold text-primary mb-4">Makhana Store</h3>
                    <p class="text-gray-500 text-sm">Premium quality handpicked fox nuts for your healthy lifestyle.
                        Natural, organic, and delicious.</p>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-primary text-sm">Home</a></li>
                        <li><a href="{{ route('items') }}" class="text-gray-500 hover:text-primary text-sm">All
                                Products</a></li>
                        <li><a href="{{ route('cart') }}" class="text-gray-500 hover:text-primary text-sm">My Cart</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Connect</h4>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                <p class="text-gray-400 text-xs">&copy; {{ date('Y') }} Makhana Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <div
        class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 flex justify-around items-center h-16 z-50">
        <a href="{{ route('home') }}"
            class="flex flex-col items-center {{ request()->routeIs('home') ? 'text-primary' : 'text-gray-400' }}">
            <i class="fas fa-home text-xl"></i>
            <span class="text-[10px] mt-1 font-medium">Home</span>
        </a>
        <a href="{{ route('items') }}"
            class="flex flex-col items-center {{ request()->routeIs('items') ? 'text-primary' : 'text-gray-400' }}">
            <i class="fas fa-search text-xl"></i>
            <span class="text-[10px] mt-1 font-medium">Browse</span>
        </a>
        <a href="{{ route('cart') }}"
            class="flex flex-col items-center {{ request()->routeIs('cart') ? 'text-primary' : 'text-gray-400' }}">
            <i class="fas fa-shopping-basket text-xl"></i>
            <span class="text-[10px] mt-1 font-medium">Cart</span>
        </a>
        @auth
            <form action="{{ route('logout') }}" method="POST" id="logout-form-mobile" class="hidden">@csrf</form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                class="flex flex-col items-center text-gray-400">
                <i class="fas fa-sign-out-alt text-xl"></i>
                <span class="text-[10px] mt-1 font-medium">Logout</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="flex flex-col items-center text-gray-400">
                <i class="fas fa-user-circle text-xl"></i>
                <span class="text-[10px] mt-1 font-medium">Login</span>
            </a>
        @endauth
    </div>

</body>

</html>