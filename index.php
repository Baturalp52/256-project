<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("core/head.php"); ?>
</head>

<body data-bs-theme="dark">
    <?php
        require_once "core/db.php";
        require_once "models/users.model.php";
        $a = new UsersModel($db);
        
        $name = "John";
        $last_name = "Doe";
        $email = "john.aadoe@example.com";
        $birth_date = "1990-01-01";
        $picture = "profile.jpg";
        $password = "password123";
        // $a->create($name, $last_name, $email, $birth_date, $picture, $password);   
    ?>
    <?php include("core/scripts.php"); ?>
</body>

</html>