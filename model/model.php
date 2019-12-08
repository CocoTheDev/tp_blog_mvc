<?php


// Connection to the db (password = '' on WAMP; or 'root' on MAMP)
function dbConnect() {
    try
        {
            $db = new PDO('mysql:host=localhost;dbname=TP_blog;charset=utf8', 'root', 'root');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }
    catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
}


// Select ALL posts
function getPosts() {
    $db = dbConnect();

    $req = $db->prepare('SELECT id, title, content, 
    DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS billet_date_fr 
    FROM billets 
    ORDER BY date_creation 
    DESC LIMIT 0, 5');
    
    $req->execute();
    $posts = $req;
    return $posts;
}

// Select a post
function getPost($postId) {
    $db = dbConnect();

    $req = $db->prepare('SELECT id, title, content, 
    DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS billet_date_fr 
    FROM billets 
    WHERE id = ?');
    
    $req->execute(array($postId));
    $post = $req;
    return $post;
}

// Select Comments
function getComments($postId) {
    $db = dbConnect();

    $req = $db->prepare('SELECT id, author, comment, 
    DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr 
    FROM comments 
    WHERE post_id = ?
    ORDER BY comment_date DESC');
    
    $req->execute(array($postId));
    $comments = $req;
    return $comments;
}