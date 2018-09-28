<?php

namespace App\Table;

class Comments 
{
  
    private $idComments;
    private $content;
    private $dateT;
    private $posts_id;
    private $users_id;
    private $waiting;


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
}