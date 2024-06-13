<?php

// Executes a prepared statement with optional parameters and returns the query object.

function query( $pdo, $sql, $parameters = [] )
 {
    $query = $pdo->prepare( $sql );
    $query->execute( $parameters );
    return $query;
}

////////////////// Users ///////////////////////

// Retrieves all users from the database.

function allUsers( $pdo )
 {
    $users = query( $pdo, 'SELECT * FROM users' );
    return $users->fetchAll();
}

// Retrieves users from the database based on a filter condition ( username ).

function filterUser( $pdo, $filter )
 {
    $query = 'SELECT * FROM users';
    $params = [];

    if ( !empty( $filter ) ) {
        $query .= ' WHERE username LIKE :filter';
        $params[ 'filter' ] = '%' . $filter . '%';
    }

    $query .= ' ORDER BY id ASC';

    $stmt = query( $pdo, $query, $params );
    $results = $stmt->fetchAll( PDO::FETCH_ASSOC );

    return $results;
}

// Retrieves a specific user from the database based on the user ID.

function getUser( $pdo, $userId )
 {
    $userSql = 'SELECT * FROM users WHERE id = :userId';
    $params = [ ':userId' => $userId ];
    $userStmt = query( $pdo, $userSql, $params );
    return $userStmt->fetch();
}

// Retrieves all records from the 'users' table.

function fetchRecords( $pdo )
 {
    $query = 'SELECT * FROM users';
    $stmt = query( $pdo, $query );
    return $stmt->fetchAll();
}

// Retrieves the number of questions asked by a user.

function userQuestions( $pdo, $userId )
 {
    $query = 'SELECT COUNT(*) AS total FROM question WHERE userid = :userId';
    $params = [ ':userId' => $userId ];
    $stmt = query( $pdo, $query, $params );
    $total = $stmt->fetch( PDO::FETCH_ASSOC );
    return $total[ 'total' ];
}

// Retrieves user information based on the username.

function getUserInformation( $pdo, $username )
 {
    $query = 'SELECT * FROM users WHERE username = :username';
    $params = [ ':username' => $username ];
    $stmt = query( $pdo, $query, $params );
    return $stmt->fetch( PDO::FETCH_ASSOC );
}

// Retrieves questions asked by a specific user.

function getUserQuestions( $pdo, $userId )
 {
    $query = 'SELECT * FROM question WHERE userid = :userId ORDER BY question.questiondate DESC';
    $params = [ ':userId' => $userId ];
    $stmt = query( $pdo, $query, $params );
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
}

//  Retrieves answers provided by a specific user.

function getUserAnswers( $pdo, $userId )
 {
    $query = 'SELECT * FROM answer WHERE userid = :userId';
    $params = [ ':userId' => $userId ];
    $stmt = query( $pdo, $query, $params );
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
}

// Deletes a user from the database based on the user ID.

function deleteUser( $pdo, $id )
 {
    $params = [ ':userId' => $id ];
    query( $pdo, 'DELETE FROM users WHERE id = :userId', $params );
}

// Function to update user details

function updateUser( $pdo, $userId, $newUsername, $newEmail ) {
    try {
        // Prepare the UPDATE statement
        $sql = 'UPDATE users SET username = :username, email = :email WHERE id = :id';
        $stmt = $pdo->prepare( $sql );

        // Bind the parameters
        $stmt->bindValue( ':username', $newUsername );
        $stmt->bindValue( ':email', $newEmail );
        $stmt->bindValue( ':id', $userId );

        // Execute the statement
        $stmt->execute();
    } catch ( PDOException $e ) {
        echo 'Error updating user details: ' . $e->getMessage();

    }
}

////////////////// Questions ///////////////////////

// Retrieves the total number of questions in the database

function totalQuestions( $pdo )
 {
    $query = $pdo->prepare( 'SELECT COUNT(*) FROM question' );
    $query->execute();
    return $query->fetchColumn();
}

// Retrieves all questions along with user and category information.

function allQuestions( $pdo )
 {
    $sql = 'SELECT question.id, questiontext, `name`, email, categoryName FROM question
            INNER JOIN users ON userid = user.id
            INNER JOIN category ON categoryid = category.id';

    $questions = query( $pdo, $sql );
    return $questions->fetchAll( PDO::FETCH_ASSOC );
}

// Retrieves questions with user and category information, ordered by question date.

function showQuestions( $pdo )
 {
    $sql = 'SELECT question.*, users.username, category.categoryName
            FROM question
            INNER JOIN users ON question.userid = users.id
            INNER JOIN category ON question.categoryid = category.id
            ORDER BY question.questiondate DESC';

    $stmt = query( $pdo, $sql );
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
}

// Retrieves questions with user, category, and question date information.

