<!-- Inside your HTML file -->
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <!-- Question Title -->
                <h5 class="card-title"><?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <hr />
                <!-- Question Text -->
                <p class="card-text pl-5 my-4"><?= nl2br(htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8')); ?></p>
                </p>
                <!-- Question Image -->
                <p class="pl-5">
                <p class="pl-5">
    <?php if ($question['imageData']): ?>
            <img src="data:image/jpeg;base64,<?= base64_encode($question['imageData']); ?>" alt="Question Image" style="max-width: 100%; height: auto;">
    <?php endif; ?>
</p>
                <!-- Category -->
                <div class="pl-5">
                    <span class="badge badge-info">
                        <a class="text-white ">
                            <?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </span>
                </div>
                <hr />
                <!-- Edit and Delete Links (if user is the question's owner) -->
                <?php if (strcasecmp($_SESSION['username'], $question['username']) === 0): ?>
                <a href="question_edit.php?id=<?= $question['id'] ?>" class="float-left mx-2 pl-5 ">Edit</a>
                <a href="question_delete.php?id=<?= $question['id'] ?>" class="float-left ">Delete</a>
                <?php endif; ?>

                <div class="card-body">
                    <!-- Question Details -->
                    <p class="card-text text-right float-right pr-2 bg-light rounded"
                        style="width: 12rem; height: 6rem;">
                        <small class="text-muted px-1 float-left ">Asked
                            <?= htmlspecialchars($question['questiondate'], ENT_QUOTES, 'UTF-8'); ?></small>
                        <br>
                        <!-- User Profile Image -->
                        <?php if (!empty($user['profile_image'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>"
                            alt="Profile Picture" class="card-img-top float-left mx-2"
                            style="width: 55px; height: 55px;">
                        <?php else: ?>
                        <img src="../images/imgs.jpg" alt="Default Profile Picture"
                            class="card-img-top float-left  mx-1" style="width: 55px; height: 55px;">
                        <?php endif; ?>
                        <!-- User Profile Link -->
                        <small class="text-muted float-left">
                            <a class="text-decoration-none" href="user_page.php?id=<?= $question['username'] ?>">
                                <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </small>
                    </p>
                </div>

            </div>
        </div>

        <!-- Answer Section -->

        <!-- This if-else chain shows nothing if there are no answers -->
        <!-- If there is one answer, it shows 'answer' -->
        <!-- If there is more than one answer, it shows the number of answers and 'answers' -->

        <?php if (count($answers) > 0): ?>
        <?php $currentQuestionId = $question['id']; ?>
        <?php $answerCount = ($currentQuestionId == $question['id']) ? totalAnswers($pdo, $currentQuestionId) : 0; ?>
        <div class="mt-4">
            <?php if ($answerCount > 1): ?>
            <h6><?= $answerCount ?> Answers</h6>
            <?php else: ?>
            <h6>Answer</h6>
            <?php endif; ?>
            <?php foreach ($answers as $answer): ?>

            <div class="float-right">

            </div>
            <div class="card my-3 pl-5">
                <div class="card-body">
                    <!-- Answer Text -->
                    <p class="card-text"><?= htmlspecialchars($answer['answertext'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="card-text text-right float-right pr-2">
                        <!-- Answer Details -->
                        <small class="text-muted px-1">
                            Answered <?= htmlspecialchars($answer['answerdate'], ENT_QUOTES, 'UTF-8'); ?>
                        </small>
                        <br>
                        <!-- User Profile Image -->
                        <?php if (!empty($answer['profile_image'])): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($answer['profile_image']) ?>" alt="Profile Picture" class="card-img-top float-left mx-2" style="width: 55px; height: 55px;">
                        <?php else: ?>
                        <img src="../images/imgs.jpg" alt="Default Profile Picture" class="card-img-top float-left mx-1"
                            style="width: 55px; height: 55px;">
                        <?php endif; ?>
                        <!-- User Profile Link -->
                        <small class="text-muted float-left">
                            <a href="user_page.php?id=<?= htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?= htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </small>
                    </p>
                </div>
            </div>
            <hr />
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Answer Form -->
    <div class="container my-4">
        <div>
            <h6 class="mb-4">Your Answer</h6>
            <form action="" method="post">
                <div class="form-group">
                    <textarea name="answerBody" id="answerBody" class="form-control" rows="11" required></textarea>
                </div>
                <input type="hidden" name="questionId" value="<?= $question['id']; ?>">
                <button type="submit" value="Add" class="btn btn-primary">Post Your Answer</button>
            </form>
        </div>
    </div>
</body>
