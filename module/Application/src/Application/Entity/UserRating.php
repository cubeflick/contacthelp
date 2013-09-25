<?php


namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_rating")
 */




class UserRating {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer",name="id");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $_id = null ;

	/**
	 * @ORM\Column(name="listing_name",type="string")
	 */
	protected $_listingName;

	/**
	 * @ORM\Column(name="comments",type="string")
	 */
	protected $_comments;
	/**
	 * @ORM\Column(name="sub_category_two",type="string");
	 */

	/**
	 * @ORM\Column(type="integer",name="reachability");
	 */
	protected $_reachability = null ;
	
	/**
	 * @ORM\Column(type="integer",name="return_proccess");
	 */
	protected $_returnProccess = null ;
	
	/**
	 * @ORM\Column(type="integer",name="issue_resolution");
	 */
	protected $_issueResolution = null ;
	
	/**
	 * @ORM\Column(type="integer",name="friendliness");
	 */
	protected $_friendliness = null ;
	
	/**
	 * @ORM\Column(type="integer",name="service_knowledge");
	 */
	protected $_serviceKnowledge = null ;
	
	
	/**
	 * @ORM\Column(name="screen_name",type="string");
	 */
	
	protected $_screenName;

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
		$this->_id = $data['listing_id'];
		$this->_listingName = $data['listing_name'];
		$this->_comments = $data['comments'];
		$this->_reachability = $data['reachability'];
		$this->_returnProccess = $data['return_proccess'];
		$this->_issueResolution = $data['issue_resolution'];
		$this->_friendliness = $data['friendliness'];
		$this->_serviceKnowledge = $data['service_knowledge'];
		$this->_screenName = $data['screen_name'];
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
	public function getListingId()
	{

// 		return $this->listingId;

		return $this->_id;

	}
	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getListingName()
	{

// 		return $this->listingName;

		return $this->_listingName;

	}

	/**
	 * Returns the Text Content
	 *
	 * @access public
	 * @return string
	 */
	public function getComments()
	{
	
		// 		return $this->listingName;
	
		return $this->_comments;
	
	}
	
	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getReachability()
	{
		return $this->_reachability;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getReturnProccess()
	{

		return $this->_returnProccess;

// 		return $this->sub_category_two;

	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getIssueResolution()
	{
		return $this->_issueResolution;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getFriendliness()
	{
		return $this->_friendliness;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getServiceKnowledge()
	{
		return $this->_serviceKnowledge;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getScreenName()
	{
		return $this->_screenName;
	}


	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUserName()
	{
		return $this->_userName;
	}

	/**
	 * Returns the Identifier
	 *
	 * @access public
	 * @return int
	 */
	public function getUserEmail()
	{
		return $this->_userEmail;
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
