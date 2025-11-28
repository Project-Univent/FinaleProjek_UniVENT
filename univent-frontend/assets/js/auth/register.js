// FORM ELEMENT
const registerForm = document.getElementById("registerForm");

const fullname = document.getElementById("fullname");
const fullnameError = document.getElementById("fullnameError");

const email = document.getElementById("email");
const emailError = document.getElementById("emailError");

const password = document.getElementById("password");
const passwordError = document.getElementById("passwordError");

const confirmPassword = document.getElementById("confirmPassword");
const confirmPasswordError = document.getElementById("confirmPasswordError");

// EYE ICONS
const togglePassword = document.getElementById("togglePassword");
const eyeOpen = document.getElementById("eyeOpen");
const eyeClosed = document.getElementById("eyeClosed");

const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
const eyeOpen2 = document.getElementById("eyeOpen2");
const eyeClosed2 = document.getElementById("eyeClosed2");

// EMAIL CHECK
function validEmail(str) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
}

// RESET STYLE
function resetError(input, errorText) {
  input.classList.remove("border-red-300");
  input.classList.add("border-gray-300");
  errorText.classList.add("hidden");
}

// SET ERROR
function setError(input, errorText) {
  input.classList.remove("border-gray-300");
  input.classList.add("border-red-300");
  errorText.classList.remove("hidden");
}

// TOGGLE PASSWORD
togglePassword.addEventListener("click", () => {
  const type = password.type === "password" ? "text" : "password";
  password.type = type;
  eyeClosed.classList.toggle("hidden");
  eyeOpen.classList.toggle("hidden");
});

// TOGGLE CONFIRM PASSWORD
toggleConfirmPassword.addEventListener("click", () => {
  const type = confirmPassword.type === "password" ? "text" : "password";
  confirmPassword.type = type;
  eyeClosed2.classList.toggle("hidden");
  eyeOpen2.classList.toggle("hidden");
});

// SUBMIT CHECK
registerForm.addEventListener("submit", function (e) {
  e.preventDefault();

  let valid = true;

  // FULLNAME
  if (fullname.value.trim() === "") {
    setError(fullname, fullnameError);
    valid = false;
  } else {
    resetError(fullname, fullnameError);
  }

  // EMAIL
  if (!validEmail(email.value.trim())) {
    setError(email, emailError);
    valid = false;
  } else {
    resetError(email, emailError);
  }

  // PASSWORD
  if (password.value.length < 6) {
    setError(password, passwordError);
    valid = false;
  } else {
    resetError(password, passwordError);
  }

  // CONFIRM PASSWORD
  if (confirmPassword.value !== password.value || confirmPassword.value === "") {
    setError(confirmPassword, confirmPasswordError);
    valid = false;
  } else {
    resetError(confirmPassword, confirmPasswordError);
  }

  if (!valid) return;

  alert("Registrasi valid! Siap connect ke backend.");
});