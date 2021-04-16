<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Confirma tu ingreso') }}
          </h2>
        </div>
      </div>
    </div>
  </x-slot>

  <div class="container mt-5">
    <div class="row center-pls">
      <h1 class='text-center'>Hola, estás apunto de entrar a {{ $market[0]->name }}...</h1>
      <img src="{{url('/').'/'.$market[0]->logo }}" style="max-height: 10rem" class="my-4">
      <p class='text-center'>
        ¿Estás seguro de que es una operación correcta?
      </p>
      <form action="{{ route('employees.confirm') }}" method="post">
        <div class="form-row">
          <div class="col-6">
            <a href="{{ route('dashboard') }}" class='btn btn-danger'>Cancelar</a>
          </div>
          <div class="col-6">
            @csrf
            <input id="market_id" type="hidden" name="market_id" value="{{ $market[0]->id }}">
            <Button class="btn btn-dark" type="submit">Confirmar</Button>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
