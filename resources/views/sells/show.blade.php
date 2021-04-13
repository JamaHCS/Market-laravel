<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ventas') }}
          </h2>
          <x-jet-secondary-button type="button" class="btn-new mt-2 mr-2" onclick="history.back()">
            <i class="fas fa-angle-double-left"></i> Regresar
          </x-jet-secondary-button>


        </div>
        <div class="col-9">
          <div class="flex-container">
            <form action="{{ route('sells.delete') }}" method="post">
              <input type="hidden" name="relation_id" value="{{ $relation->id }}">
              <input type="hidden" name="sell_id" value="{{ $sell->id }}">
              @csrf
              <button class="btn btn-danger " type="submit">
                Eliminar venta.
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </x-slot>
  @php
  $details = $sell->sellDetails()->get();
  $total = 0;
  $totalCost = 0;
  $id = 1;

  foreach ($details as $detail) {
  $total += $detail->product()->get()[0]->price * $detail->quant;
  $totalCost += $detail->product()->get()[0]->cost * $detail->quant;
  }

  // dd($details[0]->product()->get()[0]->image()->get()[0]->url);
  @endphp

  <div class="py-12 dashboard-element">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-xl sm:rounded-lg py-3">
        <div class="container">
          <h2 class="ml-2">Venta #{{ $sell->id }}</h2>
          <div class="row">
            <div class="col-6">
              Vendedor: {{ $sell->user()->get()[0]->name }}
            </div>
            <div class="col-3">
              Total: ${{ $total }}
            </div>
            <div class="col-3">
              Ganancias: <span class="text-green-400">${{ $total - $totalCost }}</span>
            </div>
          </div>
          <div class="row mt-4">
            <table class="table table-light">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">&nbsp;</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Subtotal</th>
                </tr>
              </thead>
              <tbody>
                @foreach($details as $detail)
                <tr>
                  <td>{{ $id }}</td>
                  <td>
                    <div class="container-image-product">
                      <img src="{{ $detail->product()->get()[0]->image()->get()[0]->url }}" class="img-product">
                    </div>
                  </td>
                  <td>{{ $detail->product()->get()[0]->name }}</td>
                  <td>{{ $detail->quant }}</td>
                  <td>${{ $detail->product()->get()[0]->price }}</td>
                  <td>${{ $detail->product()->get()[0]->price * $detail->quant }}</td>
                </tr>
                @php
                $id++
                @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>
