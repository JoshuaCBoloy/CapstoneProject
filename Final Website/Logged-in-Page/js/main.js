const inputs = document.querySelectorAll(".input");

function addcl() {
  let parent = this.parentNode.parentNode;
  parent.classList.add("focus");
}

function remcl() {
  let parent = this.parentNode.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

// Check if input fields have a value when the page loads
window.addEventListener("DOMContentLoaded", function () {
  inputs.forEach((input) => {
    let parent = input.parentNode.parentNode;
    if (input.value !== "") {
      parent.classList.add("focus");
    }
  });
});

inputs.forEach((input) => {
  input.addEventListener("focus", addcl);
  input.addEventListener("blur", remcl);
});

function validateForm() {
  var name = document.getElementsByName("full_name")[0];
  var email = document.getElementsByName("email")[0];
  var password = document.getElementsByName("password")[0];
  var confirmPassword = document.getElementsByName("repeat_password")[0];
  var isValid = true;

  if (!name.value) {
    document.getElementById("nameError").innerText =
      "Please enter your full name.";
    isValid = false;
  } else {
    document.getElementById("nameError").innerText = "";
  }

  if (!email.value) {
    document.getElementById("emailError").innerText =
      "Please enter a valid email address.";
    isValid = false;
  } else {
    document.getElementById("emailError").innerText = "";
  }

  if (!password.value) {
    document.getElementById("passwordError").innerText =
      "Please enter a password.";
    isValid = false;
  } else {
    document.getElementById("passwordError").innerText = "";
  }

  if (password.value !== confirmPassword.value) {
    document.getElementById("confirmPasswordError").innerText =
      "Passwords do not match.";
    isValid = false;
  } else {
    document.getElementById("confirmPasswordError").innerText = "";
  }

  if (!isValid) {
    alert("Please fill in all required fields.");
  }

  return isValid;
}

function clearError(errorId) {
  document.getElementById(errorId).innerText = "";
}

// Clear error messages when input fields receive focus
document
  .getElementsByName("full_name")[0]
  .addEventListener("focus", function () {
    clearError("nameError");
  });

document.getElementsByName("email")[0].addEventListener("focus", function () {
  clearError("emailError");
});

document
  .getElementsByName("password")[0]
  .addEventListener("focus", function () {
    clearError("passwordError");
  });

document
  .getElementsByName("repeat_password")[0]
  .addEventListener("focus", function () {
    clearError("confirmPasswordError");
  });

function showPopup() {
  var popup = document.getElementById("popup");
  popup.classList.remove("hidden");
  setTimeout(function () {
    popup.classList.add("hidden");
  }, 3000); // Adjust the duration (in milliseconds) as needed
}


