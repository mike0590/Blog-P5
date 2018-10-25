<?php

namespace App\Table;

class CategoriesManager
{

	 /**
     * [propriete representant la table categories en BDD]
     * @var string
     */
	private $table = 'categories';

	/**
	 * [renvoie une categorie en particulier]
	 * @param  [int] $id [id de la categorie]
	 * @return [obj]     
	 */
	public function getCategory($id)
	{
		$category = \App\App::getDb() -> prepare("SELECT * FROM {$this -> table} WHERE idCategories = ?", $id, true, Categories::class);
		if ($category) {
			return $category;
		} else{
			return false;
		}
	}

	/**
	 * [renvoie la liste des categories existantes]
	 * @return [obj] 
	 */
	public function getCategories()
	{
		$datas = \App\App::getDb() -> query ("SELECT * FROM {$this -> table}", false, Categories::class);
		if ($datas) {
			return $datas;
		} else{
			return false;
		}
	}

	/**
	 * [renvoie un tableau avec l id de la categorie comme cle et et son nom comme valeure]
	 * @return [array obj] 
	 */
    public function selectCategories()
    {
    	$datas = [];
        $categories = $this -> getCategories();
      
       foreach($categories as $category){
          $datas[] = array($category -> idCategories() => $category -> name());
        }

       if ($categories) {
       	return $datas;
       } else{
       	return false;
       }
	}
}

