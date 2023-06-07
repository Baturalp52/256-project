<?php
$friendModel = new FriendsModel($db);

$friend_requests = $friendModel->findRequests($_SESSION["user_id"]);


?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark border-start mt-0 position-fixed overflow-y-scroll"
    style="width: 320px;top:81px;height:calc(100% - 81px);right:0;">

    <?php if (count($friend_requests)) { ?>
        <div class="card mb-4 rounded-3 shadow-sm" id="side-bar-friend-requests">
            <div class="card-header py-3">
                <a href="/friend-requests.php" class="text-decoration-none">
                    <h4 class="my-0 fw-normal d-flex align-items-center">
                        <iconify-icon icon="line-md:account-add" width="32" height="32"></iconify-icon>Friend Requests
                    </h4>
                </a>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-1 align-items-center justify-content-center">
                    <div class="list-group w-100">
                        <?php foreach ($friend_requests as $request) { ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center gap-2 p-3 w-100"
                                aria-current="true" data-inviter-id="<?= $request["users.id"] ?>">
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
                                            icon="line-md:menu-to-close-transition" width="16"
                                            height="16"></iconify-icon></button>
                                    <button type="button" data-inviter-id="<?= $request["users.id"] ?>"
                                        class="btn btn-success rounded-circle p-1 d-flex align-items-center accept-request"><iconify-icon
                                            icon="line-md:confirm" width="16" height="16"></iconify-icon></button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <a href="/notifications.php" class="text-decoration-none">
                <h4 class="my-0 fw-normal d-flex align-items-center">
                    <iconify-icon icon="line-md:bell" width="32" height="32"></iconify-icon>Notifications
                </h4>
            </a>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column gap-1 align-items-center justify-content-center">
                <div class="list-group w-100">
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-2 ps-1 w-100"
                        aria-current="true">
                        <iconify-icon icon="line-md:circle-to-confirm-circle-transition" class="text-success" width="24"
                            height="24"></iconify-icon>
                        <div class="d-flex w-100 justify-content-between gap-1">
                            <p class="mb-0">Notification 1</p>
                            <small class="opacity-50 text-nowrap">now</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-2 ps-1 w-100"
                        aria-current="true">
                        <iconify-icon icon="line-md:circle-to-confirm-circle-transition" class="text-success" width="24"
                            height="24"></iconify-icon>
                        <div class="d-flex w-100 justify-content-between gap-1">
                            <p class="mb-0">Notification 2</p>
                            <small class="opacity-50 text-nowrap">now</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-2 ps-1 w-100"
                        aria-current="true">
                        <iconify-icon icon="line-md:circle-to-confirm-circle-transition" width="24"
                            height="24"></iconify-icon>
                        <div class="d-flex w-100 justify-content-between gap-1">
                            <p class="mb-0">Notification 3</p>
                            <small class="opacity-50 text-nowrap">now</small>
                        </div>
                    </a>
                </div>
                <a href="/notifications.php" class="text-decoration-none mx-auto">
                    Show More
                </a>
            </div>
        </div>
    </div>



    <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <a href="/friends.php" class="text-decoration-none">
                <h4 class="my-0 fw-normal d-flex align-items-center">
                    <iconify-icon icon="line-md:account-small" width="32" height="32"></iconify-icon>Friends
                </h4>
            </a>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column gap-1 align-items-center justify-content-center">
                <div class="list-group w-100">
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 ps-1 w-100"
                        aria-current="true">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <p class="mb-0">Friend 1</p>
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 ps-1 w-100"
                        aria-current="true">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <p class="mb-0">Friend 2</p>
                    </a>
                    <a href="#"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-2 ps-1 w-100"
                        aria-current="true">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <p class="mb-0">Friend 3</p>
                    </a>
                </div>
                <a href="/friends.php" class="text-decoration-none mx-auto">
                    Show More
                </a>
            </div>
        </div>
    </div>

</div>