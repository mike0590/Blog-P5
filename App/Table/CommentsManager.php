<?php

namespace App\Table;

class CommentsManager
{
	
    private $table = 'comments';

  	public function getComments($id)
  {
    $comments = [];

    $datas = \App\App::getDb() -> prepare("SELECT comments.content, users.username,  DATE_FORMAT(dateT, '%d/%m/%Y - %Hh%i') AS dateT,  DATE_FORMAT(dateT, '%Y/%m/%d - %Hh%i') AS dateR
      FROM {$this -> table} 
      JOIN users ON users.idUsers = comments.users_id
      WHERE waiting = 0 AND posts_id = ? ORDER BY dateR DESC", $id, $one = false);
    
    foreach($datas as $data)
    {
      $user = new \App\Auth\DbAuth($data);
      $comment = new \App\Table\Comments($data);
      $comment -> setUsers($user);
      $comments[] = $comment;
    }
    return $comments;
  }


    	public function addComment($options)
    {
      foreach ($options as $key => $value) {
            $parts[] = "$key = ?";
            $attributes [] = $value;
          }
            $sql_parts = (implode(', ', $parts));
            $sql_parts.= ', waiting = 1';

          return \App\App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes, null);
    }

    public function showComments()
    {
      $comments = [];
      $datas = \App\App::getDb() -> query("SELECT comments.idComments, comments.content, posts.title, users.username
        FROM {$this -> table} 
        JOIN posts ON posts.idPosts = comments.posts_id
        Join users ON users.idUsers = comments.users_id
        WHERE waiting = 1", $one = false);
        foreach ($datas as $data) {
          $post = new \App\Table\Posts($data);
          $user = new \App\Auth\DbAuth($data);
          $comment = new \App\Table\Comments($data);
          $comment -> setPosts($post);
          $comment -> setUsers($user);
          $comments[] = $comment;
        }
        return $comments;
      }

    public function showComment($id)
    {
      $data = \App\App::getDb() -> prepare("SELECT comments.idComments, comments.content, posts.title, users.username
        FROM {$this -> table} 
        JOIN posts ON posts.idPosts = comments.posts_id
        Join users ON users.idUsers = comments.users_id
        WHERE comments.idComments =?", $id);

      $post = new \App\Table\Posts($data);
      $user = new \App\Auth\DbAuth($data);
      $comment = new \App\Table\Comments($data);
      $comment -> setPosts($post);
      $comment -> setUsers($user);
      return $comment;
    }

    public function commentAccepted($id)
    {
      $comment = \App\App::getDb() -> prepare("UPDATE {$this -> table} SET waiting = 0 WHERE idComments =?", $id);
      return $comment;
    }

    public function commentDenied($id)
    {
      $comment = \App\App::getDb() -> prepare("DELETE FROM {$this -> table} WHERE idComments =?", $id);
      return $comment;
    }
}