<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Markets') }}
          </h2>
        </div>
        <div class="col-9">
          <div class="flex-container">
            <a href="{{ route('market.create') }}" class="btn-new" data-toggle="tooltip" data-placement="top" title="Crear o agregar market">
              <x-jet-secondary-button class="mt-2 mr-2" type="button">
                <i class="fas fa-plus"></i> Nuevo
              </x-jet-secondary-button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </x-slot>

  @foreach($relations as $relation)

  <div class="py-12 dashboard-element">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if ($relation->is_main)
      <div class="bg-white shadow-xl sm:rounded-lg py-3">
        @else
        <div class="bg-white bg-secondary shadow-xl sm:rounded-lg py-3">
          @endif
          <div class="container">
            <div class="row">
              <div class="col-md-2">
                <picture class="picture-logo" style="background-image: url({{ $relation->market()->get()[0]->logo }})">
                  {{-- <img src="{{ $relation->market()->get()[0]->logo }}" alt="{{ $relation->market()->get()[0]->name }}" class="logo" /> --}}
                </picture>
              </div>
              <div class="col-md-7">
                <h4>{{ $relation->market()->get()[0]->name }}</h4>
                <div class="specs">
                  <span class="text-muted">{{ $relation->market()->get()[0]->type()->get()[0]->name }}</span>
                  {{ __(' | ') }}
                  <span class="text-muted">{{ $relation->role()->get()[0]->role }}</span>
                </div>
              </div>
              <div class="col-md-3 buttons-dashboard">

                @if ($relation->is_main)
                <x-jet-secondary-button class="mt-0 mb-auto" type="submit" disabled>
                  <i class="fas fa-home"></i> Este es tu Market principal
                </x-jet-secondary-button>
                @else
                <form action="{{ route('market.main') }}" method="post" class="mt-0 mb-auto">
                  <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                  @csrf
                  <x-jet-secondary-button class="mt-0 mb-auto" type="submit" data-toggle="tooltip" data-placement="top" title="Este será el Market que podrás usar en la app movil">
                    <i class="fas fa-home"></i> Hacer tu Market principal
                  </x-jet-secondary-button>
                </form>
                @endif

                @if($relation->is_active)
                <x-jet-dropdown align="right" width="48">
                  <x-slot name="trigger">
                    <span class="inline-flex rounded-md">
                      <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        Acción
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                      </button>
                    </span>
                  </x-slot>

                  <x-slot name="content">
                    <!-- Market Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Acciones') }}
                    </div>

                    @if ($relation->role_id != 3)
                    <!-- Configuration -->
                    <form action="{{ route('market.config') }}" method="post">
                      <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                      @csrf
                      <button type="submit" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out w-full">

                        {{ __('Configuraciones') }}
                      </button>
                    </form>
                    <div class="border-t border-gray-100"></div>
                    @endif

                    <!-- Products Management -->
                    <form action="{{ route('market.products.show') }}" method="post">

                      <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                      @csrf
                      <button type="submit" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out w-full">

                        {{ __('Productos') }}
                      </button>
                    </form>

                    <div class="border-t border-gray-100"></div>

                    @if ($relation->role_id != 3)
                    <!-- Statistics -->
                    <form action="{{ route('statistics') }}" method="post">
                      <input type="hidden" name="market_id" value="{{ $relation->market_id }}">
                      @csrf
                      <button type="submit" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out w-full">
                        {{ __('Estadisticas') }}
                      </button>
                    </form>

                    <div class="border-t border-gray-100"></div>
                    @endif

                    <!-- Sells -->
                    <a href="{{ route('sells.index', $relation->id) }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out w-full">
                      {{ __('Ventas') }}
                    </a>
                    <div class="border-t border-gray-100"></div>

                    @if ($relation->role_id != 3)
                    <form action="{{ route('employees.index') }}" method="post">
                      <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                      @csrf
                      <button type="submit" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out w-full">
                        {{ __('Empleados') }}
                      </button>
                    </form>

                    <div class="border-t border-gray-100"></div>
                    @endif

                  </x-slot>
                </x-jet-dropdown>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @endforeach
</x-app-layout>
