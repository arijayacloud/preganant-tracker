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
                            Panduan Kehamilan
                        </h2>

                        <p class="mt-2 text-sm opacity-90">
                            Trimester {{ $trimester }} • Informasi ibu dan janin
                        </p>
                    </div>

                    <div class="text-6xl opacity-90 animate-bounce">
                        🤰
                    </div>

                </div>
            </div>



            <!-- TAB TRIMESTER -->
            <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-2 flex gap-2 w-fit">

                <a href="{{ route('panduan.trimester',1) }}"
                    class="px-5 py-2 rounded-xl text-sm font-semibold
{{ $trimester == 1 ? 'bg-pink-500 text-white' : 'text-gray-600 hover:bg-pink-50' }}">
                    Trimester 1
                </a>

                <a href="{{ route('panduan.trimester',2) }}"
                    class="px-5 py-2 rounded-xl text-sm font-semibold
{{ $trimester == 2 ? 'bg-pink-500 text-white' : 'text-gray-600 hover:bg-pink-50' }}">
                    Trimester 2
                </a>

                <a href="{{ route('panduan.trimester',3) }}"
                    class="px-5 py-2 rounded-xl text-sm font-semibold
{{ $trimester == 3 ? 'bg-pink-500 text-white' : 'text-gray-600 hover:bg-pink-50' }}">
                    Trimester 3
                </a>

            </div>



            <!-- PERKEMBANGAN JANIN SLIDER -->
            @php
            $availableWeeks = [1,4,8,12,16,20,24,28,32,36,40];

            $selectedWeek = collect($availableWeeks)
            ->filter(fn($w) => $week >= $w)
            ->last() ?? 1;

            $startIndex = array_search($selectedWeek, $availableWeeks);
            @endphp

            <div
                x-data="{
        active: {{ $startIndex ?? 0 }},
        weeks: @js($availableWeeks),
    }"
                class="bg-white rounded-3xl shadow-lg border border-pink-100 p-8 relative overflow-hidden">

                <h3 class="text-xl font-semibold text-pink-600 mb-6 text-center">
                    👶 Perkembangan Janin Minggu ke-<span x-text="weeks[active]"></span>
                </h3>

                <!-- IMAGE -->
                <div class="relative flex items-center justify-center min-h-[420px]">

                    <template x-for="(weekItem, index) in weeks" :key="index">
                        <div x-show="active === index"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="w-full flex justify-center">

                            <img
                                :src="'/images/fetus/week' + weekItem + '.png'"
                                :alt="'Minggu ' + weekItem"
                                class="w-96 md:w-[500px] h-auto rounded-3xl shadow-xl border border-pink-200">
                        </div>
                    </template>

                </div>

                <!-- BUTTONS -->
                <div class="flex justify-between mt-8">

                    <button
                        @click="active = active === 0 ? weeks.length - 1 : active - 1"
                        class="bg-pink-100 hover:bg-pink-200 text-pink-600 px-5 py-2 rounded-xl transition">
                        ◀ Sebelumnya
                    </button>

                    <button
                        @click="active = active === weeks.length - 1 ? 0 : active + 1"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-xl transition">
                        Berikutnya ▶
                    </button>

                </div>

                <!-- DOT INDICATOR -->
                <div class="flex justify-center gap-2 mt-6">
                    <template x-for="(weekItem, index) in weeks" :key="index">
                        <button
                            @click="active = index"
                            :class="active === index 
                    ? 'bg-pink-500 w-4 h-4' 
                    : 'bg-pink-200 w-3 h-3'"
                            class="rounded-full transition-all duration-300">
                        </button>
                    </template>
                </div>

            </div>

            <!-- CHECKLIST KESEHATAN -->
            <div class="bg-white rounded-3xl shadow-md p-6 border border-green-100">

                <div class="flex items-center gap-3 mb-5">

                    <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                        ✅
                    </div>

                    <h3 class="text-lg font-semibold text-green-600">
                        Checklist Kesehatan Ibu
                    </h3>

                </div>

                <div class="grid md:grid-cols-2 gap-4 text-gray-700">

                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="rounded text-pink-500">
                        Minum vitamin kehamilan
                    </label>

                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="rounded text-pink-500">
                        Minum air putih cukup
                    </label>

                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="rounded text-pink-500">
                        Olahraga ringan / jalan kaki
                    </label>

                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="rounded text-pink-500">
                        Latihan relaksasi hypnobirthing
                    </label>

                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="rounded text-pink-500">
                        Istirahat cukup
                    </label>

                    <label class="flex items-center gap-3">
                        <input type="checkbox" class="rounded text-pink-500">
                        Kontrol ANC sesuai jadwal
                    </label>

                </div>

            </div>



            {{-- INFO HARS --}}
            @if($harsLevel)

            <div class="bg-white border border-pink-200 rounded-2xl p-5 shadow-sm flex items-center gap-4">

                <div class="text-3xl">
                    💗
                </div>

                <div>
                    <p class="text-sm text-gray-500">
                        Tingkat kecemasan berdasarkan
                        <span class="font-semibold text-pink-600">HARS</span>
                    </p>

                    <p class="text-lg font-bold text-pink-600">
                        {{ $harsLevel }}
                    </p>
                </div>

            </div>

            @endif




            <!-- KETIDAKNYAMANAN FISIK -->
            <div class="bg-white rounded-3xl shadow-md p-6 border border-pink-100">

                <div class="flex items-center gap-3 mb-6">

                    <div class="bg-pink-100 text-pink-600 p-2 rounded-lg">
                        🤰
                    </div>

                    <h3 class="text-lg font-semibold text-pink-600">
                        Ketidaknyamanan Fisik
                    </h3>

                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse($fisik as $item)

                    <div class="bg-pink-50 border border-pink-100 rounded-xl p-5 
