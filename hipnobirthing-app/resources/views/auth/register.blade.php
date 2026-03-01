<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-50 via-white to-purple-50">

    <div class="w-full max-w-5xl bg-white shadow-xl rounded-2xl overflow-hidden grid md:grid-cols-2">

        <!-- LEFT SIDE -->
        <div class="hidden md:flex items-center justify-center bg-pink-100 p-10">
            <div class="text-center">

                <img src="/images/pregnant-mother.png" class="w-72 mx-auto mb-6">

                <h2 class="text-2xl font-bold text-pink-600">
                    Hypnobirthing App
                </h2>

                <p class="text-gray-600 mt-2 text-sm">
                    Daftar untuk mulai memantau kehamilan,
                    relaksasi, dan mempersiapkan persalinan dengan tenang.
                </p>

            </div>
        </div>

        <!-- RIGHT SIDE FORM -->
        <div class="p-10">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-pink-600">
                    Buat Akun
                </h1>
                <p class="text-gray-500 text-sm mt-2">
                    Daftar untuk menggunakan aplikasi
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name -->
                <div>
                    <label class="text-sm font-medium text-gray-600">Nama</label>

                    <input type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required autofocus
                        class="w-full mt-1 px-4 py-3 rounded-lg border border-pink-200 bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                        placeholder="Masukkan nama lengkap">

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>

                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full mt-1 px-4 py-3 rounded-lg border border-pink-200 bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                        placeholder="Masukkan email">

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium text-gray-600">Password</label>

                    <input type="password"
                        name="password"
                        required
                        class="w-full mt-1 px-4 py-3 rounded-lg border border-pink-200 bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                        placeholder="Masukkan password">

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="text-sm font-medium text-gray-600">Konfirmasi Password</label>

                    <input type="password"
                        name="password_confirmation"
                        required
                        class="w-full mt-1 px-4 py-3 rounded-lg border border-pink-200 bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                        placeholder="Ulangi password">

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Button -->
                <button
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg font-semibold shadow-md transition">
                    Daftar
                </button>

            </form>

            <!-- Login Link -->
            <div class="text-center mt-6 text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}"
                   class="text-pink-500 font-semibold hover:underline">
                   Login disini
                </a>
            </div>

            <div class="text-center mt-8 text-xs text-gray-400">
                © {{ date('Y') }} Hypnobirthing App
            </div>

        </div>

    </div>

</div>

</x-guest-layout>