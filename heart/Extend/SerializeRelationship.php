<?php namespace Qdiscuss\Extend;

use Qdiscuss\Application;
use Closure;

class SerializeRelationship implements ExtenderInterface
{
	protected $parent;

	protected $type;
	
	protected $name;
	
	protected $child;
	
	public function __construct($parent, $type, $name, $child = null)
	{
		$this->parent = $parent;
		$this->type = $type;
		$this->name = $name;
		$this->child = $child;
	}
	
	public function extend(Application $app)
	{
		$parent = $this->parent;
		$parent::addRelationship($this->name, function ($serializer) {
			if ($this->type instanceof Closure) {
				return $this->type();
			} else {
				return $serializer->{$this->type}($this->child, $this->name);
			}
		});
	}

}