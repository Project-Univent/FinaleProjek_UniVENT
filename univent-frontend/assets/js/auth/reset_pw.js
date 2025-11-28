const resetForm = document.getElementById("resetForm");

const pw1 = document.getElementById("pw1");
const pw2 = document.getElementById("pw2");
const pwError = document.getElementById("pw_error");

resetForm.addEventListener("submit", function (e) {
  e.preventDefault();

  let valid = true;

  // Password kosong?
  if (pw1.value.trim() === "" || pw2.value.trim() === "") {
    pwError.textContent = "Password tidak boleh kosong!";
    pwError.classList.remove("hidden");
    pw1.classList.add("border-red-300");
    pw2.classList.add("border-red-300");
    valid = false;
  }

  // Minimal 6 karakter?
  else if (pw1.value.length < 6) {
    pwError.textContent = "Password minimal 6 karakter!";
    pwError.classList.remove("hidden");
    pw1.classList.add("border-red-300");
    pw2.classList.add("border-red-300");
    valid = false;
  }

  // Password cocok?
  else if (pw1.value !== pw2.value) {
    pwError.textContent = "Password tidak sama!";
    pwError.classList.remove("hidden");
    pw1.classList.add("border-red-300");
    pw2.classList.add("border-red-300");
    valid = false;
  }

  // Semua valid
  else {
    pwError.classList.add("hidden");
    pw1.classList.remove("border-red-300");
    pw2.classList.remove("border-red-300");
  }

  if (!valid) return;

  alert("Password berhasil direset!");
  window.location.href = "login.html";
});
