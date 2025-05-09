<?php
    include "./database/connection.php";
    $email = "";
    $password = "";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        
        if(empty($email)){
            $errors['email'] = "Email is required";
        }elseif (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }        

        if(empty($password)){
            $errors['password'] = "Password is required"; 
        }elseif (strlen($password) < 6) {  
            $errors['password'] = "Password must be at least 6 characters long";
        }

        if(empty($errors)){
          /*  ======  chack if the given email belong to exist user. =====  */
            $sql = "SELECT * FROM users WHERE email = $email";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              
              /*  ===== Verify that the given hash matches the given password.  ===== */
              if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['username'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                header("Location: index.php");
              }else{
                $errors['email_password'] = "Email or password is wrong"; 
              }
            } else {
              $errors['email_password'] = "Email or password is wrong"; 
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
    <title>Login</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>

    <main class="my-5 pt-5 w-100" style="height: 60vh;">
        <form method="POST" class="w-50 m-auto">
        <h1 class="h3 mb-3 fw-normal">Please Login</h1>
    
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
    
        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>

        <div>
            <?php if(isset($errors['email_password'])) : ?>
                <p class="text-danger"><?=$errors['email_password']?></p>
            <?php endif; ?>
        </div>

        <button class="btn btn-outline-primary w-100 py-2" type="submit">Login</button>
      </form>
    </main>

    <!-- footer -->
    <?php include("./components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>