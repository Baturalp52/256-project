<?php include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php");
    $um = new UsersModel($db);

    if (isset($query_text) && $query_text) {
        $search_users = $um->searchUsers($query_text, $_SESSION["user_id"]);
    } else {
        $search_users = $um->findAllWithNoFriend($_USER["id"]);
    }

    ?>




    <div class="container">
        <?php


        if (isset($query_text) && $query_text) {
            ?>
            <div class="mb-5 text-center">
                <h1 class="display-6">Search results for <b>
                        <?= filter_var($query_text, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                    </b>
                </h1>
            </div>
        <?php } ?>

        <div class="row row-cols-3">
            <?php foreach ($search_users as $user) { ?>
                <div class="col my-1">
                    <div class="card">
                        <div class="card-body">
                            <div href="#" class="d-flex align-items-center gap-2 text-decoration-none">
                                <?php if ($user["picture"]) { ?>
                                    <img src="<?= $user["picture"] ?>" alt="mdo" width="32" height="32" class="rounded-circle"
                                        style="object-fit:cover;">
                                <?php } else { ?>
                                    <iconify-icon icon="heroicons:rocket-launch-solid" width="32" height="32"
                                        class="text-danger"></iconify-icon>
                                <?php } ?>
                                <div class="d-flex flex-column">
                                    <a href="/profile.php?id=<?= $user["id"] ?>"
                                        class="d-flex align-items-stretch gap-2 text-decoration-none">
                                        <?= filter_var($user["name"] . " " . $user["last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                                    </a>
                                </div>
                                <button class="btn btn-primary d-flex align-items-center ms-auto add-friend"
                                    data-user-id="<?= $user["id"] ?>" type="button" <?= isset($user["is_friend"]) && $user["is_friend"] ? "disabled" : "" ?>><iconify-icon
                                        icon="line-md:account-add"></iconify-icon>Add</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <?php if (!count($search_users)) { ?>

                <h6 class="mx-auto">Nothing...</h6>


            <?php } ?>
        </div>

    </div>





    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
    <script src="/src/common/js/side-bar-right/actions.js" crossorigin="anonymous"></script>
    <script src="/src/common/js/search/actions.js" crossorigin="anonymous"></script>
</body>

</html>