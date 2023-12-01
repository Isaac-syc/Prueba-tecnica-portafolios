<div class="flex">
    <div class="w-full mt-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Crear portafolio</h2>
        </div>
        <form wire:submit.prevent="createPortafolio" enctype="multipart/form-data">
            <!-- Título -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Título:</label>
                <input wire:model="title" type="text" id="title" name="title"
                    class="mt-1 p-2 w-full border rounded-md">
                @error('title')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                <div wire:ignore>
                    <div id="editor">
                    </div>
                </div>
                <textarea id="editorHidden" name="description" wire:model="description" style="display: none;"></textarea>
                @error('description')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>



            <!-- Imagen -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Imagen:</label>
                <input wire:model="image" type="file" id="image" name="image"
                    class="mt-1 p-2 w-full border rounded-md">
                @error('image')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <!-- Visibilidad pública -->
            <div class="mb-4">
                <label for="public" class="block text-sm font-medium text-gray-700">Visibilidad pública:</label>
                <input wire:model="public" type="checkbox" id="public" name="public" class="mt-1">
            </div>

            <!-- Botón de envío -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Crear Portafolio
                </button>
            </div>
        </form>
    </div>
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
