<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add user') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="grid md:grid-cols-2 md:gap-8 mb-6">
                            <div>
                                <h5 class="mb-4">{{__('User data')}}</h5>
                                <div class="grid md:grid-cols-3 mb-4 items-center">
                                    <x-input-label for="name" value="{{__('Name')}}" mandatory="true" />
                                    <div class="md:col-span-2">
                                        @error('name')
                                        <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                        <x-text-input autocomplete="off" id="name" type="text"
                                                        class="mt-1 block w-full" name="name"
                                                        value="{{ old('name') }}" />
                                    </div>
                                </div>
                                <div class="grid md:grid-cols-3 mb-4 items-center">
                                    <x-input-label for="email" value="Email" mandatory="true" />
                                    <div class="md:col-span-2">
                                        @error('email')
                                        <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                        <x-text-input autocomplete="off" id="email" type="text"
                                                        class="mt-1 block w-full" name="email"
                                                        value="{{ old('email') }}" />
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-4">{{__('Other')}}</h5>

                                <div class="grid md:grid-cols-3 mb-4 items-center">
                                    <x-input-label for="role_id" value="{{__('User type')}}" mandatory="true" />
                                    <div class="md:col-span-2">
                                        @error('role_id')
                                        <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                        @php

                                        @endphp
                                        <x-input-select name="role_id" id="role_id" class="mt-1 block w-full">
                                            <option value="">---</option>
                                            @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </x-input-select>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-3 mb-4 items-center mt-8">
                                    <x-input-label for="active" value="{{__('Active')}}" />
                                    <div class="md:col-span-2">
                                        @error('active')
                                        <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                        <div class="flex flex-row gap-6">
                                            <div class="flex items-center">
                                                <input id="active-1" type="radio" value="1" name="active"
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                <label for="active-1"
                                                       class="ml-2 tebase-sm font-medium text-g5ay-900">Da</label>
                                            </div>
                                            <div class="flex items-center ml-12">
                                                <input id="active-2" type="radio" value="0" name="active"
                                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                <label for="active-2"
                                                       class="ml-2 tebase-sm font-medium text-g5ay-900">Nu</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div>
                            <x-button color="green" type="submit" class="mr-2">{{ __('Save') }}</x-button>
                            <x-link-button color="gray" href="{{ route('users') }}">{{ __('Cancel') }}
                            </x-link-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
