<?php if ( session()->flash() ): ?>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <div
            x-data="{ open: true }"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            x-cloak
            class="fixed inset-0 flex items-center justify-center z-50"
    >
        <!-- Overlay -->
        <div
                class="absolute inset-0 bg-gray-800/30 backdrop-blur-sm"
                @click="open = false"
        ></div>

        <!-- Flash Box -->
        <div
                class="relative bg-white rounded-lg shadow-lg max-w-md w-full mx-4 p-6 border-l-4
            <?php
				echo match ( session()->flash_type() )
				{
					'success' => 'border-green-500',
					'error' => 'border-red-500',
					default => 'border-blue-500',
				};
				?>
        "
        >
            <!-- Close button -->
            <button
                    @click="open = false"
                    class="absolute top-2 right-2 text-gray-500 hover:text-black"
            >
                &times;
            </button>

            <!-- Message -->
            <div class="text-gray-800">
				<?= htmlspecialchars( session()->flash() ) ?>
            </div>
        </div>
    </div>
<?php endif; ?>