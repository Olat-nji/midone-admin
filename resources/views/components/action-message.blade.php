@props(['on'=>''])

<div x-data="{ shown: false, timeout: null }"
    
    x-show.transition.opacity.out.duration.1500ms="shown"
    style="display: none;"
    {{ $attributes->merge(['class' => 'text-sm text-gray-600']) }}>
    {{ $slot ?? 'Saved.' }}
</div>
