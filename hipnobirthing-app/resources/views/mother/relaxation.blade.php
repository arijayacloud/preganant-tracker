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
                            🎧 Modul Relaksasi Hypnobirthing
                        </h2>

                        <p class="mt-3 text-sm opacity-90 max-w-md">
                            Latihan pernapasan, afirmasi positif, dan meditasi untuk
                            membantu ibu tetap tenang menjelang persalinan.
                        </p>
                    </div>

                    <div class="text-7xl opacity-80 animate-bounce">
                        🧘‍♀️
                    </div>

                </div>

                <div class="absolute -right-20 -top-20 w-60 h-60 
    bg-white/20 rounded-full blur-3xl"></div>

            </div>

            <!-- ✅ SUCCESS ALERT -->
            @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 p-4 rounded-2xl shadow animate-fade-in">
                {{ session('success') }}
            </div>
            @endif

            <!-- 📊 STATUS LEVEL -->
            @php
            $level = strtolower($latestHars->anxiety_level ?? '');
            $color = match($level){
            'ringan' => 'bg-green-500',
            'sedang' => 'bg-yellow-400',
            'berat' => 'bg-red-500',
            default => 'bg-gray-400'
            };
            @endphp

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 
p-6 flex items-center justify-between hover:shadow-lg transition">

                <div>
                    <p class="text-gray-500 text-sm">Level Kecemasan Saat Ini</p>
                    <p class="text-2xl font-bold text-gray-700 mt-2">
                        {{ ucfirst($latestHars->anxiety_level ?? 'Belum Tes') }}
                    </p>
                </div>

                <span class="px-6 py-2 rounded-full text-white text-sm font-semibold shadow {{ $color }}">
                    {{ ucfirst($latestHars->anxiety_level ?? '-') }}
                </span>

            </div>

            <!-- 📈 STATISTIK -->
            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-white p-6 rounded-3xl shadow border border-gray-100 hover:shadow-xl transition">
                    <p class="text-gray-500 text-sm">Level Kecemasan</p>

                    <p class="text-3xl font-bold mt-2 text-gray-700">
                        {{ ucfirst($latestHars->anxiety_level ?? 'Belum Tes') }}
                    </p>

                    <span class="inline-block mt-3 px-4 py-1 rounded-full text-white text-xs {{ $color }}">
                        Status
                    </span>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 
