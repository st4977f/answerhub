<body>
    <div class="container">
        <form action="" method="post" id="frm">
            <input type="hidden" name="id" value="<?= $question['id'] ?>">
            <div class="form-group my-4">
                <label for="questiontext">
                    <h6>
                        Edit your question here:
                    </h6>
                </label>
                <textarea class="form-control my-3" name="questiontext"
                    rows="11"><?= htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Save</button>
        </form>
    </div>
</body>
