<x-app-layout>
 
 
 <x-guest-layout> 

<h2><p>Formulaire d'inscriptions</p></h2><br><hr>


@if(session()->has("success"))
        <div class="alert alert-success" >
            <h3>{{session()->get('success')}}</h3>
        </div>
        @endif


        @if($errors->any())
        <div class="alert alert-danger" >
            <ul >
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>

                @endforeach
            </ul>
            </div>
        @endif
        
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="row">
            <div class=" mt-4 col-md-6">
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            

            <div class="mt-4 col-md-6">
                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </div>
        </div>
        
        
        <div class="row">
            <div class="mt-4 col-md-6">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class=" mt-4 col-md-6">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" required autofocus autocomplete="adresse" />
                <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
            </div>


        </div>
        

        <div class="row">
            <div class="mt-4 col-md-6">
                <x-input-label for="telephone" :value="__('Téléphone')" />
                <x-text-input id="telephone" class="block mt-1 w-full" type="number" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone" />
                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
            </div>


            <div class="mt-4 col-md-6">
                <x-input-label for="date_naissance" :value="__('Date_Naissance')" />
                <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" required autofocus autocomplete="date_naissance" />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>

        </div>
        

        
                <!-- ignacio a ajouter cette partie ce 11/04/2023 -->
        <div class="row">
            <div class="mt-4 col-md-6">
                <label for="role" class="form-label">Rôle</label>
                <select name="role" id="role" class="form-control">
                    <option value="admin">admin</option>
                    <option value="superviseur">Superviseur</option>
                    
                    <option value="Collecteur">Collecteur</option>
                    
                </select>
            </div>
                <br>
            <div class="mt-4 col-md-6">
                <label for="photo">Photo </label>

                <input type="file" id="photo" name="photo" accept="image/png, image/jpeg">

            </div>

        </div>
                


              

        <!-- Password -->

        <div class="row">
            <div class="mt-4 col-md-6">
                <x-input-label for="password" :value="__('Mot de passe')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 col-md-6">
                <x-input-label for="password_confirmation" :value="__('Confirmer mot de passe')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

        </div>
       

        <div class="flex items-center justify-end mt-4">
            <!-- <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Déjà enregistré?') }}
            </a> -->

            <x-primary-button class="ml-4">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>
    </form>


    
</x-guest-layout> 
</x-app-layout>
