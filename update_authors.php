    <?php
    session_start();
    require_once('classes/database.php');
    $sweetAlertConfig = "";
    $con = new database();

    
    if(empty($id = $_POST['id'])) {
        header('location:admin_homepage.php');
    }else{
        $id = $_POST['id'];
        $data = $con->viewAuthorsID($id);
    }

    if(isset($_POST['update'])) {
        $id= $_POST['authorID'];
        $firstname = $_POST['authorFirstName'];
        $lastname = $_POST['authorLastName'];
        $birthday = $_POST['authorBirthYear'];
        $nationality = $_POST['authorNationality'];

        $authorId= $con->updateauthors($firstname, $lastname, $birthday, $nationality, $id);
 if ($authorId) {
        // Registration successful, set SweetAlert script
        $sweetAlertConfig = "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Updated Author',
                    text: 'You updated the author successfully!',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'update_authors.php';
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
    <title>Authors</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">Library Management System (Admin)</a>
        <a class="btn btn-outline-light ms-auto active" href="add_authors.php">Add Authors</a>
        <a class="btn btn-outline-light ms-2" href="add_genres.php">Add Genres</a>
        <a class="btn btn-outline-light ms-2" href="add_books.php">Add Books</a>
        <div class="dropdown ms-2">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li>
                <a class="dropdown-item" href="profile.php">
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
        <h4 class="mt-5">Update Existing Author</h4>
        <form method="POST" action="">
            <div class="mb-3">
            <input type="hidden" value="<?php echo $data['author_id']?>" class="form-control" name="authorID" required>
        </div>
        <div class="mb-3">
            <label for="authorFirstName" class="form-label">First Name</label>
            <input type="text" value="<?php echo $data['author_FN']?>" class="form-control" name="authorFirstName" required>
        </div>
        <div class="mb-3">
            <label for="authorLastName" class="form-label">Last Name</label>
            <input type="text" value="<?php echo $data['author_LN']?>" class="form-control" name="authorLastName" required>
        </div>
        <div class="mb-3">
            <label for="authorBirthYear" class="form-label">Birth Date</label>
            <input type="date" value="<?php echo isset($data['author_birthday']) ? date('Y-m-d', strtotime($data['author_birthday'])) : ''; ?>" class="form-control" name="authorBirthYear" max="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="mb-3">
            <label for="authorNationality" class="form-label">Nationality</label>
            <select class="form-select" name="authorNationality" required>
            <option value="" disabled selected><?php echo $data['author_nat']?></option>
            <option value="Filipino">Filipino</option>
            <option value="American">American</option>
            <option value="British">British</option>
            <option value="Canadian">Canadian</option>
            <option value="Chinese">Chinese</option>
            <option value="French">French</option>
            <option value="German">German</option>
            <option value="Indian">Indian</option>
            <option value="Japanese">Japanese</option>
            <option value="Mexican">Mexican</option>
            <option value="Russian">Russian</option>
            <option value="South African">South African</option>
            <option value="Spanish">Spanish</option>
            <option value="Other">Other</option>
            </select>
        </div>
        <button type="submit" name= "update" class="btn btn-primary">Update Author</button>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>

  </form>
  <?php echo $sweetAlertConfig; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script> <!-- Add Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script> <!-- Correct Bootstrap JS -->

    </body>
    </html>
    