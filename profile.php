<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    extract($_GET);

    if (!isset($id) && !isset($_SESSION["user_id"])) {
        header("Location: /login.php");
        exit;
    } else {
        $userModel = new UsersModel($db);
        $user = $userModel->findOne(isset($id) ? $id : $_SESSION["user_id"]);

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <div class="col col-xl-12">
        <div class="card" style="border-radius: 15px; margin-top: 64px;">
            <div class="card-body p-4">
                <div class="d-flex text-black position-relative">
                    <div class="position-absolute" style="top:-90px;">
                        <img class="rounded-circle" src="<?= $user['picture'] ?>" alt="Generic placeholder image"
                            style="width: 180px; border-radius: 10px;">
                    </div>
                    <div class="d-flex flex-column" style="margin-left: 200px;">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-1 text-white text-center">
                                    <?= $user["name"] . " " . $user["last_name"] ?>
                                </h5>
                                <p class="mb-2 pb-1 text-white text-center" style="color: #2b2a2a;">
                                    <?= $user["birth_date"] ?>
                                </p>
                            </div>

                            <button type="button" class="btn btn-sm btn-primary col-xl-4"
                                style="height: 50px;">Add</button>
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
        <?php for ($number = 0; $number < 3; $number++) { ?>
            <div class="card" style="width: 600px; margin-top: 12px;">
                <div class="card-header">
                    <div href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <div class="d-flex flex-column">
                            <a href="#" class="d-flex align-items-stretch gap-2 text-decoration-none">
                                <?= $user["name"] . " " . $user["last_name"] ?>
                            </a>
                            <small class="text-body-secondary">1 Jun, 2023</small>
                        </div>
                    </div>
                </div>
                <img src="/src/images/background.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem sint ipsam
                        inventore ea? Iusto debitis sequi placeat mollitia, ex velit harum nesciunt ea sunt provident dicta
                        incidunt assumenda soluta molestias.</p>
                    <a href="#" class="btn btn-dark text-danger">
                        <div class="d-flex align-items-center">
                            <iconify-icon icon="line-md:heart-filled" width="24" height="24"></iconify-icon>
                            Like
                        </div>
                    </a>
                    <a href="post-detail" class="btn btn-dark text-info">
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


        <?php } ?>
    </div>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
</body>

</html>