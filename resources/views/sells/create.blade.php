<x-app-layout>

  <input type="hidden" id="market_id" value="{{ $relation->market_id }}">
  <script>
    const PRODUCTS = <?php echo json_encode($products); ?>;
  </script>


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
      </div>
    </div>
  </x-slot>
  <div class="selling-container">
    <div class="panel">
      <div class="container">
        <div class="row">
          <div class="col-2">
            <picture class="p-2 logo">
              <img src="{{ url('/').'/'.$relation->market()->get()[0]->logo }}">
            </picture>
          </div>
          <div class="col-10">
            <div class="row">
              <form id="formSearch" class="d-block search">
                @csrf
                <div class="form-group">
                  <label for="toSearch">Busca tu producto</label>
                  <input type="text" class="d-block form-control" id="toSearch" name="toSearch" placeholder="Codigo de barras o nombre del producto">
                  <x-jet-secondary-button type="button" class="btn-new mt-2 mx-auto" id="searchButton" onclick="getProduct()">
                    <i class="fas fa-search"></i> Buscar
                  </x-jet-secondary-button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sell-elements">
      <div class="container">
        <div class="row mt-2">


      <table class="table table-light">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
            </tr>
            </thead>
            <tbody id="formtBody">
              </tbody>
              <tr>
                <td>Total:</td>
                <td id="total"></td>
              </tr>
              </table>

      <form action="{{ route('sells.store') }}" method="post">
        <input type="hidden" name="state" id="formState" value="">
        <input type="hidden" name="relation_id"  value="{{ $relation->id }}">
        @csrf

        <button type="submit" class="btn btn-success btn-sell">Vender</button>
      </form>

      </div>
      </div>

    </div>
  </div>

  <div class="modal" tabindex="-1" id="modalSells">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBody">

          <table class="table table-light">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">&nbsp;</th>
              </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
          </table>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <script src="{{ asset('js/sell.js') }}"></script>
</x-app-layout>
