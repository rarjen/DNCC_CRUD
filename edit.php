<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todo Apps</title>
  <link rel="stylesheet" href="./style/style.css" />
</head>

<body>

  <?php
  // CREATE Todo-List
  try {
    require_once("config/connection.php");
    $id = $_GET['id'];
    // print_r($_GET["id"]);
    if (isset($_POST["submit"])) {
      $tugas = $_POST["tugas"];
      $date = $_POST["date"];
      $idGet = $_POST["id"];

      $queryUpdate = "UPDATE todo_list SET tugas = '" . $tugas . "', date = '" . $date . "' WHERE id = '" . $idGet . "'";
      $updated = mysqli_query($conn, $queryUpdate);

      if ($updated) {
        header('Location: index.php');
      }
    }
  } catch (Exception $error) {
    // Jika Ada Error maka akan di handle (ditangkap) disini
    echo "Error", $error->getMessage(), "\n";
  }
  ?>

  <?php
  try {
    $id = $_GET["id"];
    $querySelect = "SELECT * FROM todo_list WHERE id = $id";
    $selected = mysqli_query($conn, $querySelect);
    $tugasEdit = "";
    $dateEdit = "";


    $data = mysqli_fetch_assoc($selected);
    $tugasEdit = $data["tugas"];
    $dateEdit = $data["date"];
  } catch (Exception $error) {
    // Jika Ada Error maka akan di handle (ditangkap) disini
    echo "Error", $error->getMessage(), "\n";
  }
  ?>
  <header>
    <h1>Todo List</h1>
  </header>
  <div class="wrapper">
    <div class="container shadow" id="add-todo">
      <h2 class="container-header text-center">
        Tambah Yang Harus Dilakukan
      </h2>
      <form class="form" action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
        <div class="form-group form-title">
          <label for="tugas">Masukkan Tugas Baru</label>
          <input type="text" name="tugas" id="tugas" required value="<?= $tugasEdit; ?>" />
        </div>
        <div class=" form-group form-title">
          <label for="date">Masukkan Deadline</label>
          <input type="date" name="date" id="date" required value="<?= $dateEdit; ?>" />
        </div>
        <input type="submit" value="Save" name="submit" id="submit" class="submit-btn" />
        <a href="index.php" class="edit-btn">BACK</a>
      </form>
    </div>

</body>

</html>