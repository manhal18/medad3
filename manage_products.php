<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "./database/connection.php";

        // sql to delete a record
        $id = $_POST["id"];
        $sql = "DELETE FROM products WHERE id=$id";
        
        $conn->query($sql);

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Manage Products</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>


    <div class="h2 text-center mt-5">Products</div>
    <!-- products table -->
    <div class="container my-5 py-3">
    <?php
    if (isset($_SESSION['role'])) {
        echo '<div class="text-end mb-3"><a href="./add_product.php" class="btn btn-outline-success">Add Product</a></div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Favorite Product</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>';
        include "./database/connection.php";
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $favorite = ($row["favorite_product"] == 1) ? "Favorite" : "Not favorite";
            echo "<tr>";
            echo "<th>".$row["id"]."</th>";
            echo "<td>".$row["product_name"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "<td>".$row["description"]."</td>";
            echo "<td>".$favorite."</td>";
            echo '<td><img src="./images/'.$row["image"].'" class="card-img-top" alt="'.$row["product_name"].'"></td>';
            echo '<td>
                <a href="./edit_product.php?id='.$row["id"].'" class="btn btn-outline-primary mb-2">Update</a>
                <form method="POST">
                    <input type="hidden" name="id" value="'.$row["id"].'">
                <button class="btn btn-outline-danger px-3" type="submit">Delete</button>
                </form>';
            echo "</td></tr>";            
        }
        
        $conn->close();
    }
    ?>
    </tbody>
    </table>
    </div>
    
    <!-- footer -->
    <?php include("./components/footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>