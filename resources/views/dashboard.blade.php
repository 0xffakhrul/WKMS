<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 pt-24">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-10 py-6">
                <div class="p-6 text-gray-900 text-4xl font-bold">
                    Welcome to Watak Kopi Management System
                </div>
                <div class="p-6 text-gray-900 text-lg font-bold">
                    @if (auth()->user()->role == 1)
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-3 bg-green-600 rounded-lg text-white">Go
                            to Admin Dashboard</a>
                    @elseif(auth()->user()->role == 2)
                        <a href="{{ route('staff.dashboard') }}" class="px-4 py-3 bg-green-600 rounded-lg text-white">Go
                            to Staff Dashboard</a>
                            
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
