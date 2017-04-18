<?php
    require("CGsql.php");

    $mysqli = CGsql::connect();

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $mysqli->query("set names utf8");

    $account = $_POST["account"];
    $password = $_POST["password"];

    $stmt = $mysqli->prepare("SELECT password FROM user WHERE account = ? LIMIT 1");
    $stmt->bind_param("s",$account);

    $data = [];
    if ($stmt->execute()) {
        $stmt->bind_result($hashpsw);
        $stmt->fetch();
        if (password_verify($password, $hashpsw)) {
            $data["status"] = "success";
        } else {
            $data["status"] = "faid";
            $data["error"] = "*账号或密码错误*";
        }
    }

    echo json_encode($data);