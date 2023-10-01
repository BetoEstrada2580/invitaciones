<x-modal name="ModalContacto" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Contactos
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
                <form class="grid gap-6 mb-6 md:grid-cols-2" wire:submit.prevent="formContacto" >
                
                    <div>
                        <x-input-label for="nombre" :value="__('Nombre')" />
                        <x-text-input 
                            id="clave" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="nombre"
                            placeholder="Nombre del contacto"
                        />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="telefono" :value="__('Telefono')" />
                        <x-text-input 
                            id="telefono" 
                            class="block mt-1 w-full" 
                            type="tel" 
                            wire:model="telefono"
                            placeholder="Telefono del contacto"
                        />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
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
            </div>
        </div>
    </div>
</x-modal>