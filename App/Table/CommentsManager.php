<?php

namespace App\Table;

class CommentsManager
{
	
    private $table = 'comments';

  public function getComments($id)
  {
    $datas = \App\App::getDb() -> prepare("SELECT comments.content, users.username,  DATE_FORMAT(dateT, '%d/%m/%Y - %Hh%i') AS dateT,  DATE_FORMAT(dateT, '%Y/%m/%d - %Hh%i') AS dateTri
      FROM {$this -> table} 
      JOIN users ON users.idUsers = comments.users_id
      WHERE waiting = 0 AND posts_id = ? ORDER BY dateTri DESC", $id, false, Comments::class);
    
    return $datas;
  }


    public function addComment($options)
    {
      foreach ($options as $key => $value) {
          $parts[] = "$key = ?";
          $attributes [] = $value;
        }
          $sql_parts = (implode(', ', $parts));
          $sql_parts.= ', waiting = 1';

        return \App\App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes);
    }

    public function showComments()
    {
      $datas = \App\App::getDb() -> query("SELECT comments.idComments, comments.content, posts.title, users.username
      FROM {$this -> table} 
      JOIN posts ON posts.idPosts = comments.posts_id
      Join users ON users.idUsers = comments.users_id
      WHERE waiting = 1", false, Comments::class);
    
      return $datas;
    }

    public function showComment($id)
    {
      $data = \App\App::getDb() -> prepare("SELECT comments.idComments, comments.content, posts.title, users.username
      FROM {$this -> table} 
      JOIN posts ON posts.idPosts = comments.posts_id
      Join users ON users.idUsers = comments.users_id
      WHERE comments.idComments =?", $id, true, Comments::class);

      return $data;
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