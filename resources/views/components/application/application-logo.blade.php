@props([
    'url' => '',
    'logoSrc' => '',
    'logoAlt' => config('app.name') . ' Logo',
    'title' => config('app.name')
])

<a href="{{ $url }}" class="flex text-white">
    <img src="{{ $logoSrc }}" class="h-8 text-3xl" alt="{{ $logoAlt }}" />
</a>