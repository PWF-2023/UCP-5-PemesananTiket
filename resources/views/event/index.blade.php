<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class ="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('event.create') }}" />
                        </div>

                        <div>
                            @if (session('success'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                            </p>
                            @endif

                            @if (session('danger'))
                            <p x-data="{ show: true }" x-show="show" x-transition
                                x-init="setTimeout(() => show = false, 5000)"
                                class="text-sm text-red-600 dark:text-red-400">{{ session('denger') }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                                Event
                                </th>
                                <th scope="col" class="px-6 py-3">
                                                Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                                Jumlah Tiket
                                </th>
                                <th scope="col" class="hidden px-6 py-3 md:block">
                                                Status
                                </th>                                
                                <th scope="col" class="px-6 py-3">
                                                Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $event)
                            <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    <a href="{{ route('event.description', $event) }}" class="hover:underline">{{ $event->event }}</a>

                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    @if ($event->category)
                                    {{ $event->category->tittle }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $event->jumlah }}
                                </td>
                                <td class ="hidden px-6 py-4 md:block">
                                    @if ($event->is_complete == false)

                                    <span 
                                        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                        Available

                                    </span>
                                    @else
                                    <span 
                                        class="bg-green-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                        Sold Out

                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        {{-- Action Here --}}
                                        @if ($event->is_complete == false)
                                        <form action="{{ route('event.complete', $event) }}" method="Post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-green-600 dark:text-green-400">
                                                                            Complete
                                            </button>        
                                        </form>     
                                        @else
                                        <form action="{{ route('event.uncomplete', $event) }}" method="Post">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-blue-600 dark:text-blue-400">
                                                                            UnComplete
                                            </button>        
                                        </form>                       
                                        @endif
                                        <form action="{{ route('event.destroy', $event) }}" method="Post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 dark:text-red-400">
                                                                            Delete
                                            </button>        
                                        </form>
                                        <form action="{{ route('event.edit', $event) }}" method="Get">
                                            @csrf
                                            @method('GET')
                                            <button type="submit"
                                                class="text-yellow-600 dark:text-yellow-400">
                                                                            Edit                                            </button>        
                                        </form>  
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-gray-800">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    Empty
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($eventsCompleted > 1)
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <form action="{{ route('event.deleteallcompleted', $event) }}" method="Post">
                        @csrf
                        @method('delete')
                        <x-primary-button>
                                Delete All Completed Event
                        </x-primary-button>        
                    </form> 
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>