<?php
echo '<nav class="shadow navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
    <a class="navbar-brand" href="./index.php">ALKHER</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>';
        session_start();
        if (isset($_SESSION['role'])) {
            
            echo '<li class="nav-item dropdown"> 
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Control Panel</a> 
                    <ul class="dropdown-menu">';
                    if($_SESSION['role'] == "admin"){
                        echo '<li><a class="dropdown-item" href="./admin_users.php">Users</a></li>';
                    }
                        echo '<li><a class="dropdown-item" href="./manage_products.php">Products</a></li> 
                    </ul>
                </li></ul>';
            echo '<ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link link-body-emphasis px-2">
                            <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="Interface / Shopping_Cart_01"> <path id="Vector" d="M17 17C15.8954 17 15 17.8954 15 19C15 20.1046 15.8954 21 17 21C18.1046 21 19 20.1046 19 19C19 17.8954 18.1046 17 17 17ZM17 17H9.29395C8.83288 17 8.60193 17 8.41211 16.918C8.24466 16.8456 8.09938 16.7291 7.99354 16.5805C7.8749 16.414 7.82719 16.1913 7.73274 15.7505L5.27148 4.26465C5.17484 3.81363 5.12587 3.58838 5.00586 3.41992C4.90002 3.27135 4.75477 3.15441 4.58732 3.08205C4.39746 3 4.16779 3 3.70653 3H3M6 6H18.8732C19.595 6 19.9555 6 20.1978 6.15036C20.41 6.28206 20.5653 6.48862 20.633 6.729C20.7104 7.00343 20.611 7.34996 20.411 8.04346L19.0264 12.8435C18.9068 13.2581 18.8469 13.465 18.7256 13.6189C18.6185 13.7547 18.4772 13.861 18.317 13.9263C18.1361 14 17.9211 14 17.4921 14H7.73047M8 21C6.89543 21 6 20.1046 6 19C6 17.8954 6.89543 17 8 17C9.10457 17 10 17.8954 10 19C10 20.1046 9.10457 21 8 21Z" stroke="#000000" stroke-width="1.176" stroke-linecap="round" stroke-linejoin="round"></path> </g> </g></svg>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./logout.php" class="nav-link link-body-emphasis px-2">
                            <svg width="28px" height="28px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#000000" d="M352 159.872V230.4a352 352 0 1 0 320 0v-70.528A416.128 416.128 0 0 1 512 960a416 416 0 0 1-160-800.128z"></path><path fill="#000000" d="M512 64q32 0 32 32v320q0 32-32 32t-32-32V96q0-32 32-32z"></path></g></svg>
                        </a>
                    </li>
                </ul>';
        } else {
            echo '</ul><ul class="navbar-nav">
                    <li class="nav-item"><a href="./login.php" class="nav-link link-body-emphasis px-2">Login</a></li>
                    <li class="nav-item"><a href="./signup.php" class="nav-link link-body-emphasis px-2">Sign up</a></li>
                </ul>';
        }
    echo '</div>
</div>
</nav>';
?>