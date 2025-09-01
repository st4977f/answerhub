<body>
<div class="container text-center py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>
                    <h1 class="display-4 text-danger"><?= $error_title ?? '404' ?></h1>
                    <h3 class="mb-4">Page Not Found</h3>
                    <p class="lead text-muted mb-4">
                        <?= $error_message ?? 'The page you are looking for could not be found.' ?>
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="/answerhub/user/user_index" class="btn btn-primary mr-2">
                            <i class="fas fa-home"></i> Go to Dashboard
                        </a>
                        <a href="/answerhub/user/questions" class="btn btn-outline-secondary">
                            <i class="fas fa-question-circle"></i> Browse Questions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
