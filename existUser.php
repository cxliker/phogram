<?php 
    require("CGsql.php");

    $mysqli = CGsql::connect();

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $mysqli->query("set names utf8");

    $account = $_POST['account'];

    $stmt = $mysqli->prepare("SELECT account FROM user WHERE account = ? LIMIT 1");
    $stmt->bind_param("s", $account);
    if ($stmt->execute()) {
        $stmt->bind_result($rst);
        $stmt->fetch();
        if (!empty($account) && $rst == null) {
            echo "success";
        } else {
            echo "fail";
        }
    }

    $stmt->close();
    $mysqli->close();