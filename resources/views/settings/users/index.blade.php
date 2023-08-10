<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('users') }}" method="GET">
                        <div class="flex flex-col md:flex-row justify-between mb-6">
                            <x-link-button href="{{ route('users.create') }}" class="mb-4">{{__('Add user')}}
                            </x-link-button>

                            <div class="flex flex-row items-center mt-4 md:mt-0">
                                <label for="perPage">{{ __('Items per page') }}</label>
                                <select name="perPage" id="perPage"
                                        class="ml-4 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-50 mt-1 block">
                                    @foreach (\Config::get('app.perPage') as $key => $value)
                                    <option value="{{$key}}" @if((isset($params['perPage']) && $params['perPage']==$key)
                                            || (!isset($params['perPage']) && $key=='25' )){{'selected'}}@endif>
                                        {{$value}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 table-auto" id="usersTable"
                                   aria-label="Lista utilizatori">
                                <thead>
                                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">
                                            ID</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Name') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Rols') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Email') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Active') }}</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Actions') }}</th>
                                    </tr>
                                    <tr class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal ">
                                        <th scope="col"
                                            class="px-3 py-1 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-28">
                                            <x-text-input name="id" id="id" placeholder="ID"
                                                          value="{{ $params['id'] ?? '' }}"
                                                          class="my-2 px-2 py-1 placeholder-slate-300 text-slate-600 border w-full" />
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-1 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                            <x-text-input name="name" id="name" placeholder="{{__('Name')}}"
                                                          value="{{ $params['name'] ?? '' }}"
                                                          class="my-2 px-2 py-1 placeholder-slate-300 text-slate-600 border" />
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <x-text-input name="email" id="email" placeholder="{{__('Email')}}"
                                                          value="{{ $params['email'] ?? '' }}"
                                                          class="my-2 px-2 py-1 placeholder-slate-300 text-slate-600 border w-full" />
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <select name="active" id="active"
                                                    class="py-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-50 block">
                                                <option value="">---</option>
                                                <option value="1" @if((isset($params['active']) &&
                                                        $params['active']==='1')){{'selected'}}@endif>
                                                    {{__('Yes')}}
                                                </option>
                                                <option value="0" @if((isset($params['active']) &&
                                                        $params['active']==='0')){{'selected'}}@endif>
                                                    {{__('No')}}
                                                </option>

                                            </select>
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-1 text-right text-sm font-medium text-gray-500 tracking-wider">

                                            <x-button type="submit" color="gray" class="uppercase">{{ __('Filter') }}
                                            </x-button>

                                            @if( !empty($hasFilters) )
                                            <x-link-button color="gray" href="{{ route('users') }}" class="uppercase">{{
                                                __('Clear
                                                filters') }}
                                            </x-link-button>
                                            @endif

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $items as $item )
                                    <tr class="@if( !$item->active ) bg-amber-50 text-gray-500 @endif">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$item->id}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$item->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $item->getRoleNames() && $item->getRoleNames()->count() ?
                                            $item->getRoleNames()->implode(',') : 'error.' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{$item->email}}
                                        </td>
                                        <td class="px-6 py-4 text-center whitespace-nowrap">
                                            @if($item->active == 1)
                                            <span
                                                  class="bg-green-100 text-green-800 font-medium mr-2 px-2.5 py-0.5 rounded border-green-400">{{__('Yes')}}</span>
                                            @else
                                            <span
                                                  class="bg-gray-100 text-gray-800 font-medium mr-2 px-2.5 py-0.5 rounded border-gray-500">{{__('No')}}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="flex flex-row justify-end">
                                                <x-link-button class="mr-2"
                                                               href="{{ route( 'users.edit', [ 'id' => $item->id ] ) }}"
                                                               title="{{ __('Edit') }}">
                                                    <?xml version="1.0" ?>
                                                    <svg class="mr-2" fill="none" height="16" stroke="currentColor"
                                                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                         viewBox="0 0 24 24" width="16"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                              d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                        <path
                                                              d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </x-link-button>

                                                <x-button color="red"
                                                          onclick="deleteItem(event, '{{ route( 'users.delete', ['id' => $item->id]) }}', '{{ __('Delete the user? You cannot restore it.')}}')"
                                                          title="{{ __('Delete') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#fff"
                                                         stroke="currentColor" height="1em" viewBox="0 0 448 512">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <path
                                                              d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                                    </svg>
                                                </x-button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small class="text-gray-400 mt-4">{{__('Users within the Super Admin group can only be deleted if not active.')}}</small>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._delete-element')

</x-app-layout>
