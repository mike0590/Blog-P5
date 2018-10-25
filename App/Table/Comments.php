<?php

namespace App\Table;

class Comments 
{
    
    /**
     * [propriete idComments de la table comments en BDD]
     * @var int
     */
    private $idComments;

    /**
     * [propriete $content de la table comments en BDD]
     * @var string
     */
    private $content;

    /**
     * [propriete dateT de la table comments en BDD]
     * @var date
     */
    private $dateT;

    /**
     * [propriete waiting de la table comments en BDD]
     * @var int
     */
    private $waiting;


    /**
     * [retourne l id d un commentaire]
     * @return [int] 
     */
    public function idComments()
    {
      return $this -> idComments;
    }

    /**
     * [retourne le contenu d un commentaire]
     * @return [string] 
     */
    public function content()
    {
      return $this -> content;
    }

    /**
     * [retourne la date de creation d un commentaire]
     * @return [date] 
     */
    public function dateT()
    {
      return $this -> dateT;
    }

    /**
     * [retourne la valeur de waiting qui signifie si un commentaire est en attente ou non]
     * @return [int] 
     */
    public function waiting()
    {
      return $this -> waiting;
    }

    /**
     * [instancie la class DbAuth et lui envoie un username comme parametre]
     * @return [obj] 
     */
    public function getUsers()
    {
        $users = new \App\Auth\DbAuth();
        if (isset($this -> username)) {
            $users -> setUsername($this -> username);
        }

        return $users;
    }

    /**
     * [instancie la class categories et lui envoie un nom de categorie et id de categorie en parametre comme parametre]
     * @return [obj] 
     */
    public function getPosts()
    {
        $posts = \App\App::getInstance() -> getTable('posts');
        if (isset($this -> title)) {
            $posts -> setTitle($this -> title);
        }

        return $posts;
    }
}