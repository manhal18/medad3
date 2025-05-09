
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home Page</title>
</head>
<body>
    
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>
    
    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://gospringsolarnow.com/storage/2021/02/Main-Purpose-Of-Solar-Panels-scaled-2560x1280.jpeg" style="height: 500px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://modernize.com/wp-content/uploads/2016/01/Solar-Panels-Cottage.jpg" style="height: 500px;" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    
    <!-- favorite products cards -->
    <div class="container my-5 d-flex">
        <?php
        include "./database/connection.php";
        $sql = "SELECT * FROM products WHERE favorite_product=1";
        $result = $conn->query($sql);
        
        // output data of each row`id`, `price`, 
        while($row = $result->fetch_assoc()) {
            echo'<div class="card mx-3" style="width: 18rem;">
                <img src="./images/'.$row["image"].'" class="card-img-top" alt="'.$row["product_name"].'">
                <div class="card-body">
                    <h5 class="card-title">'. $row["product_name"] .'</h5>
                    <p class="card-text">'. $row["description"] .'</p>
                    <a href="./product.php?id='.$row["id"].'" class="btn btn-outline-primary">See more</a>
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