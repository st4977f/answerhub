<body>
    <div class="container">
        <h2 class="my-4">Ask a Question</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Question Title -->
            <div class="form-group">
                <label class="font-weight-bold" for="questionTitle">Title</label>
                <p>Be specific and imagine you’re asking a question to another person.</p>
                <input type="text" name="questionTitle" id="questionTitle" class="form-control"
                    placeholder="e.g. Is there an R function for finding the index of an element in a vector?" required>
            </div>
            <!-- Category Selection -->
            <div class="form-group">
                <label class="font-weight-bold" for="categories">Category</label>
                <p>Select a category for your problem</p>
                <select name="categories" class="form-control" required>
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?= htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Question Details -->
            <div class="form-group">
                <label class="font-weight-bold" for="questionBody">What are the details of your problem?</label>
                <p>Introduce the problem and expand on what you put in the title. Minimum 20 characters.</p>
                <textarea name="questionBody" id="questionBody" class="form-control" rows="11" required></textarea>
            </div>
            <!-- Image Upload -->
            <label class="font-weight-bold" for="questionImage">Upload an Image (optional)</label>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="questionImage" id="questionImage" class="custom-file-input">
                            <label class="custom-file-label" for="questionImage">Choose file</label>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="col-9">
                    <div class="text-right">
                        <button type="submit" value="Add" class="btn btn-primary">Post Your Question</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
