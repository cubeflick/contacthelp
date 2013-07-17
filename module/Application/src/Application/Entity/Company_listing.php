<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company_listing")
 */

class Company_listing {
	/**
	 * @ORM\c_id
	 * @ORM\Column(type="integer");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $c_id = null ;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $c_name;

	/**
	 * @ORM\Column(name="sub_category1",type="varchar");
	 */

	protected $sub_category1;
	/**
	 * @ORM\Column(name="sub_category2",type="varchar");
	 */

	protected $sub_category2;

	/**
	 * @ORM\Column(name="sub_category3",type="varchar");
	 */

	protected $sub_category3;

	/**
	 * @ORM\Column(name="company_url",type="varchar");
	 */

	protected $company_url;

	/**
	 * @ORM\Column(name="department",type="varchar");
	 */

	protected $department;

	/**
	 * @ORM\Column(name="phone_number",type="varchar");
	 */

	protected $phone_number;

	/**
	 * @ORM\Column(name="step_to_reach",type="varchar");
	 */

	protected $step_to_reach;

	/**
	 * @ORM\Column(name="customer_service_link",type="varchar");
	 */

	protected $customer_service_link;

	/**
	 * @ORM\Column(name="customer_support_email",type="varchar");
	 */

	protected $customer_support_email;

	/**
	 * @ORM\Column(name="operation_hours",type="varchar");
	 */

	protected $operation_hours;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $description;

	/**
	 * @ORM\Column(name="additional_note",type="varchar");
	 */

	protected $additional_note;

	/**
	 * @ORM\Column(name="user_name",type="varchar");
	 */

	protected $user_name;

	/**
	 * @ORM\Column(name="user_email",type="varchar");
	 */

	protected $user_email;

	/**

	/**

	/**




	/**
	* Populate from an array.
	*
	* @param array $data
	*/
	public function populate($data = array())
	{
		$this->c_id = $data['c_id'];
		$this->c_name = $data['_cname'];
		$this->sub_category1 = $data['sub_category1'];
		$this->sub_category2 = $data['sub_category2'];
		$this->sub_category3 = $data['sub_category3'];
		$this->company_url = $data['company_url'];
		$this->department = $data['department'];
		$this->phone_number = $data['phone_number'];
		$this->step_to_reach = $data['step_to_reach'];
		$this->customer_service_link = $data['customer_service_link'];
		$this->customer_support_email = $data['customer_support_email'];
		$this->operation_hours = $data['operation_hours'];
		$this->description = $data['description'];
		$this->additional_note = $data['additional_note'];
		$this->user_name = $data['user_name'];
		$this->user_email = $data['user_email'];

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
	public function getC_id()
	{
		return $this->c_id;
	}
	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getC_name()
	{
		return $this->c_name;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSub_category1()
	{
		return $this->sub_category1;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSub_category2()
	{
		return $this->sub_category2;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSub_category3()
	{
		return $this->sub_category3;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCompany_url()
	{
		return $this->company_url;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getDepartment()
	{
		return $this->department;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getPhone_number()
	{
		return $this->phone_number;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getStep_to_reach()
	{
		return $this->step_to_reach;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCustomer_service_link()
	{
		return $this->customer_service_link;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCustomer_support_email()
	{
		return $this->customer_support_email;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getOperation_hours()
	{
		return $this->operation_hours;
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
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getAdditional_note()
	{
		return $this->additional_note;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUser_name()
	{
		return $this->user_name;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUser_emaile()
	{
		return $this->user_email;
	}

	//     /**
	//      * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
	//      */
	//     private $children;

	//     /**
	//      * @ORM\ManyToOne(targetEntity="Category",inversedBy="children")
	//      * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	//      */
	//     private $parent;

	//     public function __construct() {
	//     	$this->children = new \Doctrine\Common\Collections\ArrayCollection();
	//     }
}
