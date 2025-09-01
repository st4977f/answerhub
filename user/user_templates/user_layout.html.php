<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="/answerhub/images/University-of-Greenwich.svg">
    <link rel="alternate icon" href="/answerhub/images/University-of-Greenwich.svg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="/answerhub/templates/styles.css">
    
    <style>
    /* Active page highlighting */
    .nav-link.active {
        background-color: #007bff !important;
        color: white !important;
        border-radius: 0.25rem;
        font-weight: 600;
    }
    
    .nav-link:hover {
        background-color: #e9ecef;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }
    
    .nav-link.active:hover {
        background-color: #0056b3 !important;
        color: white !important;
    }
    </style>

    <!-- jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    // Get current page name for active navigation highlighting
    $currentPage = basename($_SERVER['REQUEST_URI']);
    $currentPage = strtok($currentPage, '?'); // Remove query parameters
    
    // Handle user area page detection
    if (strpos($_SERVER['REQUEST_URI'], '/user/') !== false) {
        $pathParts = explode('/', $_SERVER['REQUEST_URI']);
        $currentPage = end($pathParts);
        $currentPage = strtok($currentPage, '?'); // Remove query parameters
    }
    
    if (empty($currentPage) || $currentPage === 'user_index') {
        $currentPage = 'user_index';
    }
    ?>
    
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light sticky-top mb-2 shadow-sm">
            <div class="collapse navbar-collapse d-flex">
                <a class="navbar-brand" href="/answerhub/user/user_index">Greenwich AnswerHub</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage === 'user_index') ? 'active' : '' ?>" href="/answerhub/user/user_index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($currentPage === 'profile') ? 'active' : '' ?>" href="/answerhub/user/profile">Profile</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link <?= ($currentPage === 'questions') ? 'active' : '' ?>" href="/answerhub/user/questions">Questions</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link <?= ($currentPage === 'userlist') ? 'active' : '' ?>" href="/answerhub/user/userlist">Users</a>
                    </li>
                   <!--  <li class="nav-item d-none d-sm-block">
                        <a class="nav-link" href="../user/contact">Contact Us</a>
                    </li>
                    -->
                </ul>
                <div class="ml-auto">
                    <a class="btn btn-primary btn-md mr-1" href="/answerhub/user/logout" role="button">Log out</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="mx-3"> <?=$output?>
        </div>
    </main>


    <footer id="sticky-footer" class="bg-dark py-3 mt-2 w-100 mt-auto">
        <div class="container">
            <p class="text-center text-light my-auto ">Copyright &copy; 2023 - Suleman Tunkara</p>
        </div>
    </footer>
</body>

</html>