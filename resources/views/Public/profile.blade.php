@extends('Layout.publiclayout')
@section('title', 'My Profile')

@section('content')
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-4 border-primary pl-4">Account Settings</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar (Hidden on Mobile, shown on Desktop) -->
                <aside class="hidden lg:block w-72 flex-shrink-0">
                    @include('Public.Partials.profile-sidebar')
                </aside>

                <!-- Main Content -->
                <div class="flex-1 space-y-6">
                    <div class="bg-white p-6 md:p-10 rounded-lg border border-gray-100 shadow-sm">
                        <div class="flex flex-col md:flex-row items-center gap-6 mb-10 pb-10 border-b border-gray-100">
                            <div
                                class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center text-primary text-3xl font-black">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="text-center md:text-left">
                                <h2 class="text-2xl font-black text-gray-900">{{ Auth::user()->name }}</h2>
                                <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
                                <span
                                    class="inline-block mt-2 px-3 py-1 bg-green-100 text-primary text-[10px] font-black uppercase rounded-full">Explorer
                                    Member</span>
                            </div>
                        </div>

                        <form action="#" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Full
                                        Name</label>
                                    <input type="text" value="{{ Auth::user()->name }}"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email
                                        Address</label>
                                    <input type="email" value="{{ Auth::user()->email }}"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-100 bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm"
                                        readonly>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="bg-primary text-white px-10 py-4 rounded-lg font-bold hover:bg-green-800 transition-all shadow-md active:scale-95 transform">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection