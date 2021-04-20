<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Market') }}
          </h2>
        </div>
      </div>
    </div>
  </x-slot>

  <div class="py-12 dashboard-element">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-xl sm:rounded-lg py-3">
        <div class="container">
          <div class="row text-center">
            Hola, {{ $uri }}
          </div>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>
