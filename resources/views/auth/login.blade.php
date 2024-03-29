 <div class="container">



 
 <x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <style>
        .container {
            background-image: url("img/2.jpg");
            background-size: cover;
            background-position: center;
            height: 100vh;
            /* border-radius: 10px; */
        }
    </style>

    <section>
        <div class="login-logo">
            <a href="#" style="color: #006400; font-size: 1.8em;margin-left:150px;"><b style="font-weight:bold;">SGDS-GN</b></a>
            <hr/>
        </div><br>

        <div class="card ">
            <div class="card-body login-card-body ">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" style="border-radius: 10px;" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Mot de passe')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>
                            @endif

                            <x-primary-button class="ml-3">
                                {{ __('Connexion') }}
                            </x-primary-button>
                        </div>
                    </form>
            </div>

        </div>



        
    </section>

</x-guest-layout> 

</div>
