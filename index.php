<?php
ini_set('display_errors', 'on'); 
error_reporting(E_ALL);

require('controller/post.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception("Le post selectionné n'existe pas.");
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                $postId = nl2br(htmlspecialchars($_GET['id']));
                $author = nl2br(htmlspecialchars($_POST['author']));
                $comment = nl2br(htmlspecialchars($_POST['comment']));
                comment($postId,$author, $comment);
            }
            else {
                throw new Exception("Tous les champs doivent être remplis");
            }
        }
        elseif ($_GET['action'] == 'editComment') {
            if (!empty($_POST['commentId'])) {
                $commentId = nl2br(htmlspecialchars($_POST['commentId']));
                $comment = nl2br(htmlspecialchars($_POST['comment']));
                editComment($commentId, $comment);
            }
            else {
                throw new Exception("Commentaire non selectionné");
            }
        }
        elseif ($_GET['action'] == 'updateComment') {
            if (!empty($_POST['commentNew'])) {
                $commentId = nl2br(htmlspecialchars($_GET['commentId']));
                $commentNew = nl2br(htmlspecialchars($_POST['commentNew']));
                updateComment($commentId, $commentNew);
            }
            else {
                throw new Exception("Édition du commentaire non valide");
            }
        }
        else {
            throw new Exception("Nous n'avons pas comprit votre requête.");
        }

    }
    else {
        listPosts();
    }
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}
