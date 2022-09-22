<div {{ $attributes->merge(['class' => 'card shadow-lg rounded-full']) }}>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>