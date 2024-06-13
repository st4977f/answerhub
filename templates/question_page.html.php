<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <!-- Display the question title -->
                <h5 class="card-title"><?= htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8'); ?></h5>
                <hr />
                <!-- Display the question text -->
                <p class="card-text pl-5 my-4"><?= nl2br(htmlspecialchars($question['questiontext'], ENT_QUOTES, 'UTF-8')); ?></p>
                <p class="card-text pl-5">
                    <?php if ($question['imageData']) : ?>
                        <!-- Display the question image, if available -->
                        <img src="data:image/jpeg;base64,<?= base64_encode($question['imageData']); ?>" alt="Question Image" class="img-fluid">
                    <?php endif; ?>
                </p>
                <div class="pl-5">
                    <span class="badge badge-info">
                        <a class="text-white ">
                            <?= htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </span>
                </div>
                <hr />

                <!-- Edit and delete links for the question -->
                <div class="card-body ml-2">
                    <p class="card-text text-right float-right pr-2 bg-light rounded " style="width: 12rem; height: 6rem;">
                        <small class="text-muted px-1 float-left ">Asked
                            <?= htmlspecialchars($question['questiondate'], ENT_QUOTES, 'UTF-8'); ?></small>
                        <br>
                        <?php if (!empty($user['profile_image'])) : ?>
                            <!-- Display the profile image of the user who asked the question -->
                            <img src="data:image/jpeg;base64,<?= base64_encode($user['profile_image']) ?>" alt="Profile Picture" class="card-img-top float-left mx-2" style="width: 55px; height: 55px; overflow: hidden;">
                        <?php else : ?>
                            <!-- Display a default profile image if the user has no profile image -->
                            <img src="images/imgs.jpg" alt="Default Profile Picture" class="card-img-top float-left  mx-1" style="width: 55px; height: 55px;">
                        <?php endif; ?>
                        <small class="text-muted float-left">
                            <!-- Display the username of the user who asked the question -->
                            <a class="text-decoration-none" href="user_page.php?id=<?= $question['username'] ?>">
                                <?= htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </small>
                    </p>
                </div>
            </div>
        </div>

        <!-- This if else chain shows nothing if there are no answers  -->
        <!-- if there is one answer it shous 'answer'  -->
        <!-- if there is more than one answer it shows number of answer and 'answers' -->

        <?php if (count($answers) > 0) : ?>
            <?php $currentQuestionId = $question['id']; ?>
            <?php $answerCount = ($currentQuestionId == $question['id']) ? totalAnswers($pdo, $currentQuestionId) : 0; ?>
            <div class="mt-4">
                <?php if ($answerCount > 1) : ?>
                    <h6><?= $answerCount ?> Answers</h6>
                <?php else : ?>
                    <h6>Answer</h6>
                <?php endif; ?>
                <!-- Display the answers for that question  -->
                <?php foreach ($answers as $answer) : ?>
                    <div class="float-right">
                    </div>
                    <div class="card my-3 pl-5">
                        <div class="card-body">
                            <!-- Display the answer text -->
                            <p class="card-text"><?=nl2br(htmlspecialchars($answer['answertext'], ENT_QUOTES, 'UTF-8'));?></p>
                            <p class="card-text text-right float-right pr-2">
                                <small class="text-muted px-1">
                                    <!-- Display the answer date -->
                                    Answered <?=htmlspecialchars($answer['answerdate'], ENT_QUOTES, 'UTF-8');?>
                                </small>
                                <br>
                                <?php if (!empty($answer['profile_image'])): ?>
                                <!-- Display the profile image of the user who answered -->
                            <img src="data:image/jpeg;base64,<?=base64_encode($answer['profile_image'])?>" alt="Profile Picture" class="card-img-top float-left mx-2" style="width: 55px; height: 55px;">
                        <?php else: ?>
                                <!-- Display a default profile image if the user has no profile image -->
                            <img src="images/imgs.jpg" alt="Default Profile Picture" class="card-img-top float-left  mx-1" style="width: 55px; height: 55px;">
                        <?php endif;?>
                        <small class="text-muted float-left">
                                <!-- Display the username of the user who answered -->
                                    <a href="
                                user_page.php?id=<?=htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8');?>">
                                        <?=htmlspecialchars($answer['username'], ENT_QUOTES, 'UTF-8');?>
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
</body>
