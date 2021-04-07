<?php

require_once 'src/DB/Database.php';

class Review implements JsonSerializable
{
	private int $id;
	private float $score;
	private string $comment;
	private int $userID;
	private \DateTime $createdAt;
	private bool $isArchived;
	private \DateTime $archivedAt;

	private Database $db;

	//Initializes objects properties (variables) - two underscores
	public function __construct(float $score, string $comment, int $userId = null)
	{
		$this->score = $score;
		$this->comment = $comment;
		if ($userId) {
			$this->userID = $userId;
		}
		$this->db = $this->db ?? new Database();
		$this->createdAt = new \DateTime();
		$this->isArchived = false;
	}

	//Function to save to database
	public function saveToDB()
	{
		//Establish connection to DB
		$dbCon = $this->db->getConnection();
		if (!empty($this->id)) {
			$sql = "UPDATE review SET score = $this->score, comment = '$this->comment'" . ($this->isArchived && empty($this->archivedAt) ? ', archivedAt = NOW() ' : '') . "WHERE id=$this->id";
			// echo $sql;
		} else {
			//Write query to save info
			$sql = "INSERT INTO review (score, comment, userID) VALUES ($this->score, '$this->comment', $this->userID)";
		}
		//DB run query
		$insertSuccess = $dbCon->query($sql);
		//Does it work successfully
		if (!$insertSuccess) {
			echo $dbCon->error;
			return false;
		}

		$this->id = $this->id ?? $dbCon->insert_id;
		//Return true
		return true;
	}

	public static function getAllReviews(string $filter = '', bool $includeArchived = false)
	{
		//Establish connection to DB
		$db = new \Database();
		$dbCon = $db->getConnection();
		$sql = 'SELECT * FROM review ';
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

		//Does it work successfully
		if (!$results) {
			echo $dbCon->error;
			return false;
		}
		//Create array to return results
		$reviews = array();
		//Loop through results
		while ($row = $results->fetch_assoc()) {
			$review = new Review($row['score'], $row['comment'], $row['userID']);
			$review->id = $row['id'];
			if (!empty($row['archivedAt'])) {
				$review->archivedAt = new \DateTime($row['archivedAt']);
				$review->isArchived = true;
			}
			$reviews[] = $review;
		}

		return $reviews;
	}

	public static function getReviewByID(int $id)
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
			$review = new Review($row['score'], $row['comment'], $row['userID']);
			$review->id = $row['id'];
			if (!empty($row['archivedAt'])) {
				$review->archivedAt = new \DateTime($row['archivedAt']);
				$review->isArchived = true;
			}
			$reviews[] = $review;
		}
		if (count($reviews) > 1) {
			throw new Exception("Error more than one result found for ID: $id");
		}
		return $reviews[0];
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
			if (!empty($row['archivedAt'])) {
				$review->isArchived = true;
				$review->archivedAt = new DateTime($row['archivedAt']);
			} else {
				$review->isArchived = false;
			}

			$reviews[] = $review;
		}
		return $reviews;
	}

	/**
	 * Set the value of Review id
	 */
	public function setId($id)
	{
		$this->id = $id;
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

	/**
	 * Get the value of score
	 */
	public function getScore()
	{
		return $this->score;
	}

	/**
	 * Set the value of score
	 */
	public function setScore($score)
	{
		$this->score = $score;
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
	 */
	public function setComment($comment)
	{
		$this->comment = $comment;
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
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * Get the value of archivedAt
	 */
	public function getArchivedAt()
	{
		return $this->archivedAt ?? false;
	}

	/**
	 * Set the value of archivedAt
	 */
	public function setArchivedAt($archivedAt)
	{
		$this->archivedAt = $archivedAt;
	}

	public function archive()
	{
		$this->isArchived = true;

		$this->saveToDB();
	}

	// We need this to convert private vars to json correctly
	public function jsonSerialize()
	{
		$reviewJSON = [
			'id'   => $this->getId(),
			'score' => $this->getScore(),
			'comment' => $this->getComment(),
			'userId' => $this->getUserID(),
			'createdAt' => $this->getCreatedAt()->getTimestamp(), //TODO timestamp message 
			'archived' => $this->isArchived,
		];

		if ($this->isArchived) {
			$reviewJSON['archivedAt'] = $this->getArchivedAt();
		}

		if (!empty($this->userID)) {
			$reviewJSON['user'] = User::findUserById($this->userID);
		}

		return $reviewJSON;
	}
}
