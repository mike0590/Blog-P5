<?php

namespace App\Table;

class PostsManager 
{

/**
 * [variable representant la table Posts en BDD]
 * @var string
 */
protected $table = "posts";


	public function db()
	{
		$db = \App\App::getDb();
		return $db;
	}

	/**
	 * [affichage des different posts]
	 * @return [array] [tableau d'objets de la class Posts]
	 */
	public function getPosts()
	{
		$datas = $this -> db() -> query ("SELECT *, DATE_FORMAT(dateT, '%d/%m/%Y') AS dateT, 
			DATE_FORMAT(dateT, '%Y/%m/%d') AS dateR  
			FROM {$this -> table} ORDER BY dateT DESC", false, Posts::class);

		if ($datas) {
			return $datas;
		} else{
			return false;
		}
	}


	/**
	 * [recuperer un post en particulier]
	 * @param  [int] $id [id du post]
	 * @return [obj]      [objet de class Posts]
	 */
	public function getPost($id)
	{
		$data = $this -> db() -> prepare("SELECT posts.idPosts, posts.title, posts.content, posts.chapo, DATE_FORMAT(dateT, '%d/%m/%Y') AS dateT, DATE_FORMAT(dateUpdate, '%d/%m/%Y - %Hh%i') AS dateUpdate, users.username
			FROM {$this -> table} 
			JOIN users ON users.idUsers = posts.user_id 
			WHERE posts.idPosts = ?", $id, true, Posts::class);

		if ($data) {
			return $data;
		} else{
			return false;
		}
	}


	/**
	 * [affichage des différents posts d une categorie particuliere]
	 * @param  [int] $id [id de la categorie]
	 * @return [array]     [tableau d objets de class Posts]
	 */
	public function getPostsPerCat($id)
	{
		$datas = $this -> db() -> prepare("SELECT posts.idPosts, posts.title, posts.chapo, posts.content, categories.idCategories, categories.name
			 FROM {$this -> table}
			 JOIN categories ON categories.idCategories = posts.category_id
			 WHERE posts.category_id = ?", $id, false, Posts::class);
		
		if ($datas) {
			return $datas;
		} else{
			return false;
		}
	}

	
	 /**
	 * [categorie d un post en particulier]
	 * @param  [int] $postId [id du post]
	 * @return [obj]         [objet de class Posts]
	 */
	public function categoryPost($postId)
    {
    	$data = $this -> db() -> prepare("SELECT posts.idPosts, posts.category_id, categories.name, 
    		categories.idCategories 
    		FROM {$this -> table} 
    		JOIN categories ON categories.idCategories = posts.category_id
    		WHERE posts.idPosts = ?", $postId, true, Posts::class);
    		
		if ($data) {
			return $data;
		} else{
			return false;
		}
	}

    
    /**
     * [afiche tous les titres d articles, ainsi que ses auteurs, dates, categories respectifs]
     * @return [array] [tableau d objets de class Posts]
     */
	public function getAll()
	{
		$datas = $this -> db() -> query("SELECT posts.idPosts, posts.title, posts.content, 
			posts.dateT, posts.category_id, categories.name, users.username 
			FROM {$this -> table}
			JOIN categories ON categories.idCategories = posts.category_id
			JOIN users ON users.idUsers = posts.user_id", false, Posts::class);

		if ($datas) {
			return $datas;
		} else{
			return false;
		}
	}


	/**
	 * [met a jour un article en particulier (titre,contenu,auteur,categorie)]
	 * @param  [int] $id     [id de l article]
	 * @param  [array] $modifs [tableau contenant les modifications]
	 * @return [void]         [insere la mis a jour en BDD]
	 */
	public function update($id, $modifs)
    {
    		
    	foreach ($modifs as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    		$attributes[] = $id;
    		$sql_parts = (implode(',', $parts));
    	return $this -> db() -> prepare("UPDATE {$this -> table} SET $sql_parts, dateUpdate = NOW() WHERE idPosts = ?", $attributes, null, true);
	}


	/**
	 * [ajoute un nouvel article en bdd]
	 * @param  [array] $options [tableau contenant toust le contenu d un article(titre,contenu,etc..)]
	 * @return [void]          [insere le nouvel article en bdd]
	 */
	public function create($options)
    {
    		
    	foreach ($options as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    		$sql_parts = (implode(', ', $parts));
    	return $this -> db() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes, true);
	}


	/**
	 * [supprime un article en particulier]
	 * @param  [int] $id [id de l article]
	 * @return [void]     [supprine l article de la bdd]
	 */
	public function delete($id)
    {
    		
    	return $this -> db() -> prepare("DELETE FROM {$this -> table} WHERE idPosts = ?", $id, true);
	}
}









