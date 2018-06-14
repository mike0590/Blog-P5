<?php

namespace App\Table;



class Comments extends Table
{
	protected $table;

	public function getComments($id)
	{
		$comments = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE waiting = 0 AND posts_id = ?", $id, __CLASS__, $one = false);
		return $comments;
	}

	

	public function returnCommentBox()
	{
		return '<div class="card my-4">
            <h5 class="card-header">Laissez un Commentaire:</h5>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <textarea name="content" class="form-control" rows="3"></textarea></br>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
              </form>
          </div>
     </div>';
	}

  public function returnLogin()
  {
    return '<div class="card my-2" style="width:300px;">
            <h5 class="card-header">Votre Pseudo</h5></br>
            <div class="card-body">
              <form method="post">
                <div class="form-group">
                  <input type="text" name="pseudo" class="form-control"></input></br>
                  <h5 class="card-header">Votre mot de pass:</h5><br>
                  <input type="password" name="pass" class="form-control"></input>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
              </form>
          </div>
     </div>';
  }


public function addComment($options)
{
  foreach ($options as $key => $value) {
        $parts[] = "$key = ?";
        $attributes [] = $value;
      }
        $sql_parts = (implode(', ', $parts));
        $sql_parts.= ', waiting = 1';

      return \App\App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts", $attributes, null);
}

public function showComments()
{
  $comments = \App\App::getDb() -> query("SELECT * FROM {$this -> table} WHERE waiting = 1", __CLASS__, $one = false);
    return $comments;
  }

public function showComment($id)
{
  $comment = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE id =?", $id, __CLASS__);
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