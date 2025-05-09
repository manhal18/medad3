<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Product Details</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>

    <div class="h2 text-center pt-5 mt-5">Product Details</div>

    <div class="container p-5">
        <?php
        if($_GET['id']){
        include "./database/connection.php";
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();

        echo'<div class="row featurette">
            <div class="col-md-7 order-md-2">
                    <h3 class="featurette-heading">'. $product['product_name'] .'</h3>
                    <p class="lead">'. $product['description'] .'</p>
                <div class="text-primary fw-bold mt-5">
                        <span>Category1</span><span class="float-end">'. $product['price'] .'</span>
                </div>
            </div>
            <div class="col-md-5 order-md-1">
                <img src="./images/'.$product["image"].'" class="card-img-top" alt="'.$product["product_name"].'">
            </div>
        </div>';
        
        $conn->close();
        }
        ?>
    </div>
    <!-- footer -->
    <?php include("./components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>