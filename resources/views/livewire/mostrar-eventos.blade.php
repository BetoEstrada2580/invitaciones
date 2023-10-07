<div>
    @livewire('filtrar-eventos')
    <hr class="mb-3">
    <a href="{{ route('evento.create') }}">
        <x-primary-button class="mb-5">
            {{ __('Agregar evento') }}
        </x-primary-button>
    </a>
    <x-card>
        @forelse ($eventos as $evento)
        <div class=" p-2 md:p-6 border-b border-gray-200 text-gray-900 dark:text-gray-100
        grid gap-1 mb-3 md:grid-cols-3">
            <div class="space-y-3 font-bold">
                <a class="text-2xl text">
                    {{$evento->clave}}
                </a>
                <p class="text-lg truncate">
                    {{$evento->festejado}}
                </p>
            </div>
            
            <div class="space-y-3 font-bold text-lg">
                <p class="text-2xl">
                    {{$evento->fecha->format('d/m/Y')}}
                </p>
                <p class="truncate ">
                    Paquete: {{$evento->paquete->nombre}}
                </p>
            </div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-center gap-3 mt-5 md:mt-0 text-center">
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
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('eliminar', (evento) => {
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
                    @this.dispatch('eliminarEvento', {evento: evento});
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
