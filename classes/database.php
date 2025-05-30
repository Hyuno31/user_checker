<?php
class database{
 
    function opencon(): PDO{
        return new PDO(
            dsn: 'mysql:host=localhost;
            dbname=lms_app',
            username: 'root',
            password: '');
    }
 
    function signupUser($firstname, $lastname, $birthday, $email, $sex, $phone, $username, $password, $profile_picture_path) {
 
        $con = $this->opencon();
       
        try {
            $con->beginTransaction();
 
            $stmt = $con->prepare("INSERT INTO users (user_FN, user_LN, user_birthday, user_sex, user_email, user_phone, user_username, user_password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstname, $lastname, $birthday, $sex, $email, $phone, $username, $password]);
           
            $userID = $con->lastInsertId();
           
 
            $stmt = $con->prepare("INSERT INTO users_pictures (user_id, user_pic_url) VALUES (?, ?)");
            $stmt->execute([$userID, $profile_picture_path]);
 
            $con->commit();
 
            return $userID;
 
        } catch (PDOException $e) {
 
            $con->rollback();
            return false;
 
        }
 
    }
 
    function insertAddress($userID, $street, $barangay, $city, $province) {
 
        $con = $this->opencon();
 
        try {
            $con->beginTransaction();
 
            $stmt = $con->prepare("INSERT INTO Address (ba_street, ba_barangay, ba_city, ba_province) VALUES (?, ?, ?, ?)");
            $stmt->execute([$street, $barangay, $city, $province]);
 
            $addressID = $con->lastInsertId();
 
            $stmt = $con->prepare("INSERT INTO users_address (user_id, address_id) VALUES (?, ?)");
            $stmt->execute([$userID, $addressID]);
 
            $con->commit();
 
            return true;
 
        } catch (PDOException $e) {
 
            $con->rollback();
            return false;
 
        }
 
    }

 function loginUser($email, $password){
    $con = $this->opencon();


    $stmt = $con->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC); // ← correct variable name here

    if ($user && password_verify($password, $user['user_password'])){
        return $user;
    } else {
        return false;
    }

 
}


function addauthors($firstname, $lastname, $birthday, $nationality){
$con = $this->opencon();
try{
    $con->beginTransaction();
    $stmt = $con->prepare("INSERT INTO authors (author_FN, author_LN, author_birthday, author_nat) VALUES (?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $birthday, $nationality]);
    $authorId = $con -> lastInsertId();
    $con->commit();
    return $authorId;
}catch (PDOException $e){
    $con->rollback();
    return false;

}
}

function addGenre($name){
    $con= $this->opencon();
    try{
        $con->beginTransaction();
        $stmt = $con->prepare("INSERT INTO genres (genre_name)VALUES (?)");
        $stmt ->execute([$name]);
        $genreId=$con->lastInsertId();
        $con->commit();
        return true; 
    }catch(PDOException $e){
        $con->rollback();
        return false;
    }
}


function viewAuthors()
    {
        $con = $this->opencon();
        return $con->query("SELECT * FROM Authors")
        ->fetchAll();
    }






function viewAuthorsID($id)
{
    $con = $this->opencon();
   $stmt =$con-> prepare("SELECT * FROM Authors WHERE author_id=?");
   $stmt-> execute ([$id]);
   return $stmt->fetch(PDO::FETCH_ASSOC);
}


function updateauthors($firstname, $lastname, $birthday,$nationality, $id) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE authors SET author_FN=?, author_LN=?,author_birthday=?, author_nat=?  WHERE author_id=?");
        $query->execute([$firstname, $lastname, $birthday,$nationality, $id]);
        // Update successful
        $con->commit();
        return true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
         $con->rollBack();
        return false; // Update failed
    }
}
// genre
function viewGenre(){
        $con = $this->opencon();
        return $con->query("SELECT * FROM Genres")->fetchAll();
    }
 
    function viewGenreID($id){
        $con = $this->opencon();
        $stmt = $con->prepare("SELECT * FROM Genres WHERE genre_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
    // update authors
    function updateGenre($g_name, $id) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE Genres SET genre_name=? WHERE genre_id=?");
        $query->execute([$g_name, $id]);
        // Update successful
        $con->commit();
        return true;
    } catch (PDOException $e) {
        // Handle the exception (e.g., log error, return false, etc.)
         $con->rollBack();
        return false; // Update failed
    }
}
 
//add books 
function addBook($title, $isbn, $pubyear, $quantity, $genre_ids = [], $author_ids = []) {
        $con = $this->opencon();
       
 
        try{
 
        $con->beginTransaction();
       
        $stmt = $con->prepare("INSERT INTO books (book_title, book_isbn, book_pubyear, quantity_avail) VALUES (?, ?, ?, ?)");
       
        $stmt->execute([$title, $isbn, $pubyear, $quantity]);
        $book_id = $con->lastInsertId();
       
 
        foreach($genre_ids as $genre_id){
            $stmt = $con->prepare("INSERT INTO genre_books (genre_id, book_id) VALUES (?, ?)");
            $stmt->execute([$genre_id, $book_id]);
        }
 
        foreach($author_ids as $author_id){
            $stmt = $con->prepare("INSERT INTO book_authors (book_id, author_id) VALUES (?, ?)");
            $stmt->execute([$book_id, $author_id]);
        }
 
        for($i = 0; $i < $quantity; $i++){
            $stmt = $con->prepare("INSERT INTO book_copy (book_id, is_available) VALUES (?, 1)");
            $stmt->execute([$book_id]);
        }
 
       
        $con->commit();
        return $book_id;
   
    }catch (PDOException $e){
        $con->rollback();
        return false;
    }
    }
}

?>
