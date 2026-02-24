@extends('Layout.publiclayout')
@section('title', 'Register')

@section('content')
    <section class="min-h-screen py-20 flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full mx-4">
            <div class="bg-white p-8 rounded-md border border-gray-100 shadow-sm">
                <div class="text-center mb-10">
                    <a href="{{ route('home') }}" class="text-3xl font-bold text-primary inline-flex items-center">
                        <i class="fas fa-leaf mr-2 text-2xl"></i> Makhana Store
                    </a>
                    <h2 class="text-xl font-bold text-gray-900 mt-6">Create an Account</h2>
                    <p class="text-gray-500 text-sm mt-2">Join us for healthy and crunchy snacks.</p>
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

                <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                            placeholder="Full Name">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                            placeholder="yourname@example.com">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Password</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                placeholder="••••••••">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Confirm</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-3 rounded-md border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-sm"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-start mt-2">
                        <input id="terms" type="checkbox" required
                            class="mt-1 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-xs text-gray-500 leading-relaxed">
                            I agree to the <a href="#" class="text-primary font-bold">Terms of Service</a> and <a href="#"
                                class="text-primary font-bold">Privacy Policy</a>.
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary text-white py-4 rounded-md font-bold hover:bg-green-800 transition-colors shadow-sm active:scale-95 transform transition-transform">
                        Create Account
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                    <p class="text-sm text-gray-400">Already have an account?
                        <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection