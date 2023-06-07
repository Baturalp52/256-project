function checkRequestCount() {
  if (!$("[data-inviter-id]").length) {
    $("#side-bar-friend-requests").remove();
  }
}

$(function () {
  $(".reject-request").on("click", "", function () {
    const inviter_id = $(this).attr("data-inviter-id");
    showDeleteModal({
      title: "Are you sure you want to reject user?",
      onAccept: function () {
        $.ajax({
          method: "DELETE",
          url: `/friend-requests.php`,
          data: {
            inviter_id,
          },
        })
          .done((d, res, o) => {
            if (res === "success") {
              showToast({
                title: "",
                description: "User rejected successfully!",
                color: "danger",
              });
              $(`[data-inviter-id=${inviter_id}]`).remove();
              checkRequestCount();
            }
          })
          .fail((...res) => {
            console.log("Error:", res);
          });
      },
    });
  });

  $(".accept-request").on("click", "", function () {
    const inviter_id = $(this).attr("data-inviter-id");
    $.ajax({
      method: "PATCH",
      url: `/friend-requests.php`,
      data: {
        inviter_id,
      },
    })
      .done((d, res, o) => {
        if (res === "success") {
          showToast({
            title: "",
            description: "User accepted successfully!",
            color: "success",
          });
          $(`[data-inviter-id=${inviter_id}]`).remove();
          checkRequestCount();
        }
      })
      .fail((...res) => {
        console.log("Error:", res);
      });
  });
});
