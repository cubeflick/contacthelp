<?php 

namespace Category\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="category")
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
	protected $cname;

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
		$this->cname = $data['cname'];
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
		return $this->cname;
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
	
	public function getParent()
	{
		return $this->parent;
	}
	
	public function getChildren()
	{
		return $this->children;
	}
	
	
	
    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    public function __construct() {
    	$this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }    
}