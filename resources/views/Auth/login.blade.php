@extends('Layout.publiclayout')
@section('title', 'Login')

@section('content')
    <section class="min-h-screen py-20 flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full mx-4">
            <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                <div class="text-center mb-10">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-primary inline-flex items-center">
                        <i class="fas fa-leaf mr-2 text-2xl"></i> Makhana Store
                    </a>
                    <h2 class="text-xl font-bold text-gray-900 mt-6">Welcome Back!</h2>
                    <p class="text-gray-500 text-sm mt-2">Login to manage your orders and cart.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 text-sm rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                            placeholder="yourname@example.com">
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Password</label>
                            <a href="#"
                                class="text-[10px] font-bold text-primary hover:underline uppercase tracking-wider">Forgot?</a>
                        </div>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-primary text-white py-4 rounded-md font-bold hover:bg-green-800 transition-colors shadow-sm active:scale-95 transform transition-transform">
                        Login Now
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                    <p class="text-sm text-gray-400">Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Sign up for
                            free</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection