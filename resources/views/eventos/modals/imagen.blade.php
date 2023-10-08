<x-modal name="ModalImagen" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Imagen del evento
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
                <form class="grid gap-6 mb-6" wire:submit.prevent="formImagen" >

                    <div>
                        <x-input-label for="tipo_imagen_id" :value="__('Tipo de imagen')" />
                        <x-select wire:model="tipo_imagen_id" id="tipo_imagen_id">
                                <option value="">Seleccione un tipo de imagen</option>
                                @foreach ($tipoImagenes as $tipoImagen)
                                    <option value="{{$tipoImagen->id}}">{{$tipoImagen->nombre}}</option>
                                @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('tipo_imagen_id')" class="mt-2" />
                    </div>
                    
                    <div>
                        <x-input-label for="titulo" :value="__('Imagen')" />
                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                            id="{{ rand() }}" type="file" accept="image/*" wire:model="imagen">
                        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                    </div>

                    @if ($imagen)
                    <div class="grid">
                            <x-input-label :value="__('Imagen nueva')" />
                            <div class="w-full inline-flex justify-center items-center">
                                <img class="h-auto max-w-full md:max-w-xs" src="{{$imagen->temporaryUrl()}}" alt="Imagen nueva" >
                            </div>
                    </div>
                    @endif

                    @if ($imagen_actual)
                    <div class="grid">
                            <x-input-label :value="__('Imagen actual')" />
                            <div class="w-full inline-flex justify-center items-center">
                                <img class="h-auto max-w-full md:max-w-xs" src="{{ asset('storage/eventos/'.$imagen_actual) }}" alt="Imagen actual" >
                            </div>
                    </div>
                    @endif

                    <div class="mt-8 w-full flex justify-end">
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