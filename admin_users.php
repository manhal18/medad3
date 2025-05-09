<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "./database/connection.php";

        if($_POST['action'] == "delete"){
            // sql to delete a record
            $id = $_POST["id"];
            $sql = "DELETE FROM users WHERE id=$id";
        }
        
        if($_POST['action'] == "update"){
            // sql to update a record
            $id = $_POST["id"];
            $role = $_POST["role"];
            $sql = "UPDATE `users` SET `role`='$role' WHERE id=$id";
        }

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
    <title>Users</title>
</head>
<body>
    <!-- navbar -->
    <?php include "./components/navbar.php"; ?>

    <div class="h2 text-center mt-5">Users</div>

    <!-- users table -->
    <div class="container my-5 py-3">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") {
        include "./database/connection.php";
        $sql = "SELECT id, name, email, role FROM users";
        $result = $conn->query($sql);
        
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $new_role = ($row["role"] == "user") ? "admin" : "user";
            echo "<tr>";
            echo "<th>".$row["id"]."</th>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["role"]."</td>";
            echo '<td class="d-flex">';
            echo '<form method="POST">
                    <input type="hidden" name="id" value="'.$row["id"].'">
                    <input type="hidden" name="role" value="'.$new_role.'">
                    <input type="hidden" name="action" value="update">
                    <button class="btn btn-outline-primary py-0 me-2" type="submit">Make ';
                    echo $new_role;
            echo '</button></form>';
            echo '<form method="POST">
                    <input type="hidden" name="id" value="'.$row["id"].'">
                <input type="hidden" name="action" value="delete">
                <button class="btn btn-outline-danger py-0" type="submit">Delete</button>
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