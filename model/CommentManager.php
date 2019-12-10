<?php
require_once('model/Manager.php');

class CommentManager extends Manager
{

// Select Comments
function getComments($postId) {
    $db = $this->dbConnect();

    $req = $db->prepare('SELECT id, author, comment, 
    DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr 
    FROM comments 
    WHERE post_id = ?
    ORDER BY comment_date DESC');
    
    $req->execute(array($postId));
    return $req;
}

function addComment ($postId,$author, $comment) {
    $db = $this->dbConnect();
    
    $req = $db->prepare('INSERT INTO `comments`(`post_id`, `author`, `comment`) VALUES (:post_id, :author, :comment)');

    $req->execute(array(
        "post_id" => $postId,
        "author" => $author, 
        "comment" => $comment
        ));

    return $req;
}

function updateComment ($commentId, $commentNew) {
    $db = $this->dbConnect();

    $req = $db->prepare('
    UPDATE comments 
    SET comment = :commentNew 
    WHERE ID = :commentId 
    ');

    $req->execute(array(
    'commentNew' => $commentNew,
    'commentId' => $commentId
    ));

    return $req;
}

function deleteComment ($commentId) {
    $db = $this->dbConnect();

    $req = $db->prepare('
    DELETE FROM comments 
    WHERE ID = :commentId 
    ');

    $req->execute(array(
    'commentId' => $commentId
    ));

    return $req;
}

}