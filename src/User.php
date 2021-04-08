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
	private bool $isArchived;
	private \DateTime $createdAt;
	private \DateTime $archivedAt;

	private \Database $db;

	public function __construct(string $firstName, string $lastName, string $email, string $password, string $phoneNumber, bool $isPreferred = false, DateTime $createdAt = null)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->password = $password; // FIXME hash this before saving
		$this->phoneNumber = $phoneNumber;
		$this->isPreferred = $isPreferred;
		$this->isPreferred = false;
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

		if (!empty($this->id)) {
			// if we have an id this user exists in the db and needs to be updated
			$sql = "UPDATE `user` SET firstName = '$this->firstName', lastName = '$this->lastName', email = '$this->email', phoneNumber = $this->phoneNumber, isPreferred = $preferred, password = '$hash'" . ($this->isArchived && empty($this->archivedAt) ? ', archivedAt = NOW() ' : '') . "WHERE id=$this->id";
		} else {
			// otherwise create new excluding createdAt since it defaults to current timestamp
			$sql = "INSERT INTO `user` (firstName, lastName, email, password, phoneNumber, isPreferred) VALUES ('$this->firstName', '$this->lastName', '$this->email', '$hash', '$this->phoneNumber', '$preferred')";
		}

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

	public static function getAllUsers(string $filter = '', bool $includeArchived = false)
	{
		$db = new \Database();
		$dbCon = $db->getConnection();
		$sql = "SELECT * FROM `user`";
		if (!$includeArchived || !empty($filter)) {
			$sqlWhere = 'WHERE ';
			$whereArr = [];
			if (!$includeArchived) {
				$whereArr[] = 'archivedAt IS NULL';
			}

			if (!empty($filter)) {
				$whereArr[] = $filter;
			}

			$sql .= $sqlWhere . implode(' and ', $whereArr);
			// echo $sql;
		}

		//DB run query
		$results = $dbCon->query($sql);

		if ($results->num_rows < 1) {
			return false;
		}

		$users = array();

		while ($row = $results->fetch_assoc()) {
			$retUser =  new \User($row['firstName'], $row['lastName'], $row['email'], $row['password'], $row['phoneNumber'], $row['isPreferred'], new \DateTime($row['createdAt']));
			$retUser->setId($row['id']);
			$users[] = $retUser;
		}

		$dbCon->close();

		return $users;
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

		$row = $result->fetch_object();

		$dbCon->close();
		$retUser =  new \User($row->firstName, $row->lastName, $row->email, $row->password, $row->phoneNumber, $row->isPreferred, new \DateTime($row->createdAt));
		$retUser->setId($row->id);
		return $retUser;
	}

	// find user by id
	public static function findUserById(int $id)
	{
		$db = new \Database();
		$dbCon = $db->getConnection();
		$sql = "SELECT * FROM `user` WHERE id='$id'";

		$result = $dbCon->query($sql);

		if (!$result) {
			throw new Exception("User info not found.");
		}

		if ($result->num_rows === 0) {
			return null;
		}

		$row = $result->fetch_assoc();
		$user = new User($row['firstName'], $row['lastName'], $row['email'], $row['password'], $row['phoneNumber']);
		$user->id = $row['id'];

		$dbCon->close();

		return $user;
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

	public function archive()
	{
		$this->isArchived = true;

		$this->saveToDB();
	}

	public function jsonSerialize()
	{
		$userJSON = [
			'id' => $this->getID(),
			'first_name' => $this->getFirstName(),
			'last_name' => $this->getLastName(),
			'email' => $this->getEmail(),
			'phone_number' => $this->getPhoneNumber(),
			'createdAt' => $this->createdAt,
		];

		if (!empty($this->isArchived)) {
			$userJSON['archivedAt'] = $this->archivedAt;
		}

		return $userJSON;
	}
}
