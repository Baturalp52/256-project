<?php include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php"); ?>

<?php
$post_id = $_GET['id'];
if (!isset($post_id)) {
    header("Location: feed.php");
}
$obg = new PostsModel($db);
$post = $obg->findOne($post_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <div class="d-flex flex-column mx-auto align-items-stretch gap-5" style="width: 800px;">
        <div class="card">
            <div class="card-header">
                <div href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    <div class="d-flex flex-column">
                        <a href="#" class="d-flex align-items-stretch gap-2 text-decoration-none">Name Lastname</a>
                        <small class="text-body-secondary">1 Jun, 2023</small>
                    </div>
                </div>
            </div>
            <img src="<?= $post['image'] ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text">
                    <?= $post['text'] ?>
                </p>
                <a href="#" class="btn btn-dark text-danger">
                    <div class="d-flex align-items-center">
                        <iconify-icon icon="line-md:heart-filled" width="24" height="24"></iconify-icon>
                        Like
                    </div>
                </a>
                <a href="#" class="btn btn-dark text-info">
                    <div class="d-flex align-items-center">
                        <iconify-icon icon="line-md:email-twotone" width="24" height="24"></iconify-icon>
                        Comment
                    </div>
                </a>
                <a href="#" class="btn btn-dark text-warning">
                    <div class="d-flex align-items-center">
                        <iconify-icon icon="line-md:telegram" width="24" height="24"></iconify-icon>
                        Share
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
</body>

</html>