<?php
session_start();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - UniVent</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

  <div class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-sm">
      <div class="rounded-3xl p-10 bg-white border border-gray-200 shadow-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-2">
          <img src="../assets/img/logo.png" class="w-16 h-16" alt="Logo UniVent">
        </div>

        <!-- Title -->
        <div class="flex items-center justify-center gap-1 mb-6">
          <span class="text-xl font-semibold">Login</span>
          <img src="../assets/img/univent.png" class="h-6" alt="UniVent">
        </div>

        <!-- ERROR BACKEND -->
        <?php if (isset($_GET['error'])): ?>
          <p class="text-sm text-red-500 text-center mb-4">
            Email atau password salah
          </p>
        <?php endif; ?>

        <form id="loginForm"
              method="post"
              action="login_proses.php"
              class="space-y-4"
              novalidate>

          <!-- EMAIL -->
          <div>
            <input
              id="email"
              name="email"
              type="text"
              placeholder="Email"
              class="w-full h-12 border border-gray-300 rounded-md px-4
                     focus:outline-none focus:ring-2 focus:ring-blue-400">

            <p id="emailError"
               class="text-sm text-red-500 mt-1 hidden">
              Email tidak valid!
            </p>
          </div>

          <!-- PASSWORD -->
          <div>
            <div class="relative">
              <input
                id="password"
                name="password"
                type="password"
                placeholder="Password"
                class="w-full h-12 border border-gray-300 rounded-md
                       px-4 pr-12
                       focus:outline-none focus:ring-2 focus:ring-blue-400">

              <button
                type="button"
                id="togglePassword"
                class="absolute right-3 top-1/2 -translate-y-1/2
                       w-8 h-8 flex items-center justify-center
                       text-gray-500">

                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18M10.58 10.58a2 2 0 002.83 2.83M9.88 5.08
                       A9.96 9.96 0 0112 5c4.48 0 8.27 2.94 9.54 7
                       a9.96 9.96 0 01-4.07 5.13M6.1 6.1
                       A9.96 9.96 0 002.46 12
                       c1.27 4.06 5.06 7 9.54 7
                       a9.96 9.96 0 003.94-.8"/>
                </svg>

                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 hidden"
                  fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.46 12C3.73 7.94 7.52 5 12 5
                       c4.48 0 8.27 2.94 9.54 7
                       -1.27 4.06-5.06 7-9.54 7
                       -4.48 0-8.27-2.94-9.54-7z"/>
                </svg>

              </button>
            </div>

            <p id="password_error"
               class="text-sm text-red-500 mt-1 hidden">
              Password tidak boleh kosong!
            </p>
          </div>

          <!-- FORGOT -->
          <div class="text-right -mt-2">
            <a href="lupa_pw.php"
               class="text-sm text-blue-500 hover:underline">
              Lupa Password?
            </a>
          </div>

          <!-- BUTTON -->
          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700
                   text-white font-semibold rounded-xl py-3">
            Login
          </button>

          <!-- REGISTER -->
          <p class="text-center text-sm">
            <a href="register.php"
               class="text-blue-500 hover:underline">
              Belum punya akun? Daftar
            </a>
          </p>

        </form>

      </div>
    </div>
  </div>

  <script src="../assets/js/auth/login.js"></script>
</body>
</html>
