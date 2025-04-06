<div class=" flex flex-col items-center justify-center py-8">
    <!-- Card for upload form -->
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Upload a New Photo</h1>
		<?php if ( ! session()->guest() ): ?>
            <form action="#" method="POST" enctype="multipart/form-data">
                <!-- File Input -->
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700 text-sm font-medium mb-2">Select a photo to upload:</label>
                    <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-700 bg-gray-200 rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Title Input (Optional) -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Title:</label>
                    <input type="text" name="title" id="title" class="block w-full text-sm text-gray-700 bg-gray-200 rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Upload Photo
                    </button>
                </div>
            </form>
		<?php else: ?>
            <div class="flex flex-col gap-y-6 items-center">
                You must be logged in to upload photos.
                <a class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75" href="/login">Login Now</a>
            </div>
		<?php endif; ?>
    </div>
</div>
