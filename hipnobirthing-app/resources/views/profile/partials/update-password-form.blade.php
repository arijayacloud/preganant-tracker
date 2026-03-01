<section class="space-y-6">

    <header>

        <h2 class="text-xl font-semibold text-gray-800">
            🔒 Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Gunakan password yang kuat untuk menjaga keamanan akun Anda
        </p>

    </header>


    <form method="post" action="{{ route('password.update') }}" class="space-y-6">

        @csrf
        @method('put')


        <!-- CURRENT PASSWORD -->
        <div>

            <label class="text-sm font-medium text-gray-600">
                Password Saat Ini
            </label>

            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"

                class="mt-2 w-full rounded-xl border border-gray-200
px-4 py-3 shadow-sm
focus:ring-2 focus:ring-pink-300
focus:border-pink-400
transition" />

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

        </div>


        <!-- NEW PASSWORD -->
        <div>

            <label class="text-sm font-medium text-gray-600">
                Password Baru
            </label>

            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"

                class="mt-2 w-full rounded-xl border border-gray-200
px-4 py-3 shadow-sm
focus:ring-2 focus:ring-pink-300
focus:border-pink-400
transition" />

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

        </div>


        <!-- CONFIRM PASSWORD -->
        <div>

            <label class="text-sm font-medium text-gray-600">
                Konfirmasi Password
            </label>

            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"

                class="mt-2 w-full rounded-xl border border-gray-200
px-4 py-3 shadow-sm
focus:ring-2 focus:ring-pink-300
focus:border-pink-400
transition" />

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />

        </div>



        <!-- BUTTON -->
        <div class="flex items-center gap-4">

            <button
                class="bg-gradient-to-r from-pink-500 to-purple-500
text-white px-6 py-3 rounded-xl
font-semibold shadow-md
hover:scale-[1.02]
transition">

                🔐 Update Password

            </button>


            @if (session('status') === 'password-updated')

            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 font-medium">

                ✔ Password berhasil diperbarui

            </p>

            @endif

        </div>


    </form>

</section>