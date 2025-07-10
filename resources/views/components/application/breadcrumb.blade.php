@props([
    'items' => [],
])

<nav class="flex items-center space-x-2 text-sm font-medium text-slate-600" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                @if ($index > 0)
                    <i class="fas fa-chevron-right w-4 h-4 mx-2 text-slate-400"></i>
                @endif

                @if (isset($item['url']) && $index !== count($items) - 1)
                    <a href="{{ $item['url'] }}"
                       class="flex items-center space-x-2 hover:text-green-600 transition-colors duration-200">
                        @if ($index === 0)
                            <i class="fas fa-home w-4 h-4"></i>
                        @endif
                        <span>{{ $item['title'] }}</span>
                    </a>
                @else
                    <span class="text-slate-900">{{ $item['title'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>