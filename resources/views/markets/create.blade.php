<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo market') }}
          </h2>
        </div>
      </div>
    </div>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
          <x-slot name="title">Nuevo Market!</x-slot>
          <x-slot name="description">Bienvenido, estás apunto de empezar este proceso para llevar la transformación digital de tu negocio a otro nivel. Aquí encontrarás diversas herramientas para llevar la eficiencia de tu negocio a otro nivel.</x-slot>
        </x-jet-section-title>

        <div class="md:mt-0 md:col-span-2">
          <form enctype="multipart/form-data" action="{{ route('market.store') }}" method="POST">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
              <div class="grid grid-cols-6 gap-6">

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="name" value="{{ __('Nombre del comercio') }}" />
                  <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" />
                  <x-jet-input-error for="name" class="mt-2" />
                </div>

                <!-- logo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                  <!-- Profile Photo File Input -->
                  <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " name="logo" />

                  <x-jet-label for="photo" value="{{ __('Logo del comercio') }}" />

                  <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                  </div>

                  <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Selecciona tu logo') }}
                  </x-jet-secondary-button>

                  <x-jet-input-error for="photo" class="mt-2" />
                </div>


                <!-- type -->
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="type_id" value="{{ __('Tipo de comercio') }}" />
                  <select name="type_id" id="type_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option>Selecciona una</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                  </select>
                  <x-jet-input-error for="type_id" class="mt-2" />
                </div>
              </div>
            </div>

            @csrf
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
              <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Crear!') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>
