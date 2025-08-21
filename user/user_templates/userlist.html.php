<body>
<!-- Header Section -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-bold mb-2"></i> Community Members</h1>
                <p class="lead mb-0">Discover and connect with our amazing community</p>
            </div>
            <div class="col-md-4 text-right">
                <div class="row text-center">
                    <div class="col-4">
                        <h3 class="mb-0"><?= $totalUsers ?></h3>
                        <small>Members</small>
                    </div>
                    <div class="col-4">
                        <h3 class="mb-0"><?= $totalQuestionsInSystem ?></h3>
                        <small>Questions</small>
                    </div>
                    <div class="col-4">
                        <h3 class="mb-0"><?= $totalAnswersInSystem ?></h3>
                        <small>Answers</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Search and Filter Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="GET" action="" class="d-flex">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" name="filter" class="form-control" 
                           placeholder="Search members by username..." 
                           value="<?= isset($_GET['filter']) ? htmlspecialchars($_GET['filter'], ENT_QUOTES, 'UTF-8') : '' ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-right">
            <?php if (!empty($filter)): ?>
                <p class="mb-0 text-muted">
                    Showing <?= $filteredUsers ?> result(s) for "<?= htmlspecialchars($filter, ENT_QUOTES, 'UTF-8') ?>"
                    <a href="userlist.php" class="text-primary ml-2"><i class="fas fa-times"></i> Clear</a>
                </p>
            <?php else: ?>
                <p class="mb-0 text-muted">Showing all <?= $filteredUsers ?> members</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- User Cards Grid -->
    <?php if (!empty($results)): ?>
        <div class="row">
            <?php for ($i = $startIndex; $i < $endIndex && $i < $filteredUsers; $i++): 
                $user = $results[$i];
                $userQuestionCount = userQuestions($pdo, $user['id']);
                $userAnswerCount = userAnswers($pdo, $user['id']);
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm user-card">
                        <div class="card-body text-center">
                            <!-- Profile Picture -->
                            <div class="mb-3">
                                <div class="user-avatar mx-auto" style="width: 80px; height: 80px; position: relative;">
                                    <?php if (!empty($user['profile_image'])): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>"
                                             alt="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" 
                                             class="rounded-circle w-100 h-100" style="object-fit: cover; border: 3px solid #e9ecef;">
                                    <?php else: ?>
                                        <div class="bg-secondary rounded-circle w-100 h-100 d-flex align-items-center justify-content-center"
                                             style="border: 3px solid #e9ecef;">
                                            <i class="fas fa-user fa-2x text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Activity indicator -->
                                    <?php if ($userQuestionCount > 0 || $userAnswerCount > 0): ?>
                                        <span class="badge badge-success position-absolute" 
                                              style="bottom: 0; right: 0; width: 20px; height: 20px; border-radius: 50%;">
                                            <i class="fas fa-check" style="font-size: 10px;"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- User Info -->
                            <h5 class="card-title mb-2">
                                <a href="user_page?id=<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" 
                                   class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </h5>
                            
                            <!-- User Stats -->
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <div class="border-right">
                                        <h6 class="text-primary mb-0"><?= $userQuestionCount ?></h6>
                                        <small class="text-muted">Questions</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-success mb-0"><?= $userAnswerCount ?></h6>
                                    <small class="text-muted">Answers</small>
                                </div>
                            </div>

                            <!-- Member Status Badge -->
                            <?php if ($userQuestionCount >= 5 && $userAnswerCount >= 5): ?>
                                <span class="badge badge-warning mb-2">Expert Contributor</span>
                            <?php elseif ($userQuestionCount >= 3 || $userAnswerCount >= 3): ?>
                                <span class="badge badge-info mb-2">Active Member</span>
                            <?php elseif ($userQuestionCount > 0 || $userAnswerCount > 0): ?>
                                <span class="badge badge-secondary mb-2">Community Member</span>
                            <?php else: ?>
                                <span class="badge badge-light mb-2">New Member</span>
                            <?php endif; ?>

                            <!-- Action Button -->
                            <div class="mt-auto">
                                <a href="user_page?id=<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <!-- No Users Found -->
        <div class="text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-3"></i>
            <h4>No members found</h4>
            <?php if (!empty($filter)): ?>
                <p class="text-muted">No members match your search for "<?= htmlspecialchars($filter, ENT_QUOTES, 'UTF-8') ?>"</p>
                <a href="userlist.php" class="btn btn-primary">View All Members</a>
            <?php else: ?>
                <p class="text-muted">There are no registered members yet.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Enhanced Pagination -->
    <?php if ($totalPages > 1): ?>
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="User pagination">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1<?= !empty($filter) ? '&filter=' . urlencode($filter) : '' ?>">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= ($currentPage - 1) ?><?= !empty($filter) ? '&filter=' . urlencode($filter) : '' ?>">
                                    <i class="fas fa-angle-left"></i> Previous
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php
                        $start = max(1, $currentPage - 2);
                        $end = min($totalPages, $currentPage + 2);
                        
                        for ($i = $start; $i <= $end; $i++): ?>
                            <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?><?= !empty($filter) ? '&filter=' . urlencode($filter) : '' ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= ($currentPage + 1) ?><?= !empty($filter) ? '&filter=' . urlencode($filter) : '' ?>">
                                    Next <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $totalPages ?><?= !empty($filter) ? '&filter=' . urlencode($filter) : '' ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                
                <!-- Pagination Info -->
                <div class="text-center mt-2">
                    <small class="text-muted">
                        Showing <?= $startIndex + 1 ?>-<?= min($endIndex, $filteredUsers) ?> of <?= $filteredUsers ?> members
                        <?php if ($filteredUsers != $totalUsers): ?>
                            (filtered from <?= $totalUsers ?> total)
                        <?php endif; ?>
                    </small>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.user-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.user-avatar {
    transition: transform 0.2s ease-in-out;
}

.user-card:hover .user-avatar {
    transform: scale(1.05);
}

.badge {
    font-size: 0.75rem;
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #ced4da;
}
</style>
</body>
