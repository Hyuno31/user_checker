<?php
session_start();
require_once('./classes/database.php');
$sweetAlertConfig = "";
$con = new database();
 
if(empty($id = $_POST['id'])){
    header('location:admin_homepage.php');
}else{
    $id = $_POST['id'];
    $data = $con->viewGenreID($id);
 
}
 
if (isset($_POST['update'])) {
    $g_name = $_POST['genreName'];
   
    $genreId= $con->updateGenre($g_name, $id);
 
    if ($genreId) {
        // Registration successful, set SweetAlert script
        $sweetAlertConfig = "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Update Genre',
                    text: 'You updated the genre successfully!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'update_genre.php';
                    }
                });
            </script>";
    } else {
        $_SESSION['error'] = "Sorry, there was an error signing up.";
    }
}
 
?>
 
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="./package/dist/sweetalert2.css">
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> <!-- Correct Bootstrap Icons CSS -->
  <title>Genres</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin_homepage.php">Library Management System (Admin)</a>
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
 
  <h4 class="mt-5">Update Existing Genre</h4>
  <form method="post" action="" novalidate>
    <div class="mb-3">
    <div class="mb-3">
      <label for="genre_ID" class="form-label"></label>
      <input type="hidden" name="id" value="<?php echo $data['genre_id']?>" class="form-control" id="genre_ID" required>
    </div>
      <label for="genreName" class="form-label">Genre Name</label>
      <input type="text" class="form-control" name="genreName" value="<?php echo $data['genre_name']?>" required>
    </div>
    <input type="hidden" name="id" value="<?php echo $data['genre_id']?>" >
    <button type="submit" name="update" class="btn btn-primary">Add Genre</button>
 
    <script src="./package/dist/sweetalert2.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<?php echo $sweetAlertConfig; ?>
  </form>
</div>
 
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> <!-- Add Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> <!-- Correct Bootstrap JS -->
</body>
</html>