<div>
    @if (session()->has('success'))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600
        font-bold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="uppercase border border-reed-600 bg-red-100 text-red-600
        font-bold p-2 my-3 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <x-primary-button type="button" @click="$dispatch('nuevaImagen')">
        Agregar imagen al evento
    </x-primary-button>
    
    <div class="grid md:grid-cols-2 gap-3 mt-2">
    @forelse ($principales as $principal)
        <div class="p-3 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100 flex flex-col justify-center items-center gap-3">
            <p class="text-2xl font-bold">
                {{$principal->tipoImagen->nombre}}
            </p>
            <div class="flex items-center">
                <img class="h-auto max-w-xs max-h-52" src="{{ asset('storage/eventos/'.$principal->url) }}" alt="Imagen actual" >
            </div>
            <div class="inline-flex items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarImagen', { imagen: {{$principal->id}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarImagenModal', {{$principal}} )">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay imagenes de imagen que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.imagen')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('eliminarImagenModal', (principal) => {
            // El siguiente código es el Alert utilizado
            Swal.fire({
            title: `¿Eliminar imagen ${principal.tipo_imagen.nombre} ?`,
            text: "Una imagen de imagen eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.dispatch('eliminarImagen', {imagen: principal});

                Swal.fire(
                '¡Eliminado!',
                'La imagen de la imagen se ha eliminado correctamente',
                'success'
                );
            }
            });

            });
        });
    </script>

    @endpush
</div>