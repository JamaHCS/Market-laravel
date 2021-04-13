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
            <form action="" method="post">
              <input type="hidden" name="relation_id" value="{{ $relation->id }}">
              @csrf
              <x-jet-secondary-button class="btn-new mt-2 mr-2" type="submit">
                <i class="fas fa-plus"></i> Vender!
              </x-jet-secondary-button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </x-slot>

  @foreach($sells as $sell)
  @php
  $details = $sell->sellDetails()->get();
  $total = 0;
  $totalCost = 0;

  foreach ($details as $detail) {
  $total += $detail->product()->get()[0]->price * $detail->quant;
  }

  // dd($details[0]->product()->get()[0]->image()->get()[0]->url);
  @endphp
  @if(isset($details[0]) && $sell->is_active)
  <div class="py-12 dashboard-element">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-xl sm:rounded-lg py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-2">
              <picture class="picture-logo" style="background-image: url({{ $details[0]->product()->get()[0]->image()->get()[0]->url }})">
                {{-- <img src="{{ $relation->market()->get()[0]->logo }}" alt="{{ $relation->market()->get()[0]->name }}" class="logo" /> --}}
              </picture>
            </div>
            <div class="col-md-6">
              <h4 class="text-green-400	">$ {{ $total }}</h4>
              <div class="specs">
                <span class="text-muted">Vendedor: </span>
                <span class="text-muted">{{ $sell->user()->get()[0]->name }}</span>
              </div>
            </div>
            <div class="col-md-2">
              <form action="{{ route('sells.show') }}" method="post">
                <input type="hidden" name="relation_id" value="{{ $relation->id }}">
                <input type="hidden" name="sell_id" value="{{ $sell->id }}">
                @csrf
                <x-jet-secondary-button class="btn-new mt-2 mr-2" type="submit">
                  <i class="fas fa-eye"></i> Detalles
                </x-jet-secondary-button>
              </form>

            </div>
            <div class="col-md-2">
              <span class="text-muted">{{ $sell->updated_at->diffForHumans() }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  @endforeach

  <div class="py-12 dashboard-element">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow-xl sm:rounded-lg py-3">
        <div class="container">
          <div class="row">
            <div class="paginate mx-auto">
              {{ $sells->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>
