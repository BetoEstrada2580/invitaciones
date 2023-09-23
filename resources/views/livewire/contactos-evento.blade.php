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
    
    <div class="flex flex-col md:flex-row items-stretch gap-3 mt-2">
    @forelse ($contactos as $contacto)
        <div class="p-6 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:justify-between md:items-center md:w-1/2">
            <div class="space-y-3">
                <a href="" class="text-xl font-bold">
                    {{$contacto->nombre}}
                </a>
                <p class="text-base font-bold">
                    {{$contacto->telefono}}
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarContacto', { contacto: {{$contacto->id}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarContactoModal', {{$contacto}} )">
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
           @this.on('eliminarContactoModal', (contacto) => {
            // El siguiente código es el Alert utilizado
            Swal.fire({
            title: '¿Eliminar contacto: '+contacto.nombre+'?',
            text: "Una evento eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.dispatch('eliminarContacto', {contacto: contacto});

                Swal.fire(
                '¡Eliminado!',
                'El contacto se ha eliminado correctamente',
                'success'
                );
            }
            });

            });
        });
    </script>

    @endpush
</div>