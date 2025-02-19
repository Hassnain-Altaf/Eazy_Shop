

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Engaging eCommerce Header</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=shopping_cart" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">
</head>
<body>

<header class="header">
    <nav class="navbar navbar-expand navbar-dark container">
        <!-- <a class="navbar-brand" href="/"></a> -->
        <a href="./index.html" class="text-nowrap logo-img mt-2 mx-0">
            <img src="./img/logo-side.png" height="40" width="150" style="object-fit: cover;" alt="" />
          </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex search-bar">
                <input class="form-control rounded-0 shadow-none border-0" type="search" placeholder="Search products..." aria-label="Search">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50" fill="white">
                    <path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"></path>
                </svg>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        My Account
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Orders</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex flex-row my-auto cart-button" href="#"  role="button" >
                        <span class="material-symbols-outlined fs-3">shopping_cart</span>
                        <!-- <small class="item-count mx-sm-1">Items</small> -->
                        <span class="item-number">3</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>


<header class="mini-header mx-auto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <!-- Hamburger Icon for Mobile -->
                <button class="navbar-toggler custom-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#categoriesOffcanvas" aria-controls="categoriesOffcanvas">
                    <img class="navbar-toggler-icon" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA+ElEQVR4nO2ZMQ6CUBBE5xiKJ1I8j9hKPJZYwIUM2FCNIVkKSUw+FP8vOC/ZbjeZYT7ZYgEhxFLOACoAbwBMXJ1pyeeauDsQzx9VzkliGOgBXABkSE8GoDBNg7ZTyNDTmodBbxSm7RHS3FnzHv7YmbY2pHl8i15hqD4ZiQSViDOoRCY0EbZ3g40YqWMYSQ1lxBlUIs6gEnEG17RHmq0YqWMYSQ1lxBlUIs6gEnEG17RHmq0YqWMYSQ1lxBlUIs7g3yXSWqOHk9uUg2l7IYDK8entOuf0lltzb2Y8HkOPoYNlhO29tG5zv8LJIhz/mZTVmpbgJIQQ+OIDvrPJx04tYoYAAAAASUVORK5CYII=" alt="menu-squared-2">
                    <span>Categories</span>
                </button>

                <!-- Main Categories for Larger Screens -->
                <ul class="nav justify-content-center custom-dropdown-category d-lg-flex m-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="electronicsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Electronics
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="electronicsDropdown">
                            <li><a class="dropdown-item" href="#">Smartphones</a></li>
                            <li><a class="dropdown-item" href="#">Laptops</a></li>
                            <li><a class="dropdown-item" href="#">Headphones</a></li>
                            <li><a class="dropdown-item" href="#">Cameras</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="clothingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Clothing
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="clothingDropdown">
                            <li><a class="dropdown-item" href="#">Men</a></li>
                            <li><a class="dropdown-item" href="#">Women</a></li>
                            <li><a class="dropdown-item" href="#">Kids</a></li>
                        </ul>
                    </li>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="homeAppliancesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Home Appliances
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="homeAppliancesDropdown">
                            <li><a class="dropdown-item" href="#">Refrigerators</a></li>
                            <li><a class="dropdown-item" href="#">Washing Machines</a></li>
                            <li><a class="dropdown-item" href="#">Air Conditioners</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="beautyHealthDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Beauty & Health
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="beautyHealthDropdown">
                            <li><a class="dropdown-item" href="#">Skincare</a></li>
                            <li><a class="dropdown-item" href="#">Haircare</a></li>
                            <li><a class="dropdown-item" href="#">Makeup</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Offcanvas Menu for Small Screens -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="categoriesOffcanvas" aria-labelledby="categoriesOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="categoriesOffcanvasLabel">Categories</h5>
        <hr class="fw-bold border border-bottom-1">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li class="nav-item">
                <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#electronicsSubMenu" aria-expanded="false" aria-controls="electronicsSubMenu">
                    Electronics 
                </button>
                <ul class="collapse list-unstyled" id="electronicsSubMenu">
                    <li><a class="nav-link" href="#">Smartphones</a></li>
                    <li><a class="nav-link" href="#">Laptops</a></li>
                    <li><a class="nav-link" href="#">Headphones</a></li>
                    <li><a class="nav-link" href="#">Cameras</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#clothingSubMenu" aria-expanded="false" aria-controls="clothingSubMenu">
                    Clothing 
                </button>
                <ul class="collapse list-unstyled" id="clothingSubMenu">
                    <li><a class="nav-link" href="#">Men</a></li>
                    <li><a class="nav-link" href="#">Women</a></li>
                    <li><a class="nav-link" href="#">Kids</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#accessoriesSubMenu" aria-expanded="false" aria-controls="accessoriesSubMenu">
                    Accessories 
                </button>
                <ul class="collapse list-unstyled" id="accessoriesSubMenu">
                    <li><a class="nav-link" href="#">Watches</a></li>
                    <li><a class="nav-link" href="#">Bags</a></li>
                    <li><a class="nav-link" href="#">Jewelry</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#homeAppliancesSubMenu" aria-expanded="false" aria-controls="homeAppliancesSubMenu">
                    Appliances 
                </button>
                <ul class="collapse list-unstyled" id="homeAppliancesSubMenu">
                    <li><a class="nav-link" href="#">Refrigerators</a></li>
                    <li><a class="nav-link" href="#">Washing Machines</a></li>
                    <li><a class="nav-link" href="#">Air Conditioners</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#beautyHealthSubMenu" aria-expanded="false" aria-controls="beautyHealthSubMenu">
                    Beauty 
                </button>
                <ul class="collapse list-unstyled" id="beautyHealthSubMenu">
                    <li><a class="nav-link" href="#">Skincare</a></li>
                    <li><a class="nav-link" href="#">Haircare</a></li>
                    <li><a class="nav-link" href="#">Makeup</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>
</html>

