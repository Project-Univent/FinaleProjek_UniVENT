const form = document.getElementById("loginForm");
const email = document.getElementById("email");
const emailError = document.getElementById("emailError");

// define password vars BEFORE using them
const password = document.getElementById("password");
const passwordError = document.getElementById("password_error");

function validEmail(str) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
}

form.addEventListener("submit", function (e) {
  e.preventDefault();

  let valid = true;

  // INVALID EMAIL
  if (!validEmail(email.value.trim())) {
    emailError.classList.remove("hidden");
    email.classList.add("border-red-300");
    valid = false;
  } else {
    emailError.classList.add("hidden");
    email.classList.remove("border-red-300");
  }

  // PASSWORD EMPTY
  if (password.value.trim() === "") {
    passwordError.classList.remove("hidden");
    password.classList.add("border-red-300");
    valid = false;
  } else {
    passwordError.classList.add("hidden");
    password.classList.remove("border-red-300");
  }

  if (!valid) return;

  alert("Login valid! Siap connect ke backend.");
});


// === PASSWORD TOGGLE ===

const togglePassword = document.getElementById("togglePassword");
const eyeOpen = document.getElementById("eyeOpen");
const eyeClosed = document.getElementById("eyeClosed");

togglePassword.addEventListener("click", () => {
  const show = password.getAttribute("type") === "password";
  password.setAttribute("type", show ? "text" : "password");

  eyeOpen.classList.toggle("hidden", !show);
  eyeClosed.classList.toggle("hidden", show);
});
