<?php 

namespace App\Html;




class Form
{
	
	
	private $data;
	private $surround = 'p';

	public function __construct($data = array())
	{
		$this -> data = $data;
	}

	public function input($name, $label = null, $options = [])
	{
		if (isset($options['type'])) {
			$type = $options['type'];
		}
		else{
			$type = 'text';
		}
		$label = "<h4>" .$label. "</h4></br>";
		if ($type === 'textarea') {
			$input = '<textarea  name="' .$name.'" class="form-control">' .$this -> getValue($name).'</textarea></br>';
		}
		else{
			$input = '<input type="' .$type. '" name="' .$name. '" class="form-control" value="' .$this -> getValue($name). '"</input></br>';
		}
		return $this -> surround($label . $input);
	}

	

	public function surround($html)
	{
		return "<{$this -> surround}> {$html} </{$this -> surround}>";
	}

	private function getvalue($index)
	{
		if(is_object($this -> data)){
			return $this -> data -> $index;
		}
		if (isset($this -> data[$index])) {
			return $this -> data[$index];
		}
		else
		{
			return null;
		}
	}

	public function submit($options)
	{
		echo '<button class="btn btn-primary" type="submit">' .$options. '</button></br>';
	}

	
	
}






