<body>
    <div class="container mt-5">
        <!-- Display the total number of questions -->
        <p>Total Questions: <?=$totalQuestions?></p>
    </div>

    <div class="container py-2">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            Recent Questions
                        </div>
                        <div class="ml-auto">
                            <!-- Button to ask a new question -->
                            <a class="btn btn-primary btn-md mr-1" href="new_question.php" role="button">Ask
                                Question</a>
                        </div>
                    </div>
                    <!-- Display questions based on the current page -->
                    <?php
                    for ($i = $startIndex; $i < $endIndex; $i++) {
                        $question = $questions[$i];
                    ?>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <!-- Question Title with a link to the question page -->
                                <h5 class="card-title">
                                    <a class="text-decoration-none" href="question_page.php?id=<?=$question['id']?>">
                                        <?=htmlspecialchars($question['questiontitle'], ENT_QUOTES, 'UTF-8');?>
                                    </a>
                                </h5>

                                <div class="pb-2">
                                    <!-- Display a shortened version of the question text -->
                                    <?=shortText($pdo, $question['id'])?>
                                </div>
                                <!-- Number of answers badge -->
                                <span class="badge badge-secondary">
                                    <?=($currentQuestionId = $question['id']) ? totalAnswers($pdo, $currentQuestionId) : ''?>
                                    Answers
                                </span>
                                <!-- Category badge -->
                                <span class="badge badge-info">
                                    <a class="text-white">
                                        <?=htmlspecialchars($question['categoryName'], ENT_QUOTES, 'UTF-8');?>
                                    </a>
                                </span>
                                <div class="float-right">
                                    <!-- User profile image and link -->
                                    <span>
                                        <p class="badge badge-outline-primary">
                                            <a class="text-decoration-none"
                                                href="user_page.php?id=<?=$question['username']?>">
                                                <?php if (!empty($question['profile_image'])): ?>
                                                    <img src="data:image/jpeg;base64,<?=base64_encode($question['profile_image'])?>"
                                                        alt="Profile Picture"
                                                        class="profile-picture rounded img-thumbnail border-0"
                                                        style="width: 35px; height: 35px;">
                                                <?php else: ?>
                                                    <img src="../images/imgs.jpg" alt="Default Profile Picture"
                                                        class="card-img-top" style="width: 35px; height: 35px;">
                                                <?php endif;?>
                                                <?=htmlspecialchars($question['username'], ENT_QUOTES, 'UTF-8');?>
                                            </a>
                                        </p>
                                        <p class="badge badge-outline-secondary">
                                            asked <?=date("D d M Y", strtotime($question['questiondate']))?>
                                        </p>
                                    </span>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--  Generate pagination buttons -->
    <?php
    echo generatePaginationButtons($totalPages, $currentPage);
    ?>
</body>
