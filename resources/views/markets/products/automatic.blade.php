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
          <x-slot name="description">En esta sección podrás buscar productos por el código de barras y añadirlos automáticamente a tu market. <span class="text-muted text-xs">Esta función es experimental, puede presentar errores o no encontrar el producto, en estos casos se recomiendo hacer uso de la opción manual.</span></x-slot>
        </x-jet-section-title>
        <div class="md:mt-0 md:col-span-2">

          <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md animated-height">
            <div class="container-fluid">
              <form>
                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <x-jet-label for="barcode" value="{{ __('Codigo de barras') }}" />
                    <x-jet-input id="barcodeInput" type="text" name="barcode" class="mt-1 block w-full" required />
                    <x-jet-input-error for="barcode" class="mt-2" />
                  </div>

                  <div class="form-group col-sm-6">
                    <button type="button" id="submit" onclick="submitAction()" class="inline-flex items-center px-4 py-2 mt-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 float-right">
                      {{ __('Buscar') }}
                    </button>
                  </div>


                </div>
              </form>

              <form action="{{ route('market.products.store.automatic') }}" method="POST" id="final-form" class="d-none mt-2">
                <div class="separated"></div>

                <div class="form-row mt-4">
                  <div class="form-group col-sm-6">
                    <x-jet-label for="name" value="{{ __('Nombre del producto') }}" />
                    <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" required />
                    <x-jet-input-error for="name" class="mt-2" />
                  </div>

                  <div class="form-group col-sm-6">
                    <x-jet-label for="barcode" value="{{ __('Código de barras') }}" />
                    <x-jet-input id="barcode" type="text" name="barcode" class="mt-1 block w-full" />
                    <x-jet-input-error for="barcode" class="mt-2" />
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-sm-6">
                    <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                      <!-- product image File Input -->
                      <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                      photoName = $refs.photo.files[0].name;
                                      const reader = new FileReader();
                                      reader.onload = (e) => {
                                          photoPreview = e.target.result;
                                      };
                                      reader.readAsDataURL($refs.photo.files[0]);
                              " name="productImage" />

                      <x-jet-label for="productImage" value="{{ __('Imagen del producto') }}" data-toggle="tooltip" data-placement="top" title="Si no seleccionas ninguna imagen, la imagen predeterminada será la que guardaremos para tí" />

                      <div class="mt-2" x-show="photoPreview">
                        <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                      </div>
                      <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Selecciona la imagen del producto') }}
                      </x-jet-secondary-button>
                      <x-jet-input-error for="productImage" class="mt-2" />
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <x-jet-label for="imageDefault" value="{{ __('Imagen predeterminada') }}" data-toggle="tooltip" data-placement="top" title="Si no seleccionas ninguna imagen, esta es la imagen que hemos encontrado para el producto." />
                    <input type="hidden" name="imageDefault" value="http://127.0.0.1:8000/logo.svg" id="imageDefaultInput">
                    <img src="http://127.0.0.1:8000/logo.svg" class="img-thumbnail" id="imageDefault">
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

  <div id="automatic-result"></div>

  <script src="{{ asset('js/automaticProduct.js') }}"></script>
</x-app-layout>
