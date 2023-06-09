<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");

function checkPasswordValidity($password)
{
    if (strlen($password) <= 8) {
        return false;
    }

    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    return true;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_SESSION["user_id"])) {
        header("Location: /feed.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST)) {

        extract($_POST); // email, pass, username

        $user = new UsersModel($db);

        if (!$user->checkUserExists($email)) {
            // Email already exists
            $errorMessage = "Email already exists";

        } else {
            $isValid = checkPasswordValidity($passwordInput);
            if (!$isValid || $passwordAgainInput != $passwordInput) {
                header("HTTP/1.1 400 Error");
                exit;
            }

            $hashPassw = password_hash($passwordInput, PASSWORD_BCRYPT);
            $new_user_id = $user->create($name, $last_name, $email, $hashPassw);
            $_SESSION["user_id"] = $new_user_id;

            // Redirect to the login page
            header("Location: /settings.php");
            exit;
        }

    }

}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">


<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>

    <style>
        html,
        body {
            height: 100%;
        }

        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin .form-floating input {
            border-radius: 0;
        }

        #inputName {
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
        }

        #passwordAgainInput {
            margin-bottom: 10px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary" data-bs-theme="dark">
    <main class="form-signin w-100 m-auto">
        <form method="post">
            <?php include($_SERVER["DOCUMENT_ROOT"] . "/common/logo.php"); ?>
            <h1 class="h3 mb-3 fw-normal">Please Register</h1>

            <div class="form-floating">
                <input type="name" class="form-control" id="inputName" name="name" placeholder="name">
                <label for="inputName">Name</label>
            </div>
            <div class="form-floating">
                <input type="surname" class="form-control" id="inputSurname" name="last_name" placeholder="surname">
                <label for="inputSurname">Surname</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="name@example.com">
                <label for="inputEmail">Email address</label>

            </div>
            <?php if (isset($errorMessage)) { ?>

                <span class="text-danger" id="ErrorMessage">
                    <?= $errorMessage ?>
                </span>
            <?php } ?>


            <div class="form-floating">
                <input type="password" class="form-control" id="passwordInput" name="passwordInput"
                    placeholder="Password">
                <label for="passwordInput">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordAgainInput" name="passwordAgainInput"
                    placeholder="Password Again">
                <label for="passwordAgainInput">Password Again</label>
            </div>
            <div class="text-danger" id="passwordError" style="display: none;"><iconify-icon
                    icon="pajamas:warning-solid" class="me-2"></iconify-icon>Please enter matching
                passwords.</div>

            <div class="text-danger" id="length" style="display: none;"><iconify-icon icon="pajamas:warning-solid"
                    class="me-2"></iconify-icon>Password must be at least 8 characters.</div>
            <div class="text-danger" id="small" style="display: none;"><iconify-icon icon="pajamas:warning-solid"
                    class="me-2"></iconify-icon>Password must include at least 1 small
                character.</div>
            <div class="text-danger" id="capital" style="display: none;"><iconify-icon icon="pajamas:warning-solid"
                    class="me-2"></iconify-icon>Password must include at least 1 capital
                character.</div>
            <div class="text-danger" id="number" style="display: none;"><iconify-icon icon="pajamas:warning-solid"
                    class="me-2"></iconify-icon>Password must include at least 1 numeric
                character.</div>

            <button class="btn btn-primary w-100 py-2 my-2" id="regbtn" type="submit" disabled>Register</button>
            <a href="/login.php" class="text-info-emphasis">Already Have an Account?</a>

        </form>
    </main>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
    <script src="/src/register/js/check.js"></script>
</body>

</html>