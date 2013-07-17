<?php 

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User {
	/**
	 * @ORM\Id
	 * @ORM\Column(name="user_id",type="integer");
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	public $userId = null ;

	/**
	 * @ORM\Column(type="string")
	 */
	public $username;

	/**
	 * @ORM\Column(type="string")
	 */
	public $email;

	/**
	 * @ORM\Column(type="string")
	 */
	public $password;

}

