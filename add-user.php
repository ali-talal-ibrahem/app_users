<?php
$title = "Add_User";
include_once __DIR__ . "/assets/header.php";
include_once __DIR__ . "/assets/footer.php";
$title_page = "Add";
$name = "";
$email = "";
$password = "";
$phone = "";
$btn_title = "Save";
if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id=$id";
    $users = mysqli_query($conn, $sql);
    if ($users) {
        $title_page = "Edit";
        $user = $users->fetch_assoc();
        $name = $user['name'];
        $email = $user['email'];
        $password = $user['password'];
        $phone = $user['phone'];
        $btn_title = "Update";
    }
}

?>

<div class="container">
    <div class="wrapper p-5 m-5">
        <div class="d-flex p-2 justify-content-between">
            <h2><?php echo $title_page ?> User</h2>
            <div><a href="index.php"><i data-feather="corner-down-left"></i></a></div>
        </div>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label class="form-label"> User Name :</label>
                <input type="text"
                    class="form-control"
                    name="name"
                    placeholder="User Name"
                    autocomplete="FALSE"
                    value="<?php echo $name ?>">
            </div>
            <div class="mb-3">
                <label class="form-label"> Email :</label>
                <input type="email"
                    class="form-control"
                    name="email"
                    placeholder="Email"
                    autocomplete="FALSE"
                    value="<?php echo $email ?>">
            </div>
            <div class="mb-3">
                <label class="form-label"> Password :</label>
                <input type="password"
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    autocomplete="FALSE"
                    value="<?php echo $password ?>">
            </div>
            <div class="mb-3">
                <label class="form-label"> Mobile Phone :</label>
                <input type="number"
                    class="form-control"
                    name="mobile"
                    placeholder="Mobile Phone"
                    autocomplete="FALSE"
                    value="<?php echo $phone ?>">
            </div>
            <?php if(isset($_GET['id'])){?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
                <?php }?>
            <div class="d-grid gap-2 col-6 mx-auto">
                <input href="index.php" class="btn btn-primary" type="submit" value="<?php echo $btn_title?>" name="save"></input>
            </div>
        </form>
    </div>
</div>


<script>
    feather.replace();
</script>