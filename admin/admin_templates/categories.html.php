<body>
  <div class="container mt-5">

    <h1>Add Category</h1>
    <!-- Form to add a new category -->
    <form action="categories.php" method="POST">
      <div class="mb-3">
        <label for="categoryName" class="form-label">Category Name</label>
        <!-- Input field for entering the category name -->
        <input type="text" class="form-control" id="categoryName" name="categoryName" required>
      </div>
      <!-- Button to submit the form and add the category -->
      <button type="submit" name="addCategory" class="btn btn-primary">Add Category</button>
    </form>
    <hr>
    
    <h2>Current Categories</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Category ID</th>
          <th scope="col">Category Name</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <!-- Show current categories -->
      <tbody>
        <?php foreach ($categories as $category) : ?>
          <tr>
            <td><?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
              <!-- Form to update the category name -->
              <form action="category_edit.php" method="POST">
                <input type="hidden" name="categoryId" value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="text" class="form-control" name="categoryName" value="<?= htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>">
            </td>
            <td>
              <!-- Button to update the category -->
              <button type="submit" name="updateCategory" class="btn btn-sm btn-primary float-left">Update</button>
              </form>
              <!-- Form to delete the category -->
              <form action="category_delete.php" method="POST" class="float-left mx-2">
                <input type="hidden" name="categoryId" value="<?= htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                <!-- Button to delete the category -->
                <button type="submit" name="deleteCategory" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

