<?php


require_once('CNConnect.class.php');

    // Tests MySQL connection
    $connection = CNConnect::new();

    // CNConnect::freeResult();

    


    // TESTING NEW mysqli_data_seek !!!! WORKING O(1) CONSTANT TIME 
    // $query = "SELECT product_id, name, unit_price FROM sql_inventory.products;";
    // $test = CNConnect::getRow($query, 2);
    // echo $test[1];


    // $query = "SELECT product_id, name, unit_price FROM sql_inventory.products;";
    // $result = $connection->query($query); 
    // mysqli_data_seek($result, 2);
    // $row = mysqli_fetch_array($result);
    // echo $row[1];
    

    // Tests getRow method and the types it returns 

    // // $query = "blah blah";


    // Iterating from row 7 to the end of the table
    // $x = 7;
    // while ($row = CNConnect::getRow($query, $x, MYSQLI_NUM))
    // {
    //     foreach ($row as $s)
    //     {
    //         echo $s . " ";
    //     }
    //     echo "\n";
    //     $x++;
    // }

    // $test = CNConnect::getRow($query, 5);
    // echo (mysqli_num_rows(CNConnect::$result));

    // $test = CNConnect::getRow($query, 5);
    // echo (mysqli_num_rows(CNConnect::$result));
    

    // CNConnect::freeResult();
    // CNConnect::freeResult();




    // $result = $connection->query($query);
    // $ar = mysqli_fetch_array($result);
    // echo $ar['name'];
    // mysqli_fetch_array()

    // echo $test['name'] . "\n";
    // echo is_array($test) ? "Is array" : "Not a array";
    // echo "\n";
    // echo is_null($test) ? "Is null" : "Is not null"; 

    // Tests query and mysqli_fetch_row using -> notation 

    // $resulObjs = $connection->query("SELECT product_id, name, unit_price FROM sql_inventory.products; ");
    // $resulObjs = $connection->query("SHOW tables;");
    // $row = mysqli_fetch_row($resulObjs);
    // echo $row[0] . "\n";

    // $connection->query("USE sql_hr");
    // $resulObjs = $connection->query("SHOW tables;");
    // $row = mysqli_fetch_row($resulObjs);
    // echo $row[0] . "\n";


    // Tests getDB method 
    // CNConnect::getDB();

    // Tests how to switch what row is being pointed to. Linear time

    // $resulObjs = $connection->query("SELECT product_id, name, unit_price FROM sql_inventory.products; ");
    // $row = mysqli_fetch_row($resulObjs);
    // $row = mysqli_fetch_row($resulObjs);
    // echo $row[1];

    // Testing for loop iteration #s 
    // for ($i = 0; $i< 2; $i++)
    // {
    //     echo "iteration";
    // }

    // Iterates through entire table of results. Downside = fetches entire table. Linear o(n)
    // while ($row = mysqli_fetch_row($resulObjs))
    // {
    //     foreach($row as $x)
    //     {
    //         echo $x . " ";
    //     }
    //     echo "\n";
    // }

    // Testing linear efficiency in fetching rows VS using CNConnect::getRow()
    // Linear search loop has 7 digit limit before taking too long to search...
    // $query = "SELECT product_id, name, unit_price FROM sql_inventory.products;";
    // $resulObjs = $connection->query($query);
    // for ($i = 0; $i<99999; $i++)
    // {
    //     $row = mysqli_fetch_row($resulObjs);
    //     echo $row[1];
    // }



    // Iterates thru result table and only print fields @ index 1 
    // while ($row = mysqli_fetch_row($resulObjs))
    // {
    //     echo $row[1];
    //     echo "\n";
    // }


    
?>