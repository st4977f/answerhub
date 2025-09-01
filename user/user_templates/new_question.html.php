<body>
    <!-- Page Banner -->
    <div class="bg-gradient-primary text-white py-5 mb-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div>
                            <h1 class="h2 mb-2 font-weight-bold">Ask a Question</h1>
                            <p class="lead mb-0 text-white-50">Get help from our community of experts and developers</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                    <div class="text-white-50">
                        <small><i class="fas fa-users mr-2"></i>Join thousands of learners</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row">
            <!-- Main Form Column -->
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-white border-bottom-0 py-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle p-2 mr-3">
                                <i class="fas fa-edit text-white"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 font-weight-bold text-dark">Question Details</h4>
                                <p class="text-muted mb-0 small">Fill out the form below to ask your question</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post" enctype="multipart/form-data">
                            <!-- Progress Steps -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-primary badge-pill mr-2">1</span>
                                            <small class="text-muted">Title & Category</small>
                                        </div>
                                        <div class="flex-grow-1 mx-3">
                                            <hr class="my-0">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-light badge-pill mr-2">2</span>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <div class="flex-grow-1 mx-3">
                                            <hr class="my-0">
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-light badge-pill mr-2">3</span>
                                            <small class="text-muted">Submit</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Question Title -->
                            <div class="form-group mb-4">
                                <label class="h6 text-dark mb-2" for="questionTitle">
                                    <i class="fas fa-heading text-primary mr-2"></i>Question Title
                                    <span class="text-danger">*</span>
                                </label>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-info-circle text-info mr-1"></i>
                                    Write a clear, specific title that summarizes your problem
                                </p>
                                <input type="text" name="questionTitle" id="questionTitle" 
                                       class="form-control form-control-lg border-light shadow-sm"
                                       placeholder="e.g. How do I center a div element using CSS flexbox?" 
                                       required>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-lightbulb text-warning mr-1"></i>
                                        Good titles are specific and help others understand your problem quickly
                                    </small>
                                </div>
                            </div>

                            <!-- Category Selection -->
                            <div class="form-group mb-4">
                                <label class="h6 text-dark mb-2" for="categories">
                                    <i class="fas fa-tags text-primary mr-2"></i>Category
                                    <span class="text-danger">*</span>
                                </label>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-info-circle text-info mr-1"></i>
                                    Select the category that best fits your question
                                </p>
                                <select name="categories" class="form-control form-control-lg border-light shadow-sm" required>
                                    <option value="">Choose a category...</option>
                                    <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?= htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Question Details -->
                            <div class="form-group mb-4">
                                <label class="h6 text-dark mb-2" for="questionBody">
                                    <i class="fas fa-align-left text-primary mr-2"></i>Detailed Description
                                    <span class="text-danger">*</span>
                                </label>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-info-circle text-info mr-1"></i>
                                    Provide a comprehensive explanation of your problem. Include code snippets, error messages, and what you've tried.
                                </p>
                                <textarea name="questionBody" id="questionBody" 
                                          class="form-control border-light shadow-sm" rows="14" 
                                          placeholder="Describe your problem in detail...

