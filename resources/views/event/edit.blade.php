<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('event.update', $event) }}" class="">
                        @csrf
                        @method('patch')
                        <div class="mb-6">
                            <x-input-label for="event" :value="('Tittle')" />
                            <x-text-input id="event" name="event" type="text" class="mt-1 block w-full"
                                :value="old('event', $event->event)" required autofocus autocomplete="event" />
                            <x-input-error class="mt-2" :messages="$errors->get('event')" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="category" :value="('Category')" />
                            <x-select id="category" name="category_id" class="block w-full mt-1">
                                <option value=""> Select Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($event->category_id === $category->id) selected @endif>{{ $category->tittle }}
                                    </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ ('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('event.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>