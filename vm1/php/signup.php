<?php
    $uname = htmlspecialchars($_POST['uname']);
    $passwd = htmlspecialchars($_POST['passwd']);
    $uid = uniqid();
    $salt = "1234";

    $dbconn = pg_connect("host=127.0.0.1 port=5432 dbname=test_pgdb user=postgres password=CMZC32)^ED-oJLkDp##sz6k.");
    if (!$dbconn) {
        echo ("An error occurred.\n");
    } else {
        $queryString = "INSERT INTO logins VALUES ($1, $2, $3, $4)";
        $queryResult = pg_query_params($dbconn, $queryString, [$uid, $uname, $salt, $passwd]);

        if ($queryResult == false) {
            header('Location: ../signup.html');
        } else {
            setcookie("id", $uname, 0, "/");
            setcookie("uname", $uid, 0, "/");
            header('Location: ../index.html');
        }
    }
?>
