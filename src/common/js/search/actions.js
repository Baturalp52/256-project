$(function () {
  $(".add-friend").on("click", "", function () {
    const user_id = $(this).attr("data-user-id");
    $.ajax({
      method: "POST",
      url: `/friend-requests.php`,
      data: {
        friend_id: user_id,
      },
    })
      .done((d, res, o) => {
        if (res === "success") {
          showToast({
            title: "",
            description: "Friend invititation sent successfully!",
            color: "success",
          });
          $(`[data-user-id=${user_id}]`).attr("disabled", true);
        }
      })
      .fail((...res) => {
        console.log("Error:", res);
      });
  });
});
