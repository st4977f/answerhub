<body>
<!-- Header Section -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-bold mb-2"></i> Question</h1>
                <p class="lead mb-0">Get detailed answers from our community</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="questions" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Questions
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Question Card -->
    <div class="card shadow-sm mb-4">
        <!-- Question Header -->
        <div class="card-header bg-light">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <h2 class="mb-2">
                        <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8'); ?>
                    </h2>
                    <div class="d-flex flex-wrap align-items-center">
                        <span class="badge badge-primary mr-3 mb-1">
                            <i class="fas fa-tag"></i> <?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                        <small class="text-muted mr-3 mb-1">
                            <i class="fas fa-clock"></i> Asked <?= date("M d, Y", strtotime($question['questiondate'])); ?>
                        </small>
                        <small class="text-muted mb-1">
                            <i class="fas fa-user"></i> by 
                            <a href="user_page?id=<?= $question['username'] ?>" 
                               class="text-decoration-none">
                                <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </small>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <?php $answerCount = totalAnswers($pdo, $question['id']); ?>
                    <div class="text-center">
                        <h3 class="text-primary mb-1"><?= $answerCount ?></h3>
                        <small class="text-muted">Answer<?= $answerCount != 1 ? 's' : '' ?></small>
                        <br>
                        <span class="badge badge-<?= $answerCount > 0 ? 'success' : 'warning' ?> mt-2">
                            <?= $answerCount > 0 ? 'Answered' : 'Needs Answer' ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Content -->
        <div class="question-content-area p-4">
            <div class="question-text mb-4">
                <?= nl2br(htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8')); ?>
            </div>
            
            <?php if ($question['imageData']) : ?>
                <div class="question-image-container mb-4">
                    <img src="data:image/jpeg;base64,<?= base64_encode($question['imageData']); ?>" 
                         alt="Question Image" 
                         class="question-image img-fluid rounded shadow"
                         style="max-height: 500px; width: auto;">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Answers Section -->
 <?php if (count($answers) > 0) : ?>
        <?php $currentQuestionId = $question['id']; ?>
        <?php $answerCount = ($currentQuestionId == $question['id']) ? totalAnswers($pdo, $currentQuestionId) : 0; ?>
        
        <div class="answers-section mb-4">
            <div class="answers-header mb-3">
                <h3 class="mb-0">
                    <i class="fas fa-comments"></i>
                    <?php if ($answerCount > 1) : ?>
                        <?= $answerCount ?> Answers
                    <?php else : ?>
                        Answer
                    <?php endif; ?>
                </h3>
                <hr class="mt-2">
            </div>

          
            <!-- Answers List -->
            <?php foreach ($answers as $index => $answer) : ?>
                <div class="card answer-card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row">
                            <!-- Answer Content -->
                            <div class="col-md-10">
                                <div class="answer-content mb-3">
                                    <?= nl2br(htmlspecialchars($answer['answertext'], ENT_QUOTES, 'UTF-8')); ?>
                                </div>
                            </div>
                            
                            <!-- Answer Meta -->
                            <div class="col-md-2 text-right">
                                <div class="answer-meta">
                                    <div class="answer-number mb-2">
                                        <span class="badge badge-secondary">#<?= $index + 1 ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Answer Footer -->
                        <div class="answer-footer mt-3 pt-3 border-top">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i>
                                        Answered on <?= date("F d, Y \a\\t g:i A", strtotime($answer['answerdate'])); ?>
                                    </small>
                                </div>
                                <div class="col-md-4 text-right">
                                    <div class="answer-author d-flex align-items-center justify-content-end">
                                        <div class="text-right mr-2">
                                            <div class="author-name">
                                                <a href="user_page?id=<?= htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8'); ?>"
                                                   class="text-decoration-none font-weight-medium">
                                                    <?= htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8'); ?>
                                                </a>
                                            </div>
                                            <small class="text-muted">Community Member</small>
                                        </div>
                                        <div class="author-avatar">
                                            <?php if (!empty($answer['profile_image'])) : ?>
                                                <img src="data:image/jpeg;base64,<?= base64_encode($answer['profile_image']) ?>"
                                                     alt="<?= htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8'); ?>"
                                                     class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                            <?php else : ?>
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
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <!-- No Answers State -->
        <div class="no-answers-section text-center py-4 mb-4">
            <div class="card shadow-sm bg-light">
                <div class="card-body">
                    <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                    <h4>No answers yet</h4>
                    <p class="text-muted mb-0">Be the first to help by providing an answer below!</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Call to Action for More Engagement -->
    <div class="engagement-section mb-4">
        <div class="card shadow-sm bg-primary text-white">
            <div class="card-body text-center">
                <h5><i class="fas fa-lightbulb"></i> Know the Answer?</h5>
                <p class="mb-3">Help the community by sharing your knowledge!</p>
                <div>
                    <a href="registration" class="btn btn-light mr-2">
                        <i class="fas fa-user-plus"></i> Join to Answer
                    </a>
                    <a href="login" class="btn btn-outline-light">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Question Card Styles */
.question-title {
    color: #333;
    font-weight: 600;
    line-height: 1.3;
}

.question-content {
    font-size: 1.1rem;
    line-height: 1.6;
}

.question-text {
    color: #555;
}

.question-stats {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.5rem;
}

.action-buttons .btn {
    margin: 0 2px;
}

.answer-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.answer-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.answer-content {
    font-size: 1.05rem;
    line-height: 1.6;
    color: #555;
}

.answer-number .badge {
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
}

.answers-header h3 {
    color: #333;
    font-weight: 600;
}

.author-info, .answer-author {
    min-height: 50px;
}

.font-weight-medium {
    font-weight: 500;
}

.answer-form-section {
    margin-top: 2rem;
}

.answer-form-section .card-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

#answerBody {
    border: 2px solid #e9ecef;
    transition: border-color 0.3s ease;
}

#answerBody:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

@media (max-width: 768px) {
    .question-stats {
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .author-info, .answer-author {
        justify-content: center;
        text-align: center;
        margin-top: 1rem;
    }
    
    .answer-card .row > div {
        margin-bottom: 1rem;
    }
    
    .action-buttons {
        text-align: center;
        margin-bottom: 1rem;
    }
}
</style>
</body>
