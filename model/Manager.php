<?php
class Manager {


    // Connection to the db (password = '' on WAMP; or 'root' on MAMP)
    protected function dbConnect() {
      $db = new PDO('mysql:host=localhost;dbname=TP_blog;charset=utf8', 'root', 'root');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
  }

}