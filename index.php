<?php
$title = "Users_App";
include_once __DIR__ . "/assets/header.php";
include_once __DIR__ . "/assets/footer.php";

$action = false;
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
if($_POST['save'] == "Save"){
    $save_sql = "INSERT INTO users ( name , email, password, phone) 
VALUES ('$name','$email','$password','$mobile')";
}else{
    $id = $_POST['id'];
    $save_sql = " UPDATE users set name = '$name' , email = '$email', password = '$password', phone = '$mobile' WHERE id =$id " ;
}



    $result_save = mysqli_query($conn, $save_sql);
    if (!$result_save) {
        die(mysqli_error($conn));
    } else {
        if(isset($_POST['id'])){
            $action = "edit";
        }else{
            $action = "add";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'del') {
    $id = $_GET['id'];
    $del_sql = "DELETE FROM users WHERE id = $id";
    $result_del = mysqli_query($conn, $del_sql);
    if (!$result_del) {
        die(mysqli_error($conn));
    } else {
        $action = "del";
    }
}

$users_sql = "SELECT * FROM users";
$result_users = mysqli_query($conn, $users_sql);
$users = $result_users->fetch_all(MYSQLI_ASSOC);

?>

<div class="container">
    <div class="wrapper p-5 m-5">
        <div class="d-flex p-2 justify-content-between">
            <h2>All Users</h2>
            <div><a href="add-user.php"><i data-feather="user-plus"></i></a></div>
        </div>
        <hr>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Add</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo $user['name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['password'] ?></td>
                        <td><?php echo $user['created_at'] ?></td>
                        <td>
                            <div class="d-flex justify-content-evenly">
                                <i onclick="confirm_delete(<?php echo $user['id'] ?>);" class="text-danger" data-feather="delete"></i>
                                <i onclick="confirm_edit(<?php echo $user['id'] ?>);" class="text-primary" data-feather="edit"></i>
                            </div>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

<?php
if ($action != false) {
    if ($action == "add") { ?>
        <script>show_add();</script>
    <?php } elseif($action == "del") { ?>
        <script>show_delete();</script>
    <?php } elseif($action == "edit") { ?>
        <script>show_update();</script>
    <?php }
}
?>



<script>
    feather.replace();
</script>