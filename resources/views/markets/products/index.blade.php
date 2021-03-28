<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis productos') }}
          </h2>
        </div>
        <div class="col-9">
          <div class="flex-container">
            <form action="{{ route('market.products.how') }}" method="post">
              <input type="hidden" name="relation_id" value="{{ $relation->id }}">
              @csrf

              <x-jet-secondary-button type="submit" data-toggle="tooltip" data-placement="top" class="btn-new mt-2 mr-2" title="Agregar nuevo producto">
                <i class="fas fa-plus"></i> Nuevo
              </x-jet-secondary-button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-slot>

  <div class="container">
    <div class="row">

      @foreach ($products as $product )
      @php
      // dd($product);
      @endphp
      <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
        <div class="card">
          <div class="img-container">
            <img src="{{ $product->image()->get()[0]->url }}" class="card-img-top" alt="{{ $product->name }}">
          </div>
          <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text mb-0"><span class="mr-2 font-weight-bold">Precio:</span>${{ $product->price }}</p>
            <p class="card-text"><span class="mr-2 font-weight-bold">Costo:</span>${{ $product->cost }}</p>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Editar</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

</x-app-layout>
