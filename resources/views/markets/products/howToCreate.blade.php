<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar producto') }}
          </h2>
        </div>
      </div>
    </div>
  </x-slot>

  <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
          <x-slot name="title">Nuevo producto!</x-slot>
          <x-slot name="description">En esta sección podrás añadir los productos que le darán vida a tu negocio.</x-slot>
        </x-jet-section-title>

        <div class="md:mt-0 md:col-span-2">
          <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
            <div class="container-fluid container-how">
              <div class="row h-40">
                <div class="col-6 align-content-center">
                  <form action="{{ route('market.products.manual') }}" method="post">
                    <div class="form-how">
                      <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                      @csrf

                      <label for="manual">Manual</label>
                      <button type="submit" id="manual" class="btn btn-light btn-ico">
                        <i class="fas fa-edit"></i>
                      </button>
                    </div>
                  </form>
                </div>


                <div class="col-6 align-content-center">
                  <form action="{{ route('market.products.automatic') }}" method="post">
                    <div class="form-how">
                      <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                      @csrf

                      <label for="automatic">Automático <span class="text-muted text-xs">(Experimental)</span></label>
                      <button type="submit" id="automatic" class="btn btn-light btn-ico">
                        <i class="fas fa-barcode"></i>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>
