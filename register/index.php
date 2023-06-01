<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <?php include("../core/head.php"); ?>
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
        <form>
            <?php include("../common/logo.php"); ?>
            <h1 class="h3 mb-3 fw-normal">Please Register</h1>

            <div class="form-floating">
                <input type="name" class="form-control" id="inputName" placeholder="name">
                <label for="inputName">Name</label>
            </div>
            <div class="form-floating">
                <input type="surname" class="form-control" id="inputSurname" placeholder="surname">
                <label for="inputSurname">Surname</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="inputEmail" placeholder="name@example.com">
                <label for="inputEmail">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordInput" placeholder="Password">
                <label for="passwordInput">Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordAgainInput" placeholder="Password Again">
                <label for="passwordAgainInput">Password Again</label>
            </div>
            <span class="text-danger" id="passwordError" style="display: none;">Please enter matching
                passwords.</span>

            <button class="btn btn-primary w-100 py-2 my-2" type="submit">Register</button>
            <a href="/login" class="text-info-emphasis">Already Have an Account?</a>

        </form>
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <?php include("../core/scripts.php"); ?>
    <script src="check.js"></script>
</body>

</html>