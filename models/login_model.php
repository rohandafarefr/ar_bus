<?php
function login($conn, $username, $password) {
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;

        mysqli_free_result($result);
        mysqli_close($conn);

        return true;
    } else {
        mysqli_free_result($result);
        mysqli_close($conn);

        return false;
    }
}
?>
