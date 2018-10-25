<?php 

namespace App\Html;

class Form
{

	/**
	 * [variable representant une tag]
	 * @var string
	 */
	private $surround = 'p';

	private $data;

	/**
	 * [constructeur qui permet aux methodes de recuperer certaines valeures ]
	 * @param array $data 
	 */
	public function __construct($data = array())
	{
		$this -> data = $data;
	}

	/**
	 * [renvoie du code html des balises input, textarea..]
	 * @param  [string] $name    [attribut nom de la balise input ou texarea]
	 * @param  [string] $label   [attribut label de la balise input ou texarea]
	 * @param  array  $options [definit quel type d input il s agit..text,password,textarea,etc..]
	 * @return code html
	 */
	public function input($name, $label = null, $options = [])
	{
		if (isset($options['type'])) {
			$type = $options['type'];
		} else {
			$type = 'text';
		}
		$label = "<h4>" .$label. "</h4></br>";
		if ($type === 'textarea') {
			$input = '<textarea  name="' .$name.'" class="form-control">' .$this -> getValue($name).'</textarea></br>';
		} elseif ($type === 'textareaB') {
			$input = '<textarea style="height:300px;"  name="' .$name.'" class="form-control">' .$this -> getValue($name).'</textarea></br>';
		} else {
			$input = '<input type="' .$type. '" name="' .$name. '" class="form-control" value="' .$this -> getValue($name). '"</input></br>';
		}
		return $this -> surround($label . $input);
	}

	/**
	 * [renvoie tout le code html genere entre les balises]
	 * @param  [html] $html [code html qui sera insere entre les balises]
	 * @return [html]       
	 */
	public function surround($html)
	{
		return "<{$this -> surround}> {$html} </{$this -> surround}>";
	}

	/**
	 * [capte une valeure passee dans le constructeur]
	 * @param  [type] $index [description]
	 * @return [type]        [description]
	 */
	private function getvalue($index)
	{
		if(is_object($this -> data)){
			return $this -> data -> $index();
		}
		if (isset($this -> data[$index])) {
			return $this -> data[$index];
		} else {
			return null;
		}
	}

	/**
	 * [affiche une valeure au nom du bouton]
	 * @param  [string] $options [nom du bouton]
	 * @return [string]     
	 */
	public function submit($options)
	{
		echo '<button class="btn btn-primary" type="submit">' .$options. '</button>';
	}

	/**
	 * [renvoie une balise select]
	 * @param  [string] $name           [attribut nom de la balise select]
	 * @param  [string] $label          [attribut label de la balise select]
	 * @param  array  $options        [les selections]
	 * @param  [int] $categoryPostId [id d une categorie]
	 * @param  [string] $categoryPost   [nom d une categorie]
	 * @return [html]               
	 */
	public function select($name, $label = null, $options = [], $categoryPostId = null, $categoryPost = null)
	{
		$label = '<label>' .$label. '</label></br>';
		$input = '<select class="form-control" name="' .$name. '">';
		foreach ($options as $option) {
			foreach ($option as $key => $value) {
				if($key == $categoryPostId){
				$input.= "<option value='$categoryPostId' selected>" .$categoryPost. "</option>";
			} else{
				$input.= "<option value='$key'>$value</option>";
			}
				
			}
			
		}
		$input.= '</select></br>';
		return $this -> surround($label . $input);
	}
}






