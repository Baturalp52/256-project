<?php
$url = explode(".", $_SERVER['REQUEST_URI'])[0];
?>


<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark border-end mt-0 position-fixed"
    style="width: 280px;top:81px;height:calc(100% - 81px);left:0;">
    <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="/feed"
                class="nav-link <?= $url === "/feed" ? "active" : "" ?> text-white d-flex align-items-center"
                aria-current="page">
                <iconify-icon class="me-1" height="32" width="32" icon="line-md:text-box"></iconify-icon>
                Feed
            </a>
        </li>
        <li>
            <a href="/search"
                class="nav-link <?= $url === "/search" ? "active" : "" ?> text-white d-flex align-items-center">
                <iconify-icon class="me-1" height="32" width="32" icon="line-md:search"></iconify-icon>
                Search
            </a>
        </li>
        <li>
            <a href="/profile"
                class="nav-link <?= $url === "/profile" ? "active" : "" ?> text-white d-flex align-items-center">
                <iconify-icon class="me-1" height="32" width="32" icon="line-md:account"></iconify-icon>
                Profile
            </a>
        </li>
        <li>
            <a href="/settings"
                class="nav-link <?= $url === "/settings" ? "active" : "" ?> text-white d-flex align-items-center">
                <iconify-icon class="me-1" height="32" width="32" icon="line-md:grid-3-filled"></iconify-icon>
                Settings
            </a>
        </li>
    </ul>
</div>