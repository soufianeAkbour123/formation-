<!DOCTYPE html>
<html>
<head>
    <title>Maintenance - Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-2xl mb-6 text-center">Site en maintenance</h2>
            
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('maintenance.auth') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Identifiant</label>
                    <input type="text" name="username" class="w-full p-2 border rounded" required>
                </div>
                
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" required>
                </div>
                
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Connexion
                </button>
            </form>
        </div>
    </div>
</body>
</html>