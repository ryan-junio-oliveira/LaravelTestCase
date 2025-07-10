@props([
    'class' => '',
])

<div {{ $attributes->merge(['class' => 'p-4 max-w-7xl mx-auto space-y-4' . $class]) }}>
    {{ $slot }}
</div>