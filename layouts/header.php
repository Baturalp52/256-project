<?php


if (isset($_SESSION["user_id"])) {
    $um = new UsersModel($db);
    $_USER = $um->findOne($_SESSION["user_id"]);


    if (isset($_GET["q"])) {
        $query_text = $_GET["q"];
    }


}
?>

<header class="py-3 position-fixed border-bottom w-100 z-3 bg-dark" style="top:0;left:0;">
    <div class="d-flex align-items-center">
        <div style="width:280px;" class="ps-5">
            <?php include($_SERVER["DOCUMENT_ROOT"] . "/common/logo.php"); ?>
        </div>
        <div class="d-flex align-items-center flex-fill">
            <form class="w-100" role="search" action="search.php">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="q"
                    value="<?= isset($query_text) ? filter_var($query_text, FILTER_SANITIZE_FULL_SPECIAL_CHARS) : "" ?>">
            </form>
        </div>
        <div class="flex-shrink-0 dropdown d-flex justify-content-end pe-5" style="width:320px;">
            <a href="#" class="d-flex align-items-center gap-2 link-body-emphasis text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <?php if ($_USER["picture"]) { ?>
                    <img src="<?= $_USER["picture"] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                <?php } else { ?>
                    <iconify-icon icon="heroicons:rocket-launch-solid" width="24" height="24"
                        class="text-danger"></iconify-icon>
                <?php } ?>
                <?= filter_var($_USER["name"] . " " . $_USER["last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="/sign-out.php">Sign out</a></li>
            </ul>
        </div>

    </div>
</header>