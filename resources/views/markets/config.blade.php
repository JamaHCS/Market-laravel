<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurando tu Market') }}
          </h2>
        </div>
      </div>
    </div>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
          <x-slot name="title">Configuración básica</x-slot>
          <x-slot name="description">Aquí puedes editar la configuración básica para tu market. Recuerda que es información sensible, aquí estás editando como se verá tu marca.</x-slot>
        </x-jet-section-title>

        <div class="md:mt-0 md:col-span-2">
          <form id="basic-conf">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
              <div class="grid grid-cols-6 gap-6">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="name" value="{{ __('Nombre del comercio') }}" />
                  <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{ old('name', $relation->market()->get()[0]->name) }}" />
                  <x-jet-input-error for="name" class="mt-2" />
                </div>

                <!-- logo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                        <x-jet-label value="{{ __('Logo actual de '.$relation->market()->get()[0]->name) }}" />
                        <div class="mt-2">
                          <picture class="picture-config">
                            <img src="{{url('/') . '/'. $relation->market()->get()[0]->logo }}" alt="{{ $relation->market()->get()[0]->name }}" class="logo" />

                          </picture>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <!-- Profile Photo File Input -->
                        <input id="logo-input" type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " name="logo" />

                        <x-jet-label for="photo" value="{{ __('Nuevo logo de '. $relation->market()->get()[0]->name) }}" />

                        <div class="mt-2" x-show="photoPreview">
                          <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                          </span>
                        </div>

                        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                          {{ __('Selecciona tu logo') }}
                        </x-jet-secondary-button>

                        <x-jet-input-error for="photo" class="mt-2" />

                      </div>
                    </div>
                  </div>
                </div>


                <!-- type -->
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="type_id" value="{{ __('Tipo de comercio') }}" />
                  <select name="type_id" id="type_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option>Selecciona una</option>
                    @foreach($types as $type)
                    @if($type->id == $relation->market()->get()[0]->type_id)
                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                    @else
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endif
                    @endforeach
                  </select>
                  <x-jet-input-error for="type_id" class="mt-2" />
                </div>
              </div>
            </div>
            <input type="hidden" name="relation_id" value="{{ $relation->id }}">
            @csrf

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
              <button type="button" id="btn-basic-conf" onclick="sendingData()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Actualizar') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/marketConfig.js') }}"></script>

</x-app-layout>
