@props(['color' => '', 'title' => '', 'type' => 'button', 'small' => 'true'])

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
        case 'yellow':
            $class = $base . ' bg-yellow-500 hover:bg-yellow-600';
            break;
        case 'gray':
            $class = $base . ' bg-gray-500 hover:bg-gray-600';
            break;
        default:
        $class = $base . ' bg-emerald-500 hover:bg-emerald-600';
            break;
    }
@endphp

<button title="{{ $title }}" {{ $attributes->merge(['class' => $class]) }} type="{{ $type }}">
    {{ $slot }}
</button>
