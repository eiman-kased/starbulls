<?php

require_once 'src/DB/Database.php';

class Review implements JsonSerializable
{
	private int $id;
	private float $score;
	private string $comment;
	private int $userID;
	private \DateTime $createdAt;

	private Database $db;

	//Initializes objects properties (variables) - two underscores
	public function __construct($score, $comment, $userId = null)
	{
		$this->score = $score;
		$this->comment = $comment;
		$this->createdAt = new \DateTime();
		if ($userId !== null) {
			$this->userID = $userId;
		}
	}

	//Function to save to database
	public function saveToDB()
	{
		//Establish connection to DB
		$this->db = $this->db ?? new Database();
		$dbCon = $this->db->getConnection();
		//Write query to save info
		$sql = "INSERT INTO review (score, comment, userID) VALUES ($this->score, '$this->comment', $this->userID)";

		//DB run query
		$insertSuccess = $dbCon->query($sql);
		//Does it work succesfully
		if (!$insertSuccess) {
			echo $dbCon->error;
			return false;
		}
		//Return true
		return true;
	}

	public static function getReviewsByID(int $id)
	{
		//Establish connection to DB
		$db = new \Database();
		$dbCon = $db->getConnection();
		//Write query to get info on review from ID
		$sql = "SELECT * FROM `review` where id = $id";
		//DB run query
		$results = $dbCon->query($sql);
		//Create array to return results
		$reviews = array();
		//Loop through results
		while ($row = $results->fetch_assoc()) {
			$results->id = $row['id'];
			$results->score = $row['score'];
			$results->comment = $row['comment'];
			$results->userID = $row['userID'];
			$reviews[] = $results;
		}
		return $reviews;
	}
	//Chunk of comments based on some specific piece of data
	public function getReviewsByScore($score)
	{
		//Establish connection to DB
		$this->db = $this->db ?? new Database();
		$dbCon = $this->db->getConnection();
		//Write query to get review based on score
		$sql = "SELECT * FROM review where score=$score";
		//DB run query
		$results = $dbCon->query($sql);
		//Create array to return results
		$reviews = array();
		//Loop through results
		while ($row = $results->fetch_assoc()) {
			$review = new Review($row['score'], $row['comment'], $row['userID']);
			$reviews[] = $review;
		}
		return $reviews;
	}
		// Update a Review in the db
		public function updateReview(int $id){

			$dbCon = $this->db->getConnection();
			//write query to update db
			$sql = "UPDATE review (score, comment) SET ($this->score, $this->comment') WHERE id=$id";
			//run query
			$results = $dbCon->query($sql);
			//place results in array
			$reviewupdate = array();
			//update review
			while ($row = $results->fetch_assoc()) {
				$results = new Review();
				$results->id = $row['id'];
				$results->score = $row['score'];
				$results->comment = $row['comment'];
				$reviewupdate[] = $results;
			}
			return $reviewupdate;
		}

	/**
	 * Get the value of userID
	 */
	public function getUserID()
	{
		return $this->userID ?? null;
	}

	/**
	 * Set the value of userID
	 *
	 * @return  self
	 */
	public function setUserID($userID)
	{
		$this->userID = $userID;

		return $this;
	}

	// We need this to convert private vars to json correctly
	public function jsonSerialize()
	{
		return [
			'id'   => $this->getId(),
			'score' => $this->getScore(),
			'comment' => $this->getComment(),
			'userId' => $this->getUserID(),
			'createdAt' => $this->getCreatedAt()->getTimestamp(),
		];
	}

	/**
	 * Get the value of score
	 */
	public function getScore()
	{
		return $this->score;
	}

	/**
	 * Set the value of score
	 *
	 * @return  self
	 */
	public function setScore($score)
	{
		$this->score = $score;

		return $this;
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id ?? null;
	}

	/**
	 * Get the value of comment
	 */
	public function getComment()
	{
		return $this->comment;
	}

	/**
	 * Set the value of comment
	 *
	 * @return  self
	 */
	public function setComment($comment)
	{
		$this->comment = $comment;

		return $this;
	}

	/**
	 * Get the value of createdAt
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * Set the value of createdAt
	 *
	 * @return  self
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;

		return $this;
	}
}

