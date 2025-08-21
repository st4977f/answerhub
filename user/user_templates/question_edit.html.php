<body>
<!-- Header Section -->
<div class="bg-primary text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-4 font-weight-bold mb-2"><i class="fas fa-edit"></i> Edit Question</h1>
                <p class="lead mb-0">Update your question to get better answers</p>
            </div>
            <div class="col-md-4 text-right">
                <a href="question_page?id=<?= $question['id'] ?>" class="btn btn-light btn-sm">
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

    <!-- Edit Question Form -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-edit"></i> Edit Your Question</h5>
        </div>
        <div class="card-body">
            <form action="" method="post" id="frm">
                <input type="hidden" name="id" value="<?= $question['id'] ?>">
                
                <div class="form-group">
                    <label for="questiontext" class="font-weight-medium">
                        <i class="fas fa-question-circle"></i> Question Details:
                    </label>
                    <textarea class="form-control" 
                              name="questiontext" 
                              id="questiontext"
                              rows="12" 
                              placeholder="Update your question here... Be clear and specific!"
                              required><?= htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                    <small class="form-text text-muted">
                        <i class="fas fa-lightbulb"></i> 
                        Tip: Be specific about your problem and include relevant details to get better answers.
                    </small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="question_page?id=<?= $question['id'] ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary btn-lg" name="submit">
                            <i class="fas fa-save"></i> Update Question
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tips Card -->
    <div class="card mt-4 shadow-sm border-info">
        <div class="card-header bg-info text-white">
            <h6 class="mb-0"><i class="fas fa-tips"></i> Tips for Better Questions</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Be specific and clear</li>
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Include relevant details</li>
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Use proper grammar</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Mention what you've tried</li>
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Add context if needed</li>
                        <li class="mb-2"><i class="fas fa-check text-success"></i> Ask one question at a time</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.card-header.bg-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
}

#questiontext {
    border: 2px solid #e9ecef;
    transition: border-color 0.3s ease;
    font-size: 1rem;
    line-height: 1.6;
}

#questiontext:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}

.font-weight-medium {
    font-weight: 500;
}

@media (max-width: 768px) {
    .btn-lg {
        width: 100%;
        margin-top: 1rem;
    }
    
    .text-right {
        text-align: left !important;
    }
}
</style>
</body>
