<header class="py-3 position-fixed border-bottom w-100 ps-5">
    <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 6fr;">
        <?php include("common/logo.php"); ?>
        <div class="d-flex align-items-center">
            <form class="w-100 me-3" role="search" action="search.php">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="q">
            </form>

            <div class="flex-shrink-0 dropdown">
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
    </div>
</header>