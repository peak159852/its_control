const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signUpBtn.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

signInBtn.addEventListener("click", () => {
  container.classList.add("right-panel-active");
});
// secondForm.addEventListener("submit", (e) => e.preventDefault());
// fistForm.addEventListener("submit", (e) => e.preventDefault());
