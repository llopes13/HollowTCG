    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/main.css'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <title>Hollow TCG</title>
</head>
<body class="bg-[#1E1126] text-[#D4C2FC] m-0 p-0">
  @extends('layouts.master')
  @section('content')
  <div id="cards-container" class="grid grid-cols-4 gap-4 max-w-4xl mx-auto"></div>
    <script src="{{ asset('js/cards.js') }}"></script>
  @endsection
</body>
</html>
