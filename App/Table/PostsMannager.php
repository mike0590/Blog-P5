<?php

namespace App\Table;

class PostsMannager 

{
	protected $table = "posts";


	
public function getPosts()
	{
		$posts = [];
		$datas = \App\App::getDb() -> query ("SELECT *, DATE_FORMAT(dateT, '%d/%m/%Y') AS dateT  FROM {$this -> table} ORDER BY dateT DESC", $one = false);
		foreach ($datas as $data) {
			$posts[] = new \App\Table\Posts($data);
		}

		return $posts;
		
	}


	public function postExist($id)
	{
		$post = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE idPosts =?", $id);
		if ($post) {
			return true;
		}
		else
			return false;
	}

	public function getPost($id)
	{
		$data = \App\App::getDb() -> prepare("SELECT posts.idPosts, posts.title, posts.content, posts.chapo, DATE_FORMAT(dateT, '%d/%m/%Y') AS dateT, DATE_FORMAT(dateUpdate, '%d/%m/%Y - %Hh%i') AS dateUpdate, users.username
			FROM {$this -> table} 
			JOIN users ON users.idUsers = posts.user_id 
			WHERE posts.idPosts = ?", $id);
		$user = new \App\Auth\DbAuth($data);
		$post = new \App\Table\Posts($data);
		$post -> setUsers($user);

		return $post;
	}

	public function getPostsPerCat($id)
	{
		$posts = [];
		$datas = \App\App::getDb() -> prepare("SELECT posts.idPosts, posts.title, posts.chapo, posts.content, categories.idCategories, categories.name
			 FROM {$this -> table}
			 JOIN categories ON categories.idCategories = posts.category_id
			 WHERE posts.category_id = ?", $id, $one = false);

		foreach($datas as $data)
		{
			$categories = new \App\Table\Categories($data);
			$post = new \App\Table\Posts($data);
			$post -> setCategories($categories);
			$posts [] = $post;
		}
		
		return $posts;

	}

	

	 public function categoryPost($postId)
    {
    	$data = \App\App::getDb() -> prepare("SELECT posts.idPosts, posts.category_id, categories.name
    		FROM {$this -> table} 
    		JOIN categories ON categories.idCategories = posts.category_id
    		WHERE posts.idPosts = ?", $postId, $one = true);
    	$categorie = new \App\Table\Categories($data);
    	$post = new \App\Table\Posts($data);
    	$post -> setcategories($categorie);
    	
    	return $post;

    }

    
	public function getAll()
	{
		$posts = [];
		$datas = \App\App::getDb() -> query("SELECT posts.idPosts, posts.title, posts.content, 
									 posts.dateT, posts.category_id, categories.name, 
									 users.username
									 FROM {$this -> table}
									 JOIN categories ON categories.idCategories = posts.category_id
									 JOIN users ON users.idUsers = posts.user_id"
									 , $one = false);

		foreach($datas as $data)
		{
			$categorie = new \App\Table\Categories($data);
			$user = new \App\Auth\DbAUth($data);
			$post = new \App\Table\Posts($data);
			$post -> setCategories($categorie);
			$post -> setUsers($user);
			$posts [] = $post;
		}

		return $posts;


	}


	public function update($id, $modifs)
    {
    		
    	foreach ($modifs as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    		$attributes[] = $id;
    		$sql_parts = (implode(',', $parts));
    	return \App\App::getDb() -> prepare("UPDATE {$this -> table} SET $sql_parts, dateUpdate = NOW() WHERE idPosts = ?", $attributes, null, true);
	}


	public function create($options)
    {
    		
    	foreach ($options as $key => $value) {
    		$parts[] = "$key = ?";
    		$attributes [] = $value;
    	}
    		$sql_parts = (implode(', ', $parts));
    	return \App\App::getDb() -> prepare("INSERT INTO {$this -> table} SET $sql_parts, dateT = NOW()", $attributes, null);
	}


	public function delete($id)
    {
    		
    	return \App\App::getDb() -> prepare("DELETE FROM {$this -> table} WHERE id = ?", $id, null, true);
	}




}









