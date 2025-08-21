<body>
<!-- Header Section -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-bold mb-2"><i class="fas fa-edit"></i> Edit Answer</h1>
                <p class="lead mb-0">Update your response to help the community</p>
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

    <!-- Edit Answer Form -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-edit"></i> Edit Your Answer</h5>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="answerBody" class="font-weight-medium">
                        Update your answer:
                    </label>
                    <textarea name="answerBody" 
                              id="answerBody" 
                              class="form-control" 
                              rows="12" 
                              placeholder="Write your answer here... Be detailed and helpful!"
                              required><?= htmlspecialchars($answer['answertext'], ENT_QUOTES, 'UTF-8') ?></textarea>
                    <small class="form-text text-muted">
                        <i class="fas fa-lightbulb"></i> 
                        Tip: Provide clear explanations, examples, and references when possible.
                    </small>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <a href="question_page?id=<?= $questionId ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> Update Answer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
#answerBody {
    border: 2px solid #e9ecef;
    transition: border-color 0.3s ease;
}

#answerBody:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.card-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>
</body>
