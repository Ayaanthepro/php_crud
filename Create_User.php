<?php
require_once './database/connection.php'
?>

<?php
$error = $name = $email =$success= "";
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($name)) {
        $error = "Please Enter Your Name";
    } else if (empty($email)) {
        $error = "Please Enter Your Email";
    } else if (empty($password)) {
        $error = "Please Enter Your Password";
    } else {

        $sql = "SELECT *FROM `users` WHERE `email` ='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $new_password = md5($password);
            $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$new_password')";
            if ($conn->query($sql)) {
                $success = "User has been Added";
            } else {
                $error = "User has failed to add";
            }
        }else {
            $error="E-mail already exists";
        }
       
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title"></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            height: 100vh;
            overflow: hidden;
            display: flex;
            width: 100vw;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row d-flex ">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="h2">Add User</div>
                            <a href="./show_users.php" class="btn btn-outline-primary">Show Users</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"><?php echo $error ?></p>
                        <p class="text-success"><?php echo $success ?></p>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="form" method="post">
                            <div class="mb-2 mt-2">
                                <label for="name" class="form-label h5">
                                    Name
                                </label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name ?>" placeholder="Enter Your Name">
                            </div>
                            <div class="mb-2 mt-2">
                                <label for="email" class="form-label h5">
                                    Email
                                </label>
                                <input type="email" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Enter Your Email">
                            </div>
                            <div class="mb-2 mt-2">
                                <label for="password" class="form-label h5">
                                    Password
                                </label>
                                <input type="password" class="form-control" name="password" value="" placeholder="Enter Your password">
                            </div>
                            <div class="mb-2 mt-2">
                                <input type="submit" value="Submit" class="btn btn-primary" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    const title = document.location.pathname.split('/').pop();
    const fileName = title.split('.')[0];
    document.getElementById('title').innerText = fileName;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</html>