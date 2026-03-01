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
                            Profil Kehamilan
                        </h2>

                        <p class="mt-2 text-sm opacity-90">
                            Pantau perkembangan kehamilan Anda
                        </p>
                    </div>

                    <div class="text-6xl opacity-80 animate-bounce">
                        🤰
                    </div>

                </div>

            </div>


            <!-- ================= FORM ================= -->
            @if(session('success'))

            <div class="bg-green-100 border border-green-200 text-green-700 
p-4 rounded-xl shadow">

                {{ session('success') }}

            </div>

            @endif
            <div class="bg-white rounded-3xl shadow-lg border border-pink-100 p-8">

                <h2 class="text-xl font-semibold text-pink-600 mb-6 flex items-center gap-2">
                    {{ $pregnancy ? '✏️ Edit Data Kehamilan' : '📋 Data Kehamilan Ibu' }}
                </h2>

                <form method="POST" action="/pregnancy" class="grid md:grid-cols-2 gap-6">
                    @csrf

                    <!-- HPHT -->

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Tanggal HPHT
                        </label>

                        <input
                            type="date"
                            name="hpht"
                            value="{{ old('hpht', $pregnancy->hpht ?? '') }}"
                            required
                            class="mt-2 w-full rounded-xl border border-gray-200
    focus:border-pink-400 focus:ring focus:ring-pink-200
    px-4 py-3 transition" />

                        <p class="text-xs text-gray-500 mt-1">
                            Hari Pertama Haid Terakhir
                        </p>
                    </div>


                    <!-- Siklus -->

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Panjang Siklus (hari)
                        </label>

                        <input
                            type="number"
                            name="cycle_length"
                            value="{{ old('cycle_length', $pregnancy->cycle_length ?? 28) }}"
                            class="mt-2 w-full rounded-xl border border-gray-200
    focus:border-pink-400 focus:ring focus:ring-pink-200
    px-4 py-3" />
                    </div>


                    <div class="md:col-span-2">

                        <button class="w-full bg-gradient-to-r from-pink-500 to-purple-500
