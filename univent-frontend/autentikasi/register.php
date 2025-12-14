<?php
session_start();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Univent</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

  <div class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-sm">
      <div class="rounded-3xl p-10 bg-white border border-gray-200 shadow-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-2 mt-2">
          <img src="../assets/img/logo.png" class="w-16 h-16" alt="Logo Univent">
        </div>

        <!-- Title -->
        <div class="flex items-center justify-center gap-1 mb-6">
          <span class="text-xl font-semibold">Daftar Akun</span>
          <img src="../assets/img/univent.png" class="h-6 object-contain" alt="UniVent Logo">
        </div>

        <!-- ERROR BACKEND -->
        <?php if (isset($_GET['error'])): ?>
          <p class="text-sm text-red-500 text-center mb-4">
            Email sudah terdaftar
          </p>
        <?php endif; ?>

        <form id="registerForm"
              method="post"
              action="register_process.php"
              class="space-y-4"
              novalidate>

          <!-- Nama -->
          <div>
            <input id="fullname" name="fullname" type="text" placeholder="Nama Lengkap"
              class="w-full h-12 border border-gray-300 rounded-md px-4
                     focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p id="fullnameError" class="text-sm text-red-500 mt-1 hidden">
              Nama tidak boleh kosong
            </p>
          </div>

          <!-- Email -->
          <div>
            <input id="email" name="email" type="text" placeholder="Email"
              class="w-full h-12 border border-gray-300 rounded-md px-4
                     focus:outline-none focus:ring-2 focus:ring-blue-300">
            <p id="emailError" class="text-sm text-red-500 mt-1 hidden">
              Email tidak valid
            </p>
          </div>

          <!-- Password -->
          <div>
            <div class="relative">
              <input id="password" name="password" type="password" placeholder="Password"
                class="w-full h-12 border border-gray-300 rounded-md
                       px-4 pr-12
                       focus:outline-none focus:ring-2 focus:ring-blue-300">

              <button type="button" id="togglePassword"
                class="absolute right-3 top-1/2 -translate-y-1/2
                       w-8 h-8 flex items-center justify-center text-gray-500">

                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18M10.58 10.58a2 2 0 002.83 2.83"/>
                </svg>

                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </button>
            </div>

            <p id="passwordError" class="text-sm text-red-500 mt-1 hidden">
              Password minimal 6 karakter
            </p>
          </div>

          <!-- Confirm Password -->
          <div>
            <div class="relative">
              <input id="confirmPassword" name="confirm_password" type="password"
                placeholder="Konfirmasi Password"
                class="w-full h-12 border border-gray-300 rounded-md
                       px-4 pr-12
                       focus:outline-none focus:ring-2 focus:ring-blue-300">

              <button type="button" id="toggleConfirmPassword"
                class="absolute right-3 top-1/2 -translate-y-1/2
                       w-8 h-8 flex items-center justify-center text-gray-500">

                <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3l18 18"/>
                </svg>

                <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </button>
            </div>

            <p id="confirmPasswordError" class="text-sm text-red-500 mt-1 hidden">
              Password tidak sama
            </p>
          </div>

          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700
                   text-white font-semibold rounded-xl py-3">
            Daftar
          </button>

          <p class="text-center mt-2">
            <a href="login.php" class="text-sm text-blue-500 hover:underline">
              Sudah punya akun? Login
            </a>
          </p>

        </form>
      </div>
    </div>
  </div>

  <script src="../assets/js/auth/register.js"></script>
</body>
</html>
