<?php require "../views/layout/_page_head.view.php" ?>
<?php require "../views/layout/_nav.view.php" ?>
<?php require "../views/layout/_header.view.php" ?>

<div class="mx-auto max-w-xl px-4 py-6 sm:px-6 lg:px-8">
    <!-- Photo -->
    <div class="">
        <img class="w-full" alt="photo" src="https://picsum.photos/id/237/400/300" />
    </div>

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
                <span class="ml-2 text-gray-700 font-medium">4.2 / 5</span>
            </div>

            <!-- Total Ratings -->
            <div class="text-gray-600">
                <span class="font-medium">128</span> Ratings
            </div>

            <!-- Total Comments -->
            <div class="text-gray-600">
                <span class="font-medium">45</span> Comments
            </div>
        </div>

        <!-- Optional: Star Breakdown -->
        <div class="mt-4 space-y-1">
            <div class="flex items-center">
                <span class="w-12 text-sm text-gray-600">5★</span>
                <div class="flex-1 bg-gray-100 h-2 rounded">
                    <div class="bg-yellow-400 h-2 rounded" style="width: 60%;"></div>
                </div>
                <span class="ml-2 text-sm text-gray-600">76</span>
            </div>
            <div class="flex items-center">
                <span class="w-12 text-sm text-gray-600">4★</span>
                <div class="flex-1 bg-gray-100 h-2 rounded">
                    <div class="bg-yellow-400 h-2 rounded" style="width: 25%;"></div>
                </div>
                <span class="ml-2 text-sm text-gray-600">32</span>
            </div>
            <!-- Repeat for 3, 2, 1 stars if desired -->
        </div>
    </section>

    <section class="max-w-xl mx-auto mt-8 p-4 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Recent Reviews</h2>

        <div class="space-y-6">
            <div class="border-b pb-4">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center">
                        <!-- 5 filled stars -->
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                    </div>
                    <span class="text-sm text-gray-500">March 20, 2025</span>
                </div>
                <p class="text-gray-700">This photo is stunning. It could be in a magazine — well done!</p>
                <div class="mt-1 text-sm text-gray-500">— Alex R.</div>
            </div>

            <div class="border-b pb-4">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center">
                        <!-- 4 stars filled, 1 empty -->
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                    </div>
                    <span class="text-sm text-gray-500">March 18, 2025</span>
                </div>
                <p class="text-gray-700">Really great! Just wish it had a bit more color pop.</p>
                <div class="mt-1 text-sm text-gray-500">— Mel C.</div>
            </div>
            <div class="border-b pb-4">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                    </div>
                    <span class="text-sm text-gray-500">March 14, 2025</span>
                </div>
                <p class="text-gray-700">It’s okay — nice composition but feels a bit flat to me.</p>
                <div class="mt-1 text-sm text-gray-500">— Anonymous</div>
            </div>
            <div class="border-b pb-4">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                    </div>
                    <span class="text-sm text-gray-500">March 12, 2025</span>
                </div>
                <p class="text-gray-700">Not really my taste. Feels a bit rushed.</p>
                <div class="mt-1 text-sm text-gray-500">— Sam K.</div>
            </div>
            <div class="border-b pb-4">
                <div class="flex items-center justify-between mb-1">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 fill-current text-yellow-400" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                        <svg class="w-4 h-4 fill-current text-gray-300" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/></svg>
                    </div>
                    <span class="text-sm text-gray-500">March 10, 2025</span>
                </div>
                <p class="text-gray-700">Didn’t connect with this one. Sorry!</p>
                <div class="mt-1 text-sm text-gray-500">— Chris T.</div>
            </div>
        </div>
    </section>

    <section class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Leave a Review</h2>

        <form action="#" method="POST" class="space-y-4">

            <!-- Star Rating -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                <div class="flex flex-row-reverse justify-end gap-1">
                    <!-- 5 to 1 radio buttons -->
                    <input type="radio" name="rating" id="star5" value="5" class="peer hidden" required>
                    <label for="star5" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star4" value="4" class="peer hidden" required>
                    <label for="star4" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star3" value="3" class="peer hidden" required>
                    <label for="star3" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star2" value="2" class="peer hidden" required>
                    <label for="star2" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                    <input type="radio" name="rating" id="star1" value="1" class="peer hidden" required>
                    <label for="star1" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-500 transition">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L1 6.91l6.561-.954L10 0l2.439 5.956L19 6.91l-4.244 4.635 1.122 6.545z"/>
                        </svg>
                    </label>
                </div>
            </div>

            <!-- Name Field (optional) -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name <span class="text-gray-400 text-xs">(optional)</span></label>
                <input type="text" name="name" id="name" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200" maxlength="100">
            </div>

            <!-- Comment Field -->
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea name="comment" id="comment" rows="4" class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200" required></textarea>
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

<?php require "../views/layout/_page_foot.view.php" ?>