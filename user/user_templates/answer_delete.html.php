<body>
<!-- Header Section -->
<div class="bg-danger text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-bold mb-2"><i class="fas fa-trash"></i> Delete Answer</h1>
                <p class="lead mb-0">Remove your answer from the community</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="question_page?id=<?= $questionId ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Question
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Delete Confirmation -->
    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Confirm Deletion</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning" role="alert">
                <h6><i class="fas fa-warning"></i> Warning</h6>
                This action cannot be undone. Are you sure you want to delete this answer?
            </div>

            <!-- Answer Preview -->
            <div class="bg-light p-3 rounded mb-4">
                <h6 class="mb-2">Your Answer:</h6>
                <div class="answer-preview">
                    <?= nl2br(htmlspecialchars($answer['answertext'], ENT_QUOTES, 'UTF-8')) ?>
                </div>
                <small class="text-muted d-block mt-2">
                    <i class="fas fa-clock"></i> Originally posted on <?= date("F d, Y \a\\t g:i A", strtotime($answer['answerdate'])); ?>
                </small>
            </div>
            
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <a href="question_page?id=<?= $questionId ?>" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <input type="hidden" name="confirm" value="yes">
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="fas fa-trash"></i> Delete Answer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.answer-preview {
    max-height: 200px;
    overflow-y: auto;
    font-size: 1rem;
    line-height: 1.6;
}

.card-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}
</style>
</body>
