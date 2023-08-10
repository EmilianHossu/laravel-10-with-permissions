@props(['href', 'title' => '', 'color' => '', 'small' => 'true'])

@php
    $size = 'text-base py-3 px-4';
    if($small) {
        $size = 'text-xs py-2 px-3';
    }

    $base = 'inline-flex flex-row justify-between items-center focus:outline-none text-white '.$size.' rounded hover:shadow-md font-bold';

    switch ($color) {
        case 'red':
            $class = $base . ' bg-red-500 hover:bg-red-600';
            break;
        case 'green':
            $class = $base . ' bg-green-500 hover:bg-green-600';
            break;
        case 'gray':
            $class = $base . ' bg-gray-500 hover:bg-gray-600';
            break;
        default:
        $class = $base . ' bg-emerald-500 hover:bg-emerald-600';
            break;
    }
@endphp

<a href="{{ $href }}" title="{{ $title }}" {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</a>
