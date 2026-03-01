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
                    Membantu ibu hamil merasa lebih tenang,
                    rileks dan siap menghadapi persalinan.
                </p>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="p-10">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-pink-600">
                    Selamat Datang
                </h1>
                <p class="text-gray-500 text-sm mt-2">
                    Masuk untuk melanjutkan ke aplikasi
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required autofocus
                        class="w-full mt-1 px-4 py-3 rounded-lg border border-pink-200 bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                        placeholder="Masukkan email">
                    
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium text-gray-600">Password</label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full mt-1 px-4 py-3 rounded-lg border border-pink-200 bg-pink-50 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400 transition"
                        placeholder="Masukkan password">

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center text-gray-600">
                        <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-pink-500 focus:ring-pink-400">
                        <span class="ml-2">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-pink-500 hover:underline"
                            href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif

                </div>

                <!-- Login Button -->
                <button
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg font-semibold shadow-md transition">
                    Masuk
                </button>

            </form>

            <!-- Register Link -->
            <div class="text-center mt-6 text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}"
                    class="text-pink-500 font-semibold hover:underline">
                    Daftar disini
                </a>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 text-xs text-gray-400">
                © {{ date('Y') }} Hypnobirthing App
            </div>

        </div>

    </div>

</div>
</x-guest-layout>