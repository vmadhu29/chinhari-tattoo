<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            @if(auth()->user()->hasAnyRole(['super-admin', 'admin', 'manager', 'artist', 'receptionist']))
                <div class="bg-red-50 border border-red-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-red-900">Admin Portal Access</h3>
                            <p class="text-sm text-red-700 mt-1">Manage the studio's portfolio, settings, and more.</p>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="bg-red-700 hover:bg-red-800 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                            Enter Admin Portal &rarr;
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
