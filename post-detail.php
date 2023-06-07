<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
include($_SERVER["DOCUMENT_ROOT"] . "/helpers/get-file.helper.php");
$post_id = $_GET['id'];
if (!isset($post_id)) {
    header("Location: feed.php");
}
$pm = new PostsModel($db);

$is_post_owned = false;
if (isset($_SESSION["user_id"])) {
    $is_post_owned = $pm->checkUserOwnPost($_SESSION["user_id"], $post_id);
    $post = $pm->findOne($post_id, $_SESSION["user_id"]);
} else
    $post = $pm->findOne($post_id);

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
    if ($is_post_owned) {
        if (count($_FILES) > 0) {
            $newImage = getFile("newImage", "post-img-");
        }
        extract($_POST);
        $pm->updatePost($post_id, isset($newText) ? $newText : $post["text"], isset($newImage) ? $newImage : $post["image"]);
        $post = $pm->findOne($post_id);
    }
}
if ($_SERVER["REQUEST_METHOD"] === "DELETE") {

    if ($is_post_owned) {
        $pm->deletePost($post_id);
        header("HTTP/1.1 200 OK");
        exit();
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

        #image-overlay {
            position: absolute;
            transition: all .5s;
        }

        #image-overlay:hover {
            opacity: 0.8 !important;
            cursor: pointer;
        }
    </style>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <div class="d-flex flex-column mx-auto align-items-stretch gap-5" style="width: 800px;">
        <div class="card" id="post">
            <div class="card-header d-flex align-items-center gap-2 text-decoration-none">
                <?php if (isset($post["user.picture"])) { ?>
                    <img src="<?= $post["user.picture"] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                <?php } else { ?>
                    <iconify-icon icon="heroicons:rocket-launch-solid" width="32" height="32"
                        class="text-danger"></iconify-icon>
                <?php } ?>
                <div class="d-flex flex-column">
                    <a href="/profile.php?id=<?= $post["user_id"] ?>"
                        class="d-flex align-items-stretch gap-2 text-decoration-none">
                        <?= filter_var($post["user.name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . " " . filter_var($post["user.last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                    </a>
                    <small class="text-body-secondary">
                        <?= date_format(date_create($post["created_at"]), 'j, M, Y') ?>
                    </small>
                </div>
                <?php if ($is_post_owned) { ?>
                    <div class="dropdown ms-auto">
                        <button
                            class="btn btn-secondary edit-post dropdown-toggle rounded-circle p-1 d-flex align-items-center justify-content-center"
                            type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            <iconify-icon icon="mingcute:more-2-fill" width="24" height="24"></iconify-icon>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" id="edit">Edit</a></li>
                            <li><a class="dropdown-item text-danger" id="delete">Delete</a></li>
                        </ul>
                    </div>
                <?php } ?>
            </div>
            <div style="position:relative">
                <img src="<?= $post['image'] ?>" class="card-img-top" alt="..." id="post-image">
            </div>
            <div class="card-body">
                <p class="card-text">
                    <?= filter_var($post['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                </p>
                <button class="btn btn-dark text-danger" id="like">
                    <div class="d-flex align-items-center">
                        <?php if ($post["is_liked"]) { ?>
                            <iconify-icon icon="line-md:heart-filled" width="24" height="24"></iconify-icon>
                        <?php } else { ?>
                            <iconify-icon icon="line-md:heart" width="24" height="24"></iconify-icon>
                        <?php } ?>
                        Like
                    </div>
                </button>
                <a href="#" class="btn btn-dark text-info">
                    <div class="d-flex align-items-center">
                        <iconify-icon icon="line-md:email-twotone" width="24" height="24"></iconify-icon>
                        Comment
                    </div>
                </a>
            </div>


        </div>
        <!-- Comment Section -->
        <div class="d-flex flex-column mx-auto align-items-stretch w-100 gap-3">
            <?php for ($number = 0; $number < 3; $number++) { ?>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <img src="https://example.com/avatar.png" alt="User Avatar" width="32" height="32"
                                class="rounded-circle">
                            <div class="d-flex flex-column">
                                <a href="#" class="text-decoration-none">Commenter Name</a>
                                <small class="text-body-secondary">2 Jun, 2023</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text">This is a comment.</p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
        <script src="/src/common/js/helpers/show-delete-modal.helper.js" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $("#edit").on("click", "", function () {
                    const form = document.createElement("form");
                    form.setAttribute("method", "POST");
                    form.enctype = "multipart/form-data";

                    const newImageInput = document.createElement("input");
                    newImageInput.type = "file";
                    newImageInput.style = "display:none";
                    newImageInput.name = "newImage";
                    newImageInput.onchange = function (e) {
                        const file = e.target.files[0];
                        const src = URL.createObjectURL(file);
                        const img = $("#post-image");
                        img.attr("old-src", img.attr("src"));
                        img.attr("src", src);
                    }


                    const newImageOverlay = document.createElement("div");
                    newImageOverlay.id = "image-overlay";
                    newImageOverlay.className = "w-100 h-100 text-center d-flex align-items-center justify-content-center bg-dark opacity-50"

                    const newImageText = document.createElement("p");
                    newImageText.className = "text-white d-flex align-items-center justify-content-center gap-1 opacity-100";

                    const newImageIcon = document.createElement("iconify-icon");
                    newImageIcon.setAttribute("icon", "line-md:image");
                    newImageIcon.setAttribute("width", "24");
                    newImageIcon.setAttribute("height", "24");

                    newImageText.appendChild(newImageIcon);
                    newImageText.innerHTML += "ADD NEW IMAGE";

                    newImageOverlay.appendChild(newImageText);

                    newImageOverlay.onclick = function () {
                        newImageInput.click();
                    }


                    const textAreaContainer = document.createElement("div");
                    const textAreaLabel = document.createElement("label");
                    const textArea = document.createElement("textarea");

                    textAreaLabel.htmlFor = "newText";
                    //textAreaLabel.setAttribute("for", "newText");
                    textAreaLabel.className = "form-label fw-bold";
                    textAreaLabel.innerText = "Edit";

                    textArea.className = "form-control";
                    textArea.id = "newText";
                    textArea.name = "newText";
                    textArea.rows = "3";
                    textArea.innerText = "<?= $post["text"] ?>";

                    const btnContainer = document.createElement("div");
                    btnContainer.className = "mt-2 text-end";

                    const saveBtn = document.createElement("button");
                    saveBtn.className = "btn btn-dark text-primary";
                    saveBtn.type = "submit";
                    saveBtn.innerText = "SAVE";

                    const cancelBtn = document.createElement("button");
                    cancelBtn.className = "btn btn-dark text-danger me-2 ";
                    cancelBtn.id = "cancel";
                    cancelBtn.innerText = "CANCEL";
                    cancelBtn.onclick = function () {
                        const text = document.createElement("p");
                        text.className = "card-text";
                        text.innerText = "<?= filter_var($post['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>";

                        $(form).replaceWith(text);
                        $(newImageOverlay).remove();
                        const img = $("#post-image");
                        if (img.attr("old-src"))
                            img.attr("src", img.attr("old-src"));
                    }

                    btnContainer.appendChild(cancelBtn);
                    btnContainer.appendChild(saveBtn);

                    textAreaContainer.appendChild(textAreaLabel);
                    textAreaContainer.appendChild(textArea);
                    textAreaContainer.appendChild(btnContainer);

                    form.appendChild(textAreaContainer);
                    $("#post > .card-body > .card-text").replaceWith(form);
                    $(newImageOverlay).insertBefore("#post-image");
                    form.appendChild(newImageInput);
                });


                $("#delete").on("click", "", function () {
                    showDeleteModal({
                        title: "Are you sure you want to delete?",
                        onAccept: function () {
                            $.ajax({
                                method: "DELETE",
                                url: window.location.href,
                            }).done((d, res, o) => {
                                if (res === "success")
                                    window.location.href = "/feed.php?alert=1";
                            }).fail((...res) => {
                                console.log("Error:", res);
                            })
                        },
                    });
                });

                $("#like").on("click", "", function () {
                    $.ajax({
                        method: "POST",
                        url: "/like-post.php",
                        data: {
                            post_id: <?= $post_id ?>
                        }
                    }).done((d, res, o) => {
                        if (res === "success") {
                            const icon = $(this).find("iconify-icon").attr("icon");
                            $(this).find("iconify-icon").attr("icon", icon === "line-md:heart" ? "line-md:heart-filled" : "line-md:heart");
                        }
                    }).fail((...res) => {
                        console.log("Error:", res);
                    })

                });





            });
        </script>
</body>

</html>