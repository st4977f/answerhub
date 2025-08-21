<body>
<!-- Header Section -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-2"><i class="fas fa-question-circle"></i> Question Management</h1>
                <p class="mb-0">Review and manage community questions</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="questions.php" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-left"></i> Back to Questions
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Question Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <!-- Question Header -->
            <div class="row mb-3">
                <div class="col-md-8">
                    <h2 class="question-title mb-3">
                        <?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8'); ?>
                    </h2>
                </div>
                <div class="col-md-4 text-right">
                    <?php $answerCount = totalAnswers($pdo, $question['id']); ?>
                    <div class="question-stats text-center">
                        <h3 class="mb-0 text-<?= $answerCount > 0 ? 'success' : 'muted' ?>"><?= $answerCount ?></h3>
                        <small class="text-muted">Answer<?= $answerCount != 1 ? 's' : '' ?></small>
                        <div class="mt-2">
                            <span class="badge badge-<?= $answerCount > 0 ? 'success' : 'secondary' ?>">
                                <?= $answerCount > 0 ? 'Answered' : 'Open' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Meta Info -->
            <div class="question-meta mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <span class="badge badge-info mr-2">
                            <i class="fas fa-tag"></i> <?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                        </span>
                        <small class="text-muted">
                            <i class="fas fa-clock"></i> Asked on <?= date("F d, Y \a\\t g:i A", strtotime($question['questiondate'])); ?>
                        </small>
                    </div>
                    <div class="col-md-6 text-right">
                        <!-- Admin Actions -->
                        <div class="admin-actions mb-2">
                            <a href="question_edit.php?id=<?= $question['id'] ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="question_delete.php?id=<?= $question['id'] ?>" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                        
                        <div class="author-info d-flex align-items-center justify-content-end">
                            <div class="text-right mr-2">
                                <div class="author-name">
                                    <a href="user_page.php?id=<?= $question['username'] ?>" 
                                       class="text-decoration-none font-weight-medium">
                                        <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                </div>
                                <small class="text-muted">Question Author</small>
                            </div>
                            <div class="author-avatar">
                                <?php if (!empty($user['profile_image'])) : ?>
                                    <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>" 
                                         alt="<?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8'); ?>"
                                         class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else : ?>
                                    <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Question Content -->
            <div class="question-content">
                <div class="question-text mb-4">
                    <?= nl2br(htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8')); ?>
                </div>
                
                <?php if ($question['imageData']) : ?>
                    <div class="question-image mb-3">
                        <img src="data:image/jpeg;base64,<?= base64_encode($question['imageData']); ?>" 
                             alt="Question Image" 
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 400px; width: auto;">
                    </div>
                <?php endif; ?>
            </div>
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
                                    <!-- Admin can moderate answers -->
                                    <div class="admin-answer-actions">
                                        <button class="btn btn-outline-danger btn-sm" title="Delete Answer">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                                                <a href="user_page.php?id=<?= htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8'); ?>"
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
                    <p class="text-muted mb-0">This question is waiting for community responses.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Admin Answer Form -->
    <div class="answer-form-section">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-shield-alt"></i> Admin Response</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="answerBody" class="font-weight-medium">
                            Provide an official response or guidance:
                        </label>
                        <textarea name="answerBody" 
                                  id="answerBody" 
                                  class="form-control" 
                                  rows="8" 
                                  placeholder="Write an official response as an administrator..."
                                  required></textarea>
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> 
                            As an admin, your response will be highlighted for the community.
                        </small>
                    </div>
                    <input type="hidden" name="questionId" value="<?= $question['id']; ?>">
                    <div class="text-right">
                        <button type="submit" value="Add" class="btn btn-warning btn-lg">
                            <i class="fas fa-paper-plane"></i> Post Admin Response
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
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

.admin-actions .btn, .admin-answer-actions .btn {
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
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
}

#answerBody {
    border: 2px solid #e9ecef;
    transition: border-color 0.3s ease;
}

#answerBody:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255,193,7,.25);
}

.admin-answer-actions {
    margin-top: 0.5rem;
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
    
    .admin-actions {
        text-align: center;
        margin-bottom: 1rem;
    }
}
</style>
</body>
