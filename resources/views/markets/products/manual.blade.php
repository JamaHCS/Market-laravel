<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar producto') }}
          </h2>
          <x-jet-secondary-button type="button" class="btn-new mt-2 mr-2" onclick="history.back()">
            <i class="fas fa-angle-double-left"></i> Regresar
          </x-jet-secondary-button>

        </div>
      </div>
    </div>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
          <x-slot name="title">Nuevo producto!</x-slot>
          <x-slot name="description">En esta sección podrás agregar manualmente los productos que le darán vida a tu negocio.</x-slot>
        </x-jet-section-title>
        <div class="md:mt-0 md:col-span-2">

          <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="container-fluid">
              <form enctype="multipart/form-data" action="{{ route('market.products.store') }}" method="POST">
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <x-jet-label for="name" value="{{ __('Nombre del producto') }}" />
                    <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" required />
                    <x-jet-input-error for="name" class="mt-2" />
                  </div>

                  <div class="form-group col-sm-6">
                    <x-jet-label for="barcode" value="{{ __('Código de barras (Opcional)') }}" />
                    <x-jet-input id="barcode" type="text" name="barcode" class="mt-1 block w-full" />
                    <x-jet-input-error for="barcode" class="mt-2" />
                  </div>
                </div>

                <div class="form-row">
                  <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                    <!-- product image File Input -->
                    <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " name="productImage" required />

                    <x-jet-label for="productImage" value="{{ __('Logo del comercio') }}" />
                    <div class="mt-2" x-show="photoPreview">
                      <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                      </span>
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                      {{ __('Selecciona tu logo') }}
                    </x-jet-secondary-button>
                    <x-jet-input-error for="productImage" class="mt-2" />
                  </div>
                </div>

                <div class="form-row mt-3">
                  <div class="form-group col-sm-6">
                    <x-jet-label for="brand" value="{{ __('Marca del producto') }}" />
                    <x-jet-input id="brand" type="text" name="brand" class="mt-1 block w-full" required />
                    <x-jet-input-error for="brand" class="mt-2" />
                  </div>

                  <div class="form-group col-sm-6">
                    <x-jet-label for="type" value="{{ __('Tipo') }}" />
                    <x-jet-input id="type" type="text" name="type" class="mt-1 block w-full" data-toggle="tooltip" data-placement="top" title="Con una palabra, ¿Qué tipo de producto es?" required />
                    <x-jet-input-error for="type" class="mt-2" />
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <x-jet-label for="cost" value="{{ __('Costo del producto') }}" />
                    <x-jet-input id="cost" type="number" name="cost" min="0" step="0.01" class="mt-1 block w-full" data-toggle="tooltip" data-placement="top" title="¿Cuánto te costó a tí el producto?" required />
                    <x-jet-input-error for="cost" class="mt-2" />
                  </div>

                  <div class="form-group col-sm-6">
                    <x-jet-label for="price" value="{{ __('Precio del producto') }}" />
                    <x-jet-input id="price" type="number" name="price" min="0" step="0.01" class="mt-1 block w-full" data-toggle="tooltip" data-placement="top" title="¿Cuánto le va a costar al cliente final el producto?" required />
                    <x-jet-input-error for="price" class="mt-2" />
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <x-jet-label for="stock" value="{{ __('Stock') }}" />
                    <x-jet-input id="stock" type="number" name="stock" min="0" step="0.01" class="mt-1 block w-full" data-toggle="tooltip" data-placement="top" title="¿Cuántos tienes en tu inventario?" required />
                    <x-jet-input-error for="stock" class="mt-2" />
                  </div>
                </div>

                <input type="hidden" name="relation_id" value="{{ $relation->id }}">

                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 mt-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                  {{ __('Crear!') }}
                </button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>
