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

  // Import Connection
  require_once("config/connection.php");
  // require_once("./edit.php");
  try {
    // Menangkap Value yang dikirim dan Melakukan Query
    if (isset($_POST["submit"])) {
      $tugas = $_POST["tugas"];
      $date = $_POST["date"];
      $queryCreate = "INSERT INTO todo_list (tugas, date) VALUES ('$tugas', '$date')";
      $created = mysqli_query($conn, $queryCreate);
    }
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
      <form class="form" action="index.php" method="POST">
        <div class="form-group form-title">
          <label for="tugas">Masukkan Tugas Baru</label>
          <input type="text" name="tugas" id="tugas" required />
        </div>
        <div class=" form-group form-title">
          <label for="date">Masukkan Deadline</label>
          <input type="date" name="date" id="date" required />
        </div>
        <input type="submit" value="Submit" name="submit" id="submit" class="submit-btn" />
      </form>
    </div>

    <div class="container">
      <h2 class="container-header">Daftar Tugas</h2>
      <div class="list-item" id="todos">
        <div class="item shadow">
          <div class="item shadow">
            <table style="width: 100%">
              <tr>
                <th class="number">No.</th>
                <th>Tugas</th>
                <th>Deadline</th>
                <th>Action</th>
              </tr>
              <?php
              $queryShow = "SELECT * FROM todo_list ORDER BY date ASC";
              $show = mysqli_query($conn, $queryShow);

              if (mysqli_num_rows($show) > 0) {
                $number = 1;
                while ($data = mysqli_fetch_assoc($show)) {
                  // var_dump($data["id"]);
              ?>
                  <tr>
                    <td class="number"><?= $number; ?></td>
                    <td><?= $data["tugas"]; ?></td>
                    <td><?= $data["date"]; ?></td>
                    <td class="action">
                      <a href="edit.php?id=<?php echo $data["id"] ?>" class="edit-btn">Edit</a>
                      <a href="delete.php?id=<?php echo $data["id"] ?>" class="delete-btn">Delete</a>
                    </td>
                  </tr>
                <?php
                  $number++;
                }
              } else {
                ?>
                <tr>
                  <td colspan="4">No Data Found</td>
                </tr>
              <?php } ?>

            </table>
          </div>
        </div>
      </div>
    </div>

</body>

</html>