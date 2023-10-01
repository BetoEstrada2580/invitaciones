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
        Agregar opción de regalo
    </x-primary-button>
    
    <div class="flex flex-col md:flex-row items-stretch gap-3 mt-2">
    @forelse ($regalos as $regalo)
        <div class="p-3 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        flex flex-col justify-between items-center md:w-1/2">
            <div class="space-y-3">
                <p class="text-xl font-bold">
                    {{$regalo->tipoMesa->nombre}}
                </p>
            </div>

            <div class="flex items-stretch gap-3 mt-5 md:mt-0 text-center">
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
        No hay opciones de regalos que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.mesaRegalo')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('eliminarUbicacionModal', (MesaRegalo) => {
                Swal.fire({
                title: '¿Eliminar opción de regalo de: '+MesaRegalo.tipo_mesa.nombre+'?',
                text: "Una opción de regalo eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('eliminarMesaRegalo', {MesaRegalo: MesaRegalo});
                }
                });
            });

            @this.on('notify', (event) => {
                Swal.fire(
                    {
                        icon: event.type,
                        title: event.title,
                        showConfirmButton: false,
                        timer:3000,
                        timerProgressBar: true
                    }
                );
            });

        });
    </script>

    @endpush
</div>