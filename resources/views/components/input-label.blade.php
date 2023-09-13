@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold uppercase text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
