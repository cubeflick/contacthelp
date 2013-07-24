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
	 * @ORM\Id
	 * @ORM\Column(type="integer",name="listing_id");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $_listingId = null ;

	/**
	 * @ORM\Column(name="listing_name",type="string")
	 */
	protected $_listingName;

	/**
	 * @ORM\Column(name="sub_category_one",type="string");
	 */

	protected $_subCategoryOne;
	/**
	 * @ORM\Column(name="sub_category_two",type="string");
	 */

	protected $_subCategoryTwo;

	/**
	 * @ORM\Column(name="sub_category_three",type="string");
	 */

	protected $_subcategoryThree;

	/**
	 * @ORM\Column(name="company_url",type="string");
	 */

	protected $_companyUrl;

	/**
	 * @ORM\Column(name="department",type="string");
	 */

	protected $_department;

	/**
	 * @ORM\Column(name="phone_number",type="string");
	 */

	protected $_phoneNumber;

	/**
	 * @ORM\Column(name="step_to_reach",type="string");
	 */

	protected $_stepToReach;

	/**
	 * @ORM\Column(name="customer_service_link",type="string");
	 */

	protected $_customerServiceLink;

	/**
	 * @ORM\Column(name="customer_support_email",type="string");
	 */

	protected $_customerSupportEmail;

	/**
	 * @ORM\Column(name="operation_hours",type="string");
	 */

	protected $_operationHours;

	/**
	 * @ORM\Column(name="description",type="string")
	 */
	protected $_description;

	/**
	 * @ORM\Column(name="additional_note",type="string");
	 */

	protected $_additionalNote;

	/**
	 * @ORM\Column(name="user_name",type="string");
	 */

	protected $_userName;

	/**
	 * @ORM\Column(name="user_email",type="string");
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
		$this->_listingId = $data['listing_id'];
		$this->_listingName = $data['listing_name'];
		$this->_subCategoryOne = $data['sub_category_one'];
		$this->_subCategoryTwo = $data['sub_category_two'];
		$this->_subCategoryThree = $data['sub_category_three'];
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
	public function getlistingId()
	{
<<<<<<< HEAD
		return $this->listingId;
=======
		return $this->_listingId;
>>>>>>> 998fb4a70ac55a5eedf71e8878ff049fdbfbf682
	}
	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getListingName()
	{
<<<<<<< HEAD
		return $this->listingName;
=======
		return $this->_listingName;
>>>>>>> 998fb4a70ac55a5eedf71e8878ff049fdbfbf682
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSubCategoryOne()
	{
		return $this->subCategoryOne;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSubCategoryTwo()
	{

		return $this->subCategoryTwo;

		return $this->sub_category_two;

	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getSubCategoryThree()
	{
		return $this->subCategoryThree;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCompanyUrl()
	{
		return $this->companyUrl;
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
		return $this->stepToReach;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCustomerServiceLink()
	{
		return $this->customerServiceLink;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getCustomerSupportEmail()
	{
		return $this->customerSupportEmail;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getOperationHours()
	{
		return $this->operationHours;
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
		return $this->additionalNote;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUserName()
	{
		return $this->userName;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUserEmail()
	{
		return $this->userEmail;
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
