<?php
require_once('model/Manager.php');

class PostManager extends Manager
{

  // Connection to the db (password = '' on WAMP; or 'root' on MAMP)
  function dbConnect() {
      $db = new PDO('mysql:host=localhost;dbname=TP_blog;charset=utf8', 'root', 'root');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
  }


  // Select ALL posts
  function getPosts() {
      $db = $this->dbConnect();

      $req = $db->prepare('SELECT id, title, content, 
      DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS billet_date_fr 
      FROM billets 
      ORDER BY date_creation 
      DESC LIMIT 0, 5');
      
      $req->execute();
      return $req;
  }

  // Select a post
  function getPost($postId) {
      $db = $this->dbConnect();

      $req = $db->prepare('SELECT id, title, content, 
      DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS billet_date_fr 
      FROM billets 
      WHERE id = ?');
      
      $req->execute(array($postId));
      return $req;
  }

}