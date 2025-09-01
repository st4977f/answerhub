<body>
<!-- Header Section -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-bold mb-2"></i> Questions</h1>
                <p class="lead mb-0">Explore community questions and share your knowledge</p>
            </div>
            <div class="col-md-4 text-right">
                <div class="row text-center">
                    <div class="col-6">
                        <h3 class="mb-0"><?= $totalQuestions ?></h3>
                        <small>Total Questions</small>
                    </div>
                    <div class="col-6">
                        <a href="registration" class="btn btn-light btn-sm">
                            <i class="fas fa-plus"></i> Ask Question
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Filters and Search Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0">All Questions</h5>
                            <small class="text-muted">Showing <?= $startIndex + 1 ?>-<?= min($endIndex, $totalQuestions) ?> of <?= $totalQuestions ?> questions</small>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm active">
                                    <i class="fas fa-clock"></i> Recent
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-fire"></i> Popular
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-question"></i> Unanswered
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm bg-light">
                <div class="card-body py-3 text-center">
                    <h6 class="mb-2">Have a Question?</h6>
                    <a href="registration" class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Ask Your Question
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions List -->
    <div class="row">
        <div class="col-12">
            <?php if (!empty($questions)): ?>
                <?php for ($i = $startIndex; $i < $endIndex; $i++): 
                    $question = $questions[$i];
                    $answerCount = totalAnswers($pdo, $question['id']);
                ?>
                    <div class="card mb-3 shadow-sm question-card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Stats Column -->
                                <div class="col-md-2 text-center border-right">
                                    <div class="question-stats">
                                        <div class="stat-item mb-2">
                                            <h4 class="mb-0 text-<?= $answerCount > 0 ? 'success' : 'muted' ?>"><?= $answerCount ?></h4>
                                            <small class="text-muted">Answer<?= $answerCount != 1 ? 's' : '' ?></small>
                                        </div>
                                        <div class="stat-item">
                                            <span class="badge badge-<?= $answerCount > 0 ? 'success' : 'secondary' ?>">
                                                <?= $answerCount > 0 ? 'Answered' : 'Open' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content Column -->
                                <div class="col-md-8">
                                    <div class="question-content">
                                        <h5 class="question-title mb-2">
                                            <a href="question_page?id=<?= $question['id'] ?>" class="text-decoration-none text-dark">
                                                <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8') ?>
                                            </a>
                                        </h5>
                                        
                                        <p class="question-excerpt text-muted mb-3">
                                            <?= shortText($pdo, $question['id']) ?>
                                        </p>

                                        <!-- Tags and Category -->
                                        <div class="question-tags mb-2">
                                            <span class="badge badge-info mr-1">
                                                <i class="fas fa-tag"></i> <?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Author Column -->
                                <div class="col-md-2 text-right">
                                    <div class="question-author">
                                        <div class="author-info d-flex align-items-center justify-content-end">
                                            <div class="text-right mr-2">
                                                <div class="author-name">
                                                    <a href="user_page?id=<?= $question['username'] ?>" 
                                                       class="text-decoration-none font-weight-medium">
                                                        <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8') ?>
                                                    </a>
                                                </div>
                                                <div class="question-date">
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock"></i>
                                                        <?= date("M d, Y", strtotime($question['questiondate'])) ?>
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="author-avatar">
                                                <?php 
                                                // Debug: Check if we have profile image data
                                                $hasProfileImage = ($question['profile_image'] !== null && 
                                                                   !empty($question['profile_image']) && 
                                                                   strlen($question['profile_image']) > 0);
                                                
                                                if ($hasProfileImage): 
                                                    try {
                                                        $imageData = base64_encode($question['profile_image']);
                                                ?>
                                                    <img src="data:image/jpeg;base64,<?= $imageData ?>"
                                                         alt="<?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8') ?>"
                                                         class="rounded-circle" 
                                                         style="width: 40px; height: 40px; object-fit: cover;"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 40px; height: 40px; display: none;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                <?php 
                                                    } catch (Exception $e) {
                                                ?>
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                <?php 
                                                    }
                                                else: 
                                                ?>
                                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-white"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-5">
                    <i class="fas fa-question-circle fa-4x text-muted mb-3"></i>
                    <h4>No questions yet</h4>
                    <p class="text-muted">Be the first to ask a question!</p>
                    <a href="registration" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus"></i> Ask the First Question
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Enhanced Pagination -->
    <?php if ($totalPages > 1): ?>
        <div class="row mt-4">
            <div class="col-12">
                <nav aria-label="Questions pagination">
                    <ul class="pagination justify-content-center">
                        <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= ($currentPage - 1) ?>">
                                    <i class="fas fa-angle-left"></i> Previous
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php
                        $start = max(1, $currentPage - 2);
                        $end = min($totalPages, $currentPage + 2);
                        
                        for ($i = $start; $i <= $end; $i++): ?>
                            <li class="page-item <?= ($currentPage == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= ($currentPage + 1) ?>">
                                    Next <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $totalPages ?>">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                
                <!-- Pagination Info -->
                <div class="text-center mt-2">
                    <small class="text-muted">
                        Page <?= $currentPage ?> of <?= $totalPages ?> 
                        (<?= $totalQuestions ?> total questions)
                    </small>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Call to Action -->
    <div class="bg-light rounded p-4 mt-5 text-center">
        <h4><i class="fas fa-lightbulb"></i> Got a Question?</h4>
        <p class="text-muted mb-3">Join our community and get answers from experts and fellow learners.</p>
        <div>
            <a href="registration" class="btn btn-primary mr-2">
                <i class="fas fa-user-plus"></i> Sign Up to Ask
            </a>
            <a href="login" class="btn btn-outline-primary">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </div>
</div>

<style>
.question-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.question-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.question-title a:hover {
    color: #007bff !important;
}

.question-stats .stat-item {
    padding: 0.5rem 0;
}

.author-info {
    min-height: 60px;
}

.question-excerpt {
    line-height: 1.5;
    max-height: 3em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.font-weight-medium {
    font-weight: 500;
}

@media (max-width: 768px) {
    .question-card .row > div {
        margin-bottom: 1rem;
    }
    
    .border-right {
        border-right: none !important;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 1rem;
    }
}
</style>
</body>
