<?php
$errors = "";

$db = mysqli_connect('localhost','root','','todo');

if (isset($_POST['submit'])){
    $task = $_POST['task'];
    if(empty($task)){
        $errors ="You Must Fill In The Task";
    }
    else{
        mysqli_query($db,"INSERT INTO tasks (task) VALUES ('$task')");
        header('location:index.php');
    }
}

if (isset($_GET['del_task'])){
    $id=$_GET['del_task'];
    mysqli_query($db,"DELETE FROM tasks WHERE id=$id");
    header('location:index.php');
}


?>
<!DOCTYPE html>
<html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>To do list application</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="heading">
            <h2>To do list application</h2>

        </div>
       <form method ="POST" action="index.php">
        <?php if(isset($errors)){?>
        <p><?php echo $errors; ?></p>
        <?php } ?>

        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">ADD TASK</button>

       </form>

       <table>
        <thead>
            <tr>
                <th>N</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            $tasks = mysqli_query($db,"SELECT * FROM tasks");
            while ($row = mysqli_fetch_array($tasks)){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class = "task"><?php echo $row['task']; ?></td>
                <td class ="delete">
                    <a href="index.php?del_task=<?php echo $row['id'];?>">X</a>
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
       </table>

        <script src="" async defer></script>
    </body>
</html>