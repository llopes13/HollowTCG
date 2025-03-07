<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HollowTCG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Oswald', sans-serif;
        }
    </style>
</head>
<body class="bg-[#1E1126] text-[#D4C2FC] m-0 p-0">
    @include('layouts.navbar')
    <main class="flex flex-col items-center p-4">
        <section class="bg-[#5E1675] p-6 m-4 rounded-lg w-full max-w-[400px] shadow-lg">
            <h2 class="mb-4 text-[#D4C2FC]">Login</h2>
            <form id="login-form" class="flex flex-col">
                <label for="login-username" class="mb-2 text-[#D4C2FC]">Nombre de Usuario:</label>
                <input type="text" id="login-username" name="login-username" class="mb-4 p-2 border border-[#9B30FF] rounded-md text-base focus:outline-none focus:border-[#ECDFCC]" required>

                <label for="login-password" class="mb-2 text-[#D4C2FC]">Contraseña:</label>
                <input type="password" id="login-password" name="login-password" class="mb-4 p-2 border border-[#9B30FF] rounded-md text-base focus:outline-none focus:border-[#ECDFCC]" required>

                <button type="submit" class="bg-[#9B30FF] text-[#D4C2FC] p-2 rounded-md cursor-pointer hover:bg-[#ECDFCC] hover:text-[#181C14]">Iniciar Sesión</button>
            </form>
            <p class="mt-4">¿No tienes una cuenta? <a href="register" class="text-[#D4C2FC] underline">Regístrate aquí</a>.</p>
        </section>
    </main>

</body>
</html>