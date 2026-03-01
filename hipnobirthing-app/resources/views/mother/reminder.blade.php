<x-app-layout>

    <div class="py-8 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- HEADER -->
            <div class="relative overflow-hidden 
                bg-gradient-to-r from-pink-500 via-rose-400 to-purple-500
                rounded-3xl shadow-xl p-8 text-white">

                <div class="flex items-center justify-between">

                    <div>
                        <h3 class="text-2xl font-bold">
                            Jadwal Pemeriksaan Kehamilan
                        </h3>

                        <p class="opacity-90 text-sm mt-1">
                            Kelola jadwal ANC Anda agar kehamilan tetap terpantau
                        </p>
                    </div>

                    <div class="text-6xl opacity-80 animate-bounce">
                        🤰
                    </div>

                </div>
            </div>

            @if($nextReminder)

            @php
            $daysLeft = ceil(now()->diffInDays($nextReminder->appointment_date, false));
            @endphp

            <div class="bg-gradient-to-r from-purple-500 to-pink-500 
rounded-2xl shadow-xl p-6 text-white">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm opacity-90">
                            Pemeriksaan Berikutnya
                        </p>

                        <h3 class="text-xl font-bold mt-1">
                            {{ \Carbon\Carbon::parse($nextReminder->appointment_date)->format('d M Y') }}
                        </h3>

                        <p class="text-sm mt-1">
                            {{ $nextReminder->location }}
                        </p>
                    </div>

                    <div class="text-right">

                        <p class="text-sm opacity-90">
                            Countdown
                        </p>

                        <h2 class="text-3xl font-bold">
                            ⏳ {{ $daysLeft }} hari lagi
                        </h2>

                    </div>

                </div>

            </div>

            @endif

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))

            <div class="bg-green-100 border border-green-200 text-green-700 
px-4 py-3 rounded-xl shadow-sm">

                {{ session('success') }}

            </div>

            @endif

            {{-- FORM TAMBAH REMINDER --}}
            <div class="bg-white/80 backdrop-blur-lg border border-pink-100 
shadow-xl rounded-2xl p-6">

                <h3 class="text-lg font-semibold text-gray-700 mb-5">
                    Tambah Jadwal ANC
                </h3>

                <form method="POST" action="{{ route('reminder.store') }}">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>

                            <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
                                Tanggal Pemeriksaan
                            </label>

                            <input type="date"
                                name="appointment_date"
                                required
                                class="w-full border border-gray-200 rounded-xl p-3 
focus:ring-2 focus:ring-pink-400">

                        </div>


                        <div>

                            <label class="block text-sm text-gray-600 dark:text-gray-300 mb-1">
                                Lokasi Pemeriksaan
                            </label>

                            <input type="text"
                                name="location"
                                placeholder="Contoh: Puskesmas Balong"
                                required
                                class="w-full border border-gray-200 rounded-xl p-3 
focus:ring-2 focus:ring-pink-400">

                        </div>

                    </div>

                    <button
                        class="mt-5 bg-pink-500 hover:bg-pink-600 
transition text-white px-6 py-2 rounded-xl shadow">

                        Simpan Reminder

                    </button>

                </form>

            </div>

            {{-- LIST REMINDER --}}
            <div class="bg-white/80 backdrop-blur-lg border border-pink-100 
shadow-xl rounded-2xl p-6">

                <h3 class="text-lg font-semibold text-gray-700 mb-6">
                    Jadwal ANC Anda
                </h3>

                <div class="space-y-4">

                    @forelse($reminders as $reminder)

                    <div class="flex items-center justify-between 
bg-white/70 backdrop-blur-md border border-pink-100
rounded-xl p-4 hover:shadow-md transition">

                        <div class="flex items-center gap-4">

                            <div class="w-10 h-10 bg-gradient-to-r from-pink-400 to-rose-400 
rounded-full flex items-center justify-center text-white">
                                🗓️
                            </div>

                            <div>

                                <p class="font-semibold text-gray-700">
                                    {{ \Carbon\Carbon::parse($reminder->appointment_date)->format('d M Y') }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $reminder->location }}
                                </p>

                            </div>

                        </div>

                        <span class="bg-green-100 text-green-700 
text-xs px-3 py-1 rounded-full">

                            Terjadwal

                        </span>

                    </div>

                    @empty

                    <div class="text-center py-10">

                        <div class="text-5xl mb-3">
                            📅
                        </div>

                        <p class="text-gray-500">
                            Belum ada jadwal ANC
                        </p>

                    </div>

                    @endforelse

                </div>

            </div>

            {{-- Timeline ANC --}}
            <div class="bg-white/80 backdrop-blur-lg border border-pink-100 
shadow-xl rounded-2xl p-6">

                <h3 class="font-semibold text-gray-700 mb-5">
                    Timeline ANC
                </h3>

                <div class="space-y-4">

                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-green-500 rounded-full"></div>
                        <p>ANC 1 (Trimester 1)</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-green-500 rounded-full"></div>
                        <p>ANC 2 (Trimester 1)</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                        <p>ANC 3 (Trimester 2)</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                        <p>ANC 4 (Trimester 2)</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="w-6 h-6 bg-gray-300 rounded-full"></div>
                        <p>ANC 5 (Trimester 3)</p>
                    </div>

                </div>

                <div
                    x-data="ancChart()"
                    x-init="initChart()"
                    class="bg-white/80 backdrop-blur-lg border border-pink-100 
shadow-xl rounded-2xl p-6">

                    <h3 class="font-semibold text-gray-700 mb-4">
                        Grafik Kunjungan ANC
                    </h3>

                    <canvas x-ref="chart"></canvas>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            function ancChart() {
                return {

                    initChart() {

                        const ctx = this.$refs.chart;

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['ANC 1', 'ANC 2', 'ANC 3', 'ANC 4', 'ANC 5'],
                                datasets: [{
                                    label: 'Kunjungan ANC',
                                    data: [1, 2, 3, 3, 4],
                                    borderColor: '#ec4899',
                                    backgroundColor: 'rgba(236,72,153,0.2)',
                                    tension: 0.4,
                                    fill: true
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

                        });

                    }

                }
            }
        </script>

</x-app-layout>