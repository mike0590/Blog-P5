<?php

namespace App\Table;



class Comments extends Entity
{
  
  private $idComments;
  private $content;
  private $dateT;
  private $posts_id;
  private $users_id;
  private $waiting;
  private $users;
  private $posts;


  public function __construct(array $data)
  {
    parent::__construct($data);
  }


  public function idComments()
  {
    return $this -> idComments;
  }

  public function content()
  {
    return $this -> content;
  }

  public function dateT()
  {
    return $this -> dateT;
  }

  public function posts_id()
  {
    return $this -> posts_id;
  }

  public function users_id()
  {
    return $this -> users_id;
  }

  public function waiting()
  {
    return $this -> waiting;
  }

  public function users()
  {
    return $this -> users;
  }

  public function posts()
  {
    return $this -> posts;
  }

 

  public function setIdComments($data)
  {
    if (!is_int($data)) {
      $this -> idComments = $data;
    }
    
  }

  public function setContent($data)
  {
    $this -> content = $data;
  }

  public function setDateT($data)
  {
    $this -> dateT = $data;
  }

  public function setPosts_id($data)
  {
    $this -> posts_id = $data;
  }

  public function setUsers_id($data)
  {
    $this -> users_id = $data;
  }

  public function setWaiting($data)
  {
    $this -> waiting = $data;
  }

  public function setUsers($data)
  {
    $this -> users = $data;
  }

  public function setPosts($data)
  {
    $this -> posts = $data;
  }



  



}