<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  @foreach($relations as $relation)
  <div class="py-12 dashboard-element">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-xl sm:rounded-lg">
        <div class="container">
          <div class="row">

            <div class="col-4 dashboard-element">
              <picture>
                <img src="{{ asset('logo.svg') }}" alt="{{ $relation->market()->get()[0]->name }}" class="logo" />
              </picture>
            </div>
            <div class="col-4 dashboard-element">
              <h4>{{ $relation->market()->get()[0]->name }}</h4>
            </div>
            <div class="col-4 dashboard-element">
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
                  <!-- Account Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Acciones') }}
                  </div>

                  <x-jet-dropdown-link href="#">
                    {{ __('Configuraciones') }}
                  </x-jet-dropdown-link>
                  <x-jet-dropdown-link href="#">
                    {{ __('Configuraciones') }}
                  </x-jet-dropdown-link>
                  <x-jet-dropdown-link href="#">
                    {{ __('Configuraciones') }}
                  </x-jet-dropdown-link>

                  <div class="border-t border-gray-100"></div>

                  <!-- Authentication -->
                </x-slot>
              </x-jet-dropdown>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</x-app-layout>
