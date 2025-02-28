<script src="https://cdn.tailwindcss.com"></script>
<section class="bg-gray-50 dark:bg-gray-900 p-6 rounded-lg shadow-sm">
    <header>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Formulaire de mise à jour du profil -->
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-sm text-red-600 dark:text-red-400" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-sm text-red-600 dark:text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-4">
                <p class="text-sm text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button form="send-verification" class="underline text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <!-- Section des compétences -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('Compétences') }}</h3>
        <div class="mt-4 space-y-4">
            <!-- Liste des compétences -->
            <div class="space-y-4">
          <!--  -->
                @if(isset($competences) && $competences->count())
                @foreach ($competences as $competence)
                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <span class="text-gray-900 dark:text-gray-100">{{ $competence->content }}</span>
                    <a href="{{ route('showCompetence', $competence->id) }}" class="text-blue-500 hover:text-blue-700">
                    </a>
                    <form action="{{route('competence.destroy', $competence->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
                @endforeach
                @else
                <p>No competences found.</p>
                @endif

            </div>


            <!-- Formulaire pour ajouter une compétence -->
            <form action="{{ route('ajouterCompetence') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la compétence</label>
                    <input type="text" id="nom" name="content" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100" placeholder="Ajouter une compétence">
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm">
                    Add
                </button>
            </form>

        </div>
    </div>
    
             <!-- Section des certification -->
             <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('Certification') }}</h3>
        <div class="mt-4 space-y-4">
            <!-- Liste des Certifications -->
            <div class="space-y-4">

                @if(isset($certfications) && $certfications->count())
                @foreach ($certfications as $certfication)
                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <span class="text-gray-900 dark:text-gray-100">{{ $certfication->content }}</span>
                    <a href="{{ route('showCertification', $certfication->id) }}" class="text-blue-500 hover:text-blue-700">
                    </a>
                    <form action="{{route('certfication.destroy', $certfication->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
                @endforeach
                @else
                <p>No competences found.</p>
                @endif

            </div>
            <!-- form ajouter certification  -->
            <form action="{{ route('addCertification') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom </label>
                    <input type="text" id="content" name="content" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100" placeholder="Ajouter une compétence">
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm">
                    Add
                </button>
            </form>

  <!-- Section des projets -->
  <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('Projets') }}</h3>
        <div class="mt-4 space-y-4">
            <!-- Liste des projet -->
            <div class="space-y-4">

                @if(isset($projets) && $projets->count())
                @foreach ($projets as $projet)
                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <span class="text-gray-900 dark:text-gray-100">{{ $projet->content }}</span>
                    <a href="{{ route('showProjet', $projet->id) }}" class="text-blue-500 hover:text-blue-700">
                    </a>
                    <form action="{{route('projet.destroy', $projet->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
                @endforeach
                @else
                <p>No competences found.</p>
                @endif

            </div>
            <!-- form ajouter projet  -->
            <form action="{{ route('addProjet') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom </label>
                    <input type="text" id="content" name="content" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100" placeholder="Ajouter une compétence">
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm">
                    Add
                </button>
            </form>


    <!-- Section des posts -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('Posts') }}</h3>
        <div class="mt-4 space-y-4">
            <!-- Liste des posts -->
            <div class="p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <p class="text-gray-900 dark:text-gray-100">Contenu du post</p>
                <small class="text-gray-500 dark:text-gray-400">2 heures ago</small>
            </div>

            <!-- Formulaire pour ajouter un post -->
            
        </div>
    </div>

    <!-- Section des langages de programmation -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ __('Langages de programmation') }}</h3>
        <div class="mt-4 space-y-4">
            <!-- Liste des langages -->
            @if(isset($languageProgs) && $languageProgs->count())
                @foreach ($languageProgs as $languageProg)
                <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <span class="text-gray-900 dark:text-gray-100">{{ $languageProg->content }}</span>
                    <a href="{{ route('showLanguage', $languageProg->id) }}" class="text-blue-500 hover:text-blue-700">
                    </a>
                    <form action="{{ route('languageProg.destroy',$languageProg->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            Supprimer
                        </button>
                    </form>
                </div>
                @endforeach
                @else
                <p>No competences found.</p>
                @endif

            <!-- Formulaire pour ajouter un langage -->
            <form action="{{ route('ajouterLanguagePro') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la language</label>
                    <input type="text" id="content" name="content" required
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100" placeholder="Ajouter une compétence">
                </div>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm">
                    Add
                </button>
            </form>

        </div>
    </div>
</section>