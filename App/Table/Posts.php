<?php

namespace App\Table;

class Posts extends Table
{
	protected $table;


	public function getUrl()
	{
		return 'index.php?p=single&id=' .$this -> id;
	}

	public function postExist($id)
	{
		$post = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE id =?", $id, get_called_class());
		if ($post) {
			return true;
		}
		else
			return false;
	}

	public function getPost($id)
	{
		return \App\App::getDb() -> prepare("SELECT posts.id, posts.title, posts.content, posts.chapo, DATE_FORMAT(dateT, '%d/%m/%Y') AS dateT, DATE_FORMAT(dateUpdate, '%d/%m/%Y - %Hh%i') AS dateUpdate, users.username AS author 
			FROM {$this -> table} 
			JOIN users ON users.id = posts.user_id 
			WHERE posts.id = ?", $id);
	}

	public function getPostsPerCat($id)
	{
		$post = \App\App::getDb() -> prepare("SELECT posts.id, posts.title, posts.chapo, posts.content, posts.category_id, categories.id AS category FROM {$this -> table}
			 JOIN categories ON categories.id = posts.category_id
			 WHERE posts.category_id = ?", $id, __CLASS__, $one = false);
		return $post;
	}

	public function getPosts()
	{
		return \App\App::getDb() -> query ("SELECT *, DATE_FORMAT(dateT, '%d/%m/%Y') AS dateT  FROM {$this -> table} ORDER BY dateT DESC", get_called_class(), $one = false);
	}

	 public function categoryPost($postId)
    {
    	return \App\App::getDb() -> prepare("SELECT posts.id, categories.id AS idCat, categories.name AS name
    		FROM {$this -> table} 
    		JOIN categories ON categories.id = posts.category_id
    		WHERE posts.id = ?", $postId, get_called_class(), $one = true);

    }


}