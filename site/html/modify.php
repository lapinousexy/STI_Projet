<?php
if(isAdmin(getIdByUsername($_SESSION['username'])) && isActive(getIdByUsername($_SESSION['username']))){
?>

<!DOCTYPE html>
<html>
    <form action="#" method="POST">
        Username:
        <input type="text" id="username" name="username">
        <br>
        Password:
        <input type="password" id="password" name="password">
        <br>
        Confirm password:
        <input type="password" id="password_confirm" name="password_confirm">
        <br>
        Rôle:
        <!-- Source: https://www.w3schools.com/tags/tag_select.asp -->
        <select id ="role" name="role">
            <option value="0">Collaborateur</option>
            <option value="1">Administrateur</option>
        </select>
        <br>
        <select id="active" name="active">
            <option value="0">Inactive</option>
            <option value="1">Active</option>
        </select>
        <br>
        <input type="hidden" value="<?php echo $_POST['userIdModify'] ?>" name="userIdModify">
        <input type="hidden" value="<?php echo $_SESSION['token'] ?>" name="token">
        <input class="btn btn-success" type="submit" id="button_login" value="Modify">
    </form>
</html>

<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $role = $_POST['role'];
    $active = $_POST['active'];

    if(isValid($username) && verifyToken($_POST['token'])){
        if($password_confirm === $password){
            modifyUser($_POST['userIdModify'] ,$username, $password, $role, $active);
            ?>
                <br>
                <!-- Source: https://getbootstrap.com/docs/4.3/components/alerts/ -->
                <div class="alert alert-success" role="alert">
                    User has been modified !
                </div>
            <?php
        }else{
            ?>
                <br>
                <!-- Source: https://getbootstrap.com/docs/4.3/components/alerts/ -->
                <div class="alert alert-danger" role="alert">
                    User has not been modified !
                </div>
            <?php
        }
    }

    if(isValid($_POST['userIdModify'])){
        $userInfo = getUserById($_POST['userIdModify']);
        foreach($userInfo as $row){
            ?>
            <script>
                document.getElementById("username").value = "<?php echo htmlspecialchars($row[1]); ?>";
                document.getElementById("role").value = "<?php echo $row[3] ?>";
                document.getElementById("active").value = "<?php echo $row[4] ?>";
            </script>
            <?php
        }
    }
?>

<?php } else {
    header("Location: index.php?page=login.php");
} ?>