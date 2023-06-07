<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/helpers/get-file.helper.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    extract($_POST);
    $post = new PostsModel($db);
    $post->addPost($_SESSION['user_id'], $text, getFile('postImg', "post-img-"));

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>

    <form method="post" enctype="multipart/form-data">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card d-flex" style="width: 36rem; height: 25rem;">
                <div class="card-body">
                    <h5 class="card-title mb-5">ADD POST</h5>
                    <p class="card-text mb-5"><input type="text" name="text" class="form-control form-control-lg"
                            style="width: 100%; height: 100px;" placeholder="Enter your post here"></p>
                    <div>
                        <label for="formFileLg" class="form-label">Add Image</label>
                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="postImg">
                    </div>

                </div>
                <button class="btn btn-primary">POST</button>
            </div>
        </div>

    </form>



    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
</body>

</html>