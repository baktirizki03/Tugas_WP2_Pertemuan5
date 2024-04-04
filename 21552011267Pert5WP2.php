<?php
// Kelas Book
class Book
{
    private $title;
    private $author;
    private $year;
    private $status;

    public function __construct($title, $author, $year)
    {
        $this->title = $title;
        $this->author = $author;
        $this->year = $year;
        $this->status = 'available';
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function displayBookInfo()
    {
        echo "Title: " . $this->getTitle() . "<br>";
        echo "Author: " . $this->getAuthor() . "<br>";
        echo "Year: " . $this->getYear() . "<br>";
        echo "Status: " . $this->getStatus() . "<br>";
        echo "---------------------------<br>";
    }
}

// Kelas Library
class Library
{
    private static $books = [];

    public static function addBook(Book $book)
    {
        self::$books[] = $book;
    }

    public static function borrowBook($title)
    {
        foreach (self::$books as $book) {
            if ($book->getTitle() == $title && $book->getStatus() == 'available') {
                $book->setStatus('borrowed');
                echo "Book \"$title\" has been borrowed.<br>";
                return;
            }
        }
        echo "Book \"$title\" is not available for borrowing.<br>";
    }

    public static function returnBook($title)
    {
        foreach (self::$books as $book) {
            if ($book->getTitle() == $title && $book->getStatus() == 'borrowed') {
                $book->setStatus('available');
                echo "Book \"$title\" has been returned.<br>";
                return;
            }
        }
        echo "Book \"$title\" cannot be returned or is not currently borrowed.<br>";
    }

    public static function printAvailableBooks()
    {
        echo "Available Books:<br>";
        foreach (self::$books as $book) {
            if ($book->getStatus() == 'available') {
                $book->displayBookInfo();
            }
        }
    }
}

// Membuat objek buku
$book1 = new Book("Orang-orang biasa: Invisible People", "Andrea Hirata", 2019);
$book2 = new Book("Malioboro at midnight", "Skysphire", 2023);

// Menambahkan buku ke perpustakaan
Library::addBook($book1);
Library::addBook($book2);

// Meminjam buku
Library::borrowBook("Orang-orang biasa: Invisible People");
Library::borrowBook("Malioboro at midnight");

// Mencetak daftar buku yang tersedia
Library::printAvailableBooks();

// Mengembalikan buku
Library::returnBook("Orang-orang biasa: Invisible People");

// Mencetak daftar buku yang tersedia setelah pengembalian
Library::printAvailableBooks();
?>
