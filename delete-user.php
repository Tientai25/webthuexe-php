<?php
    include("connect.php");

    $this_id = $_GET['this_id'];
    $sql = "DELETE FROM users WHERE id='$this_id' ";
    mysqLi_query($conn,$sql);
    header("location:user.php");
?>