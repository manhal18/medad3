<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Products</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>

    <!-- filter -->
    <div>
        <div class="d-flex py-1 bg-secondary text-white" style="padding: 0px 120px;">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="category1">
                <label class="form-check-label" for="1">category1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="category2">
                <label class="form-check-label" for="1">category2</label>
            </div>
            <button type="button" class="btn btn-outline-dark py-0 ms-3">Filter</button>
        </div>
    </div>

    <div class="h2 text-center pt-5 mt-5">Our Products</div>

    <!-- products carts -->
    <div class="container d-flex my-5">
    <?php
        include "./database/connection.php";
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo'<div class="card mx-3" style="width: 18rem;">
                <img src="./images/'.$row["image"].'" class="card-img-top" alt="'.$row["product_name"].'">
                <div class="card-body">
                    <h5 class="card-title">'. $row["product_name"] .'</h5>
                    <p class="card-text">'. $row["description"] .'</p>
                    <div class="d-flex justify-content-between">
                    <a href="./product.php?id='.$row["id"].'" class="btn btn-outline-primary">See more</a>
                    <span class="pt-3 text-success">'.$row["price"].'</span>
                    </div>
                </div>
            </div>';
        }
        $conn->close();
        ?>
    </div>

    <!-- footer -->
    <?php include("./components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>