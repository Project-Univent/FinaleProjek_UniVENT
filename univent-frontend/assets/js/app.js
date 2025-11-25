const form = document.getElementById("loginForm");
const email = document.getElementById("email");
const emailError = document.getElementById("emailError");

function validEmail(str) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
}

form.addEventListener("submit", function (e) {
  e.preventDefault();

  // INVALID
  if (!validEmail(email.value.trim())) {
    emailError.classList.remove("hidden");
    email.classList.add("border-red-300");
    email.classList.remove("border-gray-300");
    return;
  }

  // RESETAA
  emailError.classList.add("hidden");
  email.classList.remove("border-red-300");
  email.classList.add("border-gray-300");

  alert("Login valid! Siap connect ke backend.");
});

const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

const eyeOpen = document.getElementById("eyeOpen");
const eyeClosed = document.getElementById("eyeClosed");

togglePassword.addEventListener("click", () => {
  const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  // Toggle icon
  eyeOpen.classList.toggle("hidden");
  eyeClosed.classList.toggle("hidden");
});
