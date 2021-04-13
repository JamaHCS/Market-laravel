<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Configurando tu Market') }}
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
          <x-slot name="title">Configuración básica</x-slot>
          <x-slot name="description">Aquí puedes editar la configuración básica para tu market. Recuerda que es información sensible, aquí estás editando como se verá tu marca.</x-slot>
        </x-jet-section-title>

        <div class="md:mt-0 md:col-span-2">
          <form id="basic-conf">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
              <div class="grid grid-cols-6 gap-6">
                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="name" value="{{ __('Nombre del comercio') }}" />
                  <x-jet-input id="name" type="text" name="name" class="mt-1 block w-full" value="{{ old('name', $relation->market()->get()[0]->name) }}" />
                  <x-jet-input-error for="name" class="mt-2" />
                </div>

                <!-- logo -->
                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-6">
                        <x-jet-label value="{{ __('Logo actual de '.$relation->market()->get()[0]->name) }}" />
                        <div class="mt-2">
                          <picture class="picture-config">
                            <img src="{{url('/') . '/'. $relation->market()->get()[0]->logo }}" alt="{{ $relation->market()->get()[0]->name }}" class="logo" />

                          </picture>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <!-- Profile Photo File Input -->
                        <input id="logo-input" type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " name="logo" />

                        <x-jet-label for="photo" value="{{ __('Nuevo logo de '. $relation->market()->get()[0]->name) }}" />

                        <div class="mt-2" x-show="photoPreview">
                          <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                          </span>
                        </div>

                        <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                          {{ __('Selecciona tu logo') }}
                        </x-jet-secondary-button>

                        <x-jet-input-error for="photo" class="mt-2" />

                      </div>
                    </div>
                  </div>
                </div>


                <!-- type -->
                <div class="col-span-6 sm:col-span-4">
                  <x-jet-label for="type_id" value="{{ __('Tipo de comercio') }}" />
                  <select name="type_id" id="type_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option>Selecciona una</option>
                    @foreach($types as $type)
                    @if($type->id == $relation->market()->get()[0]->type_id)
                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                    @else
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endif
                    @endforeach
                  </select>
                  <x-jet-input-error for="type_id" class="mt-2" />
                </div>
              </div>
            </div>
            <input type="hidden" name="relation_id" id="relation_id" value="{{ $relation->id }}">
            @csrf

            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md bg-white">
              <span id="updated" class="text-muted mr-4 updated">Actualizado!</span>
              <button type="button" id="btn-basic-conf" onclick="sendingData()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Actualizar') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
          <x-slot name="title">Ubicación</x-slot>
          <x-slot name="description">Aquí es donde puedes decirle al mundo donde está tu negocio.</x-slot>
        </x-jet-section-title>

        <div class="md:mt-0 md:col-span-2">
          <form class="location-form">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
              <div class="container-fluid">
                @if(isset($location))

                <div class="form-row mt-4">
                  <div class="col-6">
                    <div class="input-group">
                      <x-jet-label for="latitud" value="{{ __('Latitud') }}" />
                      <x-jet-input id="latitud" type="number" name="latitud" class="mt-1 block w-full bg-gray disabled" value="{{ $location->latitude }}" aria-disabled="true" disabled />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="input-group">
                      <x-jet-label for="longitud" value="{{ __('Longitud') }}" />
                      <x-jet-input id="longitud" type="number" name="longitud" class="mt-1 block w-full bg-gray disabled" value="{{ $location->longitude}}" aria-disabled="true" disabled />
                    </div>
                  </div>
                </div>
                @else
                <div class="form-row mt-4">
                  <div class="col-6">
                    <div class="input-group">
                      <x-jet-label for="latitud" value="{{ __('Latitud') }}" />
                      <x-jet-input id="latitud" type="number" name="latitud" class="mt-1 block w-full bg-gray disabled" value="" aria-disabled="true" disabled />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="input-group">
                      <x-jet-label for="longitud" value="{{ __('Longitud') }}" />
                      <x-jet-input id="longitud" type="number" name="longitud" class="mt-1 block w-full bg-gray disabled" value="" aria-disabled="true" disabled />
                    </div>
                  </div>
                </div>
                @endif

                <div class="form-row mt-4">
                  <div class="col">
                    <div class="input-group">
                      <x-jet-label for="calle" value="{{ __('Calle') }}" />
                      <x-jet-input id="calle" type="text" name="calle" class="mt-1 block w-full" />
                    </div>
                  </div>
                </div>

                <div class="form-row mt-4">
                  <div class="col-6">
                    <div class="input-group">
                      <x-jet-label for="noExterior" value="{{ __('Número exterior') }}" />
                      <x-jet-input id="noExterior" type="number" name="noExterior" class="mt-1 block w-full" />
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="input-group">
                      <x-jet-label for="noInterior" value="{{ __('Número interior') }}" />
                      <x-jet-input id="noInterior" type="number" name="noInterior" class="mt-1 block w-full" />
                    </div>
                  </div>
                </div>

                <div class="form-row mt-4">
                  <div class="col-md-6">
                    <div class="input-group">
                      <x-jet-label for="colonia" value="{{ __('Colonia') }}" />
                      <x-jet-input id="colonia" type="text" name="colonia" class="mt-1 block w-full" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <x-jet-label for="localidad" value="{{ __('Localidad') }}" />
                      <x-jet-input id="localidad" type="text" name="localidad" class="mt-1 block w-full" />
                    </div>
                  </div>
                </div>

                <div class="form-row mt-4">
                  <div class="col-md-6">
                    <div class="input-group">
                      <x-jet-label for="colonia" value="{{ __('Referencia') }}" />
                      <x-jet-input id="referencia" type="text" name="referencia" class="mt-1 block w-full" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <x-jet-label for="codigoPostal" value="{{ __('Código postal') }}" />
                      <x-jet-input id="codigoPostal" type="number" name="codigoPostal" class="mt-1 block w-full" />
                    </div>
                  </div>
                </div>

                <div class="form-row mt-4">
                  <div class="col-md-6">
                    <x-jet-label for="idEstado" value="{{ __('Estado') }}" />
                    <div class="input-group columns">
                      <select name="idEstado" id="idEstado" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value=''> Selecciona el estado </option>
                        <option value='1'>AGUASCALIENTES</option>
                        <option value='2'>BAJA CALIFORNIA</option>
                        <option value='3'>BAJA CALIFORNIA SUR</option>
                        <option value='4'>CAMPECHE</option>
                        <option value='7'>CHIAPAS</option>
                        <option value='8'>CHIHUAHUA</option>
                        <option value='9'>CIUDAD DE MEXICO</option>
                        <option value='5'>COAHUILA</option>
                        <option value='6'>COLIMA</option>
                        <option value='10'>DURANGO</option>
                        <option value='11'>GUANAJUATO</option>
                        <option value='12'>GUERRERO</option>
                        <option value='13'>HIDALGO</option>
                        <option value='14'>JALISCO</option>
                        <option value='15'>MEXICO</option>
                        <option value='16'>MICHOACAN</option>
                        <option value='17'>MORELOS</option>
                        <option value='18'>NAYARIT</option>
                        <option value='19'>NUEVO LEON</option>
                        <option value='20'>OAXACA</option>
                        <option value='21'>PUEBLA</option>
                        <option value='22'>QUERETARO</option>
                        <option value='23'>QUINTANA ROO</option>
                        <option value='24'>SAN LUIS POTOSI</option>
                        <option value='25'>SINALOA</option>
                        <option value='26'>SONORA</option>
                        <option value='27'>TABASCO</option>
                        <option value='28'>TAMAULIPAS</option>
                        <option value='29'>TLAXCALA</option>
                        <option value='30'>VERACRUZ</option>
                        <option value='31'>YUCATAN</option>
                        <option value='32'>ZACATECAS</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <x-jet-label for="municipio" value="{{ __('Municipio') }}" />
                      <x-jet-input id="municipio" type="text" name="municipio" class="mt-1 block w-full" />
                    </div>
                  </div>
                </div>

                <div class="flex items-center justify-end px-4 py-3 text-right sm:px-6 bg-white">
                  <span class="text-muted mr-4">Una vez encontrada la ubicación, puedes ajustar la misma interactuando (Dandole click) en el mapa. O directamente puedes buscar tu ubicación en el mapa.</span>
                  <button type="button" id="btn-search-location" onclick="buscarPosicion()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Buscar localización') }}
                  </button>
                </div>

                <div class="row form-group">
                  <div class="col-12 mt-5">
                    <div id="map" style="width: 100%; height: 670px; padding: 10%;"></div>
                  </div>
                </div>


              </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md bg-white">
              <span id="updated-location" class="text-muted mr-4 updated">Actualizado!</span>
              <button type="button" id="btn-location" onclick="sendingDataLocation()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Actualizar ubicación') }}
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
  </div>



  <script src="{{ asset('js/location.js') }}"></script>
  <!-- Llamada asíncrona de la API de Google, cuando se cargue ejecutará la función definida en el parametro callback -->
  <!-- El API KEY funciona actualmente, lo conveniente es poner su propia API KEY para tenerlo funcionando permanentemente-->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBD83JfRc6DTP3kzy8c20gNkbFtqtiXfwg&callback=initMap&libraries=&v=weekly&quot;" async></script>
  <script src=" {{ asset('js/marketConfig.js') }}"></script>
  <!-- Fin del Container -->


</x-app-layout>
