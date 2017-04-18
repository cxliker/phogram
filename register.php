<?php
    require("CGsql.php");

    $options = [
        'cost' => 9
    ];

    $contact = htmlspecialchars($_POST["contact"]);
    $name = htmlspecialchars($_POST["name"]);
    $account = htmlspecialchars($_POST["account"]);
    $password = htmlspecialchars($_POST["password"]);
    $password = password_hash($password, PASSWORD_BCRYPT, $options);

    $mysqli = CGsql::connect();

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $mysqli->query("set names utf8");

    date_default_timezone_set('Asia/Shanghai');
    $date = date("Y-m-d");

    $data = [];

    $stmt = $mysqli->prepare("INSERT INTO user (contact, name, account, password, createTime) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $contact, $name, $account, $password, $date);
    if ($stmt->execute()) {
        $data["status"] = "success";
    } else {
        $data["status"] = "fail";
        $data["error"] = "*用户名已存在*";
    }

    $stmt->close();
    $mysqli->close();

    echo json_encode($data);
    ?>

