<div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
		<?php foreach ( $photos as $photo ): ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <a href="/photo?id={{ $photo->id }}">
                    <img src="{{ $photo->url }}" class="w-full h-64 object-cover">
                </a>
            </div>
		<?php endforeach; ?>
    </div>
</div>
