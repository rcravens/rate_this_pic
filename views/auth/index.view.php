<div class=" flex flex-col items-center justify-center py-8">
    <!-- Card for upload form -->
    <div class="bg-white shadow-lg rounded-lg p-6 w-96">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Login</h1>
        <form action="/login" method="POST" class="space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                <input type="email" name="email" id="email" required class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200"/>
				<?php if ( $error = session()->validation_message( 'email' ) ): ?>
                    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
				<?php endif; ?>
            </div>

            <div>
                <label for="password" class="mt-6 block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring focus:ring-yellow-200"/>
				<?php if ( $error = session()->validation_message( 'password' ) ): ?>
                    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
				<?php endif; ?>
            </div>

            <div>
                <button type="submit" class="mt-6 w-full bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-md transition">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Don’t have an account?
            <a href="/register" class="text-yellow-600 hover:underline">Sign up</a>
        </p>
    </div>
</div>
