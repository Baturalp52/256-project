<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>

    <div class="mb-3 ms-3">
        <h1 class="display-6 fw-bold d-flex align-items-center gap-2 justify-content-center"> <iconify-icon
                icon="line-md:account-add"></iconify-icon>Friend Requests
        </h1>
    </div>
    <div class="d-flex flex-column gap-2 align-items-center mb-3">
        <?php for ($number = 0; $number < 9; $number++) { ?>
            <div class="card w-50">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center" aria-current="true">
                        <a href="#" class="d-flex gap-1 align-items-center text-decoration-none" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="Visit User">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            <p class="mb-0">Friend 1</p>
                        </a>
                        <div class="d-flex align-items-center justify-content-center gap-1">
                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Reject User"
                                class="btn btn-danger rounded-circle p-1 d-flex align-items-center"><iconify-icon
                                    icon="line-md:menu-to-close-transition" width="24" height="24"></iconify-icon></button>
                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Accept User"
                                class="btn btn-success rounded-circle p-1 d-flex align-items-center"><iconify-icon
                                    icon="line-md:confirm" width="24" height="24"></iconify-icon></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>






    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
</body>

</html>