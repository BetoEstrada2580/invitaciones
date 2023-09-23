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

    <x-primary-button type="button" @click="$dispatch('nuevaMesaRegalo')">
        Agregar mesa de regalos
    </x-primary-button>
    
    <div class="flex flex-col md:flex-row items-stretch gap-3 mt-2">
    @forelse ($regalos as $regalo)
        <div class="p-6 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:justify-between md:items-center md:w-1/2">
            <div class="space-y-3">
                <a href="" class="text-xl font-bold">
                    {{$regalo->tipoMesa->nombre}}
                </a>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarMesaRegalo', { MesaRegalo: {{$regalo->id}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarUbicacionModal', {{$regalo}} )">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay MesaRegalos que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.mesaRegalo')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('eliminarUbicacionModal', (MesaRegalo) => {
            // El siguiente código es el Alert utilizado
            console.log(MesaRegalo.tipo_mesa);
            Swal.fire({
            title: '¿Eliminar mesa de regalo: '+MesaRegalo.tipo_mesa.nombre+'?',
            text: "Una evento eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.dispatch('eliminarMesaRegalo', {MesaRegalo: MesaRegalo});

                Swal.fire(
                '¡Eliminado!',
                'El MesaRegalo se ha eliminado correctamente',
                'success'
                );
            }
            });

            });
        });
    </script>

    @endpush
</div>