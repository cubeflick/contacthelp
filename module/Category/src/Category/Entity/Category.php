<?php 

namespace Category\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id = null ;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @ORM\Column(name="parent_id",type="integer");
	 */ 

	protected $parentId;
	
	/**
	 * @ORM\Column(type="string")
	 */
	protected $description;
	
	/**
	 * Populate from an array.
	 *
	 * @param array $data
	 */
	public function populate($data = array())
	{
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->parentId = $data['parent_id'];
		$this->description = $data['description'];
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}

  /**
   * Returns the Identifier
   *
   * @access public
   * @return int
   */
	public function getId()
	{
		return $this->id;
	}	

	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}


	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getParentId()
	{
		return $this->parentId;
	}
	
}