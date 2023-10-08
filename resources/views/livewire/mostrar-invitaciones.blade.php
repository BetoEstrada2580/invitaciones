<div class="p-6">

    <x-primary-button type="button" @click="$dispatch('nuevaInvitacion')">
        Agregar invitado
    </x-primary-button>
    
    <div class="flex-col gap-3 mt-2 space-y-3">
    @forelse ($invitaciones as $invitado)
        <div class="p-3 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        flex-col justify-between md:items-center">
            <div class="border-b-2 border-b-stone-100 columns-2">
                <p class="text-sm md:text-2xl font-bold">
                    {{$invitado->nombre}}
                </p>
                <p class="text-xs md:text-2xl">Generada: {{$invitado->created_at->diffForHumans()}}</p>
            </div>

            <div class="flex justify-between items-center mt-2">
                <p class="text-sm md:text-xl font-bold text-center">
                    {{ $invitado->pases }} @choice('pase|pases', $invitado->pases)
                </p>
                <div class="flex justify-center items-stretch gap-3 md:mt-0 text-center">
                    <x-secondary-button @click="$dispatch('consultarInvitacion', { invitacion: {{$invitado->id}} })">
                        {{ __('Editar') }}
                    </x-secondary-button>
                    <x-danger-button @click="$dispatch('eliminarInvitacionModal'
                        ,{ id: {{$invitado->id}} , nombre: '{{$invitado->nombre}}' }) ">
                        {{ __('Eliminar') }}
                    </x-danger-button>
                </div>
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay invitados que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.invitacion')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('eliminarInvitacionModal', ({id,nombre}) => {
                Swal.fire({
                title: '¿Eliminar invitación: '+nombre+'?',
                text: "Una invitación eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('eliminarInvitacion', {invitacion: id});
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