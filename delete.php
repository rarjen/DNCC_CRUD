<?php
try {
    $id = $_GET["id"];

    require_once("./config/connection.php");
    $queryDelete = "DELETE FROM todo_list WHERE id = $id";
    $deleted = mysqli_query($conn, $queryDelete);
    if ($deleted) {
        header('Location: index.php');
    } else {
        echo "Error";
    }

    // function delete($any)
    // {
    //     require_once("./config/connection.php");
    //     $queryDelete = "DELETE FROM todo_list WHERE id = $any";
    //     $deleted = mysqli_query($conn, $queryDelete);
    //     if ($deleted) {
    //         header('Location: index.php');
    //     } else {
    //         echo "Error";
    //     }
    // }
} catch (Exception $error) {
    echo "Error", $error->getMessage(), "\n";
}
