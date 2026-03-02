<x-app-layout>

    <div class="py-8 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- HEADER -->
            <div class="relative overflow-hidden 
                bg-gradient-to-r from-pink-500 via-rose-400 to-purple-500
                rounded-3xl shadow-xl p-8 text-white">

                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold tracking-tight">
                            Halo, {{ Auth::user()->name }} 👋
                        </h2>

                        <p class="mt-2 text-sm opacity-90">
                            Pantau perkembangan kehamilan Anda dengan nyaman dan terstruktur
                        </p>
                    </div>

                    <div class="text-6xl opacity-80 animate-bounce">
                        🤰
                    </div>
                </div>

            </div>


            @if($pregnancy && $pregnancy->hpht)

            @php

            $hpht = \Carbon\Carbon::parse($pregnancy->hpht);

            $totalDays = $hpht->diffInDays(now());

            $week = floor($totalDays / 7);
            $days = $totalDays % 7;

            $week = min($week, 40);

            $progress = min(($week / 40) * 100, 100);


            // Trimester
            if ($week <= 12) {
                $trimester="Trimester 1" ;
                $color="bg-green-500" ;
                } elseif ($week <=28) {
                $trimester="Trimester 2" ;
                $color="bg-yellow-400" ;
                } else {
                $trimester="Trimester 3" ;
                $color="bg-pink-500" ;
                }

                @endphp


                <!-- KEHAMILAN OVERVIEW -->
                <div class="grid md:grid-cols-4 gap-6">

                    <!-- Usia -->
                    <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                        rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                        <p class="text-gray-400 text-sm">Usia Kehamilan</p>

                        <p class="text-3xl font-bold text-pink-500">
                            {{ $week }} minggu {{ $days }} hari
                        </p>

                        <p class="text-xs text-gray-400 mt-2">
                            Dari total 40 minggu
                        </p>

                    </div>


                    <!-- HPL -->
                    <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                        rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                        <p class="text-gray-400 text-sm">Perkiraan Lahir</p>

                        <p class="text-lg font-semibold">
                            {{ \Carbon\Carbon::parse($pregnancy->estimated_due_date)->format('d M Y') }}
                        </p>

                        <p class="text-xs text-gray-400 mt-2">
                            Hari perkiraan persalinan
                        </p>

                    </div>


                    <!-- Trimester -->
                    <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                        rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                        <p class="text-gray-400 text-sm">
                            Trimester
                        </p>

                        <span class="px-3 py-1 text-white rounded-full text-sm {{ $color }}">
                            {{ $trimester }}
                        </span>

                        <p class="text-xs text-gray-400 mt-2">
                            Berdasarkan usia kehamilan
                        </p>

                    </div>


                    <!-- HARS -->
                    <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                        rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                        <p class="text-gray-400 text-sm">
                            Status Kecemasan
                        </p>

                        @if($latestHars)

                        <p class="text-xl font-semibold">

                            @if($latestHars->anxiety_level == 'Ringan')
                            <span class="text-green-500">Ringan</span>

                            @elseif($latestHars->anxiety_level == 'Sedang')
                            <span class="text-yellow-500">Sedang</span>

                            @else
                            <span class="text-red-500">Berat</span>
                            @endif

                        </p>

                        @endif

                        <p class="text-xs text-gray-400 mt-2">
                            Hasil kuesioner HARS
                        </p>

                    </div>

                </div>


                <!-- PROGRESS -->
                <div
                    x-data="{ progress: {{ intval($progress) }} }"
                    class="bg-white/80 backdrop-blur-lg border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Perkembangan Kehamilan
                    </h3>

                    <div class="w-full bg-gray-100 rounded-full h-5 overflow-hidden">

                        <div
                            class="h-5 rounded-full bg-gradient-to-r from-rose-400 to-purple-500 transition-all duration-1000 ease-out"
                            :style="`width: ${progress}%`">
                        </div>

                    </div>

                    <div class="flex justify-between text-sm text-gray-500 mt-2">
                        <span>0 minggu</span>
                        <span x-text="progress + '%'"></span>
                        <span>40 minggu</span>
                    </div>

                </div>


                <div
                    x-data="{ currentWeek: {{ $week }} }"
                    class="bg-white/80 backdrop-blur-lg border border-gray-100 rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Grafik Perkembangan Janin
                    </h3>

                    <div class="h-40 flex items-end gap-2">

                        @for($i = 4; $i <= 40; $i +=4)

                            <div class="flex flex-col items-center flex-1">

                            <div
                                class="w-full bg-pink-400 rounded-t transition-all duration-700"
                                :style="'height:' + (currentWeek >= {{ $i }} ? '120px' : '10px')">
                            </div>

                            <span class="text-xs mt-1">
                                {{ $i }}
                            </span>

                    </div>

                    @endfor

                </div>

                <p class="text-xs text-gray-400 mt-2">
                    Perkiraan perkembangan janin berdasarkan minggu kehamilan
                </p>

        </div>

        @php
        $currentWeek = $pregnancy->gestational_age_weeks ?? 0;

        if($currentWeek <= 12){
            $activeTrimester=1;
            } elseif($currentWeek <=28){
            $activeTrimester=2;
            } else {
            $activeTrimester=3;
            }
            @endphp

            <div class="bg-white rounded-2xl p-6 shadow-md">

            <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
                🩺 Timeline Pemeriksaan ANC
            </h3>

            <div class="space-y-6">

                <!-- Trimester 1 -->
                <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                    rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">


                    <div class="relative flex gap-4">

                        <span class="absolute -left-[14px] top-1 w-6 h-6 rounded-full flex items-center justify-center
                            {{ $activeTrimester >= 1 ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                            ✓
                        </span>

                        <div class="ml-4">
                            <p class="font-semibold text-gray-800">
                                Trimester 1 (0–12 minggu)
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Pemeriksaan awal kehamilan, USG pertama, cek laboratorium.
                            </p>

                            @if($activeTrimester == 1)
                            <span class="text-xs mt-2 inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded">
                                Sedang berlangsung
                            </span>
                            @elseif($activeTrimester > 1)
                            <span class="text-xs mt-2 inline-block px-2 py-1 bg-green-100 text-green-700 rounded">
                                Selesai
                            </span>
                            @endif
                        </div>

                    </div>
                </div>


                <!-- Trimester 2 -->
                <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                    rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                    <div class="relative flex gap-4">

                        <span class="absolute -left-[14px] top-1 w-6 h-6 rounded-full flex items-center justify-center
                            {{ $activeTrimester >= 2 ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                            ✓
                        </span>

                        <div class="ml-4">
                            <p class="font-semibold text-gray-800">
                                Trimester 2 (13–28 minggu)
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Pemantauan pertumbuhan janin, cek tekanan darah & gula darah.
                            </p>

                            @if($activeTrimester == 2)
                            <span class="text-xs mt-2 inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded">
                                Sedang berlangsung
                            </span>
                            @elseif($activeTrimester > 2)
                            <span class="text-xs mt-2 inline-block px-2 py-1 bg-green-100 text-green-700 rounded">
                                Selesai
                            </span>
                            @endif
                        </div>

                    </div>
                </div>


                <!-- Trimester 3 -->
                <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                    rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                    <div class="relative flex gap-4">

                        <span class="absolute -left-[14px] top-1 w-6 h-6 rounded-full flex items-center justify-center
                            {{ $activeTrimester >= 3 ? 'bg-green-500 text-white' : 'bg-gray-300' }}">
                            ✓
                        </span>

                        <div class="ml-4">
                            <p class="font-semibold text-gray-800">
                                Trimester 3 (29–40 minggu)
                            </p>

                            <p class="text-sm text-gray-500 mt-1">
                                Persiapan persalinan, pemantauan posisi janin, dan kontrol rutin.
                            </p>

                            @if($activeTrimester == 3)
                            <span class="text-xs mt-2 inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded">
                                Sedang berlangsung
                            </span>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
    </div>


    <!-- RELAKSASI -->
    <div class="bg-white border border-pink-100 
    rounded-2xl shadow-sm hover:shadow-md 
    transition duration-300 p-6">

        <h3 class="text-lg font-semibold mb-4 text-pink-700">
            Rekomendasi Relaksasi
        </h3>

        @if($latestHars)

        @if($latestHars->anxiety_level === 'berat')

        <p class="text-sm text-gray-700">
            Tingkat kecemasan Anda tergolong
            <span class="font-semibold text-red-500">Berat</span>.
            Disarankan melakukan latihan hypnobirthing setiap hari
            untuk membantu menenangkan pikiran dan tubuh.
        </p>

        @elseif($latestHars->anxiety_level === 'sedang')

        <p class="text-sm text-gray-700">
            Tingkat kecemasan Anda tergolong
            <span class="font-semibold text-yellow-500">Sedang</span>.
            Lakukan latihan pernapasan dan relaksasi minimal
            3 kali seminggu untuk menjaga kestabilan emosi.
        </p>

        @else

        <p class="text-sm text-gray-700">
            Tingkat kecemasan Anda tergolong
            <span class="font-semibold text-green-500">Ringan</span>.
            Kondisi mental cukup baik. Tetap lakukan relaksasi ringan
            untuk menjaga ketenangan selama kehamilan.
        </p>

        @endif

        @else

        <p class="text-sm text-gray-600">
            Anda belum mengisi kuesioner HARS.
            Silakan lakukan pemeriksaan untuk mendapatkan rekomendasi relaksasi yang sesuai.
        </p>

        @endif

        <a href="{{ route('mother.relaxation') }}"
            class="inline-block mt-5 bg-pink-500 hover:bg-pink-600 
        text-white px-5 py-2 rounded-xl shadow-sm 
        transition duration-200">

            Mulai Relaksasi
        </a>

    </div>

    @endif

    </div>

</x-app-layout>