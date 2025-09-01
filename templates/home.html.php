<body>
<!-- Hero Section -->
<div class="jumbotron jumbotron-fluid bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="py-4">
                    <h1 class="display-4 font-weight-bold mb-4">AnswerHub</h1>
                    <p class="lead mb-4">Your go-to platform for asking questions and sharing knowledge with the University of Greenwich community.</p>
                    <div class="d-flex flex-wrap">
                        <a class="btn btn-light btn-lg mr-3 mb-2" href="questions" role="button">
                            <i class="fas fa-search"></i> Browse Questions
                        </a>
                        <a class="btn btn-outline-light btn-lg mb-2" href="registration" role="button">
                            <i class="fas fa-user-plus"></i> Join Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <div class="p-4">
                    <img src="images/campus.png" alt="University of Greenwich Campus" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Section -->
<div class="container my-5">
    <div class="row text-center">
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-question-circle fa-3x text-primary mb-3"></i>
                    <h3 class="card-title text-primary"><?= $totalQuestions ?? 0 ?></h3>
                    <p class="card-text">Questions Asked</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-comments fa-3x text-success mb-3"></i>
                    <h3 class="card-title text-success"><?= $totalAnswers ?? 0 ?></h3>
                    <p class="card-text">Answers Given</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-users fa-3x text-info mb-3"></i>
                    <h3 class="card-title text-info"><?= $totalUsers ?? 0 ?></h3>
                    <p class="card-text">Community Members</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-tags fa-3x text-warning mb-3"></i>
                    <h3 class="card-title text-warning"><?= $totalCategories ?? 0 ?></h3>
                    <p class="card-text">Categories</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Questions Section -->
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4">Recent Questions</h2>
            <?php if (!empty($recentQuestions)): ?>
                <?php foreach (array_slice($recentQuestions, 0, 5) as $question): ?>
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="question_page?id=<?= $question['id'] ?>" class="text-decoration-none">
                                    <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8') ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                <?= substr(htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8'), 0, 150) ?>...
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-primary"><?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8') ?></span>
                                <small class="text-muted">
                                    by <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8') ?> 
                                    on <?= date('M d, Y', strtotime($question['questiondate'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="text-center">
                    <a href="questions" class="btn btn-primary">View All Questions</a>
                </div>
            <?php else: ?>
                <div class="alert alert-info">
                    <h4>No questions yet!</h4>
                    <p>Be the first to ask a question and start the conversation.</p>
                    <a href="registration" class="btn btn-primary">Get Started</a>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Sidebar -->
        <div class="col-md-4">
            <h3>Popular Categories</h3>
            <div class="list-group mb-4">
                <?php if (!empty($popularCategories)): ?>
                    <?php foreach (array_slice($popularCategories, 0, 6) as $category): ?>
                        <a href="questions?category=<?= $category['id'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8') ?>
                            <span class="badge badge-primary badge-pill"><?= $category['question_count'] ?? 0 ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <h3>Quick Actions</h3>
            <div class="card">
                <div class="card-body">
                    <a href="questions" class="btn btn-outline-primary btn-block mb-2">
                        <i class="fas fa-search"></i> Browse Questions
                    </a>
                    <a href="userlist" class="btn btn-outline-info btn-block mb-2">
                        <i class="fas fa-users"></i> View Members
                    </a>
                    <a href="login" class="btn btn-success btn-block">
                        <i class="fas fa-sign-in-alt"></i> Login to Ask
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">Why Choose AnswerHub?</h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-bolt fa-3x text-primary mb-3"></i>
                <h4>Fast Responses</h4>
                <p>Get quick answers from our active community of experts and enthusiasts.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                <h4>Quality Content</h4>
                <p>Our community ensures high-quality questions and well-researched answers.</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                <h4>Friendly Community</h4>
                <p>Join a welcoming community that's passionate about helping each other learn.</p>
            </div>
        </div>
    </div>
</div>
</body>
