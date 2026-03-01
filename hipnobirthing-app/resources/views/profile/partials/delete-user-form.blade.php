<section class="space-y-6">

    <!-- HEADER -->
    <header class="flex items-start gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-red-100 text-red-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v2m0 4h.01M5.455 19h13.09c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.723 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-800 dark:text-black">
                {{ __('Delete Account') }}
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Deleting your account will permanently remove all your data from the system. Please make sure you have downloaded any important information.') }}
            </p>
        </div>
    </header>


    <!-- WARNING BOX -->
    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
        <p class="text-sm text-red-700">
            ⚠️ {{ __('This action cannot be undone. All pregnancy records, consultations, and personal data will be permanently deleted.') }}
        </p>
    </div>


    <!-- BUTTON -->
    <div>
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow transition">
            🗑 {{ __('Delete My Account') }}
        </button>
    </div>


    <!-- MODAL -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>

        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
                {{ __('Confirm Account Deletion') }}
            </h2>

            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                {{ __('To confirm deletion, please enter your password. This action will permanently remove your account and all associated data.') }}
            </p>

            <!-- PASSWORD -->
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-lg"
                    placeholder="{{ __('Enter your password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>


            <!-- BUTTON ACTION -->
            <div class="mt-8 flex justify-end gap-3">

                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded-lg">
                    {{ __('Cancel') }}
                </button>

                <button
                    type="submit"
                    class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow">
                    {{ __('Delete Account') }}
                </button>

            </div>
        </form>

    </x-modal>

</section>