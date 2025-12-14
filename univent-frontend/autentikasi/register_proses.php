document.addEventListener("DOMContentLoaded", () => {

  const form = document.getElementById("registerForm");

  const fullname = document.getElementById("fullname");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirmPassword");

  const fullnameError = document.getElementById("fullnameError");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");
  const confirmPasswordError = document.getElementById("confirmPasswordError");

  const togglePassword = document.getElementById("togglePassword");
  const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");

  const eyeOpen = document.getElementById("eyeOpen");
  const eyeClosed = document.getElementById("eyeClosed");
  const eyeOpen2 = document.getElementById("eyeOpen2");
  const eyeClosed2 = document.getElementById("eyeClosed2");

  function validEmail(val) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(val);
  }

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let valid = true;

    if (fullname.value.trim() === "") {
      fullnameError.classList.remove("hidden");
      valid = false;
    } else fullnameError.classList.add("hidden");

    if (!validEmail(email.value.trim())) {
      emailError.classList.remove("hidden");
      valid = false;
    } else emailError.classList.add("hidden");

    if (password.value.length < 6) {
      passwordError.classList.remove("hidden");
      valid = false;
    } else passwordError.classList.add("hidden");

    if (confirmPassword.value !== password.value) {
      confirmPasswordError.classList.remove("hidden");
      valid = false;
    } else confirmPasswordError.classList.add("hidden");

    if (!valid) return;

    form.submit();
  });

  togglePassword.addEventListener("click", () => {
    const hidden = password.type === "password";
    password.type = hidden ? "text" : "password";
    eyeOpen.classList.toggle("hidden", !hidden);
    eyeClosed.classList.toggle("hidden", hidden);
  });

  toggleConfirmPassword.addEventListener("click", () => {
    const hidden = confirmPassword.type === "password";
    confirmPassword.type = hidden ? "text" : "password";
    eyeOpen2.classList.toggle("hidden", !hidden);
    eyeClosed2.classList.toggle("hidden", hidden);
  });

});
