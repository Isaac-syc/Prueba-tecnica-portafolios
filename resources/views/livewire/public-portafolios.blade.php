<div>
    @if (!auth()->check())
        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Iniciar sesión para ver más</a>
        </div>
    @else
        <div class="text-center mt-4">
            <a href="{{ route('portafolio.index') }}" class="text-blue-500 hover:underline">Explorar portafolios</a>
        </div>
    @endif

    <h2 class="text-3xl font-bold text-center text-gray-800 mb-6 mt-6">Portafolio</h2>
    <div class="bg-gray-100 p-4">
        <div class="grid grid-cols-5 gap-4">
            @foreach ($portafolios as $portafolio)
                <div x-data="{ showDescription: false }" @mouseover="showDescription = true" @mouseout="showDescription = false"
                    class="group relative overflow-hidden">
                    <img class="w-full h-auto object-cover rounded-lg transform transition-transform duration-150"
                        src="{{ asset('storage/images/' . $portafolio->image_name) }}" alt="">
                    <div x-show="showDescription"
                        class="overlay absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 text-white p-4 opacity-100 transition-opacity">
                        <div>
                            {!! $portafolio->description !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
