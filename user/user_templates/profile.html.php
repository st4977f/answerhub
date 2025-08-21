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
                        <button type="button" class="btn btn-light btn-sm position-absolute" 
                                style="bottom: 10px; right: 10px; border-radius: 50%; width: 35px; height: 35px;"
                                data-toggle="modal" data-target="#changePictureModal">
                            <i class="fas fa-camera"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- User Information -->
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb-1"><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></h2>
                        <p class="mb-3 text-light"><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></p>
                        
                        <!-- Quick Stats -->
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="border-right border-light pr-3">
                                    <h4 class="mb-0"><?= count($questions) ?></h4>
                                    <small>Questions</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border-right border-light pr-3">
                                    <h4 class="mb-0"><?= count($answers) ?></h4>
                                    <small>Answers</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">Active</h4>
                                <small>Status</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <!-- Action Buttons -->
                        <a href="delete.php" class="btn btn-danger d-block ml-auto" 
                           onclick="return confirm('Are you sure you want to delete your account? This cannot be undone.')">
                            <i class="fas fa-trash"></i> Delete Account
                        </a>
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
                                        <div class="dropdown">
                                            <button class="btn btn-link text-muted" type="button" data-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="question_edit.php?id=<?= $question['id'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a class="dropdown-item text-danger" href="question_delete.php?id=<?= $question['id'] ?>"
                                                   onclick="return confirm('Are you sure you want to delete this question?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
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
                                            <a class="page-link" href="<?= $currentPageURL ?>?page=<?= ($page - 1) ?>">
                                                <i class="fas fa-chevron-left"></i> Previous
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="<?= $currentPageURL ?>?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $totalPages): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?= $currentPageURL ?>?page=<?= ($page + 1) ?>">
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
                            <p class="text-muted">Ready to ask your first question?</p>
                            <a href="new_question.php" class="btn btn-primary my-2">Ask a Question</a>
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
                            <p class="text-muted">Help the community by answering questions!</p>
                            <a href="questions.php" class="btn btn-primary">Browse Questions</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Activity Tab -->
                <div class="tab-pane fade" id="activity" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-chart-bar"></i> Your Statistics</h6>
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
                                        <p class="text-muted mb-0">Start participating to earn achievements!</p>
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
                    <a href="new_question.php" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-plus"></i> Ask a Question
                    </a>
                    <a href="questions.php" class="btn btn-outline-secondary btn-block mb-2">
                        <i class="fas fa-search"></i> Browse Questions
                    </a>
                    <a href="userlist.php" class="btn btn-outline-info btn-block">
                        <i class="fas fa-users"></i> View Members
                    </a>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-cogs"></i> Account Settings</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-outline-primary btn-block mb-2" data-toggle="modal" data-target="#changeDetails">
                        <i class="fas fa-user-edit"></i> Edit Profile
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-block mb-2" data-toggle="modal" data-target="#changePictureModal">
                        <i class="fas fa-camera"></i> Change Picture
                    </button>
                    <a href="logout.php" class="btn btn-outline-warning btn-block">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Change Picture Modal -->
<div class="modal fade" id="changePictureModal" tabindex="-1" aria-labelledby="changePictureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePictureModalLabel">
                    <i class="fas fa-camera"></i> Change Profile Picture
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="upload_image.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div class="current-avatar" style="width: 100px; height: 100px; margin: 0 auto;">
                            <?php if (!empty($user['profile_image'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>" 
                                     alt="Current Profile" class="rounded-circle w-100 h-100" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center w-100 h-100">
                                    <i class="fas fa-user fa-2x text-secondary"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profileImage" class="form-label">Choose a new image</label>
                        <input type="file" class="form-control-file" id="profileImage" name="profileImage" accept="image/*" required>
                        <small class="form-text text-muted">Please upload a JPG, PNG, or GIF image (max 5MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload Picture</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Details Modal -->
<div class="modal fade" id="changeDetails" tabindex="-1" aria-labelledby="changeDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeDetailsLabel">
                    <i class="fas fa-user-edit"></i> Edit Profile Details
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="details_edit.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>
</body>