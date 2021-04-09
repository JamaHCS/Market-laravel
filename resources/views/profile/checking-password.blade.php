<x-guest-layout>
  <x-jet-authentication-card>
    <x-slot name="logo">
      <x-jet-authentication-card-logo />
    </x-slot>

    <x-jet-validation-errors class="mb-4" />

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
      {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('checkingPassword') }}">
      @csrf

      <div>
        <p>
          Hola, necesitamos que guardes una contraseña para poder iniciar sesión en caso de que necesites hacerlo de forma manual.
        </p>
      </div>

      <div>
        <x-jet-label for="password" value="{{ __('Contraseña') }}" />
        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" :value="old('password')" required autofocus="current-password" />

      </div>

      <div class="mt-4">
        <x-jet-label for="passwordConfirm" value="{{ __('Confirmar contraseña') }}" />
        <x-jet-input id="passwordConfirm" class="block mt-1 w-full" type="password" name="passwordConfirm" required />
      </div>

      <x-jet-button class="mt-4">
        {{ __('Guardar') }}
      </x-jet-button>
      </div>

    </form>
  </x-jet-authentication-card>
</x-guest-layout>
