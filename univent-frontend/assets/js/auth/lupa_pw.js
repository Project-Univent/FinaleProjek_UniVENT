const forgotForm = document.getElementById("forgotForm");
const email = document.getElementById("forgot_email");
const emailError = document.getElementById("forgot_error");

function validEmail(str) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(str);
}

forgotForm.addEventListener("submit", function (e) {
  if (!validEmail(email.value.trim())) {
    e.preventDefault();
    emailError.classList.remove("hidden");
    email.classList.add("border-red-300");
  }
});
