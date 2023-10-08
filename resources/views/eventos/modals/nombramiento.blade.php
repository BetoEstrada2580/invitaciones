<x-modal name="ModalNombramiento" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Nombramiento
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                x-on:click="show = false" >
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form class="flex-col md:grid gap-6 mb-6 md:grid-cols-2 space-y-3 md:space-y-0" wire:submit.prevent="formNombramiento" >
                
                    <div class="md:col-span-2">
                        <x-input-label for="invitacion_id" :value="__('Invitado')" />
                        <x-select wire:model="invitacion_id" id="invitacion_id">
                                <option value="">Selecciona el invitado</option>
                                @foreach ($invitados as $invitado)
                                    <option value="{{$invitado->id}}">{{$invitado->nombre}}</option>
                                @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('invitacion_id')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="titulo" :value="__('Titulo')" />
                        <x-text-input 
                            id="titulo" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="titulo"
                            placeholder="Titulo del nombramiento"
                        />
                        <x-input-error :messages="$errors->get('titulo')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="orden" :value="__('Orden')" />
                        <x-text-input 
                            id="orden" 
                            class="block mt-1 w-full" 
                            type="number" 
                            wire:model="orden"
                            min="1"
                            placeholder="Orden del nombramiento"
                        />
                        <x-input-error :messages="$errors->get('orden')" class="mt-2" />
                    </div>
                    
                    <div class="md:col-span-2">
                        <x-input-label for="titulo" :value="__('Foto')" />
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                            id="{{ rand() }}" type="file" accept="image/*" wire:model="imagen">
                        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                    </div>
                    
                    @if ($imagen)
                    <div class="md:col-span-2 grid">
                            <x-input-label :value="__('Imagen nueva')" />
                            <div class="w-full inline-flex justify-center items-center">
                                <img class="rounded-full h-auto w-48" src="{{$imagen->temporaryUrl()}}" alt="Imagen nueva" >
                            </div>
                    </div>
                    @endif
                    
                    @if ($imagen_actual)
                    <div class="md:col-span-2 grid">
                            <x-input-label :value="__('Imagen actual')" />
                            <div class="w-full inline-flex justify-center items-center">
                                <img class="rounded-full h-auto w-48" src="{{ asset('storage/nombramientos/'.$imagen_actual) }}" alt="Imagen actual" >
                            </div>
                    </div>
                    @endif
                    
                    <div class="mt-8 w-full flex justify-end col-span-2">
                        <x-primary-button class="gap-2" wire:loading.attr="disabled">
                            Guardar
                        </x-primary-button>
                        <div wire:loading> 
                            <x-loading/>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</x-modal>