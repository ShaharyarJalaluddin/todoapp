<?php

$connection = mysqli_connect('localhost', 'root', '', 'todo1');
$error = '';
if (isset($_POST['submit'])) {
    $textbox = $_POST['textbox'];
    if ($textbox == '') {
        $error = "Please enter a value";
    } else {
        $query = "insert into todo_list(title) values('$textbox') ";


        mysqli_query($connection, $query);
    }
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "delete from todo_list where id = $id ";

    mysqli_query($connection, $query);

    header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>PHP Todo List</h1>
        <div id="option">
            <form method="post">

                <div id="textbox">
                    <input type="textbox" name="textbox" id="textbox">
                </div>

                <div id="button">
                    <input type="submit" name="submit" id="submit"><br>
                </div>
            </form>
          
            <?php echo $error ?>
        </div>
        <div class="clear">&nbsp;</div>


        <div id="display">
            <?php
            $sql = "select * from todo_list order by id desc";
            $result = mysqli_query($connection, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0) {
            ?>

                <table class="rowdata">
                    <?php


                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td width="90%"><?php echo $row['title']; ?></td>
                            <td><a href="index.php?delete=<?php echo $row['id'] ?>">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php } else {
                echo "no data found";
            }
            ?>
        </div>
    </div>

</body>

</html>