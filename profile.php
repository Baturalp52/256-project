<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    extract($_GET);

    if (!isset($id) && !isset($_SESSION["user_id"])) {
        header("Location: /login.php");
        exit;
    } else {
        $userModel = new UsersModel($db);
        $postsModel = new PostsModel($db);        
        $friendModel = new FriendsModel($db);
        if (!isset($id)) {
            $id = $_SESSION["user_id"];
        }

        $user = $userModel->findOne($id);
        $posts = $postsModel->getUserPosts($id);



    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
    <style>
        .edit-post::after {
            display: none;
        }
    </style>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <div class="col col-xl-12">
        <div class="card" style="border-radius: 15px; margin-top: 64px;">
            <div class="card-body p-4">
                <div class="d-flex text-black position-relative">
                    <div class="position-absolute" style="top:-90px;">
                    <?php if (isset($user["picture"]) && $user["picture"]) { ?>
                        <img class="rounded-circle" src="<?= $user['picture'] ?>" alt="<?= filter_var($user["name"] . " " . $user["last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"
                            style="width: 180px;height:180px;object-fit:cover;">
                    <?php } else { ?>
                        <iconify-icon icon="heroicons:rocket-launch-solid" width="140" height="140" class="text-danger rounded-circle"></iconify-icon>
                    <?php } ?>
                    </div>
                    <div class="d-flex flex-column" style="margin-left: 200px;">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-1 text-white text-center">
                                    <?= filter_var( $user["name"] . " " . $user["last_name"],FILTER_SANITIZE_FULL_SPECIAL_CHARS )?>
                                </h5>
                                <p class="mb-2 pb-1 text-white text-center" style="color: #2b2a2a;">
                                    <?=$user["birth_date"]!=="0000-00-00"? date_format(date_create($user["birth_date"]), 'j, M, Y'):"" ?>
                                </p>
                            </div>

                            <?php if (isset($_USER) && $_USER["id"]) { ?>
                                <?php if (isset($id) && $_USER["id"] !== $id) { ?>
                                    <?php
                                    $status = $friendModel-> findstatus($_USER["id"], $id); // Function to get status from the database
                                    
                                    if ($status == 2) {
                                        $buttonText = "Request Sent";
                                        $buttonClass = "btn-primary";
                                        $buttonDisabled = true;
                                    } elseif ($status == 1) {
                                        $buttonText = "Remove Friend"; 
                                        $buttonClass = "btn-danger"; 
                                        $buttonDisabled = false;
                                    } elseif ($status == 0) {
                                        $buttonText = "Request Rejected";
                                        $buttonClass = "btn-danger";
                                        $buttonDisabled = true;
                                    } else {
                                        $buttonText = "Add Friend";
                                        $buttonClass = "btn-primary";
                                        $buttonDisabled = false;
                                    }
                                    ?>
                                   <button type="button" id="<?= $status == 1 ? 'removeFriend' : 'addFriend' ?>"
                                            class="btn btn-sm <?= $buttonClass ?> col-xl-4 d-flex align-items-center justify-content-center"
                                            style="height: 50px;" <?= $buttonDisabled ? 'disabled' : '' ?>><?= $buttonText ?></button>

                            
                                <?php } elseif (!isset($id) || $_USER["id"] === $id) { ?>
                                    <a href="/settings.php" class="btn btn-sm btn-primary col-xl-4 d-flex align-items-center justify-content-center" style="height: 50px;">Edit</a>
                                <?php } ?>
                            <?php } ?>


                        </div>

                        <div class="d-flex rounded-3 p-2 mb-2 col-xl-12 justify-content-between align-items-center">
                            <p class="text-white">Lorem ipsum dolor sit amet consectetur, adipisicing elit. A
                                dolorum, veritatis illum fugit magnam enim.</p>

                        </div>
                    </div>
                    <div class="d-flex pt-1">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column align-items-center gap-3">
        <?php if ($id == $_SESSION["user_id"]) { ?>
            <a href="new-post.php"
                class="btn btn-outline-primary border border-2 border-primary d-flex align-items-center justify-content-center mt-3"
                style="width:600px;border-style:dashed!important;">
                <iconify-icon icon="line-md:plus" width="24" height="24"></iconify-icon> Create New
                Post
            </a>
        <?php } ?>
        <?php foreach ($posts as $post) { ?>
            <div class="card" style="width: 600px; margin-top: 12px;" data-post-id="<?= $post["id"] ?>">
                <div class="card-header d-flex align-items-center gap-2 text-decoration-none">
                    <?php if (isset($user["picture"])) { ?>
                        <img src="<?= filter_var($user["picture"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>" alt="mdo" width="32"
                            height="32" class="rounded-circle">
                    <?php } else { ?>
                        <iconify-icon icon="heroicons:rocket-launch-solid" width="32" height="32" class="text-danger">
                        </iconify-icon>
                    <?php } ?>
                    <div class="d-flex flex-column">
                        <a href="/profile.php?<?= $user["id"] ?>"
                            class="d-flex align-items-stretch gap-2 text-decoration-none">
                            <?= filter_var($user["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . " " . filter_var($user["last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                        </a>
                        <small class="text-body-secondary">
                            <?= date_format(date_create($post["created_at"]), 'j, M, Y') ?>
                        </small>
                    </div>
                    <div class="dropdown ms-auto">
                        <button
                            class="btn btn-secondary edit-post dropdown-toggle rounded-circle p-1 d-flex align-items-center justify-content-center"
                            type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            <iconify-icon icon="mingcute:more-2-fill" width="24" height="24"></iconify-icon>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/post-detail.php?id=<?= $post["id"] ?>">Edit</a></li>
                            <li><button type="button" class="dropdown-item text-danger delete-post"
                                    data-post-id="<?= $post["id"] ?>">Delete</button>
                            </li>
                        </ul>
                    </div>

                </div>
                <?php if (isset($post["image"])) { ?>

                    <img src="<?= filter_var($post["image"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>" class="card-img-top"
                        alt="POST">
                <?php } ?>
                <div class="card-body">
                    <p class="card-text">
                        <?= filter_var($post["text"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                    </p>
                    <a href="#" class="btn btn-dark text-danger">
                        <div class="d-flex align-items-center">
                            <?php if ($post["is_liked"]) { ?>
                                <iconify-icon icon="line-md:heart-filled" width="24" height="24"></iconify-icon>
                            <?php } else { ?>
                                <iconify-icon icon="line-md:heart" width="24" height="24"></iconify-icon>
                            <?php } ?>
                            Like
                        </div>
                    </a>
                    <a href="/post-detail.php?id=<?= $post["id"] ?>" class="btn btn-dark text-info">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="line-md:email-twotone" width="24" height="24"></iconify-icon>
                            Comment
                        </div>
                    </a>
                </div>
            </div>


        <?php } ?>
    </div>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
    

    <script>
        

        $(function () {

            $(".delete-post").on("click", "", function () {
            const id = $(this).attr("data-post-id");
            showDeleteModal({
                title: "Are you sure you want to delete?",
                onAccept: function () {
                    $.ajax({
                        method: "DELETE",
                        url: `/post-detail.php?id=${id}`,
                    }).done((d, res, o) => {
                        if (res === "success") {
                            showToast({
                                title: "",
                                description: "Post deleted successfully!",
                                color: "danger"
                            });
                            $(`[data-post-id=${id}]`).remove();
                        }

                    }).fail((...res) => {
                        console.log("Error:", res);
                    });
                },
            });
        });

            $("#addFriend").on("click", "", function () {
                const btn = $(this);

                $.ajax({
                    method: "POST",
                    url: "/friend-requests.php",
                    data: {
                        friend_id: <?= filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS) ?>
                    }
                }).done(function (data, res, opt) {
                    if (res === "success")
                     showToast({
                     title: "",
            description: "Friend invititation sent successfully!",
            color: "success",
                        });
                        btn.attr("disabled");
                });

            });

    $("#removeFriend").on("click", "", function () {
 const btn = $(this);
        $.ajax({
            method: "DELETE",
            url: "/friend-requests.php", // PHP script to handle the removal of friend
            data: {
                inviter_id: <?= filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS) ?>
            }
        }).done(function (data, res, opt) {
            if (res === "success") {
                showToast({
                     title: "",
            description: "Friend removed successfully!",
            color: "success",
                        });
                        btn.attr("disabled");
            }
        });

        });
});


    </script>
</body>

</html>