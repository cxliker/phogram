<?php
/**
 * 这个例子对服务器做了基准测试（benchmark），检测服务器能承受多高的 cost
 * 在不明显拖慢服务器的情况下可以设置最高的值
 * 8-10 是个不错的底线，在服务器够快的情况下，越高越好。
 * 以下代码目标为  ≤ 50 毫秒（milliseconds），
 * 适合系统处理交互登录。
 */
$timeTarget = 0.05; // 50 毫秒（milliseconds） 

$cost = 8;
do {
    $cost++;
    $start = microtime(true);
    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
    $end = microtime(true);
} while (($end - $start) < $timeTarget);

echo "Appropriate Cost Found: " . $cost . "\n";
?>