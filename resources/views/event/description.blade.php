<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mb-6">
                            <i><b><h1>EVENT DETAIL</h1></b></i>
                        </div>
                        <div class="mb-6">
                            <x-input-label for="event" :value="('Event')" />
                            <b>{{ $event->event }}</b>
                        </div>
                        <div class="mb-6">
                            <x-input-label for="category" :value="('Category')" />
                            @if ($event->category)
                            <b>{{ $event->category->tittle }}</b>
                            @endif
                        </div>
                        <div class="mb-6">
                            <x-input-label for="description" :value="('Description')" />
                            <b>{{ $event->description }}</b>
                        </div>
                        <div class="mb-6">
                            <x-input-label for="jumlah" :value="('Jumlah Tiket')" />
                            <b>{{ $event->jumlah }}</b>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>