function getQuestions( $pdo )
 {
    $sql = 'SELECT question.*, users.username, users.profile_image, category.categoryName
            FROM question
            INNER JOIN users ON question.userid = users.id
            INNER JOIN category ON question.categoryid = category.id
            ORDER BY question.questiondate DESC';

    $stmt = query( $pdo, $sql );
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
}

// Retrieves a specific question based on the question ID.

function getQuestion( $pdo, $questionId )
 {
    $sql = 'SELECT question.*, users.username, category.categoryName
            FROM question
            INNER JOIN users ON question.userid = users.id
            INNER JOIN category ON question.categoryid = category.id
            WHERE question.id = :id';

    $params = [ ':id' => $questionId ];
    $stmt = query( $pdo, $sql, $params );
    return $stmt->fetch();
}

// Inserts a new question into the database.
function addQuestion($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['questionTitle'];
        $questiontext = $_POST['questionBody'];
        $category = $_POST['categories'];

        $username = $_SESSION['username'];

        // Retrieve the user's ID based on their username
        $userIdQuery = 'SELECT id FROM users WHERE username = :username';
        $userIdParams = [':username' => $username];
        $userIdStmt = query($pdo, $userIdQuery, $userIdParams);
        $user = $userIdStmt->fetch();

        if ($user) {
            $userId = $user['id'];
        } else {
            // If the user doesn't exist, redirect to the login page
            header('Location: ../login.php');
            exit();
        }

        // Handle image upload
        $imageData = null;
        if (isset($_FILES['questionImage']) && $_FILES['questionImage']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $_FILES['questionImage']['tmp_name'];
            $imageData = file_get_contents($imagePath);
        }

        try {
            // Insert the new question into the database
            $sql = 'INSERT INTO question (questiontitle, questiontext, questiondate, categoryid, userid, imageData)
                    VALUES (:questiontitle, :questiontext, CURDATE(), :categoryid, :userid, :imageData)';
            $params = [
                ':questiontitle' => $title,
                ':questiontext' => $questiontext,
                ':categoryid' => $category,
                ':userid' => $userId,
                ':imageData' => $imageData,
            ];
            query($pdo, $sql, $params);

            // Get the last inserted question ID
            $questionId = $pdo->lastInsertId();

            // Redirect to the question page
            header('Location: ../user/question_page.php?id=' . $questionId);
            exit();
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
            echo $error;
        }
    }
}

// Updates the text of a question in the database.


function editQuestion($pdo)
{
    $questionId = $_POST['id'];

    // Update the question text
    $sql = 'UPDATE question SET questiontext = :questiontext WHERE id = :id';
    $params = [
        ':questiontext' => $_POST['questiontext'],
        ':id' => $questionId,
    ];
    query($pdo, $sql, $params);

    // Redirect to the question page
    header('location: question_page.php?id=' . $questionId);
}

// Retrieves a specific question from the database.

function fetchQuestion($pdo, $questionId)
{
    // Fetch the question with the given ID
    $query = $pdo->prepare('SELECT * FROM question WHERE id = :questionId');
    $query->bindParam(':questionId', $questionId);
    $query->execute();

    if ($query->rowCount() > 0) {
        // If the question exists, fetch its details
        $sql = 'SELECT * FROM question WHERE id = :id';
        $params = [':id' => $questionId];
        $stmt = query($pdo, $sql, $params);
        return $stmt->fetch();
    } else {
        // If the question doesn't exist, redirect with an error
        header('location: question_edit.php?id=' . $questionId . '&error=not_owner');
        exit();
    }
}

//  Inserts a new question into the database.

function insertQuestion($pdo, $questiontext, $userid, $categoryid)
{
    // Insert a new question into the database
    $query = 'INSERT INTO question (questiontext, questiondate, `image`, userid, categoryid)
            VALUES (:questiontext, CURDATE(), :userid, :categoryid)';
    $params = [
        ':questiontext' => $questiontext,
        ':userid' => $userid,
        ':categoryid' => $categoryid,
    ];
    query($pdo, $query, $params);
}

// Deletes a question from the database based on the question ID.

function deleteQuestion( $pdo, $id )
 {
    $params = [ ':id' => $id ];
    query( $pdo, 'DELETE FROM question WHERE id = :id', $params );
}

// Verifies if a user is the owner of a question.

function verifyQuestionOwnership( $pdo, $questionId, $username )
 {
    // Retrieve the user ID based on the username
    $userIdQuery = $pdo->prepare( 'SELECT id FROM users WHERE username = :username' );
    $userIdQuery->bindParam( ':username', $username );
    $userIdQuery->execute();
    $userId = $userIdQuery->fetchColumn();

    // Verify if the logged-in user is the owner of the question
    $query = $pdo->prepare( 'SELECT * FROM question WHERE id = :questionId AND userid = :userId' );
    $query->bindParam( ':questionId', $questionId );
    $query->bindParam( ':userId', $userId );
    $query->execute();

    return $query->rowCount() > 0;
}

////////////////// Answers ///////////////////////

