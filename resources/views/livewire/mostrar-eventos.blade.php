<div>
    <a href="{{ route('evento.create') }}">
        <x-primary-button class="mb-5">
            {{ __('Agregar evento') }}
        </x-primary-button>
    </a>
    <x-card>
        @forelse ($eventos as $evento)
        <div class="p-6 border-b border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <a href="" class="text-xl font-bold">
                    {{$evento->clave}}
                </a>
                <p class="text-base font-bold">
                    {{$evento->festejado}}
                </p>
                <p href="" class="text-sm">
                    {{$evento->fecha->format('d/m/Y')}}
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0 text-center">
                
                <x-secondary-button onclick="window.location='{{ route('evento.edit', ['evento'=>$evento->id]) }}'">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminar', {{$evento}} )">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
        @empty
        <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
            No hay evento que mostrar
        </p>
        @endforelse
    </x-card>
    <div class="mt-10">
        {{ $eventos->links() }}
    </div>

    @push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('eliminar', (evento) => {
            // El siguiente código es el Alert utilizado
            Swal.fire({
            title: '¿Eliminar evento: '+evento.clave+'?',
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
                @this.dispatch('eliminarEvento', {evento: evento});

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
