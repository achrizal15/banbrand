<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title : 'BANBRAND' }}</title>
    @include("template.head_include")
</head>

<body class="bg-light font-family-nunito-sans">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient py-3 sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BANBRAND</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fs-6 fw-bold" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
    
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Become a Seller</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Help
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">How to Work</a></li>
                            <li><a class="dropdown-item" href="#">How to Order</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Banbrand</a>
                    </li>
                </ul>
                <div class="d-lg-flex">
                    <a href="" class="nav-link link-light">LOGIN</a>
                    <button type="button" class="btn btn-outline-light fw-bold">JOIN</button>
                </div>
            </div>
        </div>
    </nav>
    <section class="section-sub-nav shadow">
        <nav class="nav container-fluid sub-nav">
            <a class="nav-link active" aria-current="page" href="#">Banner</a>
            <a class="nav-link" href="#">Print Document</a>
            <a class="nav-link" href="#">Sticker</a>
        </nav>
    </section>
    <section class="banner-img">
        <div class="jumbotron jumbotron-fluid ">
           <div class="container-fluid">
             <h1 class="display-4 pt-3 text-center font-family-cormorant-garamond">BANNER</h1>
           </div>
         </div>
     </section>
    
    @yield("content")
    @include("template.footer_include")
</body>

</html>
