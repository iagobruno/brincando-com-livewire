@if ($attributes->has('href'))
    <a
        {{ $attributes->merge([
            'href' => $href,
            'class' => 'button',
            'role' => 'button',
        ]) }}>
        {{ $slot }}</a>
@else
    <button
        {{ $attributes->merge([
            'class' => 'button',
        ]) }}>
        {{ $slot }}</button>
@endif
