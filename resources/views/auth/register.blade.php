<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HollowTCG - Registro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;700&display=swap" rel="stylesheet">
  <style>
      body {
          font-family: 'Oswald', sans-serif;
      }
      .glass {
          background: #f0ebe5;
          backdrop-filter: blur(10px);
          border-radius: 10px;
      }
      .glass:focus {
          border: 1px solid #ECDFCC;
      }
  </style>
</head>
<body class="bg-[#1E1126] m-0 p-0">
  <main class="flex flex-col items-center p-4">
    <section class="bg-[#5E1675] p-6 m-4 rounded-lg w-full max-w-[500px] shadow-lg">
        <h2 class="mb-4 text-[#D4C2FC]">Registro</h2>
        <form class="px-7">
          <div class="grid gap-6" id="form">
            <div class="w-full flex gap-3">
              <input class="capitalize shadow-2xl p-3 w-full outline-none focus:border-solid focus:border-[1px] border-[#9B30FF] placeholder:text-[#D4C2FC] glass" type="text" placeholder="First Name" id="First-Name" name="First-Name" required>
              <input class="capitalize shadow-2xl p-3 w-full outline-none focus:border-solid focus:border-[1px] border-[#9B30FF] placeholder:text-[#D4C2FC] glass" type="text" placeholder="Last Name" id="Last-Name" name="Last-Name">
            </div>
            <div class="grid gap-6 w-full">
              <input class="p-3 shadow-2xl w-full outline-none focus:border-solid focus:border-[1px] border-[#9B30FF] placeholder:text-[#D4C2FC] glass" type="email" placeholder="Email" id="Email" name="email">
              <input class="p-3 shadow-2xl w-full outline-none focus:border-solid focus:border-[1px] border-[#9B30FF] text-[#D4C2FC] glass" type="date" required>
            </div>
            <div class="flex gap-3">
              <input class="p-3 shadow-2xl w-full outline-none focus:border-solid focus:border-[1px] border-[#9B30FF] placeholder:text-[#D4C2FC] glass" type="password" placeholder="Password" id="password" name="password" required>
              <input class="p-3 shadow-2xl w-full outline-none focus:border-solid focus:border-[1px] border-[#9B30FF] placeholder:text-[#D4C2FC] glass" type="password" placeholder="Confirm password" required>
            </div>
            <button class="outline-none shadow-2xl w-full p-3 bg-[#ffffff42] hover:border-[#9B30FF] hover:border-solid hover:border-[1px] hover:text-[#D4C2FC] font-bold glass" type="submit">Submit</button>
          </div>
        </form>
    </section>
  </main>
</body>
</html>