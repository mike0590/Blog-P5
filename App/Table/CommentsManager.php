<?php

namespace App\Table;

class CommentsManager
{
	  
    /**
     * [propriete representant la table comments en BDD]
     * @var string
     */
    private $table = 'comments';

  /**
   * [renvoie tous les commentaires d un post]
   * @param  [int] $id [id du post]
   * @return [tableau d obj]     
   */
  public function getComments($id)
  {
    $datas = \App\App::getDb() -> prepare("SELECT comments.content, users.username,  
      DATE_FORMAT(dateT, '%d/%m/%Y - %Hh%i') AS dateT,  DATE_FORMAT(dateT, '%Y/%m/%d - %Hh%i') AS dateTri
      FROM {$this -> table} 
      JOIN users ON users.idUsers = comments.users_id
      WHERE waiting = 0 AND posts_id = ? ORDER BY dateTri DESC", $id, false, Comments::class);
    
    if ($datas) {
      return $datas;
    } 
    return false;
  }

     /**
     * [additionner un commentaire]
     * @param [array] contenu, id du post et id du visiteur qui introduit le commentaire
     */
    public function addComment($options)
    {
      foreach ($options as $key => $value) {
          $parts[] = "$key = ?";
          $attributes [] = $value;
        }
          $sql_parts = (implode(', ', $parts));
          $sql_parts.= ', waiting = 1';

         \App\App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes);
    }

    /**
     * [Montrer les commentaires qui sont en attente]
     * @return [array obj] 
     */
    public function showComments()
    {
      $datas = \App\App::getDb() -> query("SELECT comments.idComments, comments.content, posts.title, users.username
      FROM {$this -> table} 
      JOIN posts ON posts.idPosts = comments.posts_id
      Join users ON users.idUsers = comments.users_id
      WHERE waiting = 1", false, Comments::class);
    
      if ($datas) {
      return $datas;
    } 
      return false;
    }

    /**
     * [renvoie un commentaire en attente en particulier]
     * @param  [int] $id [id du commentaire]
     * @return [obj]     
     */
    public function showComment($id)
    {
      $data = \App\App::getDb() -> prepare("SELECT comments.idComments, comments.content, posts.title, 
      users.username 
      FROM {$this -> table} 
      JOIN posts ON posts.idPosts = comments.posts_id
      Join users ON users.idUsers = comments.users_id
      WHERE comments.idComments =?", $id, true, Comments::class);

      if ($data) {
      return $data;
    } 
      return false;
    }

    /**
     * [accepte un commentaire]
     * @param  [int] $id [id du commentaire]
     * @return [void]     
     */
    public function commentAccepted($id)
    {
      $comment = \App\App::getDb() -> prepare("UPDATE {$this -> table} SET waiting = 0 WHERE idComments =?", $id);
    }

     /**
     * [refuse un commentaire]
     * @param  [int] $id [id du commentaire]
     * @return [void]     
     */
    public function commentDenied($id)
    {
      $comment = \App\App::getDb() -> prepare("DELETE FROM {$this -> table} WHERE idComments =?", $id);
    }
}