<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include("layouts/main.php"); ?>

    <div class="mb-3 ms-3">
        <h1 class="display-6 fw-bold d-flex align-items-center gap-2"> <iconify-icon
                icon="line-md:bell"></iconify-icon>Notifications
        </h1>
    </div>
    <div class="container">
        <?php for ($number = 0; $number < 15; $number++) { ?>
            <div class="card m-2">
                <div class="card-body">
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-2 ps-1 w-100" aria-current="true">
                        <iconify-icon icon="line-md:circle-to-confirm-circle-transition" class="text-success" width="24"
                            height="24"></iconify-icon>
                        <div class="d-flex w-100 justify-content-between gap-1">
                            <p class="mb-0">Notification
                                <?= $number + 1 ?>
                            </p>
                            <small class="opacity-50 text-nowrap">now</small>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>





    <?php include("core/scripts.php"); ?>
</body>

</html>