hover:shadow-lg hover:-translate-y-1 transition duration-200">

                        <h4 class="font-semibold text-gray-800 mb-2">
                            {{ $item->discomfort }}
                        </h4>

                        <p class="text-sm text-gray-600 leading-relaxed">
                            <span class="font-semibold text-pink-500">
                                Solusi:
                            </span>
                            {{ $item->solution }}
                        </p>

                        @if($item->notes)

                        <div class="mt-3 text-xs text-red-500 bg-red-50 p-2 rounded-md">
                            ⚠ {{ $item->notes }}
                        </div>

                        @endif

                    </div>

                    @empty

                    <p class="text-gray-400">
                        Belum ada data ketidaknyamanan fisik
                    </p>

                    @endforelse

                </div>

            </div>




            <!-- KETIDAKNYAMANAN EMOSIONAL -->
            <div class="bg-white rounded-3xl shadow-md p-6 border border-purple-100">

                <div class="flex items-center gap-3 mb-6">

                    <div class="bg-purple-100 text-purple-600 p-2 rounded-lg">
                        💞
                    </div>

                    <h3 class="text-lg font-semibold text-purple-600">
                        Ketidaknyamanan Emosional
                    </h3>

                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse($emosional as $item)

                    <div class="bg-purple-50 border border-purple-100 rounded-xl p-5 
hover:shadow-lg hover:-translate-y-1 transition duration-200">

                        <h4 class="font-semibold text-gray-800 mb-2">
                            {{ $item->discomfort }}
                        </h4>

                        <p class="text-sm text-gray-600 leading-relaxed">

                            <span class="font-semibold text-purple-500">
                                Solusi:
                            </span>

                            {{ $item->solution }}

                        </p>

                        @if($item->notes)

                        <div class="mt-3 text-xs text-red-500 bg-red-50 p-2 rounded-md">
                            ⚠ {{ $item->notes }}
                        </div>

                        @endif

                    </div>

                    @empty

                    <p class="text-gray-400">
                        Belum ada data ketidaknyamanan emosional
                    </p>

                    @endforelse

                </div>

            </div>


        </div>
    </div>

</x-app-layout>