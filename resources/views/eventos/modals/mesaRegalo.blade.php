<x-modal name="ModalMesaRegalo" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Opción de regalo
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
                <form class="grid gap-6 mb-6 md:grid-cols-2" wire:submit.prevent="formMesaRegalo" >

                    <div>
                        <x-input-label for="tipo_mesa_regalo_id" :value="__('Tipo de mesa de regalo')" />
                        <x-select wire:model="tipo_mesa_regalo_id" id="tipo_mesa_regalo_id">
                                <option value="">Seleccione un tipo de mesa de regalo</option>
                                @foreach ($tipoMesaRegalos as $tipoMesaRegalo)
                                    <option value="{{$tipoMesaRegalo->id}}">{{$tipoMesaRegalo->nombre}}</option>
                                @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('tipo_mesa_regalo_id')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="codigo" :value="__('Codigo')" />
                        <x-text-input 
                            id="codigo" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="codigo"
                            placeholder="codigo o clave de liverpool"
                        />
                        <x-input-error :messages="$errors->get('codigo')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="url" :value="__('URL')" />
                        <x-text-input 
                            id="url" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="url"
                            :value="old('url')"
                            placeholder="url de la wishlist de Amazon"
                        />
                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="banco" :value="__('Banco')" />
                        <x-text-input 
                            id="banco" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="banco"
                            :value="old('banco')"
                            placeholder="Nombre del banco"
                        />
                        <x-input-error :messages="$errors->get('banco')" class="mt-2" />
                    </div>
                
                    <div>
                        <x-input-label for="clabe" :value="__('Clabe')" />
                        <x-text-input 
                            id="clabe" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="clabe"
                            :value="old('clabe')"
                            placeholder="clabe de la cuenta bancaria"
                        />
                        <x-input-error :messages="$errors->get('clabe')" class="mt-2" />
                    </div>
                
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