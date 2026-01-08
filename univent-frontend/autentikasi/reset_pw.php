<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Univent</title>
  
  <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="bg-white text-gray-800">

  <div class="min-h-screen flex items-center justify-center px-6 py-12">

    <div class="w-full max-w-sm">
      <div class="rounded-3xl p-10 bg-white border border-gray-200 shadow-lg">

        <div class="flex justify-center mb-2 mt-2">
          <img src="../assets/img/logo.png" class="w-16 h-16">
        </div>

        <h2 class="text-center text-xl font-semibold mb-6">
          Reset Password
        </h2>

        <form id="resetForm"
              action="reset_pw_proses.php"
              method="POST"
              class="space-y-4"
              novalidate>

          <div>
            <input id="pw1"
              name="password"
              type="password"
              placeholder="Password baru"
              class="w-full border border-gray-300 rounded-md px-4 py-3 text-gray-700
                     focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
          </div>

          <div>
            <input id="pw2"
              name="password_confirm"
              type="password"
              placeholder="Konfirmasi password"
              class="w-full border border-gray-300 rounded-md px-4 py-3 text-gray-700
                     focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
            <p id="pw_error" class="text-sm text-red-500 mt-1 hidden">
              Password tidak sama!
            </p>
          </div>

          <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold 
                   rounded-xl py-3 shadow-sm transition">
            Simpan Password
          </button>

          <p class="text-center mt-2">
            <a href="login.php" class="text-sm text-blue-300 hover:underline">
              Kembali ke Login
            </a>
          </p>

        </form>

      </div>
    </div>
  </div>

  <script src="../assets/js/auth/reset_pw.js"></script>

</body>
</html>
