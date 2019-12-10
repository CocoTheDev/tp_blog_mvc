<?php
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/post/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/post/postView.php');
}

function comment($postId, $author, $comment) {

    $commentManager = new CommentManager();

    $postId = htmlspecialchars($_GET['id']);
    $author = htmlspecialchars($_POST['author']);
    $comment = nl2br(htmlspecialchars($_POST['comment']));

    $store = $commentManager->addComment($postId, $author, $comment);

    if ($store == false) {
        throw new Exception("Impossible d'ajouter le commentaire !");
    }

    $redirectTo = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    header('Location: '.$redirectTo);

    require('view/post/postView.php');   
}

// View Edit Page Variable Needed
function editComment ($commentId, $comment) {
    $commentId = nl2br(htmlspecialchars($commentId));
    $comment = nl2br(htmlspecialchars($comment));

    require ('view/comment/editComment.php');
}

function updateComment ($commentId, $commentNew) {
    $commentManager = new CommentManager();

    $commentId = nl2br(htmlspecialchars($commentId));
    $commentNew = nl2br(htmlspecialchars($commentNew));

    $store = $commentManager->updateComment($commentId, $commentNew);

    if ($store == false) {
        throw new Exception("Impossible d'ajouter le commentaire !");
    }

    header('Location:index.php');
    require ('view/comment/editComment.php');
}

function deleteComment ($commentId) {
    $commentManager = new CommentManager();

    $commentId = nl2br(htmlspecialchars($commentId));

    $store = $commentManager->deleteComment($commentId);

    if ($store == false) {
        throw new Exception("Impossible de supprimer le commentaire !");
    }

    header('Location:index.php');
    require ('view/post/postView.php');
}