hover:scale-[1.02] hover:shadow-lg text-white py-3 rounded-xl font-semibold transition">

                            {{ $pregnancy ? '💾 Update Data Kehamilan' : '💾 Simpan Data Kehamilan' }}

                        </button>

                    </div>

                </form>

            </div>


            @if($pregnancy)

            @php

            $hpht = \Carbon\Carbon::parse($pregnancy->hpht);
            $today = now();

            $totalDays = $hpht->diffInDays($today);

            $week = floor($totalDays / 7);
            $days = $totalDays % 7;

            $week = min($week, 40);

            $progress = min(($week / 40) * 100, 100);

            @endphp


            <!-- ================= SUMMARY ================= -->

            <div class="grid md:grid-cols-3 gap-6">


                <!-- Usia -->

                <div class="bg-white p-6 rounded-3xl shadow border border-gray-100 hover:shadow-xl transition">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-500 text-sm">
                                Usia Kehamilan
                            </p>

                            <p class="text-3xl font-bold text-pink-500 mt-2">
                                {{ $week }} minggu {{ $days }} hari
                            </p>

                        </div>

                        <div class="text-4xl bg-pink-100 p-4 rounded-full">
                            👶
                        </div>

                    </div>

                </div>



                <!-- HPL -->

                <div class="bg-white p-6 rounded-3xl shadow border border-gray-100 hover:shadow-xl transition">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-500 text-sm">
                                Perkiraan Lahir
                            </p>

                            <p class="text-lg font-semibold mt-2">
                                {{ \Carbon\Carbon::parse($pregnancy->estimated_due_date)->format('d M Y') }}
                            </p>

                        </div>

                        <div class="text-4xl bg-purple-100 p-4 rounded-full">
                            📅
                        </div>

                    </div>

                </div>



                <!-- Progress -->

                <div
                    x-data="{ progress: 0 }"
                    x-init="setTimeout(() => progress = {{ round($progress) }}, 400)"
                    class="bg-white p-6 rounded-3xl shadow border border-gray-100 hover:shadow-xl transition">

                    <p class="text-gray-500 text-sm mb-3">
                        Progress Kehamilan
                    </p>

                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">

                        <div
                            class="bg-gradient-to-r from-pink-500 to-purple-500 h-4 rounded-full transition-all duration-1000"
                            :style="`width: ${progress}%`">
                        </div>

                    </div>

                    <p class="text-sm text-gray-500 mt-2">
                        <span x-text="progress"></span>% menuju persalinan
                    </p>

                </div>

            </div>



            <!-- ================= PERKEMBANGAN BAYI ================= -->

            @php

            $fetusData = [
            1 => ['fruit'=>'Biji wijen','size'=>'1 mm','weight'=>'< 1 gram'],
                4=> ['fruit'=>'Biji chia','size'=>'4 mm','weight'=>'< 1 gram'],
                    8=> ['fruit'=>'Kacang merah','size'=>'1.6 cm','weight'=>'1 gram'],
                    12 => ['fruit'=>'Jeruk nipis','size'=>'5 cm','weight'=>'14 gram'],
                    16 => ['fruit'=>'Alpukat kecil','size'=>'11 cm','weight'=>'100 gram'],
                    20 => ['fruit'=>'Pisang','size'=>'16 cm','weight'=>'300 gram'],
                    24 => ['fruit'=>'Jagung','size'=>'30 cm','weight'=>'600 gram'],
                    28 => ['fruit'=>'Terong','size'=>'37 cm','weight'=>'1 kg'],
                    32 => ['fruit'=>'Nanas','size'=>'42 cm','weight'=>'1.7 kg'],
                    36 => ['fruit'=>'Pepaya','size'=>'47 cm','weight'=>'2.6 kg'],
                    40 => ['fruit'=>'Semangka kecil','size'=>'50 cm','weight'=>'3.2 kg'],
                    ];

                    $nearestWeek = collect(array_keys($fetusData))
                    ->sort()
                    ->filter(fn($w)=>$w <= $week)
                        ->last();

                        $fetus = $fetusData[$nearestWeek];

                        @endphp


                        <div
                            x-data="{ progress: 0 }"
                            x-init="setTimeout(() => progress = {{ round(($week/40)*100) }}, 400)"
                            class="bg-white rounded-3xl shadow-lg border border-pink-100 p-8">

                            <h3 class="text-xl font-semibold mb-6 flex items-center gap-2">
                                👶 Perkembangan Bayi Minggu {{ $week }}
                            </h3>


                            <div class="grid md:grid-cols-2 gap-8 items-center">


                                <!-- GAMBAR -->

                                <!-- GAMBAR -->
                                <div class="flex justify-center">

                                    <div class="bg-pink-50 p-8 rounded-3xl shadow-inner">

                                        <img
                                            src="/images/fetus/week{{ $nearestWeek }}.png"
                                            class="w-72 md:w-[420px] h-auto object-contain drop-shadow-2xl transition-transform duration-300 hover:scale-105">

                                    </div>

                                </div>


                                <!-- INFO -->

                                <div class="space-y-4">

                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Perbandingan ukuran</span>
                                        <span class="font-semibold text-pink-500">
                                            {{ $fetus['fruit'] }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Panjang bayi</span>
                                        <span class="font-semibold">
                                            {{ $fetus['size'] }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Perkiraan berat</span>
                                        <span class="font-semibold">
                                            {{ $fetus['weight'] }}
                                        </span>
                                    </div>


                                    <!-- Progress -->

                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">

                                        <div
                                            class="bg-gradient-to-r from-pink-500 to-purple-500 h-3 rounded-full transition-all duration-1000"
                                            :style="`width: ${progress}%`">
                                        </div>

                                    </div>

                                    <p class="text-xs text-gray-500">
                                        <span x-text="progress"></span>% menuju kelahiran
                                    </p>

                                </div>

                            </div>

                        </div>


                        @endif


        </div>
    </div>

</x-app-layout>