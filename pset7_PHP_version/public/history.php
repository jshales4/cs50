<?php

    // configuration
    require("../includes/config.php"); 

// query database for user
        $rows = CS50::query("SELECT a.username, b.* FROM users a Left Join Transaction_History b on a.id = b.user_id WHERE user_id = ?",$_SESSION["id"]);
        
        
$positions = [];
foreach ($rows as $row)
    {
        $transactions[] = [
            "Buy_Sell" => $row["Buy_Sell"],
            "Date_Time" => $row["Date_Time"],
            "Number_Shares" => $row["Number_Shares"],
            "Share_Price" => $row["Share_Price"],
            "Symbol" => $row["Symbol"],
            "User" => $row["username"]
        ];
    }

    // render portfolio
render("transaction_history.php", ["transactions" => $transactions, "title" => "Transactions"]);

?>
