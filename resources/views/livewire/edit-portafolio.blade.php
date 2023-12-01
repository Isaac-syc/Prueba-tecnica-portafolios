<div class="flex">
    <div class="w-full mt-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Editar Portafolio</h2>
        </div>
        <form wire:submit.prevent="updatePortafolio" enctype="multipart/form-data">
            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título:</label>
                <input wire:model="title" type="text" id="title" name="title"
                    class="mt-1 p-2 w-full border rounded-md">

                @error('portafolio.title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                <div wire:ignore>
                    <div id="editor">
                        {!! $description !!}
                    </div>
                </div>
                <textarea id="editorHidden" name="description" wire:model="description" style="display: none;"></textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Imagen actual -->
            @if ($image_name)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Imagen actual:</label>
                    <img src="{{ asset('storage/images/' . $image_name) }}" alt="{{ $title }}"
                        class="mt-2 w-full h-32 object-cover">
                </div>
            @endif

            <!-- Nueva imagen -->
            <div class="mb-4">
                <label for="newImage" class="block text-sm font-medium text-gray-700">Nueva Imagen:</label>
                <input wire:model="newImage" type="file" id="newImage" name="newImage"
                    class="mt-1 p-2 w-full border rounded-md">
                @error('newImage')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="public" class="block text-sm font-medium text-gray-700">Visibilidad pública:</label>
                <input wire:model="public" type="checkbox" id="public" name="public" class="mt-1"
                    {{ $public ? 'checked' : '' }}>
            </div>

            <button wire:click="confirmDelete" type="button"
                class="float-right bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Eliminar
            </button>


            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Actualizar Portafolio
                </button>
            </div>
        </form>
    </div>



    @if ($confirmingDelete)
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true"
                    style="background: rgba(0, 0, 0, 0.5);" wire:click="$set('confirmingDelete', false)">
                </div>

                <!-- Contenido del Modal -->
                <div class="bg-white p-4 rounded-lg shadow-md relative">
                    <p>¿Estás seguro de que deseas eliminar este portafolio?</p>

                    <!-- Botones del Modal -->
                    <button wire:click="deletePortafolio"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Eliminar
                    </button>
                    <button wire:click="$set('confirmingDelete', false)"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>



@section('js')
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(newEditor => {
                editor = newEditor;

                editor.model.document.on('change:data', () => {
                    let editorHidden = document.getElementById("editorHidden");
                    editorHidden.value = editor.getData();

                    @this.setDescription(editorHidden.value);
                    console.log(editorHidden.value);
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
