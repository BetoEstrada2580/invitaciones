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

    <x-primary-button type="button" @click="$dispatch('nuevoNombramiento')">
        Agregar nombramiento
    </x-primary-button>
    
    <div class="grid md:grid-cols-2 gap-3 mt-2">
    @forelse ($nombramientos as $nombramiento)
        <div class="p-3 border border-gray-600 rounded-lg dark:border-gray-200 text-gray-900 dark:text-gray-100
        md:flex md:items-center">
            <div class="w-3/12">
                <img class="rounded-full h-auto w-20" src="{{ asset('storage/nombramientos/'.$nombramiento->imagen->url) }}" alt="Imagen actual" >
            </div>
            <div class="w-6/12 space-y-3">
                <p class="text-xl font-bold">
                    {{$nombramiento->invitado->nombre}}
                </p>
                <p class="text-base font-bold">
                    {{$nombramiento->titulo}}
                </p>
            </div>
            <div class="w-3/12 flex flex-col items-stretch gap-3 mt-5 md:mt-0 text-center">
                <x-secondary-button @click="$dispatch('consultarNombramiento', { nombramiento: {{$nombramiento->id}} })">
                    {{ __('Editar') }}
                </x-secondary-button>

                <x-danger-button @click="$dispatch('eliminarNombramientoModal', {{$nombramiento}} )">
                    {{ __('Eliminar') }}
                </x-danger-button>
                
            </div>
        </div>
    @empty
    <p class="p-3 text-center text-2xl text-gray-900 dark:text-gray-100">
        No hay nombramientos que mostrar
    </p>
    @endforelse
    </div>
@include('eventos.modals.nombramiento')

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('eliminarNombramientoModal', (nombramiento) => {
            // El siguiente código es el Alert utilizado
            Swal.fire({
            title: '¿Eliminar nombramiento de: '+nombramiento.invitado.nombre+'?',
            text: "Un nombramiento eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                @this.dispatch('eliminarNombramiento', {nombramiento: nombramiento});

                Swal.fire(
                '¡Eliminado!',
                'El nombramiento se ha eliminado correctamente',
                'success'
                );
            }
            });

            });
        });
    </script>

    @endpush
</div>