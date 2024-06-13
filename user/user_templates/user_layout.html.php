<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- jQuery and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand navbar-light bg-light sticky-top mb-2 shadow-sm">
            <div class="collapse navbar-collapse d-flex">
                <a class="navbar-brand" href="../user/user_index.php">Greenwich AnswerHub</a>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="../user/user_index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/profile.php">Profile</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link" href="../user/questions.php">Questions</a>
                    </li>
                    <li class="nav-item d-none d-sm-block">
                        <a class="nav-link" href="../user/userlist.php">Users</a>
                    </li>
                   <!--  <li class="nav-item d-none d-sm-block">
                        <a class="nav-link" href="../user/contact.php">Contact Us</a>
                    </li>
                    -->
                </ul>
                <div class="ml-auto">
                    <a class="btn btn-primary btn-md mr-1" href="logout.php" role="button">Log out</a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>