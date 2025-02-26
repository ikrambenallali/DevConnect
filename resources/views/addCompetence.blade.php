<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <div class="space-y-2">
    <form action="{{ route('ajouterCompetence') }}" method="POST" class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la compétence</label>
        <input type="text" id="nom" name="content" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Add
    </button>
</form>
                        </div>
    </body>
    </html>
</x-app-layout>