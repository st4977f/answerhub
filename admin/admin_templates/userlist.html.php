<body>
    <br>
    <div class="container mt-5">
        <h2>Users</h2>
        <br>
        <!-- Filter user by username feature (search) -->
        <div class="row">
            <form method="GET" action="">
                <div class="col-md-10">
                    <input type="text" name="filter" class="form-control" id="filterInput"
                        placeholder="Filter by user" value="<?=isset($_GET['filter']) ? htmlspecialchars($_GET['filter']) : ''?>">
                </div>

            </form>

        </div>
    </div>
    <br>
    <!-- User List Section -->
    <main class="container mt-4">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
            <!-- Display 36 users max per page -->
            <?php
        for ($i = $startIndex; $i < $endIndex && $i < $totalUsers; $i++) {
            $user = $results[$i];
            ?>
            <!-- User card -->
            <div class="col">
                <div class="card border-0 p-2">
                    <div class="row g-0">
                        <div class="col-5">
                            <div class="d-flex align-items-center justify-content-center"
                                style="width: 100px; height: 100px; overflow: hidden;">
                                <?php if (!empty($user['profile_image'])): ?>
                                <img src="data:image/jpeg;base64,<?=base64_encode($user['profile_image'])?>"
                                    alt="Profile Picture" class="img-fluid">
                                <?php else: ?>
                                <img src="../images/imgs.jpg" alt="Default Profile Picture" class="img-fluid">
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="col-7">
                            <div class="card-body p-0">
                                <h5 class="card-title m-0">
                                    <a class="text-decoration-none"
                                        href="user_page.php?id=<?=htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8');?>">
                                        <?php echo $user['username']; ?>
                                    </a>
                                </h5>
                                <!-- Show number of post made by the user and delete user -->
                                <p class="card-text m-0">Posts:
                                    <?=($currentUserId = $user['id']) ? userQuestions($pdo, $currentUserId) : ''?></p>
                                <form action="delete_user.php" method="POST" class="mt-2">
                                    <input type="hidden" name="userId"
                                        value="<?=htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8');?>">
                                    <button type="submit" name="deleteUser" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <!--  Generate pagination buttons -->
        <?php
        echo generatePaginationButtons($totalPages, $currentPage);
        ?>
    </main>
</body>