hover:shadow-lg transition">
                    <p class="text-gray-500 text-sm">Total Latihan</p>

                    <p class="text-4xl font-bold text-pink-500 mt-3">
                        {{ $totalSessions ?? 0 }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded-3xl shadow border border-gray-100 hover:shadow-xl transition">
                    <p class="text-gray-500 text-sm">Latihan Minggu Ini</p>

                    <p class="text-4xl font-bold text-purple-500 mt-3">
                        {{ $thisWeek ?? 0 }}
                    </p>
                </div>

            </div>

            <!-- 🧠 INSIGHT -->
            @if($recommendation)
            <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50
rounded-3xl p-6 border border-purple-100 shadow-sm">

                <p class="text-purple-700 font-semibold">
                    🧠 Insight Sistem
                </p>

                <p class="mt-3 text-sm text-gray-600 leading-relaxed">
                    {{ $recommendation }}
                </p>
            </div>
            @endif

            <!-- 🔔 REMINDER -->
            @if($showReminder)
            <div class="bg-rose-50 border border-rose-200 
rounded-2xl p-5 shadow-sm">

                <p class="text-rose-600 font-semibold">
                    🔔 Sudah 3 hari belum latihan
                </p>

                <p class="text-sm text-rose-500 mt-2">
                    Luangkan 10 menit hari ini untuk relaksasi 🌸
                </p>
            </div>
            @endif

            <!-- 📊 GRAFIK -->
            <div
                x-data="weeklyChartComponent()"
                x-init="initChart(@js($weeklyData))"
                class="bg-white rounded-3xl shadow-md border border-gray-100 p-6">

                <h3 class="text-lg font-semibold text-gray-700 mb-4">
                    📊 Progress 7 Hari Terakhir
                </h3>

                <canvas x-ref="chart"></canvas>

            </div>
            <!-- 🎥 VIDEO TUTORIAL HYPNOBIRTHING -->
            @if(count($tutorialVideos))
            <section class="space-y-6">

                <h3 class="text-xl font-semibold text-gray-700">
                    🎥 Video Tutorial Teknik Hypnobirthing
                </h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($tutorialVideos as $video)
                    <div class="bg-white rounded-3xl shadow-md border border-gray-100 
            hover:shadow-xl hover:-translate-y-2 
            transition-all duration-500 overflow-hidden">

                        <div class="relative aspect-video">
                            <iframe
                                class="w-full h-full"
                                src="{{ $video['url'] }}"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <div class="p-5 space-y-2">
                            <h4 class="font-semibold text-gray-800 text-sm">
                                {{ $video['title'] }}
                            </h4>

                            <p class="text-xs text-gray-400">
                                Durasi {{ $video['duration'] }} menit
                            </p>
                        </div>

                    </div>
                    @endforeach

                </div>

            </section>
            @endif

            <!-- 🎵 AUDIO MODULE -->
            @if(count($audios))

            <section class="space-y-6 mt-12">

                <h3 class="text-xl font-semibold text-gray-700">
                    🎵 Modul Relaksasi
                </h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($audios as $audio)

                    <div class="group bg-white rounded-3xl shadow-md border border-gray-100 
            hover:shadow-2xl hover:-translate-y-2 
            transition-all duration-500 overflow-hidden">

                        <!-- VIDEO -->
                        <div class="relative aspect-video overflow-hidden">
                            <iframe
                                class="w-full h-full group-hover:scale-105 transition duration-500"
                                src="{{ $audio['url'] }}"
                                allowfullscreen>
                            </iframe>
                        </div>

                        <!-- CONTENT -->
                        <div class="p-6 space-y-4">

                            <div class="flex items-center justify-between gap-3">
                                <h4 class="font-semibold text-gray-800 text-sm leading-snug">
                                    {{ $audio['title'] }}
                                </h4>

                                <span class="text-xs px-3 py-1 rounded-full
                        {{ $audio['type'] == 'guided' 
                            ? 'bg-blue-100 text-blue-600' 
                            : 'bg-pink-100 text-pink-600' }}">
                                    {{ ucfirst($audio['type']) }}
                                </span>
                            </div>

                            <p class="text-xs text-gray-400">
                                Durasi {{ $audio['duration'] }} menit
                            </p>

                            <form action="{{ route('relaxation.session') }}" method="POST">
                                @csrf
                                <input type="hidden" name="title" value="{{ $audio['title'] }}">
                                <input type="hidden" name="type" value="{{ $audio['type'] }}">
                                <input type="hidden" name="duration" value="{{ $audio['duration'] }}">

                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-rose-400 to-purple-500
                        hover:scale-105 hover:shadow-lg
                        active:scale-95
                        transition-all duration-300
                        text-white py-3 rounded-xl font-medium">

                                    ✅ Tandai Selesai
                                </button>
                            </form>

                        </div>
                    </div>

                    @endforeach

                </div>

            </section>

            @else

            <div class="bg-white rounded-2xl p-10 text-center shadow-md border border-gray-100 mt-12">
                <p class="text-gray-500">
                    Belum ada modul tersedia.
                </p>
            </div>

            @endif

        </div>
    </div>


    <!-- 📊 ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function weeklyChartComponent() {

            return {

                chart: null,

                initChart(data) {

                    const labels = data.map(d => d.date)
                    const values = data.map(d => d.count)

                    this.chart = new Chart(this.$refs.chart, {

                        type: 'line',

                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Latihan',
                                data: values,
                                borderWidth: 3,
                                tension: 0.4,
                                fill: true,
                                backgroundColor: 'rgba(236,72,153,0.2)',
                                borderColor: '#ec4899',
                                pointBackgroundColor: '#9333ea'
                            }]
                        },

                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }

                    })

                }

            }

        }
    </script>

</x-app-layout>