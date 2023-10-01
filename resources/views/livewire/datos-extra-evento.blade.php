<div>
    @if (session()->has('success'))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600
        font-bold p-2 my-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

<form class="grid gap-6 mb-6 md:grid-cols-2" wire:submit.prevent="editarEventoExtra" novalidate>
    
    <div>
        <x-input-label for="mensaje" :value="__('Mensaje')" />
        <x-text-input 
            id="mensaje" 
            class="block mt-1 w-full"
            type="text" 
            wire:model="mensaje"
            placeholder="Mensaje principal de la invitación"
        />
        <x-input-error :messages="$errors->get('mensaje')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="titulo_final" :value="__('Titulo secundario')" />
        <x-text-input 
            id="titulo_final" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo_final"
            placeholder="Titulo secundario"
        />
        <x-input-error :messages="$errors->get('titulo_final')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="mensaje_final" :value="__('Mensaje Final')" />
        <x-text-input 
            id="mensaje_final" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="mensaje_final"
            :value="old('mensaje_final')"
            placeholder="Nombre del/los mensaje_finals"
        />
        <x-input-error :messages="$errors->get('mensaje_final')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="hashtag" :value="__('Hashtag')" />
        <x-text-input 
            id="hashtag" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="hashtag"
            :value="old('hashtag')"
            placeholder="hashtag del evento"
        />
        <x-input-error :messages="$errors->get('hashtag')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="video" :value="__('Video')" />
        <x-text-input 
            id="video" 
            class="block mt-1 w-full" 
            type="url" 
            wire:model="video"
            :value="old('video')"
            placeholder="URL del video"
        />
        <x-input-error :messages="$errors->get('video')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="cancion" :value="__('Canción')" />
        <x-text-input 
            id="cancion" 
            class="block mt-1 w-full" 
            type="url" 
            wire:model="cancion"
            :value="old('cancion')"
            placeholder="URL de la cancion"
        />
        <x-input-error :messages="$errors->get('cancion')" class="mt-2" />
    </div>

    <div class="mt-8">
        <x-primary-button class="gap-2" wire:loading.attr="disabled">
            Guardar
        </x-primary-button>
    </div>
    
    <div wire:loading> 
        <x-loading/>
    </div>
    
</form>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
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