<?php
    include "./database/connection.php";
    $username ="";
    $email = "";
    $password = "";
    $confirm_password = "";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($username)){
            $errors['username'] = "Username is required";
        }
        
        if(empty($email)){
            $errors['email'] = "Email is required";
        }elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }elseif($conn->query("SELECT email FROM users WHERE email = '$email'")->num_rows > 0){
           $errors['email'] = "Email already exists";
        }
        

        if(empty($password)){
            $errors['password'] = "Password is required"; 
        }elseif (strlen($password) < 6) {  
            $errors['password'] = "Password must be at least 6 characters long";
        }

        if(empty($confirm_password)){
            $errors['confirm_password'] = "Confirm password is required";
        }elseif ($password !== $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match";
        }

        if(empty($errors)){
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$hash_password')";

            if ($conn->query($stmt) === TRUE) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = 'user';
                header("Location: index.php");
            } else {
                echo "Error: " . "<br>" . $conn->error;
            }

            $conn->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Sign up</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>

    <main class="my-5 pt-5 w-100">
    <form method="POST" class="w-50 m-auto">
        <h1 class="h3 mb-5 fw-normal">Please Sign up</h1>
    
        <div class="mb-3">
            <input class="form-control" placeholder="Full Name" name="username" id="username" value="<?= htmlspecialchars($username) ?>">
        </div>
        <div>
            <?php if(isset($errors['username'])) : ?>
                <p class="text-danger"><?=$errors["username"] ?></p>
            <?php endif; ?>
        </div>    

        <div class="mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
        </div>
        <div>
            <?php if(isset($errors['email'])) : ?>
                <p class="text-danger"><?=$errors['email']?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        </div>
        <div>
            <?php if(isset($errors['password'])) : ?>
                <p class="text-danger"><?=$errors['password']?></p>
            <?php endif; ?>
        </div>
        <div>
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
        </div>
        <div>
            <?php if(isset($errors['confirm_password'])) : ?>
                <p class="text-danger"><?=$errors['confirm_password']?></p>
            <?php endif; ?>
        </div>
    
        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>

        <button class="btn btn-outline-primary w-100 py-2" type="submit">Sign up</button>
      </form>
    </main>

    <!-- footer -->
    <?php include("./components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>