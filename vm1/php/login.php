<?php
    $uname = htmlspecialchars($_GET['uname']);
    $passwd = htmlspecialchars($_GET['passwd']);

    $dbconn = pg_connect("host=127.0.0.1 port=5432 dbname=test_pgdb user=postgres password=CMZC32)^ED-oJLkDp##sz6k.");

    if (!$dbconn) {
        echo ("An error occurred.\n");
    } else {
        $queryString = "SELECT uid, $1, passwd FROM logins WHERE uname = $2";
        $queryResult = pg_query_params($dbconn, $queryString, [$uname, $uname]);
        header('Location: ../login.html');    

        while ($row = pg_fetch_row($queryResult)) {
            if ($passwd == $row[2]) {
                setcookie("id", $row[0], 0, "/");
                setcookie("uname", $row[1], 0, "/");
                header('Location: ../index.html');
            }
        }
    }
?>
