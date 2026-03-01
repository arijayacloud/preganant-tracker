<section class="space-y-6">

    <header>

        <h2 class="text-xl font-semibold text-gray-800">
            👤 Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui nama dan email akun Anda
        </p>

    </header>


    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>


    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">

        @csrf
        @method('patch')


        <!-- NAME -->
        <div>

            <label class="text-sm font-medium text-gray-600">
                Nama
            </label>

            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
                class="mt-2 w-full rounded-xl border border-gray-200 
focus:border-pink-400 focus:ring focus:ring-pink-200 
px-4 py-3 transition shadow-sm" />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />

        </div>



        <!-- EMAIL -->
        <div>

            <label class="text-sm font-medium text-gray-600">
                Email
            </label>

            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
                class="mt-2 w-full rounded-xl border border-gray-200 
focus:border-pink-400 focus:ring focus:ring-pink-200 
px-4 py-3 transition shadow-sm" />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div class="mt-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">

                <p class="text-sm text-yellow-700">

                    Email Anda belum diverifikasi.

                    <button form="send-verification"
                        class="underline font-medium hover:text-yellow-900 ml-1">

                        Kirim ulang verifikasi

                    </button>

                </p>


                @if (session('status') === 'verification-link-sent')

                <p class="mt-2 text-sm text-green-600 font-medium">
                    Link verifikasi telah dikirim ke email Anda.
                </p>

                @endif

            </div>

            @endif

        </div>



        <!-- BUTTON -->
        <div class="flex items-center gap-4">

            <button
                class="bg-gradient-to-r from-pink-500 to-purple-500
text-white px-6 py-3 rounded-xl
font-semibold shadow-md
hover:scale-[1.02] transition">

                💾 Simpan Perubahan

            </button>


            @if (session('status') === 'profile-updated')

            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 font-medium">

                ✔ Profil berhasil diperbarui

            </p>

            @endif

        </div>


    </form>

</section>