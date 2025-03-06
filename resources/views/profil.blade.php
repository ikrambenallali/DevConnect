<x-app-layout>
    <div class="container mx-auto p-4 max-w-3xl bg-white rounded-lg shadow-md">
        <!-- En-tête du profil -->
        <div class="text-center mb-12">
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="rounded-full mx-auto mb-4 w-32 h-32 object-cover">
            <h1 class="text-4xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
           
            <p class="text-lg text-gray-600">Software Engineer</p>
            <p class="text-lg text-gray-600">Los Angeles, California</p>
        </div>

        <!-- Bouton "Edit Profile" -->
        <div class="text-center mb-8">
            <a href="{{ route('profile.edit') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Edit Profile
            </a>
        </div>

        <!-- Section des compétences -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 "></h2>
            <div class="grid grid-cols-2 gap-4 ">
                <div class=" bg-blue-100 rounded-lg shadow-md p-4 text-center">
                    <h3 class="text-xl font-semibold text-gray-800">Compétences</h3>
                    @foreach($competences as $competence)

                    <ul class="mt-2">
                        <li class="text-gray-600">{{$competence->content}}</li>
                       
                    </ul>
                    @endforeach

                </div>
    <div class="bg-blue-100 rounded-lg shadow-md p-4 text-center">
        <h3 class="text-xl font-semibold text-gray-800">Languages de Programmation</h3>
        @foreach($languageProgs as $languageProg)

        <ul class="mt-2">
            <li class="text-gray-600">{{$languageProg->content}}</li>
        </ul>
        @endforeach

    </div>

              
            </div>
        </div>

       
        <!-- Section des projets -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Projects</h2>
            <div class=" bg-blue-100 rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Project 1: Portfolio Website</h3>
                <p class="text-gray-600">A personal website to showcase my skills and projects. Built with HTML, CSS, and JavaScript.</p>
            </div>
            
        </div>

        <!-- Section des certificats -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Certifications</h2>
            <div class=" bg-blue-100 rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Certificate 1: Google Web Developer</h3>
                <p class="text-gray-600">Completed Google Web Developer certification. Focused on responsive design and web performance.</p>
            </div>
           
        </div>

        <!-- Section "Ready for work" -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ready for work</h2>
            <p class="text-gray-600">Show recruiters that you’re ready for work.</p>
        </div>

        <!-- Section "Share posts" -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Share posts</h2>
            <p class="text-gray-600">Share latest news to get connected with others.</p>
        </div>

        <!-- Section "Update" -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Update</h2>
            <p class="text-gray-600">Keep your profile updated so that recruiters know you better.</p>
        </div>
    </div>
</x-app-layout>
