<?php

namespace App\Table;



class Comments extends Table
{
	protected $table;

	public function getComments($id)
	{
		$comments = \App\App::getDb() -> prepare("SELECT comments.content, DATE_FORMAT(dateT, '%d/%m/%Y - %Hh%i') AS dateT, users.username AS username FROM {$this -> table} 
      JOIN users ON users.id = comments.users_id
      WHERE waiting = 0 AND posts_id = ?", $id, __CLASS__, $one = false);
		return $comments;
	}

	


public function addComment($options)
{
  foreach ($options as $key => $value) {
        $parts[] = "$key = ?";
        $attributes [] = $value;
      }
        $sql_parts = (implode(', ', $parts));
        if (isset($_SESSION['auth'])) {
          $sql_parts.= ', waiting = 0';
        }
        elseif (isset($_SESSION['visitor'])) {
          $sql_parts.= ', waiting = 1';
        }

      return \App\App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes, null);
}

public function showComments()
{
  $comments = \App\App::getDb() -> query("SELECT comments.id, comments.content AS content, posts.title AS title, users.username AS username
    FROM {$this -> table} 
    JOIN posts ON posts.id = comments.posts_id
    Join users ON users.id = comments.users_id
    WHERE waiting = 1", __CLASS__, $one = false);
    return $comments;
  }

public function showComment($id)
{
  $comment = \App\App::getDb() -> prepare("SELECT comments.id, comments.content AS content, posts.title AS title, users.username AS username
    FROM {$this -> table} 
    JOIN posts ON posts.id = comments.posts_id
    Join users ON users.id = comments.users_id
    WHERE comments.id =?", $id, __CLASS__);
  return $comment;
}

public function commentAccepted($id)
{
  $comment = \App\App::getDb() -> prepare("UPDATE {$this -> table} SET waiting = 0 WHERE id =?", $id);
  return $comment;
}

public function commentDenied($id)
{
  $comment = \App\App::getDb() -> prepare("DELETE FROM {$this -> table} WHERE id =?", $id);
  return $comment;
}



}