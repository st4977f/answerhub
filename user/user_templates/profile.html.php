<body>
<!-- User Profile Section -->
<header class="bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <!-- User Avatar -->
        <div class="position-relative">
        <div class="d-flex align-items-center justify-content-center"
                        style="width: 130px; height: 130px; overflow: hidden;">
                        <?php if (!empty($user['profile_image'])): ?>
                        <img src="data:image/jpeg;base64,<?=base64_encode($user['profile_image'])?>"
                            alt="Profile Picture" class="img-fluid">
                        <?php else: ?>
                        <img src="../images/imgs.jpg" alt="Default Profile Picture" class="img-fluid">
                        <?php endif;?>
                    </div>
        </div>
      </div>
      <div class="col-md-10 px-4">
        <!-- User Information -->
        <div class="d-flex justify-content-between align-items-center">
          <h3><?=htmlspecialchars($user['username'])?> - <?=htmlspecialchars($user['email'])?></h3>
        </div>
        <div class="py-1">
          <!-- Change Username/Email Button -->
          <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#changeDetails">
            Change Personal Details
          </button>
        </div>
        <div class="py-1">
          <!-- Change Profile Picture Button -->
          <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#changePictureModal">
            Change Profile Picture
          </button>
        </div>
        <div class="py-1">
          <!-- Delete Account Link -->
          <button type="button" class="btn btn-danger btn-sm mr-2">
            <a href="delete.php" class="text-white text-decoration-none">Delete Account</a>
          </button>
        </div>
      </div>
    </div>
  </div>
</header>

    <!-- User Content Section -->
    <main class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <!-- User Questions -->
                <h2 class="mb-4">Questions</h2>
                <?php

                for ($i = $startIndex; $i < $endIndex; $i++) {
                    $question = $questions[$i];
                    ?>
                <div class="card mb-3">
                    <div class="card-body ">
                        <h5><a class="text-decoration-none" href="question_page.php?id=<?=$question['id']?>">
                                <?=htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8');?>
                            </a></h5>
                        <?=shortText($pdo, $question['id'])?>
                        <div class="mt-3">
                            <a class="btn btn-danger btn-sm mr-1 float-right"
                                href="question_delete.php?id=<?=$question['id']?>" role="button">Delete</a>
                            <a class="btn btn-secondary btn-sm mr-1 float-right"
                                href="question_edit.php?id=<?=$question['id']?>" role="button">Edit</a>
                        </div>
                    </div>
                </div>
                <?php }?>
                <!-- Questions pagination (max 10 per page) -->

                <nav aria-label="Question Pagination">
                    <ul class="pagination justify-content-end">
                        <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?=$currentPageURL?>?page=<?=($page - 1)?>">Previous</a>
                        </li>
                        <?php endif;?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php if ($i == $page) {
                            echo 'active';
                        }
                        ?>">
                            <a class="page-link" href="<?=$currentPageURL?>?page=<?=$i?>"><?=$i?></a>
                        </li>
                        <?php endfor;?>

                        <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?=$currentPageURL?>?page=<?=($page + 1)?>">Next</a>
                        </li>
                        <?php endif;?>
                    </ul>
                </nav>
            </div>

            <div class="col-md-4">
                <!-- User Stats -->
                <h2 class="mb-4">Stats</h2>
                <ul class="list-group">
                    <li class="list-group-item">Total Questions: <?=count($questions)?></li>
                    <li class="list-group-item">Total Answers: <?=count($answers)?></li>
                </ul>
            </div>

        </div>
    </main>

  <!-- Change Picture Modal -->
  <div class="modal fade" id="changePictureModal" tabindex="-1" aria-labelledby="changePictureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
        <strong>
            <h5 class="modal-title " id="changePictureModalLabel">Upload Image
            </h5></strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="upload_image.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="profileImage" class="form-label">Choose an image</label>
              <input type="file" class="form-control" id="profileImage" name="profileImage">
            </div>
            <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Change Details Modal -->

  <div class="modal fade" id="changeDetails" tabindex="-1" role="dialog" aria-labelledby="changeDetails" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeDetailsLabel">Change Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="details_edit.php" method="POST">
          <div class="form-group">
            <label for="username" class="col-form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>">
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>

</html>