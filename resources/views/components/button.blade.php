@props([
    'href' => null,
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
])

@php
    $base = 'inline-flex items-center justify-center rounded-md font-semibold no-underline select-none transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2';
    $sizes = [
        'sm' => 'px-4 py-2.5 text-sm',
        'md' => 'px-5 py-3 text-base',
    ];
    $variants = [
        'primary' => 'bg-[var(--primary-200)] text-[var(--bg-100)] hover:bg-[var(--primary-300)] focus-visible:ring-[var(--primary-100)]',
        'warning' => 'bg-[var(--accent-100)] text-[var(--text-100)] hover:bg-[var(--accent-200)] focus-visible:ring-[var(--accent-200)]',
        'danger' => 'bg-[var(--primary-300)] text-[var(--bg-100)] hover:bg-[var(--primary-200)] focus-visible:ring-[var(--primary-100)]',
        'muted' => 'bg-[var(--bg-200)] text-[var(--text-200)] cursor-not-allowed',
        'outline' => 'border border-[var(--bg-300)] text-[var(--text-100)] hover:bg-[var(--bg-100)] focus-visible:ring-[var(--primary-100)]',
    ];

    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $variantClass = $variants[$variant] ?? $variants['primary'];
    $classes = trim($base . ' ' . $sizeClass . ' ' . $variantClass);

    if ($disabled) {
        $classes .= ' opacity-60 pointer-events-none';
    }
@endphp

@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if ($disabled) aria-disabled="true" tabindex="-1" @endif
    >
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type }}"
        @if ($disabled) disabled @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
@endif
