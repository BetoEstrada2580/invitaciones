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

    <x-primary-button type="button" @click="$dispatch('nuevaGaleria')">
        Agregar imagen a la galeria
    </x-primary-button>
    
    <div class="grid md:grid-cols-2 gap-3 mt-2">
    @forelse ($galerias as $galeria)
        <div class="p-3 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:gap-3 md:items-center">
            <div>
                <img class="h-auto max-w-xs" src="{{ asset('storage/galerias/'.$galeria->imagen->url) }}" alt="Imagen actual" >
            </div>
            <div class="flex flex-col items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarGaleria', { galeria: {{$galeria->id}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarGaleriaModal', {{$galeria}} )">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay imagenes de galeria que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.galeria')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('eliminarGaleriaModal', (galeria) => {
            // El siguiente código es el Alert utilizado
            Swal.fire({
            title: '¿Eliminar imagen de galeria?',
            text: "Una imagen de galeria eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.dispatch('eliminarGaleria', {galeria: galeria});

                Swal.fire(
                '¡Eliminado!',
                'La imagen de la galeria se ha eliminado correctamente',
                'success'
                );
            }
            });

            });
        });
    </script>

    @endpush
</div>