<nav x-data="{ open: false }" class="bg-gradient-to-r from-pink-500 to-purple-500 shadow-md">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex items-center space-x-6">

                <!-- LOGO -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">

                    <div class="bg-white p-2 rounded-full shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6M9 8h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        </svg>
                    </div>

                    <span class="text-white font-bold text-lg">
                        Hypnobirthing
                    </span>

                </a>


                <!-- MENU -->
                <div class="hidden sm:flex space-x-6 text-white text-sm">

                    <a href="{{ route('dashboard') }}" class="hover:text-pink-200">
                        Dashboard
                    </a>

                    <a href="{{ route('pregnancy.index') }}" class="hover:text-pink-200">
                        Kehamilan
                    </a>

                    <a href="{{ route('mother.hars') }}" class="hover:text-pink-200">
                        Kuesioner HARS
                    </a>

                    <a href="{{ route('mother.panduan') }}" class="hover:text-pink-200">
    Panduan Kehamilan
</a>

                    <a href="{{ route('mother.relaxation') }}" class="hover:text-pink-200">
                        Relaksasi
                    </a>

                    <a href="{{ route('mother.qa') }}" class="hover:text-pink-200">
                        Q&A Bidan
                    </a>

                    <a href="{{ route('reminder.index') }}" class="hover:text-pink-200">
                        Reminder ANC
                    </a>

                </div>

            </div>


            <!-- USER DROPDOWN -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="flex items-center text-white space-x-2">

                            <div class="bg-white text-pink-500 w-8 h-8 flex items-center justify-center rounded-full font-bold">
                                {{ substr(Auth::user()->name,0,1) }}
                            </div>

                            <span class="font-medium">
                                {{ Auth::user()->name }}
                            </span>

                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <div class="w-56 bg-white text-gray-700 rounded-xl shadow-xl overflow-hidden border">

                            <!-- Profile -->
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 transition">

                                <span class="text-lg">👤</span>
                                <span class="font-medium">Profile</span>

                            </a>

                            <!-- Divider -->
                            <div class="border-t border-gray-200"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-500 hover:text-white transition">

                                    <span class="text-lg">🚪</span>
                                    <span class="font-medium">Logout</span>

                                </button>
                            </form>

                        </div>

                    </x-slot>

                </x-dropdown>

            </div>



            <!-- MOBILE BUTTON -->
            <div class="flex items-center sm:hidden">

                <button @click="open = ! open" class="text-white">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    <!-- MOBILE MENU -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden bg-pink-500 text-white">

        <div class="px-4 py-4 space-y-2">

            <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
            <a href="{{ route('pregnancy.index') }}" class="block">Kehamilan</a>
            <a href="{{ route('mother.hars') }}" class="block">Kuesioner HARS</a>
            <a href="{{ route('mother.panduan') }}" class="block">Panduan Kehamilan</a>
            <a href="{{ route('mother.relaxation') }}" class="block">Relaksasi</a>
            <a href="{{ route('mother.qa') }}" class="block">Q&A Bidan</a>
            <a href="{{ route('reminder.index') }}" class="block">Reminder ANC</a>

        </div>

    </div>

</nav>