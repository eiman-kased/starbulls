<?php

require_once 'src/DB/Database.php';

class User implements JsonSerializable
{
	private int $id;
	private string $firstName;
	private string $lastName;
	private string $email;
	private string $password;
	private string $phoneNumber;
	private bool $isPreferred;
	private \DateTime $createdAt;

	private \Database $db;

	public function __construct(string $firstName, string $lastName, string $email, string $password, string $phoneNumber, bool $isPreferred = false, DateTime $createdAt = null)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->password = $password; // FIXME hash this before saving
		$this->phoneNumber = $phoneNumber;
		$this->isPreferred = $isPreferred;
		$this->createdAt = $createdAt ?? new \DateTime();
	}

	public function saveToDB(): User
	{
		// make/get db connection
		$this->db = $this->db ?? new \Database();
		$dbCon = $this->db->getConnection();
		// check to make sure this user doesn't already exist, based on email
		if ($foundUser = self::findUserByEmail($this->email)) {
			return $foundUser;
		}
		// Construct the insert sql statement/query
		$preferred = $this->isPreferred ? 1 : 0;
		// here we want to hash the pw and save the hash in the db
		$hash = password_hash($this->password, PASSWORD_BCRYPT);

		// excluding datetime since it defaults to current timestamp
		$sql = "INSERT INTO `user` (firstName, lastName, email, password, phoneNumber, isPreferred)
		VALUES ('$this->firstName', '$this->lastName', '$this->email', '$hash', '$this->phoneNumber', '$preferred')";

		$insertSuccess = $dbCon->query($sql);
		// Check for errors in the insert process
		if (!$insertSuccess) {
			// TODO log said error rather than just display
			echo 'Error inserting user:' . $dbCon->error;
			return false;
		}
		// everything went well
		$this->id = $dbCon->insert_id;
		$dbCon->close();
		return $this;
	}

	public static function findUserByEmail($email)
	{
		$db = new \Database();
		$dbCon = $db->getConnection();
		$sql = "SELECT * FROM `user` WHERE email='$email'";

		$result = $dbCon->query($sql);
		if ($result->num_rows < 1) {
			return false;
		}

		$tmp = $result->fetch_object();

		$dbCon->close();
		$retUser =  new \User($tmp->firstName, $tmp->lastName, $tmp->email, $tmp->password, $tmp->phoneNumber, $tmp->isPreferred, new \DateTime($tmp->createdAt));
		$retUser->setId($tmp->id);
		return $retUser;
	}

	// find user by id
	public static function findUserById(int $id)
	{
		$db = new \Database();
		$dbCon = $db->getConnection();
		$sql = "SELECT * FROM `user` WHERE id='$id'";

		$result = $dbCon->query($sql);
		if ($result->num_rows < 1) {
			return false;
		}

		$tmp = $result->fetch_object(User::class);

		$dbCon->close();
		$retUser =  new \User($tmp->firstName, $tmp->lastName, $tmp->email, $tmp->password, $tmp->phoneNumber, $tmp->isPreferred, new \DateTime($tmp->createdAt));
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
		return new \DateTime($this->createdAt);
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

	public function jsonSerialize()
	{
		return [
			'id' => $this->getID(),
			'first_name' => $this->getFirstName(),
			'last_name' => $this->getLastName(),
			'email' => $this->getEmail(),
			'phone_number' => $this->getPhoneNumber(),
		];
	}
}

