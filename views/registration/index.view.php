<div class=" flex flex-col items-center justify-center py-8">
    <!-- Card for upload form -->
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Register</h1>
        <form action="/register" method="POST" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input type="text" name="name" id="name" required class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200"/>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" name="email" id="email" required class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200"/>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200"/>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200"/>
            </div>

            <div>
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-md transition">
                    Register
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Already have an account?
            <a href="/login" class="text-yellow-600 hover:underline">Sign in</a>
        </p>
    </div>
</div>
