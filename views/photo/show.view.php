<div class="mx-auto max-w-xl px-4 py-6 sm:px-6 lg:px-8">
	<?php $user = session()->user(); ?>
    <!-- Photo -->
    <div class="flex flex-col items-center gap-y-6">
        <img class="w-full" alt="photo" src="{{ $photo->url }}"/>
		<?php if ( ! is_null( $user ) && $photo->user_id == $user->id ): ?>
            <form action="/photo?id={{ $photo->id }}" method="POST">
                <input type="hidden" name="_METHOD" value="DELETE"/>
                <button type="submit" class="bg-red-400 hover:bg-red-500 text-white font-semibold px-4 py-2 rounded-md shadow">Delete Photo & Reviews</button>
            </form>
		<?php endif; ?>
    </div>

	<?php if ( count( $reviews ) > 0 ): ?>
        <!-- Summary -->
        <section class="max-w-xl mx-auto mt-6 p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Photo Summary</h2>

            <div class="flex items-center space-x-4 mb-2">
                <!-- Visual Stars -->
                <div class="flex items-center text-yellow-400">
                    <!-- Repeat filled or empty stars dynamically -->
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                    </svg>
                    <!-- Repeat for average, or dynamically render -->
                    <span class="ml-2 text-gray-700 font-medium">{{ number_format( $summary->avg_star_rating, 1 ) }} / 5</span>
                </div>

                <!-- Total Ratings -->
                <div class="text-gray-600">
                    <span class="font-medium">{{ count( $reviews ) }}</span> Ratings
                </div>

                <!-- Total Comments -->
                <div class="text-gray-600">
                    <span class="font-medium">{{ $summary->total_comments }}</span> Comments
                </div>
            </div>

            <!-- Optional: Star Breakdown -->
            <div class="mt-4 space-y-1">
				<?php for ( $i = 5; $i >= 0; $i -- ): ?>
					<?php
					$count       = $summary->star_counts[ $i ];
					$total_count = count( $reviews );
					$percent     = $total_count == 0 ? 0 : 100 * $count / $total_count;
					?>
                    <div class="flex items-center">
                        <span class="w-12 text-sm text-gray-600"><?= $i ?>★</span>
                        <div class="flex-1 bg-gray-100 h-2 rounded">
                            <div class="bg-yellow-400 h-2 rounded" style="width: {{ $percent }}%;"></div>
                        </div>
                        <span class="ml-2 text-sm text-gray-600">{{ $summary->star_counts[ $i ] }}</span>
                    </div>
				<?php endfor; ?>
            </div>
        </section>

        <section class="max-w-xl mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Recent Reviews</h2>

            <div class="space-y-6">
				<?php foreach ( $reviews as $review ): ?>
                    <div class="border-b pb-4">
                        <div class="flex items-center justify-between mb-1">
                            <div class="flex items-center">
								<?php for ( $i = 1; $i <= $review->num_stars; $i ++ ): ?>
                                    <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                                    </svg>
								<?php endfor; ?>
								<?php for ( $i = $review->num_stars + 1; $i <= 5; $i ++ ): ?>
                                    <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                                    </svg>
								<?php endfor; ?>
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                        <div class="mt-1 text-sm text-gray-500">— {{ is_null( $review->name ) || strlen( trim( $review->name ) ) === 0 ? 'Anonymous' : $review->name }}</div>
                    </div>
				<?php endforeach; ?>
            </div>
        </section>
	<?php endif; ?>

    <section class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Leave a Review</h2>

        <form action="/photo/review?id={{ $photo->id }}" method="POST" class="space-y-4">

            <!-- Star Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                <div class="flex flex-row-reverse justify-end gap-1">
                    <!-- 5 to 1 radio buttons -->
                    <input type="hidden" name="rating" value="0"/>
					<?php $old_rating = session()->old( 'rating', 0 ); ?>
                    <input type="radio" name="rating" id="star5" value="5" {{ $old_rating== 5 ? 'checked' : '' }} class="peer hidden">
                    <label for="star5" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star4" value="4" {{ $old_rating== 4 ? 'checked' : '' }} class="peer hidden">
                    <label for="star4" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star3" value="3" {{ $old_rating== 3 ? 'checked' : '' }} class="peer hidden">
                    <label for="star3" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star2" value="2" {{ $old_rating== 2 ? 'checked' : '' }} class="peer hidden">
                    <label for="star2" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star1" value="1" {{ $old_rating== 1 ? 'checked' : '' }} class="peer hidden">
                    <label for="star1" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                </div>
				<?php if ( $error = session()->validation_message( 'rating' ) ): ?>
                    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
				<?php endif; ?>
            </div>

            <!-- Name Field (optional) -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-gray-400 text-xs">(optional)</span></label>
                <input type="text" name="name" id="name" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200" maxlength="100" value="{{ session()->old( 'name' ) }}">
				<?php if ( $error = session()->validation_message( 'name' ) ): ?>
                    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
				<?php endif; ?>
            </div>

            <!-- Comment Field -->
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea name="comment" id="comment" rows="4" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200">{{ session()->old( 'comment' ) }}</textarea>
				<?php if ( $error = session()->validation_message( 'comment' ) ): ?>
                    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
				<?php endif; ?>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded-md shadow">
                    Submit Review
                </button>
            </div>

        </form>
    </section>

</div>
