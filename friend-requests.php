<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle GET request
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION["user_id"])) {
    // Get the inviter and invited IDs
    extract($_POST);
    $friendModel = new FriendsModel($db);
    $inviterId = $_SESSION["user_id"];
    $invitedId = $friend_id;




    // Call the create function from friends.model.php to add the friend request
    $friendModel->create($inviterId, $invitedId);
    header("HTTP/1.1 200 OK");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'PATCH' && isset($_SESSION["user_id"])) {
    // Get the inviter and invited IDs
    parse_str(file_get_contents('php://input'), $_PATCH);
    $friendModel = new FriendsModel($db);

    // Call the update function from friends.model.php to add the friend request
    $friendModel->update($_PATCH["inviter_id"], $_SESSION["user_id"], 1);
    header("HTTP/1.1 200 OK");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_SESSION["user_id"])) {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $friendModel = new FriendsModel($db);

    // Call the update function from friends.model.php to add the friend request
    $friendModel->update($_DELETE["inviter_id"], $_SESSION["user_id"], 0);
    header("HTTP/1.1 200 OK");
    exit();
}

?>

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
        <?php foreach ($friend_requests as $request) { ?>
            <div class="card w-50" data-inviter-id="<?= $request["users.id"] ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center" aria-current="true">
                        <a href="/profile.php?id=<?= $request["users.id"] ?>"
                            class="d-flex gap-1 align-items-center text-decoration-none" data-bs-toggle="tooltip"
                            data-bs-placement="top" data-bs-title="Visit User">
                            <?php if (isset($request["user.picture"])) { ?>
                                <img src="<?= $request["user.picture"] ?>" alt="mdo" width="32" height="32"
                                    class="rounded-circle">
                            <?php } else { ?>
                                <iconify-icon icon="heroicons:rocket-launch-solid" width="32" height="32"
                                    class="text-danger"></iconify-icon>
                            <?php } ?>
                            <p class="mb-0" style="font-size:12px">
                                <?= filter_var($request["users.name"] . " " . $request["users.last_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>
                            </p>
                        </a>
                        <div class="d-flex align-items-center justify-content-center gap-1">
                            <button type="button" data-inviter-id="<?= $request["users.id"] ?>"
                                class="btn btn-danger rounded-circle p-1 d-flex align-items-center reject-request"><iconify-icon
                                    icon="line-md:menu-to-close-transition" width="24" height="24"></iconify-icon></button>
                            <button type="button" data-inviter-id="<?= $request["users.id"] ?>"
                                class="btn btn-success rounded-circle p-1 d-flex align-items-center accept-request"><iconify-icon
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