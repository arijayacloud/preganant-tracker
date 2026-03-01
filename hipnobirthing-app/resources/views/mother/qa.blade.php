<x-app-layout>

    <div class="py-8 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8"
            x-data="qaFilter()">

            <!-- HEADER -->
            <div class="relative overflow-hidden bg-gradient-to-r 
                from-rose-400 via-pink-500 to-purple-500 
                rounded-3xl shadow-xl p-8 text-white">

                <div class="flex items-center justify-between">

                    <div>
                        <h2 class="text-3xl font-bold">
                            Konsultasi dengan Bidan
                        </h2>

                        <p class="mt-2 text-sm opacity-90">
                            Ajukan pertanyaan seputar kehamilan Anda
                        </p>
                    </div>

                    <div class="text-6xl animate-bounce">
                        🩺
                    </div>

                </div>

                <div class="absolute -right-20 -top-20 w-60 h-60 bg-white/20 rounded-full blur-3xl"></div>

            </div>


            <!-- NOTIFICATION -->
            @if(session('answered'))
            <div class="bg-green-100 border border-green-200 text-green-700 
                p-4 rounded-xl shadow animate-pulse">
                Bidan telah menjawab pertanyaan Anda
            </div>
            @endif


            <!-- FORM PERTANYAAN -->
            @if(session('success'))

            <div class="bg-green-100 border border-green-200 text-green-700 
                p-4 rounded-xl shadow">

                {{ session('success') }}

            </div>

            @endif
            <div class="bg-white/80 backdrop-blur-lg border border-gray-100 
                rounded-2xl shadow-md p-6">

                <form action="{{ route('qa.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <textarea
                        name="question"
                        rows="3"
                        placeholder="Tanyakan sesuatu kepada bidan..."
                        class="w-full border border-gray-200 rounded-xl p-4
                focus:ring-2 focus:ring-pink-400 focus:border-pink-400
                transition"></textarea>

                    <div class="flex justify-end">

                        <button
                            class="bg-gradient-to-r from-pink-500 to-purple-500
                hover:scale-105 hover:shadow-lg
                transition-all duration-300
                text-white px-6 py-2 rounded-xl">

                            Kirim Pertanyaan

                        </button>

                    </div>

                </form>

            </div>

            <!-- FILTER -->
            <div class="flex gap-3">

                <button
                    @click="filter='all'"
                    :class="filter=='all'?active:normal"
                    class="px-4 py-2 rounded-xl text-sm transition">
                    Semua
                </button>

                <button
                    @click="filter='pending'"
                    :class="filter=='pending'?active:normal"
                    class="px-4 py-2 rounded-xl text-sm transition">
                    Belum Dijawab
                </button>

                <button
                    @click="filter='answered'"
                    :class="filter=='answered'?active:normal"
                    class="px-4 py-2 rounded-xl text-sm transition">
                    Sudah Dijawab
                </button>

            </div>



            <!-- LIST QNA -->
            <div class="space-y-5">

                @if($qas->count())

                @foreach($qas as $qa)

                <div
                    x-show="filter=='all'||filter=='{{ $qa->status }}'"
                    class="bg-white/80 backdrop-blur-lg border border-gray-100
                    rounded-2xl shadow-md p-6 hover:shadow-xl transition">

                    <!-- USER QUESTION -->
                    <div class="flex gap-3">

                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                            🤰
                        </div>

                        <div class="flex-1">

                            <div class="flex justify-between items-center">

                                <p class="font-semibold text-gray-800">
                                    Anda
                                </p>

                                <span
                                    class="text-xs px-3 py-1 rounded-full
                                        {{ $qa->status=='answered'
                                        ?'bg-green-100 text-green-600'
                                        :'bg-yellow-100 text-yellow-600' }}">

                                    {{ $qa->status=='answered'?'Dijawab':'Pending' }}

                                </span>

                            </div>

                            <div class="bg-gray-50 rounded-xl p-3 mt-2">

                                <p class="text-gray-700">
                                    {{ $qa->question }}
                                </p>

                            </div>

                            <p class="text-xs text-gray-400 mt-2">
                                {{ $qa->created_at->diffForHumans() }}
                            </p>

                        </div>

                    </div>



                    <!-- MIDWIFE ANSWER -->
                    @if($qa->answer)

                    <div class="flex gap-3 mt-5 pl-12">

                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            🩺
                        </div>

                        <div class="flex-1">

                            <div class="bg-green-50 rounded-xl p-4">

                                <p class="font-semibold text-green-700 mb-1">
                                    Bidan
                                </p>

                                <p class="text-gray-700">
                                    {{ $qa->answer }}
                                </p>

                            </div>

                            <p class="text-xs text-gray-400 mt-2">
                                {{ $qa->updated_at->diffForHumans() }}
                            </p>

                        </div>

                    </div>

                    @endif

                </div>

                @endforeach

                @else


                <!-- EMPTY STATE -->
                <div class="bg-white rounded-2xl shadow-md p-10 text-center">

                    <div class="text-5xl mb-4">
                        💬
                    </div>

                    <p class="text-gray-500">
                        Belum ada pertanyaan.
                    </p>

                    <p class="text-sm text-gray-400 mt-2">
                        Silakan ajukan pertanyaan pertama Anda kepada bidan.
                    </p>

                </div>

                @endif

            </div>

        </div>
    </div>



    <script src="https://unpkg.com/alpinejs" defer></script>

    <script>
        function qaFilter() {

            return {

                filter: 'all',

                active: 'bg-pink-500 text-white shadow',
                normal: 'bg-gray-100 text-gray-600 hover:bg-gray-200'

            }

        }
    </script>

</x-app-layout>