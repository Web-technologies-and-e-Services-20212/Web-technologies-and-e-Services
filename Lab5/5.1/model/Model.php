<?php

include_once("model/Book.php");

class Model {
	public function getBookList()
	{
		// here goes some hardcoded values to simulate the database
		return array(
			"123Jungle Book" => new Book("123Jungle Book", "R. Kipling", "A classic book."),
			"Moonwalker" => new Book("Moonwalker", "J. Walker", "A nice book"),
			"PHP for Dummies" => new Book("PHP for Dummies", "Some Smart Guy", "A dev book")
		);
	}
	
	public function getBook($title)
	{
		// we use the previous function to get all the books and then we return the requested one.
		// in a real life scenario this will be done through a db select command
		$allBooks = $this->getBookList();
		return $allBooks[$title];
	}
	
	
}

?>