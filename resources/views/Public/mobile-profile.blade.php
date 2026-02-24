@extends('Layout.publiclayout')
@section('title', 'My Account')

@section('content')
    <section class="py-6 bg-gray-50 min-h-screen lg:hidden">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Header -->
            <div class="bg-primary text-white p-8 rounded-lg shadow-md mb-8 relative overflow-hidden">
                <div class="relative z-10 flex items-center gap-6">
                    <div
                        class="w-20 h-20 bg-white/20 rounded-md flex items-center justify-center text-white text-3xl font-black border border-white/30">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-black">{{ Auth::user()->name }}</h2>
                        <p class="text-white/60 text-sm">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Touch Menu -->
            <div class="space-y-4">
                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4">Manage Account</h4>

                <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                    <a href="{{ route('profile') }}"
                        class="flex items-center justify-between p-5 hover:bg-gray-50 transition-colors border-b border-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-50 text-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-900">Personal Information</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    </a>

                    <a href="{{ route('my.orders') }}"
                        class="flex items-center justify-between p-5 hover:bg-gray-50 transition-colors border-b border-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-50 text-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-box"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-900">My Orders</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    </a>

                    <a href="{{ route('cart') }}"
                        class="flex items-center justify-between p-5 hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-gray-50 text-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-900">My Bag</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                    </a>
                </div>

                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest px-4 mt-8">Support & Legal</h4>

                <div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden text-sm">
                    <a href="#" class="flex items-center justify-between p-5 border-b border-gray-50 text-gray-700">
                        <span>Terms & Conditions</span>
                        <i class="fas fa-arrow-right text-[10px] text-gray-300"></i>
                    </a>
                    <a href="#" class="flex items-center justify-between p-5 border-b border-gray-50 text-gray-700">
                        <span>Privacy Policy</span>
                        <i class="fas fa-arrow-right text-[10px] text-gray-300"></i>
                    </a>
                    <a href="#" class="flex items-center justify-between p-5 text-gray-700">
                        <span>Help Center</span>
                        <i class="fas fa-arrow-right text-[10px] text-gray-300"></i>
                    </a>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-50 text-red-600 py-5 rounded-lg font-black text-sm uppercase tracking-widest active:scale-95 transition-all">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection