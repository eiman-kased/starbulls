<?php

require_once 'src/DB/db_connect.php';

class User
{
	private int $id;
	private string $firstName;
	private string $lastName;
	private string $email;
	private string $password;
	private string $phoneNumber;
	private bool $isPreferred;
	private DateTime $createdAt;

	private static mysqli $db;

	public function __construct(string $firstName, string $lastName, string $email, string $password, string $phoneNumber, bool $isPreferred = false, DateTime $createdAt = null )
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->password = $password; // FIXME hash this before saving
		$this->phoneNumber = $phoneNumber;
		$this->isPreferred = $isPreferred;
		$this->createdAt = $createdAt ?? new DateTime();
	}

	public function saveToDB(): User
	{
		// make/get db connection
		self::$db = self::$db ?? dbConn();
		// check to make sure this user doesn't already exist, based on email
		if ($foundUser = self::findUserByEmail($this->email)) {
			return $foundUser;
		}
		// Construct the insert sql statement/query
		$preferred = $this->isPreferred ? 1 : 0;
		// excluding datetime since it defaults to current timestamp
		$sql = "INSERT INTO `user` (firstName, lastName, email, password, phoneNumber, isPreferred)
		VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->password', '$this->phoneNumber', '$preferred')";

		$insertSuccess = self::$db->query($sql);
		// Check for errors in the insert process
		if (!$insertSuccess) {
			// there was an error
			// TODO log said error rather than just display
			echo 'Error inserting user:' . self::$db->error;
			return false;
		}
		// everything went well
		$this->id = self::$db->insert_id;
		self::$db->close();
		return $this;
	}

	public static function findUserByEmail($email)
	{
		self::$db = self::$db ?? dbConn();
		$sql = "SELECT * FROM `user` WHERE email='$email'";
		$result = self::$db->query($sql);
		if ($result->num_rows < 1) {
			return false;
		}

		$tmp = $result->fetch_object();

		self::$db->close();
		$retUser =  new User($tmp->firstName, $tmp->lastName, $tmp->email, $tmp->password, $tmp->phoneNumber, $tmp->isPreferred, new DateTime($tmp->createdAt));
		$retUser->setId($tmp->id);
		return $retUser;
	}

	/**
	 * Set the id, only used internally
	 */
	private function setId(int $id)
	{
		$this->id = intval($id);
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id ?? 0;
	}

	/**
	 * Get the value of firstName
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * Set the value of firstName
	 *
	 * @return  self
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;

		return $this;
	}

	/**
	 * Get the value of lastName
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * Set the value of lastName
	 *
	 * @return  self
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;

		return $this;
	}

	/**
	 * Get the value of email
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @return  self
	 */
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Get the value of password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Get the value of phoneNumber
	 */
	public function getPhoneNumber()
	{
		return $this->phoneNumber;
	}

	/**
	 * Set the value of phoneNumber
	 *
	 * @return  self
	 */
	public function setPhoneNumber($phoneNumber)
	{
		$this->phoneNumber = $phoneNumber;

		return $this;
	}

	/**
	 * Get the value of createdAt
	 */ 
	public function getCreatedAt()
	{
		return new DateTime($this->createdAt);
	}

	/**
	 * Set the value of createdAt
	 *
	 * @return  self
	 */ 
	public function setCreatedAt(DateTime $createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}
}
