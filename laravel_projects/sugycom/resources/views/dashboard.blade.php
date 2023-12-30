<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}
                    <ul>
                        <li><a href="{{ route('priority.index') }}">Priorities</a></li>
                        <li><a href="{{ route('researcher.index') }}">Researchers</a></li>
                        <li><a href="{{ route('trigger.index') }}">Trigger</a></li>
                        <li><a href="{{ route('setting.index') }}">Settings Routes</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
