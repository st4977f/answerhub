<body>
<!-- Profile Header -->
<div class="bg-gradient-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center">
                <!-- User Avatar -->
                <div class="profile-avatar position-relative mb-3">
                    <div class="avatar-container mx-auto" style="width: 150px; height: 150px; position: relative;">
                        <?php if (!empty($user['profile_image'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>" 
                                 alt="Profile Picture" class="rounded-circle w-100 h-100" style="object-fit: cover; border: 4px solid rgba(255,255,255,0.3);">
                        <?php else: ?>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center w-100 h-100" 
                                 style="border: 4px solid rgba(255,255,255,0.3);">
                                <i class="fas fa-user fa-4x text-secondary"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- User Information -->
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="mb-2 font-weight-bold"><?= htmlspecialchars($_GET['id']) ?></h1>
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge badge-light mr-2">
                                <i class="fas fa-user"></i> Community Member
                            </span>
                            <span class="badge badge-success">
                                <i class="fas fa-circle text-success" style="font-size: 0.6rem;"></i> Active
                            </span>
                        </div>
                        
                        <!-- Enhanced Stats -->
                        <div class="row text-center">
                            <div class="col-3">
                                <div class="border-right border-light pr-3">
                                    <h3 class="mb-0 font-weight-bold text-white"><?= count($questions) ?></h3>
                                    <small class="text-light">
                                        <i class="fas fa-question-circle mr-1"></i>Questions
                                    </small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border-right border-light pr-3">
                                    <h3 class="mb-0 font-weight-bold text-white"><?= count($answers) ?></h3>
                                    <small class="text-light">
                                        <i class="fas fa-comments mr-1"></i>Answers
                                    </small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="border-right border-light pr-3">
                                    <h3 class="mb-0 font-weight-bold text-white"><?= count($questions) + count($answers) ?></h3>
                                    <small class="text-light">
                                        <i class="fas fa-chart-line mr-1"></i>Total Posts
                                    </small>
                                </div>
                            </div>
                            <div class="col-3">
                                <h3 class="mb-0 font-weight-bold text-warning">
                                    <?php 
                                    $helpfulnessScore = count($answers) > 0 ? round((count($answers) / (count($questions) + count($answers))) * 100) : 0;
                                    echo $helpfulnessScore . '%';
                                    ?>
                                </h3>
                                <small class="text-light">
                                    <i class="fas fa-star mr-1"></i>Helpfulness
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <!-- Member Since & Actions -->
                        <div class="text-light mb-3">
                            <small>
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Member since 
                                <?php 
                                // You can add actual join date from database if available
                                echo date('M Y'); 
                                ?>
                            </small>
                        </div>
                        
                        <!-- Achievement Badges -->
                        <div class="mb-2">
                            <?php if (count($questions) >= 1): ?>
                                <span class="badge badge-success badge-sm mr-1" title="Asked first question">
                                    <i class="fas fa-medal"></i> First Question
                                </span>
                            <?php endif; ?>
                            <?php if (count($answers) >= 1): ?>
                                <span class="badge badge-info badge-sm mr-1" title="Provided helpful answers">
                                    <i class="fas fa-hands-helping"></i> Helper
                                </span>
                            <?php endif; ?>
                            <?php if (count($questions) >= 5): ?>
                                <span class="badge badge-warning badge-sm mr-1" title="Active questioner">
                                    <i class="fas fa-brain"></i> Curious
                                </span>
                            <?php endif; ?>
                            <?php if (count($answers) >= 5): ?>
                                <span class="badge badge-primary badge-sm" title="Knowledge contributor">
                                    <i class="fas fa-graduation-cap"></i> Expert
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Content -->
<div class="container mt-4">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="questions-tab" data-toggle="tab" href="#questions" role="tab">
                        <i class="fas fa-question-circle"></i> Questions (<?= count($questions) ?>)
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="answers-tab" data-toggle="tab" href="#answers" role="tab">
                        <i class="fas fa-comments"></i> Answers (<?= count($answers) ?>)
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab">
                        <i class="fas fa-chart-line"></i> Activity
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Questions Tab -->
                <div class="tab-pane fade show active" id="questions" role="tabpanel">
                    <?php if (!empty($questions)): ?>
                        <?php for ($i = $startIndex; $i < $endIndex; $i++): 
                            $question = $questions[$i]; ?>
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-2">
                                                <a href="question_page?id=<?= $question['id'] ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8') ?>
                                                </a>
                                            </h5>
                                            <div class="text-muted mb-3">
                                                <?= shortText($pdo, $question['id']) ?>
                                            </div>
                                            <small class="text-muted">
                                                <i class="fas fa-calendar"></i> 
                                                Asked on <?= date('M d, Y', strtotime($question['questiondate'])) ?>
                                                <span class="badge badge-primary ml-2">
                                                    <?= totalAnswers($pdo, $question['id']) ?> answers
                                                </span>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>

                        <!-- Pagination -->
                        <?php if ($totalPages > 1): ?>
                            <nav aria-label="Question Pagination">
                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= $currentPageURL ?>?id=<?= $_GET['id'] ?>&page=<?= ($page - 1) ?>">
                                                <i class="fas fa-chevron-left"></i> Previous
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= $currentPageURL ?>?id=<?= $_GET['id'] ?>&page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= $currentPageURL ?>?id=<?= $_GET['id'] ?>&page=<?= ($page + 1) ?>">
                                                Next <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-question-circle fa-4x text-muted mb-3"></i>
                            <h4>No questions yet</h4>
                            <p class="text-muted">This user hasn't asked any questions yet.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Answers Tab -->
                <div class="tab-pane fade" id="answers" role="tabpanel">
                    <?php if (!empty($answers)): ?>
                        <?php foreach ($answers as $answer): ?>
                            <div class="card mb-3 shadow-sm">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        Answer to: <a href="question_page?id=<?= $answer['questionid'] ?>" class="text-decoration-none">
                                            Question #<?= $answer['questionid'] ?>
                                        </a>
                                    </h6>
                                    <p class="card-text"><?= nl2br(htmlspecialchars($answer['answertext'], ENT_QUOTES, 'UTF-8')) ?></p>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar"></i> 
                                        Answered on <?= date('M d, Y', strtotime($answer['answerdate'])) ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                            <h4>No answers yet</h4>
                            <p class="text-muted">This user hasn't answered any questions yet.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Activity Tab -->
                <div class="tab-pane fade" id="activity" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-chart-bar"></i> User Statistics</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-6 border-right">
                                            <h3 class="text-primary"><?= count($questions) ?></h3>
                                            <small class="text-muted">Total Questions</small>
                                        </div>
                                        <div class="col-6">
                                            <h3 class="text-success"><?= count($answers) ?></h3>
                                            <small class="text-muted">Total Answers</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-trophy"></i> Achievements</h6>
                                </div>
                                <div class="card-body">
                                    <?php if (count($questions) >= 1): ?>
                                        <div class="badge badge-success mb-1">First Question</div>
                                    <?php endif; ?>
                                    <?php if (count($answers) >= 1): ?>
                                        <div class="badge badge-info mb-1">Helpful Member</div>
                                    <?php endif; ?>
                                    <?php if (count($questions) >= 5): ?>
                                        <div class="badge badge-warning mb-1">Curious Mind</div>
                                    <?php endif; ?>
                                    <?php if (count($answers) >= 5): ?>
                                        <div class="badge badge-primary mb-1">Knowledge Sharer</div>
                                    <?php endif; ?>
                                    <?php if (count($questions) == 0 && count($answers) == 0): ?>
                                        <p class="text-muted mb-0">New member - no activity yet!</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="questions.php" class="btn btn-outline-secondary btn-block mb-2">
                        <i class="fas fa-search"></i> Browse Questions
                    </a>
                    <a href="userlist.php" class="btn btn-outline-info btn-block">
                        <i class="fas fa-users"></i> View Members
                    </a>
                </div>
            </div>

            <!-- User Stats -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-chart-line"></i> Activity Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 border-right">
                            <h4 class="text-primary"><?= count($questions) ?></h4>
                            <small class="text-muted">Questions</small>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success"><?= count($answers) ?></h4>
                            <small class="text-muted">Answers</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>
</body>

