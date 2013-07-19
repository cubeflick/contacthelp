<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company_listing")
 */

//@TODO Property Name does not use any underscore of hyphone, see first three property and change others
// only protected property will start with $_
// does not use numerics in property,
// Name should be like this - 
// if name has multiple words then property name will be like firstwordSecondwordThirdWord
// change other properties like first three in populate
// name of the getter functions will be like 
// getFirstwordSecondword ie getCId, getCName , getSubCategoryOne 


class CompanyListing {
	/**
	 * @ORM\c_id
	 * @ORM\Column(type="integer");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $_cId = null ;

	/**
	 * @ORM\Column(name="c_name",type="string")
	 */
	protected $_cName;

	/**
	 * @ORM\Column(name="sub_category1",type="varchar");
	 */

	protected $_subCategoryOne;
	/**
	 * @ORM\Column(name="sub_category2",type="varchar");
	 */

	protected $_subCategoryTwo;

	/**
	 * @ORM\Column(name="sub_category3",type="varchar");
	 */

	protected $_subcategoryThree;

	/**
	 * @ORM\Column(name="company_url",type="varchar");
	 */

	protected $_companyUrl;

	/**
	 * @ORM\Column(name="department",type="varchar");
	 */

	protected $_department;

	/**
	 * @ORM\Column(name="phone_number",type="varchar");
	 */

	protected $_phoneNumber;

	/**
	 * @ORM\Column(name="step_to_reach",type="varchar");
	 */

	protected $_stepToReach;

	/**
	 * @ORM\Column(name="customer_service_link",type="varchar");
	 */

	protected $_customerServiceLink;

	/**
	 * @ORM\Column(name="customer_support_email",type="varchar");
	 */

	protected $_customerSupportEmail;

	/**
	 * @ORM\Column(name="operation_hours",type="varchar");
	 */

	protected $_operationHours;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $_description;

	/**
	 * @ORM\Column(name="additional_note",type="varchar");
	 */

	protected $_additionalNote;

	/**
	 * @ORM\Column(name="user_name",type="varchar");
	 */

	protected $_userName;

	/**
	 * @ORM\Column(name="user_email",type="varchar");
	 */

	protected $_userEmail;

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
		$this->_cId = $data['_cid'];
		$this->_cName = $data['cname'];
		$this->_subCategoryOne = $data['sub_category1'];
		$this->_subCategoryTwo = $data['sub_category2'];
		$this->_subCategoryThree = $data['sub_category3'];
		$this->_companyUrl = $data['company_url'];
		$this->_department = $data['department'];
		$this->_phoneNumber = $data['phone_number'];
		$this->_stepToReach = $data['step_to_reach'];
		$this->_customerServiceLink = $data['customer_service_link'];
		$this->_customerSupportEmail = $data['customer_support_email'];
		$this->_operationHours = $data['operation_hours'];
		$this->_description = $data['description'];
		$this->_additionalNote = $data['additional_note'];
		$this->_userName = $data['user_name'];
		$this->_userEmail = $data['user_email'];

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
	public function getCId()
	{
		return $this->_cId;
	}
	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getCName()
	{
		return $this->_cName;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSubCategoryOne()
	{
		return $this->_subCategoryOne;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSubCategoryTwo()
	{
		return $this->sub_category2;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSubCategoryThree()
	{
		return $this->sub_category3;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCompanyUrl()
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
	public function getPhoneNumber()
	{
		return $this->phone_number;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getStepToReach()
	{
		return $this->step_to_reach;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCustomerServiceLink()
	{
		return $this->customer_service_link;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCustomerSupportEmail()
	{
		return $this->customer_support_email;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getOperationHours()
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
	public function getAdditionalNote()
	{
		return $this->additional_note;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUserName()
	{
		return $this->user_name;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUserEmail()
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
