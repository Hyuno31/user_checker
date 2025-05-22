<?php
session_start();
require_once('./classes/database.php');

$SweetAlertConfig = "";
$con = new database();

if (isset($_POST['add'])) {
  
  $name =$_POST['genreName'];

  $genreId= $con-> addGenre($name);
  if($genreId){
  
        $SweetAlertConfig = "<script>
            Swal.fire({
                icon: 'success',
                title: 'Add Author Successful',
                text: 'You added  an author successfully',
                confirmButtonText: 'ok'
            }).then((result) => {
                if (result.isConfirmed)
                {window.location.href = 'add_authors.php';
            
            }
            });
        </script>";
    } else {
        $_SESSION['Error']="Sorry,there was an error signing up.";
           
        
    }
}
?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
 
  <link rel="stylesheet" href="./package/dist/sweetalert2.css">
 
  <title>Genres</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Library Management System (Admin)</a>
      <a class="btn btn-outline-light ms-auto" href="add_authors.html">Add Authors</a>
      <a class="btn btn-outline-light ms-2 active" href="add_genres.html">Add Genres</a>
      <a class="btn btn-outline-light ms-2" href="add_books.html">Add Books</a>
      <div class="dropdown ms-2">
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <!-- Bootstrap icon -->
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li>
              <a class="dropdown-item" href="profile.html">
                  <i class="bi bi-person-circle me-2"></i> See Profile Information
              </a>
            </li>
          <li>
            <button class="dropdown-item" onclick="updatePersonalInfo()">
              <i class="bi bi-pencil-square me-2"></i> Update Personal Information
            </button>
          </li>
          <li>
            <button class="dropdown-item" onclick="updatePassword()">
              <i class="bi bi-key me-2"></i> Update Password
            </button>
          </li>
          <li>
            <button class="dropdown-item text-danger" onclick="logout()">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container my-5 border border-2 rounded-3 shadow p-4 bg-light">

  <h4 class="mt-5">Add New Genre</h4>
  <form method="post" action="" novalidate>
    <div class="mb-3">
      <label for="genreName" class="form-label">Genre Name</label>
      <input type="text" class="form-control" name="genreName" required>
    </div>
    <button type="submit" id="add" name="add" class="btn btn-primary">Add Genre</button>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
  <script src="./package/dist/sweetalert2.js"></script>
<?php echo $SweetAlertConfig; ?>
  </form>
</div>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> <!-- Add Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> <!-- Correct Bootstrap JS -->
</body>
</html>
