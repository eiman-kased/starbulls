<?php

Class User {
	private int $id;
	private string $firstName;
	private string $lastName;
	private string $email;
	private string $password;
	private string $phoneNumber;
	private bool $isPreferred;

	private static mysqli $db;

	public function __construct(string $firstName, string $lastName, string $email, string $password, string $phoneNumber, bool $isPreferred)
	{
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		$this->password = $password; // FIXME hash this before saving
		$this->phoneNumber = $phoneNumber;
		$this->isPreferred = $isPreferred;
	}

	public function saveToDB(): bool{
		// TODO make/get db connection
		self::$db = self::$db ?? dbConn();
		// Construct the insert sql statement/query
		$sql = "INSERT INTO `user` (firstName, lastName, email, password, phoneNumber, isPreferred)
		VALUES ($this->firstName, $this->lastName, $this->email, $this->password, $this->phoneNumber, $this->isPreferred)";
		$insertSuccess = self::$db->query($sql);
		// Check for errors in the insert process
		if($insertSuccess){
			$this->id = self::$db->insert_id;
			return true;
		} else {
			echo 'Error inserting user:'.self::$db->error;
			return false;
		}
	}
}