// Returns the total number of answers for a given question ID
function totalAnswers($pdo, $questionId)
{
    $query = $pdo->prepare('SELECT COUNT(*) AS total_answers FROM answer WHERE questionid = :questionId');
    $query->bindValue(':questionId', $questionId, PDO::PARAM_INT);
    $query->execute();
    $totalAnswers = $query->fetch(PDO::FETCH_ASSOC);

    return $totalAnswers['total_answers'];
}

// Adds a new answer to the database
function addAnswer($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $answerText = $_POST['answerBody'];
        $questionId = $_POST['questionId'];

        $username = $_SESSION['username'];

        // Retrieve the user's ID based on their username
        $userIdQuery = $pdo->prepare('SELECT id FROM users WHERE username = :username');
        $userIdQuery->bindValue(':username', $username);
        $userIdQuery->execute();
        $userId = $userIdQuery->fetchColumn();

        if (!$userId) {
            // If the user doesn't exist, redirect to the login page
            header('Location: ../login.php');
            exit();
        }

        try {
            // Insert the new answer into the database
            $sql = 'INSERT INTO answer (answertext, answerdate, questionid, userid) VALUES (:answertext, CURDATE(), :questionid, :userid)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':answertext', $answerText);
            $stmt->bindValue(':questionid', $questionId);
            $stmt->bindValue(':userid', $userId);
            $stmt->execute();

            // Redirect to the question page
            header('Location: ../user/question_page.php?id=' . $questionId);
            exit();
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
            echo $error;
        }
    }
}

// Retrieves all answers for a given question ID
function getAnswers($pdo, $questionId)
{
    $answersSql = 'SELECT answer.*, users.username, users.profile_image
                    FROM answer
                    LEFT JOIN users ON answer.userid = users.id
                    WHERE answer.questionid = :id';
    $answersStmt = $pdo->prepare($answersSql);
    $answersStmt->bindValue(':id', $questionId);
    $answersStmt->execute();
    return $answersStmt->fetchAll(PDO::FETCH_ASSOC);
}


////////////////// Categories ///////////////////////

// Fetches all categories from the database
function fetchAllCategories($pdo)
{
    $sql = 'SELECT id, categoryName FROM category';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Retrieves all categories from the database
function allCategories($pdo)
{
    $categoriesSql = 'SELECT * FROM category';
    $categoriesStmt = $pdo->query($categoriesSql);
    return $categoriesStmt->fetchAll(PDO::FETCH_ASSOC);
}

// Adds a new category to the database
function addCategory($pdo, $categoryName)
{
    $sql = 'INSERT INTO category (categoryName) VALUES (:categoryName)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':categoryName', $categoryName);
    $stmt->execute();
}

// Updates a category in the database
function updateCategory($pdo, $categoryId, $categoryName)
{
    $sql = 'UPDATE category SET categoryName = :categoryName WHERE id = :categoryId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':categoryName', $categoryName);
    $stmt->bindValue(':categoryId', $categoryId);
    $stmt->execute();
}

// Deletes a category from the database
function deleteCategory($pdo, $categoryId)
{
    $sql = 'DELETE FROM category WHERE id = :categoryId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':categoryId', $categoryId);
    $stmt->execute();
}

////////////////// Others ///////////////////////

// Uploads a profile image for a user
function uploadProfileImage($pdo, $username, $image)
{
    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($image['tmp_name']);

        if (!empty($imageData)) {
            $updateQuery = $pdo->prepare('UPDATE users SET profile_image = :imageData WHERE username = :username');
            $updateQuery->bindValue(':imageData', $imageData, PDO::PARAM_LOB);
            $updateQuery->bindValue(':username', $username);
            $updateQuery->execute();
        } else {
            $uploadError = 'Error: The uploaded image is empty.';
        }
    } else {
        $uploadError = 'Error uploading the profile picture. Error code: ' . $image['error'];
    }

    header('Location: profile.php');
    exit();
}

// Returns a short version of the question text
function shortText($pdo, $questionId)
{
    $query = 'SELECT questiontext FROM question WHERE id = :id';
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $questionId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $text = $row['questiontext'];

    $limit = 230;

    if (strlen($text) > $limit) {
        $truncatedText = substr($text, 0, $limit) . '...';
        return $truncatedText;
    } else {
        return $text;
    }
}

// Generates pagination buttons
function generatePaginationButtons($totalPages, $currentPage)
{
    if ($totalPages > 1) {
        echo '<div class="container mt-4">';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<nav aria-label="Page navigation">';
        echo '<ul class="pagination justify-content-end">';

        // Generate previous page button
        if ($currentPage > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage - 1) . '">Previous</a></li>';
        }

        // Generate page buttons
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<li class="page-item ' . ($currentPage == $i ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        // Generate next page button
        if ($currentPage < $totalPages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a></li>';
        }

        echo '</ul>';
        echo '</nav>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
