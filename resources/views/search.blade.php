<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
  @vite(['resources/css/main.css'])
  <style>
    body {
        font-family: 'Oswald', sans-serif;
    }
</style>
  <title>HollowTCG</title>
</head>
<body class="bg-[#181C14] text-[#ECDFCC] m-0 p-0">
    <h1>Pokémon TCG Cards</h1>
    <input type="text" id="search" placeholder="Buscar Pokémon..." />
    <button onclick="searchCards()">Buscar</button>
    <div id="card-container"></div>


<script src="{{ asset('js/pokemonAPI.js') }}"></script>
</body>
</html>