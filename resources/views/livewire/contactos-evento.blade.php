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

    <x-primary-button type="button" @click="$dispatch('nuevoContacto')">
        Agregar contacto
    </x-primary-button>
    
    <div class="grid md:grid-cols-2 gap-3 mt-2">
    @forelse ($contactos as $contacto)
        <div class="p-3 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:justify-between md:items-center">
            <div class="space-y-3">
                <p class="text-2xl font-bold">
                    {{$contacto->nombre}}
                </p>
                <p class="text-base font-bold">
                    {{$contacto->telefono}}
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarContacto', { contacto: {{$contacto->id}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarContactoModal'
                    ,{ id: {{$contacto->id}} , nombre: '{{$contacto->nombre}}' }) ">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay contactos que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.contacto')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('eliminarContactoModal', ({id,nombre}) => {
                Swal.fire({
                title: '¿Eliminar contacto: '+nombre+'?',
                text: "Una evento eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('eliminarContacto', {contacto: id});
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