<body>
<!-- Welcome Hero Section -->
<div class="jumbotron jumbotron-fluid bg-primary text-white mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4">Welcome back, <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?>!</h1>
                <p class="lead">Ready to share knowledge and help the community?</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="new_question" class="btn btn-light btn-lg">
                    <i class="fas fa-plus"></i> Ask Question
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Quick Stats -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card text-center border-primary">
                        <div class="card-body">
                            <i class="fas fa-question-circle fa-2x text-primary mb-2"></i>
                            <h3 class="text-primary"><?= $totalQuestions ?></h3>
                            <p class="card-text">Questions Asked</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-success">
                        <div class="card-body">
                            <i class="fas fa-comments fa-2x text-success mb-2"></i>
                            <h3 class="text-success"><?= $totalAnswers ?></h3>
                            <p class="card-text">Answers Given</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-info">
                        <div class="card-body">
                            <i class="fas fa-user fa-2x text-info mb-2"></i>
                            <h3 class="text-info">Active</h3>
                            <p class="card-text">Member Status</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-clock"></i> Your Recent Questions</h5>
                    <a href="questions" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($recentUserQuestions)): ?>
                        <?php foreach ($recentUserQuestions as $question): ?>
                            <div class="border-bottom pb-3 mb-3">
                                <h6 class="mb-1">
                                    <a href="question_page?id=<?= $question['id'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    Asked on <?= date('M d, Y', strtotime($question['questiondate'])) ?>
                                    <span class="badge badge-secondary ml-2">
                                        <?= totalAnswers($pdo, $question['id']) ?> answers
                                    </span>
                                </small>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                            <h5>No questions yet!</h5>
                            <p class="text-muted">Ready to ask your first question?</p>
                            <a href="new_question" class="btn btn-primary my-2">Ask Your First Question</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Community Recent Questions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users"></i> Latest Community Questions</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($recentQuestions)): ?>
                        <?php foreach ($recentQuestions as $question): ?>
                            <div class="border-bottom pb-3 mb-3">
                                <h6 class="mb-1">
                                    <a href="question_page?id=<?= $question['id'] ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    by <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8') ?>
                                    on <?= date('M d, Y', strtotime($question['questiondate'])) ?>
                                    <span class="badge badge-info ml-2">
                                        <?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                </small>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Profile Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Profile Summary</h5>
                </div>
                <div class="card-body text-center">
                    <?php if (!empty($user['profile_image'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>" 
                             alt="Profile Picture" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-2x text-white"></i>
                        </div>
                    <?php endif; ?>
                    <h5><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></h5>
                    <p class="text-muted"><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></p>
                    <a href="profile" class="btn btn-outline-primary btn-sm my-2">Edit Profile</a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="new_question" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-plus"></i> Ask a Question
                    </a>
                    <a href="questions" class="btn btn-outline-secondary btn-block mb-2">
                        <i class="fas fa-search"></i> Browse Questions
                    </a>
                    <a href="userlist" class="btn btn-outline-info btn-block mb-2">
                        <i class="fas fa-users"></i> View Members
                    </a>
                </div>
            </div>

            <!-- Help & Tips -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-lightbulb"></i> Tips for Success</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Be specific in your questions</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Search before asking</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Help others by answering</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Use relevant categories</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
