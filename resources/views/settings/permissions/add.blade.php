<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('permission.store') }}">
                        @csrf

                        <div class="grid md:grid-cols-3 md:w-1/2 mb-4 items-center">
                            <x-input-label for="name" value="{{ __('Permission name') }}" mandatory="true" />
                            <div class="md:col-span-2">
                                @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                                <x-text-input autocomplete="off" id="name" type="text" class="mt-1 block w-full"
                                                name="name" value="{{ old('name') }}" />
                            </div>
                        </div>
                        <div class="mt-6">
                            <x-button color="green" type="submit" class="mr-2">{{ __('Save') }}</x-button>
                            <x-link-button color="gray" href="{{ route('permissions') }}">{{ __('Cancel') }}</x-link-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
