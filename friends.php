<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include("layouts/main.php"); ?>

    <div class="mb-3 ms-3">
        <h1 class="display-6 fw-bold d-flex align-items-center gap-2"> <iconify-icon
                icon="line-md:account-small"></iconify-icon>Friends
        </h1>
    </div>
    <div class="container">
        <div class="row row-cols-2">
            <?php for ($number = 0; $number < 9; $number++) { ?>
                <div class="col my-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 text-decoration-none">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                    class="rounded-circle">
                                <a href="#" class="d-flex align-items-stretch gap-2 text-decoration-none"
                                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Visit Page">Name
                                    Lastname</a>
                                <div class="d-flex justify-content-end flex-grow-1">
                                    <button class="btn btn-danger d-flex align-items-center gap-1"
                                        type="button"><iconify-icon icon="line-md:account-delete"></iconify-icon>Remove
                                        Friend</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>






    <?php include("core/scripts.php"); ?>
</body>

</html>