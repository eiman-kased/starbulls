<? php 

require_once('src/DB/db_connect.php');

class review {
    private int $Id;
    //How is score being done? 
    private $score;
    private string $comment;
    private int $createdAt;

    private static mysqli $db;
    
    //Initializes objects properties (variables) - two underscores
    public function__construct($score, $comment, $createdAt);
        

}



?>