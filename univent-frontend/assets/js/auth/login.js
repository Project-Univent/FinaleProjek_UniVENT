document.addEventListener("DOMContentLoaded", () => {

  const form = document.getElementById("loginForm");
  const email = document.getElementById("email");
  const emailError = document.getElementById("emailError");
  const password = document.getElementById("password");
  const passwordError = document.getElementById("password_error");

  const togglePassword = document.getElementById("togglePassword");
  const eyeOpen = document.getElementById("eyeOpen");
  const eyeClosed = document.getElementById("eyeClosed");

  // === STATE AWAL (WAJIB) ===
  emailError.classList.add("hidden");
  passwordError.classList.add("hidden");
  password.type = "password";
  eyeOpen.classList.add("hidden");
  eyeClosed.classList.remove("hidden");

  function validEmail(val) {
    if (!val.includes("@") || !val.includes(".")) return false;
    return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(val);
  }

  // === SUBMIT ===
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let valid = true;

    // EMAIL
    if (!validEmail(email.value.trim())) {
      emailError.classList.remove("hidden");
      email.classList.add("border-red-400");
      valid = false;
    } else {
      emailError.classList.add("hidden");
      email.classList.remove("border-red-400");
    }

    // PASSWORD
    if (password.value.trim() === "") {
      passwordError.classList.remove("hidden");
      password.classList.add("border-red-400");
      valid = false;
    } else {
      passwordError.classList.add("hidden");
      password.classList.remove("border-red-400");
    }

    if (!valid) return;

    alert("Login valid. Tinggal connect backend.");
  });

  // === TOGGLE PASSWORD ===
  togglePassword.addEventListener("click", () => {
    const isHidden = password.type === "password";
    password.type = isHidden ? "text" : "password";
    eyeOpen.classList.toggle("hidden", !isHidden);
    eyeClosed.classList.toggle("hidden", isHidden);
  });

});
