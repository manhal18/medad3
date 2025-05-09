<?php
    $name ="";
    $price = "";
    $description = "";
    $image;
    $image_name = "";
    $favorite = "0";
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = trim($_POST["name"]);
        $price = trim($_POST["price"]);
        $description = trim($_POST["description"]);

        if(empty($name)){
            $errors['name'] = "Product name is required";
        }
        
        if(empty($price)){
            $errors['price'] = "Price is required";
        }elseif (is_numeric($price) != 1) {
            $errors['price'] = "Price is not a number";
        }
        

        if(empty($description)){
            $errors['description'] = "Description is required"; 
        }

        if($_FILES['image']['name'] == ""){
            $image_name = "default.png";
        }
        else{
            $target_dir = "images/";
            $image_name = basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_dir . $image_name,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $errors['image'] =  "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_dir . $image_name)) {
                $errors['image'] = "File already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                $errors['image'] = "File is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $errors['image'] = "Only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1){
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image_name);
            }
        }

        if(isset($_POST['favorite'])){
            $favorite = "1";
        }

        if(empty($errors)){
            include "./database/connection.php";

            $sql = "INSERT INTO products (product_name, price, description, image, favorite_product) 
            VALUES ('$name', '$price', '$description', '$image_name', '$favorite')";

            if ($conn->query($sql) === FALSE) {
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
    <title>Add Product</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; 

    if (isset($_SESSION['role'])) : ?>

    <main class="my-5 pt-5 w-100">
    <form method="POST" enctype="multipart/form-data" class="w-50 m-auto">
        <h1 class="h3 mb-5 fw-normal">Add Product</h1>
    
        <div class="mb-3">
            <input class="form-control" placeholder="Product Name" name="name" id="name" value="<?= htmlspecialchars($name) ?>">
        </div>
        <div>
            <?php if(isset($errors['name'])) : ?>
                <p class="text-danger"><?=$errors["name"] ?></p>
            <?php endif; ?>
        </div>    

        <div class="mb-3">
          <input class="form-control" placeholder="Price" name="price" id="price" value="<?= htmlspecialchars($price) ?>">
        </div>
        <div>
            <?php if(isset($errors['price'])) : ?>
                <p class="text-danger"><?=$errors['price']?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <textarea class="form-control" rows="3" placeholder="Description" name="description" id="description" value="<?= htmlspecialchars($description) ?>"></textarea>
        </div>
        <div>
            <?php if(isset($errors['description'])) : ?>
                <p class="text-danger"><?=$errors['description']?></p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Select image</label>
            <input class="form-control" type="file" name="image" id="image">
        </div>
        <div>
            <?php if(isset($errors['image'])) : ?>
                <p class="text-danger"><?=$errors['image']?></p>
            <?php endif; ?>
        </div>
    
        <div class="form-check text-start my-3">
          <input class="form-check-input" type="checkbox" name="favorite">
          <label class="form-check-label" for="favorite">
            Favorite Product
          </label>
        </div>

        <button class="btn btn-outline-primary w-100 py-2" type="submit">Sign up</button>
      </form>
    </main>
    <?php endif; ?>
    <!-- footer -->
    <?php include("./components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>