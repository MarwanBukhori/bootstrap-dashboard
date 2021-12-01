// REGISTER USER
<?php
if (isset($_POST['reg_user'])) {
 #receive all input values from the form
$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
// form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
if (empty($username)) { 
    array_push($errors, "Username is required"); }
if (empty($email)) { 
    array_push($errors, "Email is required"); }
if (empty($password_1)) { 
    array_push($errors, "Password is required"); }
if ($password_1 != $password_2) {
array_push($errors, "The two passwords do not match");
}
// first check the database to make sure
// a user does not already exist with the same username and/or email
$user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user) { // if user exists
if ($user['username'] === $username) {
array_push($errors, "Username already exists");
}
if ($user['email'] === $email) {
array_push($errors, "email already exists");
}
}
#ins
// Finally, register user if there are no errors in the form
if (count($errors) == 0) {
$password = md5($password_1);//encrypt the password before saving in the database
echo $password ;
$query = "INSERT INTO users(username, email, password)
VALUES('$username', '$email', '$password')";
mysqli_query($db, $query);
$_SESSION['username'] = $username;
$_SESSION['success'] = "You are now logged in";
header('location: login.php');
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="exampleInputName" type="text"
                                                        placeholder="Enter your first name" name="username" />
                                                    <label for="exampleInputName">Username</label>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div> -->
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="exampleInputEmail1" type="email"
                                                name="email" placeholder="name@example.com" />
                                            <label for="exampleInputEmail1">Email address</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="exampleInputPassword1"
                                                        name="password_1" type="password"
                                                        placeholder="Create a password" />
                                                    <label for="exampleInputPassword1">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="exampleInputPassword2"
                                                        name="password_2" type="password"
                                                        placeholder="Confirm password" />
                                                    <label for="exampleInputPassword2">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit" name="reg_user"
                                                    class="btn btn-primary btn-block" href="login.html">Create
                                                    Account</a></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>