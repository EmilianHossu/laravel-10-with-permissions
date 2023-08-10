<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route( 'permissions' ) }}" method="GET">

                        <div class="flex flex-col md:flex-row justify-between mb-6">
                            <x-link-button href="{{ route('permission.create') }}" class="mb-4">{{ __('Add permission')
                                }}
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


                        <table class="min-w-full divide-y divide-gray-200 table-auto" aria-label="Lista permisiuni">
                            <thead>
                                <tr class="text-gray-600 text-sm leading-normal border-gray-200 border-b">
                                    <th scope="col"
                                        class="text-gray-500 px-6 pb-1 pt-2 text-center text-sm font-medium uppercase tracking-wider">
                                        Id #</th>
                                    <th scope="col"
                                        class="px-6 pb-1 pt-2 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Name') }}</th>
                                    <th scope="col"
                                        class="px-6 pb-1 pt-2 text-end text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Actions') }}</th>
                                </tr>
                                <tr class="bg-gray-50 text-gray-600 text-sm leading-normal ">
                                    <th scope="col"
                                        class="px-6 py-1 text-left text-sm font-medium text-gray-500 uppercase tracking-wider w-28">
                                        <x-text-input name="id" id="id" placeholder="ID" value="{{ $params['id'] ?? '' }}" class="my-2 px-2 py-1 placeholder-slate-300 text-slate-600 border w-full"/>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-1 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                                        <x-text-input name="name" id="name" placeholder="{{ __('Permission name') }}" value="{{ $params['name'] ?? '' }}" class="my-2 px-2 py-1 placeholder-slate-300 text-slate-600 border w-full"/>
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-1 text-end text-sm font-medium text-gray-500 tracking-wider">

                                        <x-button type="submit" color="gray" class="uppercase">{{ __('Filter') }}
                                        </x-button>

                                        @if( !empty($hasFilters) )
                                        <x-link-button color="gray" href="{{ route('permissions') }}" class="uppercase">
                                            {{ __('Clear
                                            filters') }}
                                        </x-link-button>
                                        @endif

                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach( $items as $item )
                                <tr>
                                    <td class="px-7 py-2 text-center whitespace-nowrap">
                                        {{$item->id}}
                                    </td>
                                    <td class="px-7 py-2 whitespace-nowrap">
                                        {{ $item->name }}
                                    </td>
                                    <td class="px-7 py-2 whitespace-nowrap">

                                        <div class="flex flex-row justify-end">
                                            <x-link-button class="mr-2"
                                                           href="{{ route( 'permission.edit', [ 'id' => $item->id ] ) }}"
                                                           title="{{ __('Edit') }}">
                                                <?xml version="1.0" ?>
                                                <svg class="mr-2" fill="none" height="16" stroke="currentColor"
                                                     stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                     viewBox="0 0 24 24" width="16" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                          d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                                {{ __('Edit') }}
                                            </x-link-button>

                                            <x-button type="button" color="red" href="#"
                                                      onclick="deleteItem(event, '{{ route('permission.delete', ['id' => $item->id]) }}', '{{ __('Are you sure you want to delete this permission?') }}')"
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
                    </form>
                    <div class="mt-8">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="#" method="post" name="deleteElementForm" id="deleteElementForm">
        @method('DELETE')
        @csrf
    </form>

    @push('footer-js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteItem(event, path, message) {
            event.preventDefault();
            Swal.fire({
                title: '{{ __('Are you sure?') }}',
                text: message ? message : "{!! __('You won\'t be able to revert this!') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(239, 68, 68)',
                cancelButtonColor: 'rgb(107, 114, 128)',
                confirmButtonText: '{{ __('Yes, delete it!') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteElementForm').action = path;
                    document.getElementById('deleteElementForm').submit();
                }
            })
        }
    </script>
    @endpush

</x-app-layout>
