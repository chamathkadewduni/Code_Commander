<?php
session_start();

if(isset($_POST['endorser_id']) && isset($_POST['endorsee_id']) && isset($_POST['endorsee_name'])) {
    $_SESSION['endorser_id'] = $_POST['endorser_id'];
    $_SESSION['endorsee_id'] = $_POST['endorsee_id'];
    $_SESSION['endorsee_name'] = $_POST['endorsee_name'];
}
?>