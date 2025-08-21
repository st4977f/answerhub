<body>
<!-- Header Section -->
<div class="bg-danger text-white py-4 mb-4">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="display-4 font-weight-bold mb-2"><i class="fas fa-exclamation-triangle"></i> Login Failed</h1>
                <p class="lead mb-0">Authentication was unsuccessful</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- Error Card -->
            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white text-center">
                    <h5 class="mb-0"><i class="fas fa-times-circle"></i> Access Denied</h5>
                </div>
                <div class="card-body text-center">
                    <div class="error-icon mb-4">
                        <i class="fas fa-user-slash fa-4x text-danger"></i>
                    </div>
                    
                    <h4 class="text-danger mb-3">Invalid Credentials</h4>
                    <p class="text-muted mb-4">
                        The username and/or password you entered is incorrect. 
                        Please check your credentials and try again.
                    </p>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <a href="login" class="btn btn-primary btn-lg mb-2">
                            <i class="fas fa-sign-in-alt"></i> Try Again
                        </a>
                        <a href="registration" class="btn btn-outline-secondary">
                            <i class="fas fa-user-plus"></i> Create Account
                        </a>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="card mt-4 shadow-sm bg-light">
                <div class="card-body text-center">
                    <h6 class="mb-3"><i class="fas fa-question-circle text-info"></i> Need Help?</h6>
                    <div class="row">
                        <div class="col-12">
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-check text-success"></i> Check your username spelling
                            </small>
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-check text-success"></i> Verify your password is correct
                            </small>
                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-check text-success"></i> Make sure Caps Lock is off
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-4">
                <a href="index" class="btn btn-outline-primary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.card-header {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
}

.error-icon {
    opacity: 0.8;
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}

.d-grid {
    display: grid;
}

.gap-2 {
    gap: 0.5rem;
}

.card {
    border-radius: 15px;
    overflow: hidden;
}

.card-body {
    padding: 2rem;
}

@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .display-4 {
        font-size: 2rem;
    }
}

/* Animation for error icon */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.error-icon i {
    animation: shake 0.8s ease-in-out;
}
</style>
</body>
