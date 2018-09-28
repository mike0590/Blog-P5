<?php

namespace App\Table;

class CategoriesManager
{

	private $table = 'categories';

	public function getCategory($id)
	{
		$category = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE idCategories = ?", $id, true, Categories::class);
		return $category;
	}

	public function catExist($id)
	{
		$category = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE idCategories =?", $id);
		if ($category) {
			return true;
		}
		else
			return false;
	}

	public function getCategories()
	{
		$datas = \App\App::getDb() -> query ("SELECT * FROM {$this -> table}", false, Categories::class);
		return $datas;
	}

	
    public function selectCategories()
    {
    	$datas = [];
        $categories = $this -> getCategories();
      
       foreach($categories as $category){
          $datas[] = array($category -> idCategories() => $category -> name());
        }
       return $datas;
	}
}

