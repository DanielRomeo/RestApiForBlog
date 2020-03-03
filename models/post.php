<?php



class Post{
	private $conn;
	private $table = 'posts';

	//post properties:
	public $id;
	public $category_id;
	public $category_name;
	public $title;
	public $body;
	public $author;
	public $created_at;

	// constructor:
	public function __construct($db){
		$this->conn = $db;
	}

	// get posts:
	public function read(){
		$query = 'SELECT * FROM '. $this->table .'' ;

		//prepared statement:
		$stmt = $this->conn->prepare($query);

		//execute:
		$stmt->execute();

		return $stmt;
	}


	// get a single post:
	public function read_single(){
		$query = "SELECT * FROM ". $this->table ." WHERE id = ? " ;

		//prepared statement and binding:
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		//execute:
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// SET properties::
		$this->image = $row['image'];
		$this->title = $row['title'];
		$this->body = $row['body'];
		$this->uploaddate = $row['uploaddate'];
		$this->uploadedby = $row['uploadedby'];
		$this->page_views = $row['page_views'];

		return $stmt;
	}

	// create post:
	public function create(){
		$query = "INSERT INTO ".$this->table."
			SET 
				image = :image,
				title = :title,
				body = :body,
				uploaddate = :uploaddate
				uploadedby => :uploadedby,
				page_views => :page_views,
			";

		// prepare the statment:
		$stmt = $this->conn->prepare($query);


			
	}


} /* end of class*/


