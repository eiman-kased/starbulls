<?php

require_once('src/DB/db_connect.php');

class Review
{
	private int $id;
	private float $score;
	private string $comment;
	private int $user_id;
	private \DateTime $createdAt;

	private static mysqli $db;

	//Initializes objects properties (variables) - two underscores
	public function __construct($score, $comment, $userId)
	{
		$this->score = $score;
		$this->comment = $comment;
		$this->createdAt = new \DateTime();
		$this->user_id = $userId;
	}

	//Function to save to database
	public function saveToDB()
	{
		//Establish connection to DB
		self::$db = self::$db ?? dbConn();
		//Write query to save info 
		$sql = "INSERT INTO review (score, comment, user_id, createdAt)
		VALUES ($this->score, $this->comment, $this->user_id, $this->createdAt->getTimestamp())";
		//DB run query 
		$insertSuccess = self::$db->query($sql);
		//Does it work succesfully
		if (!$insertSuccess) {
			echo self::$db->error;
			return false;
		}
		//Return true
		return true;
	}
	
	//Chunk of comments based on some specific piece of data
	public function getReviewsByScore($score)
	{
		//Establish connection to DB
		self::$db = self::$db ?? dbConn();
		//Write query to get review based on score
		$sql = "SELECT * FROM review";
		//DB run query 
		$insertSuccess = self::$db->query($sql);
		//Does it work succesfully
		if (!$insertSuccess) {
			echo self::$db->error;
			return false;
		}
		//Return true
		return true;
	}
}