What exactly are you trying to achieve?
What have you tried so far?
What error messages (if any) are you getting?
Include any relevant code snippets or screenshots."
                                          required></textarea>
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-check-circle text-success mr-1"></i>
                                        Minimum 20 characters • Use markdown for code formatting
                                    </small>
                                </div>
                            </div>

                            <!-- Image Upload Section -->
                            <div class="form-group mb-4">
                                <label class="h6 text-dark mb-2" for="questionImage">
                                    <i class="fas fa-image text-primary mr-2"></i>Supporting Image
                                    <span class="badge badge-secondary badge-sm ml-1">Optional</span>
                                </label>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-info-circle text-info mr-1"></i>
                                    Upload a screenshot, diagram, or code snippet image to help illustrate your problem
                                </p>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="custom-file">
                                            <input type="file" name="questionImage" id="questionImage" 
                                                   class="custom-file-input" accept="image/*">
                                            <label class="custom-file-label border-light shadow-sm" for="questionImage">
                                                <i class="fas fa-upload mr-2"></i>Choose image file...
                                            </label>
                                        </div>
                                        <small class="form-text text-muted mt-2">
                                            <i class="fas fa-file-image text-muted mr-1"></i>
                                            Accepted: JPG, PNG, GIF • Max size: 5MB
                                        </small>
                                    </div>
                                    <div class="col-md-4 mt-3 mt-md-0">
                                        <div class="text-center">
                                            <div class="border border-light rounded p-3 bg-light">
                                                <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                                <div class="small text-muted">Preview</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Section -->
                            <hr class="my-4">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-shield-alt text-success mr-2"></i>
                                        <small>Your question will be reviewed by our community</small>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-right mt-3 mt-md-0">
                                    <button type="submit" value="Add" class="btn btn-primary btn-lg px-5 shadow">
                                        <i class="fas fa-paper-plane mr-2"></i>Post Your Question
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Enhanced Sidebar -->
            <div class="col-lg-4">
                <!-- Quick Help Card -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-gradient-success text-white border-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-rocket fa-lg mr-2"></i>
                            <h6 class="mb-0 font-weight-bold">Quick Tips</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <h6 class="text-dark mb-2">
                                <i class="fas fa-star text-warning mr-2"></i>Make it Great
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                                    <small>Write a clear, specific title</small>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                                    <small>Include relevant code snippets</small>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                                    <small>Explain what you've tried</small>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                                    <small>Add screenshots if helpful</small>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mr-2 mt-1"></i>
                                    <small>Use proper formatting</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Community Guidelines -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-header bg-gradient-info text-white border-0">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users fa-lg mr-2"></i>
                            <h6 class="mb-0 font-weight-bold">Community Guidelines</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="small text-muted mb-3">Please ensure your question:</p>
                        <ul class="small text-muted mb-0 list-unstyled">
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fas fa-heart text-danger mr-2 mt-1"></i>
                                Is respectful and appropriate
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fas fa-search text-primary mr-2 mt-1"></i>
                                Hasn't been asked before
                            </li>
                            <li class="mb-2 d-flex align-items-start">
                                <i class="fas fa-bullseye text-success mr-2 mt-1"></i>
                                Is on-topic for this community
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-brain text-warning mr-2 mt-1"></i>
                                Shows your research effort
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Statistics Card -->
                <div class="card shadow border-0 mb-4">
                    <div class="card-body p-4 text-center">
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-2">
                                    <i class="fas fa-question-circle fa-2x text-primary"></i>
                                </div>
                                <h5 class="mb-1 font-weight-bold">1.2K+</h5>
                                <small class="text-muted">Questions</small>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <i class="fas fa-comments fa-2x text-success"></i>
                                </div>
                                <h5 class="mb-1 font-weight-bold">3.5K+</h5>
                                <small class="text-muted">Answers</small>
                            </div>
                            <div class="col-4">
                                <div class="mb-2">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                                <h5 class="mb-1 font-weight-bold">450+</h5>
                                <small class="text-muted">Members</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Need Help Card -->
                <div class="card shadow border-0">
                    <div class="card-body p-4 text-center">
                        <i class="fas fa-life-ring fa-3x text-secondary mb-3"></i>
                        <h6 class="text-dark mb-2">Need Help?</h6>
                        <p class="small text-muted mb-3">
                            Check our FAQ or browse existing questions before posting.
                        </p>
                        <a href="questions" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-search mr-1"></i>Browse Questions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Custom Scripts -->
    <script>
        // File upload enhancement
        document.getElementById('questionImage').addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose image file...';
            e.target.nextElementSibling.innerHTML = '<i class="fas fa-upload mr-2"></i>' + fileName;
        });

        // Form validation enhancement
        document.querySelector('form').addEventListener('submit', function(e) {
            var title = document.getElementById('questionTitle').value;
            var body = document.getElementById('questionBody').value;
            
            if (title.length < 10) {
                e.preventDefault();
                alert('Please write a more descriptive title (at least 10 characters)');
                return false;
            }
            
            if (body.length < 20) {
                e.preventDefault();
                alert('Please provide more details about your problem (at least 20 characters)');
                return false;
            }
        });
    </script>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
        }
        .bg-opacity-20 {
            background-color: rgba(255, 255, 255, 0.2) !important;
        }
        .text-white-50 {
            color: rgba(255, 255, 255, 0.5) !important;
        }
        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }
    </style>
</body>
