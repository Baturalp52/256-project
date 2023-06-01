<header class="py-3 position-fixed border-bottom w-100 z-3 bg-dark">
    <div class="d-flex align-items-center">
        <div style="width:280px;" class="ps-5">
            <?php include("common/logo.php"); ?>
        </div>
        <div class="d-flex align-items-center flex-fill">
            <form class="w-100" role="search" action="search.php">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="q">
            </form>
        </div>
        <div class="flex-shrink-0 dropdown d-flex justify-content-end pe-5" style="width:320px;">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                Name Lastname
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" href="/sign-out">Sign out</a></li>
            </ul>
        </div>

    </div>
</header>