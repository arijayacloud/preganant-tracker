<x-app-layout>

<div class="py-8">

<div class="max-w-5xl mx-auto px-4 space-y-8">

    <!-- PROFILE HEADER -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 
        rounded-2xl shadow-xl p-8 text-white">

        <div class="flex items-center gap-5">

            <div class="w-16 h-16 rounded-full bg-white/20 
                flex items-center justify-center text-3xl">

                👩

            </div>

            <div>

                <h3 class="text-xl font-bold">
                    {{ auth()->user()->name }}
                </h3>

                <p class="text-sm opacity-90">
                    {{ auth()->user()->email }}
                </p>

                <p class="text-xs opacity-75 mt-1">
                    Kelola data akun dan keamanan Anda
                </p>

            </div>

        </div>

    </div>


    <!-- UPDATE PROFILE -->
    <div class="bg-white/80 backdrop-blur-lg 
        border border-pink-100 shadow-lg rounded-2xl p-8">

        <h3 class="text-lg font-semibold text-gray-700 mb-6">
            Informasi Profil
        </h3>

        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>

    </div>


    <!-- UPDATE PASSWORD -->
    <div class="bg-white/80 backdrop-blur-lg 
        border border-purple-100 shadow-lg rounded-2xl p-8">

        <h3 class="text-lg font-semibold text-gray-700 mb-6">
            Keamanan Akun
        </h3>

        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>

    </div>


    <!-- DELETE ACCOUNT -->
    <div class="bg-red-50 border border-red-200 
        shadow-lg rounded-2xl p-8">

        <h3 class="text-lg font-semibold text-red-600 mb-6">
            Hapus Akun
        </h3>

        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>

    </div>

</div>

</div>

</x-app-layout>