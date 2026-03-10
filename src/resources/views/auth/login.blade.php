<script src="https://cdn.tailwindcss.com"></script>
<div class="min-h-screen flex items-center justify-center bg-slate-900">
    <form method="POST" action="/login" class="bg-white p-8 rounded-lg shadow-xl w-96">
        
        @csrf
    
        <h2 class="text-2xl font-bold mb-6 text-center">Accès Restaurateur</h2>
        <input type="email" name="email" placeholder="Email" class="w-full p-2 border mb-4 rounded">
        <input type="password" name="password" placeholder="Mot de passe" class="w-full p-2 border mb-6 rounded">
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Se connecter
        </button>
    </form>
</div>