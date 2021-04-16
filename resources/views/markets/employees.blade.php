<x-app-layout>
  <x-slot name="header">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Empleados') }}
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
          <x-slot name="title">Empleados</x-slot>
          <x-slot name="description">Este es el lugar para gestionar a las personas que trabajan contigo
            <div class="mt-5">
              <p class="mt-3">
                Para que más gente pueda trabajar contigo, pideles que usen el siguiente codigo para unirse a tu negocio.
              </p>
              <h4>Codigo: <span class="badge badge-secondary">{{ $market->uuid }}</span></h4>

            </div>
          </x-slot>
        </x-jet-section-title>

        <div class="md:mt-0 md:col-span-2 employees">
          <div class="px-4 py-5  sm:p-6 sm:rounded-tl-md sm:rounded-tr-md">
            <div class="container-fluid">
              <div class="row">
                <div class="col-5">
                  <div class="card" class="employees-card">
                    <img src="{{ $chief->profile_photo_url }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-center">Administrador</h5>
                      <p class="card-text text-muted text-center">
                        {{ $chief->name }}
                        <br />
                        <span class="smaller">
                          {{ $chief->email }}
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="separated-em my-4"></div>

              <div class="row">
                @if (count($employeesRelations) != 1)
                @foreach ($employeesRelations as $employee)
                @if ($employee->id != $currentRelation->id && $employee->is_active)
                <div class="col-5">
                  <div class="card" class="employees-card">
                    <img src="{{ $employee->user()->get()[0]->profile_photo_url }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title text-center">{{ $employee->role()->get()[0]->role }}</h5>
                      <p class="card-text text-muted text-center">
                        {{ $employee->user()->get()[0]->name }}
                        <br />
                        <span class="smaller">
                          {{ $employee->user()->get()[0]->email }}
                        </span>
                      </p>
                      <form action="{{ route('employees.fire') }}" method="POST">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        <button type="submit" class="btn btn-danger ml-auto">Despedir</button>
                      </form>
                    </div>
                  </div>
                </div>
                @endif
                @endforeach
                @else
                No tienes empleados aún.
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>
