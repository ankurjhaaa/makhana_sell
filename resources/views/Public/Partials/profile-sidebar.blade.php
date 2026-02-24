<div class="bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Account Menu</h4>
    </div>
    <div class="p-2 space-y-1">
        <a href="{{ route('profile') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('profile') ? 'bg-primary text-white font-bold shadow-md' : 'text-gray-600 hover:bg-green-50 hover:text-primary' }}">
            <i class="fas fa-user-circle text-sm opacity-50"></i>
            <span class="text-sm">My Profile</span>
        </a>
        <a href="{{ route('my.orders') }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('my.orders') ? 'bg-primary text-white font-bold shadow-md' : 'text-gray-600 hover:bg-green-50 hover:text-primary' }}">
            <i class="fas fa-box text-sm opacity-50"></i>
            <span class="text-sm">My Orders</span>
        </a>
        <a href="#"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all text-gray-600 hover:bg-green-50 hover:text-primary">
            <i class="fas fa-file-contract text-sm opacity-50"></i>
            <span class="text-sm">Terms & Conditions</span>
        </a>
        <a href="#"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all text-gray-600 hover:bg-green-50 hover:text-primary">
            <i class="fas fa-shield-alt text-sm opacity-50"></i>
            <span class="text-sm">Privacy Policy</span>
        </a>

        <div class="pt-4 mt-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg transition-all text-red-500 hover:bg-red-50 font-bold">
                    <i class="fas fa-sign-out-alt text-sm"></i>
                    <span class="text-sm">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>