<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add role') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user-role.store') }}">

                        @csrf
                        <div class="grid md:grid-cols-3 md:w-1/3 mb-4 items-center">
                            <x-input-label for="name" value="{{ __('Role name') }}" mandatory="true" />
                            <div class="md:col-span-2">
                                @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                                <x-text-input autocomplete="off" id="name" type="text" class="mt-1 block w-full"
                                              name="name" value="{{ old('name') }}" />
                            </div>
                        </div>

                        <hr class="my-4">
                        <h5 class="text-xl font-bold mb-4">{{ __('Permission list') }}</h5>
                        @error('permissions')
                        <div class="text-red-500 mb-3">{{ $message }}</div>
                        @enderror
                        <div class="grid grid-cols-9 mb-6">
                            @foreach($permissions->chunk(4) as $chunk)
                            <div class="col-span-3">
                                @foreach($chunk as $permission)
                                <div class="flex items-center mb-4">
                                    <input type="checkbox" id="p-{{ $permission->id }}"
                                           name="permissions[]" value="{{ $permission->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded
                                           focus:ring-blue-500 focus:ring-2">
                                    <label class="ml-2 text-sm font-medium text-gray-900"
                                           for="p-{{ $permission->id }}">
                                        {!! $permission->name !!}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endforeach

                        </div>

                        <div>
                            <x-button color="green" type="submit" class="mr-2">{{ __('Save') }}</x-button>
                            <x-link-button color="gray" href="{{ route('user-roles') }}">{{ __('Cancel') }}
                            </x-link-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
