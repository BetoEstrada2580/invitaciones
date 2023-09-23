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

    <x-primary-button type="button" @click="$dispatch('nuevaUbicacion')">
        Agregar ubicación
    </x-primary-button>
    
    <div class="flex flex-col md:flex-row items-stretch gap-3 mt-2">
    @forelse ($ubicaciones as $ubicacion)
        <div class="p-6 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:justify-between md:items-center md:w-1/2">
            <div class="space-y-3">
                <a href="" class="text-xl font-bold">
                    {{$ubicacion->nombre}}
                </a>
                <p class="text-base font-bold">
                    {{$ubicacion->tipo_ubicacion_id}}
                </p>
                <p href="" class="text-base font-bold">
                    {{$ubicacion->fecha->format('d/m/Y h:i a')}}
                </p>
                <p class="text-base font-bold">
                    {{$ubicacion->direccion}}
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarUbicacion', { ubicacion: {{$ubicacion}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarUbicacionModal', {{$ubicacion}} )">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay ubicaciones que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.ubicacion')

@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('eliminarUbicacionModal', (ubicacion) => {
            // El siguiente código es el Alert utilizado
            Swal.fire({
            title: '¿Eliminar ubicación: '+ubicacion.nombre+'?',
            text: "Una evento eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                //eliminar la evento
                @this.dispatch('eliminarUbicacion', {ubicacion: ubicacion});

                Swal.fire(
                '¡Eliminado!',
                'El evento se ha eliminado correctamente',
                'success'
                );
            }
            });

            });
        });
    </script>

    @endpush
</div>