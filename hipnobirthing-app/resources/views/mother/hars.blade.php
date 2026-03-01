<x-app-layout>

    <div class="py-8 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- HEADER -->
            <div class="relative overflow-hidden 
bg-gradient-to-r from-pink-500 via-rose-400 to-purple-500
rounded-3xl shadow-xl p-8 text-white">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-3xl font-bold">
                            Skrining Kecemasan (HARS)
                        </h2>

                        <p class="text-sm opacity-90 mt-1">
                            Isi sesuai kondisi Anda dalam 1 minggu terakhir
                        </p>
                    </div>

                    <div class="text-6xl opacity-80 animate-bounce">
                        🧠
                    </div>

                </div>

            </div>

            <form action="{{ route('hars.store') }}" method="POST">
                @csrf

                <div
                    x-data="harsApp()"
                    class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">

                    <!-- QUESTIONS -->
                    <div class="space-y-6">

                        @foreach($questions as $index => $question)

                        <div class="border border-gray-100 rounded-xl p-6 hover:shadow-md transition">

                            <p class="font-semibold text-gray-700 mb-4">
                                {{ $index+1 }}. {{ $question->question }}
                            </p>

                            <div class="grid grid-cols-5 gap-3 text-sm">

                                @for($i=0;$i<=4;$i++)

                                    <label class="cursor-pointer block">
                                    <input type="radio"
                                        name="score[{{ $question->id }}]"
                                        value="{{ $i }}"
                                        class="peer hidden"
                                        required
                                        x-model="answers[{{ $question->id }}]"
                                        @change="calculate">

                                    <div
                                        class="py-3 rounded-lg border text-center transition-all duration-200"
                                        :class="answers[{{ $question->id }}] == {{ $i }} 
        ? 'bg-gradient-to-r from-pink-500 to-purple-500 text-white border-transparent scale-110 shadow-lg' 
        : 'bg-gray-50 border-gray-200'">

                                        {{ $i }}
                                    </div>
                                    </label>

                                    @endfor

                            </div>

                            <div class="flex justify-between text-xs text-gray-400 mt-2">
                                <span>Tidak ada</span>
                                <span>Sangat berat</span>
                            </div>

                        </div>

                        @endforeach

                    </div>


                    <!-- LEVEL BADGE -->
                    <div class="mt-8 text-center">

                        <span
                            x-show="total>0"
                            x-transition
                            class="px-5 py-2 rounded-full text-white font-semibold shadow-md"
                            :class="levelColor">

                            Level Kecemasan :
                            <span x-text="levelText"></span>

                        </span>

                    </div>


                    <!-- ALERT -->
                    <div x-show="total>=25" x-transition
                        class="mt-5 p-4 bg-red-100 text-red-700 rounded-xl text-sm">

                        ⚠️ Skor menunjukkan kecemasan tinggi.
                        Disarankan melakukan relaksasi hypnobirthing atau konsultasi tenaga kesehatan.

                    </div>


                    <!-- PROGRESS -->
                    <div class="mt-6">

                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">

                            <div class="h-4 rounded-full
bg-gradient-to-r from-pink-500 to-purple-500
transition-all duration-700"
                                :style="'width:'+(total/56*100)+'%'">

                            </div>

                        </div>

                        <p class="text-sm text-center mt-2 text-gray-500">
                            Skor :
                            <span class="font-semibold text-pink-500" x-text="total"></span>
                            / 56
                        </p>

                    </div>


                    <!-- BUTTON -->
                    <div class="mt-8 text-right">

                        <button
                            type="submit"
                            class="bg-gradient-to-r from-pink-500 to-purple-500
hover:from-pink-600 hover:to-purple-600
text-white px-6 py-3 rounded-xl
font-semibold shadow-lg
hover:scale-105 transition">

                            💾 Simpan Hasil

                        </button>

                    </div>

                </div>

            </form>


            <!-- GRAFIK HISTORI -->
            @if($history->count())

            <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6">

                <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
                    📈 Histori Skor HARS
                </h3>

                <div class="flex items-end justify-center gap-6 h-52">

                    @foreach($history as $item)

                    <div class="flex flex-col items-center">

                        <!-- BAR -->
                        <div class="w-12 h-40 flex items-end bg-gray-100 rounded-xl overflow-hidden">

                            <div
                                x-data="{
        score: {{ (int) $item->total_score }},
        height: 0
    }"
                                x-init="setTimeout(() => {
        height = (score / 56) * 100
    }, 200)"
                                class="w-full bg-gradient-to-t from-pink-500 to-purple-400
           transition-all duration-700 ease-out"
                                :style="'height:' + height + '%'">
                            </div>

                        </div>

                        <!-- SCORE -->
                        <span class="text-xs font-semibold mt-2 text-pink-500">
                            {{ $item->total_score }}
                        </span>

                        <!-- DATE -->
                        <span class="text-xs text-gray-400">
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d M') }}
                        </span>

                    </div>

                    @endforeach

                </div>

            </div>

            @endif


            <script>
                function harsApp() {
                    return {

                        answers: {},
                        total: 0,
                        levelText: '',
                        levelColor: '',

                        calculate() {

                            this.total = Object.values(this.answers)
                                .reduce((sum, val) => sum + parseInt(val || 0), 0)

                            if (this.total <= 17) {
                                this.levelText = 'Ringan'
                                this.levelColor = 'bg-green-500'
                            } else if (this.total <= 24) {
                                this.levelText = 'Sedang'
                                this.levelColor = 'bg-yellow-400'
                            } else {
                                this.levelText = 'Tinggi'
                                this.levelColor = 'bg-red-500'
                            }
                        }
                    }
                }
            </script>

</x-app-layout>