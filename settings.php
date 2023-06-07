<?php
include($_SERVER["DOCUMENT_ROOT"] . "/core/__init__.php");

$pm = new UsersModel($db);
$id = $_SESSION['user_id'];
$user = $pm->findOne($id);
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
    extract($_POST);

    if (strlen(trim($passwordInput)) !== 0 && strlen(trim($passwordAgainInput)) !== 0 && $passwordInput === $passwordAgainInput) {
        if (password_verify($floatingPassword, $user['password'])) {
            $pm->changePassword($user['id'], $passwordAgainInput);
            $pm->update_User($id, $name, $lastname, $email, $birth_date, $bio);
            $res = 1;
        } else {
            echo "WRONG PASSWORD";
            $res = 0;
        }
    } else {
        $pm->update_User($id, $name, $lastname, $email, $birth_date, $bio);
        $res = 1;
    }
    $user = $pm->findOne($id);

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/head.php"); ?>
    <style>
        #image-overlay {
            position: absolute;
            transition: all .5s;
        }

        #image-overlay:hover {
            opacity: 0.8 !important;
            cursor: pointer;
        }
    </style>
</head>

<body data-bs-theme="dark" class="d-flex justify-content-center">
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/layouts/main.php"); ?>
    <form method="POST" enctype="multipart/form-data" style="width: 600px;">
        <div class="d-flex flex-column gap-3">
            <input type="file" style="display:none" name="newImage" id="newImage">
            <div class="d-flex flex-row gap-2">
                <div class="border-rounded" style="position:relative;width: 200px;">
                    <div id="image-overlay"
                        class="w-100 h-100 text-center d-flex align-items-center justify-content-center bg-dark opacity-50">
                        <p class="text-white d-flex align-items-center justify-content-center gap-1 opacity-100">
                            <iconify-icon icon="line-md:image" width="24" height="24"></iconify-icon>
                            ADD NEW IMAGE
                        </p>
                    </div>
                    <?php if (isset($user["picture"])) { ?>
                        <img src="<?= filter_var($user["picture"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?>"
                            class="card-img-top " alt="..." id="post-image" width="200" height="200" class="rounded-circle">
                    <?php } else { ?>
                        <iconify-icon icon="heroicons:rocket-launch-solid" width="200" height="200" class="text-danger">
                        </iconify-icon>
                    <?php } ?>
                </div>
                <div class="d-flex flex-column flex-grow-1 gap-3">
                    <div class="form-floating">
                        <input type="text" id="NAME" name="name" required value="<?= $_USER['name'] ?>"
                            class="form-control">
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" id="lastname" name="lastname" required value="<?= $_USER['last_name'] ?>"
                            class="form-control">
                        <label for="lastname">Lastname</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="floatingInput" name="email"
                            value="<?= $user['email'] ?>">
                        <label for="floatingInput">Email address</label>
                    </div>
                </div>
            </div>



            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px; resize: none;"
                    name="bio"><?= filter_var($user['bio'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></textarea>
                <label for="floatingTextarea2">Bio</label>
            </div>

            <div class="form-floating">
                <input type="date" class="form-control" id="date" name="birth_date"
                    value="<?= isset($user['birth_date']) ? $user['birth_date'] : '1970-01-01' ?>">
                <label for="floatingInput">Birthdate</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="floatingPassword">
                <label for="floatingPassword3">Current Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordInput" name="passwordInput"
                    placeholder="Password">
                <label for="passwordInput">New Password</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordAgainInput" name="passwordAgainInput"
                    placeholder="Password Again">
                <label for="passwordAgainInput">Confirm Your New Password</label>
            </div>
            <div class="text-center w-100">
                <input type="submit" value="Change" id="changeBtn" class="btn btn-primary">
            </div>

            <span class="text-danger" id="passwordError" style="display: none;">Please enter matching
                passwords.</span>
        </div>
    </form>
    <?php include($_SERVER["DOCUMENT_ROOT"] . "/core/scripts.php"); ?>
    <script>
        document.getElementById("image-overlay").addEventListener("click", function () {
            document.getElementById("newImage").onchange = function (e) {
                const file = e.target.files[0];
                const src = URL.createObjectURL(file);
                const img = document.getElementById("post-image");
                img.setAttribute("old-src", img.getAttribute("src"));
                img.setAttribute("src", src);
            }
            document.getElementById("image-overlay").onclick = function () {
                document.getElementById("newImage").click();
            }
        });
    </script>
    <script src="/src/common/js/helpers/show-toast.helper.js"></script>
    <script>
        $(document).ready(function () {
            <?php
            if (isset($res)) {
                ?>
                showToast({ title: "Form Update", color: "warning", description: "<?= $res === 1 ? "Update Succesful" : "ERROR" ?>" });
            <?php } ?>
            // Function to enable/disable the "Change" button based on password validation
            function toggleChangeButton() {
                var password = $('#passwordInput').val();
                var passwordAgain = $('#passwordAgainInput').val();

                if (password.trim().length && password === passwordAgain) {
                    $('#changeBtn').prop('disabled', false);
                    $('#passwordError').hide();
                    $("#passwordInput, #passwordAgainInput").removeClass("is-invalid");
                }
                else if (!password.trim().length && !passwordAgain.trim().length) {
                    $('#changeBtn').prop('disabled', false);
                    $('#passwordError').hide();
                    $("#passwordInput, #passwordAgainInput").removeClass("is-invalid");
                }
                else {
                    $('#changeBtn').prop('disabled', true);
                    $('#passwordError').show();
                    $("#passwordInput, #passwordAgainInput").addClass("is-invalid");
                }

            }

            // Listen for changes in the password fields
            $('#passwordInput, #passwordAgainInput').on('input', toggleChangeButton);

        });
    </script>
</body>

</html>