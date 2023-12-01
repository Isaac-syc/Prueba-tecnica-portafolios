<div>
    <div class="flex mt-4 w-full">
        <div class="basis-1/4 items-center">
            <h2 class="text-2xl font-semibold text-gray-800">Gestión de Portafolios</h2>
        </div>

        <div class="flex basis-3/4 justify-end">
            <a href="{{ route('portafolio.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Crear Portafolio
            </a>
        </div>
    </div>


    <div class="mt-4 grid grid-cols-3 gap-4">
        @foreach ($portafolios as $portafolio)
            <div class="relative group bg-white p-4 rounded-lg shadow-md overflow-hidden transition-transform transform hover:scale-105">
                <img src="{{ asset('storage/images/' . $portafolio->image_name) }}" alt="{{ $portafolio->title }}"
                    class="w-full h-32 object-cover mb-4">

                <!-- Icono de editar (oculto inicialmente) -->
                <a href="{{ route('portafolio.edit', $portafolio->id) }}"
                    class="absolute top-2 right-2 bg-blue-500 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                    <!-- Agrega aquí el icono de editar (por ejemplo, un ícono de lápiz) -->
                    Editar
                </a>

                <h3 class="text-lg font-semibold text-gray-800">{{ $portafolio->title }}</h3>
                <p class="text-gray-500">{{ $portafolio->description }}</p>
            </div>
        @endforeach
    </div>
</div>
