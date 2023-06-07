$(document).ready(function () {
  // Function to compare passwords
  function comparePasswords() {
    var password = $("#passwordInput").val();
    var passwordAgain = $("#passwordAgainInput").val();

    if (!password) return false;

    if (password !== passwordAgain) {
      $("#passwordError").show();
      $("#passwordInput, #passwordAgainInput").addClass("is-invalid");
      return false;
    } else {
      $("#passwordError").hide();
      $("#passwordInput, #passwordAgainInput").removeClass("is-invalid");
      return true;
    }
  }
  function checkfuncs() {
    var name = $("#inputName").val();
    var last_name = $("#inputSurname").val();
    var email = $("#inputEmail").val();

    if (comparePasswords() && name !== "" && last_name !== "" && email !== "") {
      $("#regbtn").attr("disabled", false);
    } else $("#regbtn").attr("disabled", true);
  }
  // Trigger the comparison when either password field changes

  $("#inputName, #inputSurname, #inputEmail, #passwordInput, #passwordAgainInput").on("keyup", "", checkfuncs);
});
