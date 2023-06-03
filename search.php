<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include("layouts/main.php"); ?>




    <div class="container">
        <?php
        if (isset($query_text) && $query_text) {
            ?>
            <div class="mb-5 text-center">
                <h1 class="display-6">Search results for <b>
                        <?= $query_text ?>
                    </b>
                </h1>
            </div>
            <?php
        }

        ?>
        <div class="row row-cols-3">
            <?php for ($number = 0; $number < 9; $number++) { ?>
                <div class="col my-1">
                    <div class="card">
                        <div class="card-body">
                            <div href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                    class="rounded-circle">
                                <div class="d-flex flex-column">
                                    <a href="#" class="d-flex align-items-stretch gap-2 text-decoration-none">Name
                                        Lastname</a>
                                </div>
                                <button class="btn btn-primary d-flex align-items-center" type="button"><iconify-icon
                                        icon="line-md:account-add"></iconify-icon>Add</button>
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