$(document).ready(function () {
  // Function to compare passwords
  function checkfuncs() {
    var email = $("#floatingInput").val();
    var pass = $("#floatingPassword").val();

    if (pass !== "" && email !== "") {
      $("#logbtn").attr("disabled", false);
    } else $("#logbtn").attr("disabled", true);
  }
  // Trigger the comparison when either password field changes

  $("#floatingInput,#floatingPassword").on("keyup", "", checkfuncs);
});
