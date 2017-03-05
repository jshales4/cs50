<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        // query database for user
        
        $rows = CS50::query("SELECT shares, id FROM Portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["stock_symbol"]);
        if (count($rows) == 1)
        {$rows = $rows[0];
      
if ($rows["shares"]>$_POST["stock_shares"])
    {CS50::query("UPDATE Portfolios SET shares = shares - ? WHERE id = ?",$_POST["stock_shares"], $rows["id"]);
        $value = lookup($_POST["stock_symbol"]);
        CS50::query("UPDATE users SET cash = cash + ? * ? WHERE id = ?",$_POST["stock_shares"], $value["price"], $_SESSION["id"]);
        // redirect to portfolio and log transaction
        CS50::query("INSERT INTO Transaction_History (User_id, Symbol, Number_Shares, Share_Price, Buy_Sell) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], strtoupper($_POST["stock_symbol"]), $_POST["stock_shares"], $value["price"], "Sell");
        redirect("/");
    }
else if($rows["shares"]==$_POST["stock_shares"])
    {CS50::query("DELETE FROM Portfolios WHERE id = ?", $rows["id"]);
    $value = lookup($_POST["stock_symbol"]);
    CS50::query("UPDATE users SET cash = cash + ? * ? WHERE id = ?",$_POST["stock_shares"], $value["price"], $_SESSION["id"]);
    CS50::query("INSERT INTO Transaction_History (User_id, Symbol, Number_Shares, Share_Price, Buy_Sell) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], strtoupper($_POST["stock_symbol"]), $_POST["stock_shares"], $value["price"], "Sell");
    redirect("/");    
    }
else 
    {apologize("You're trying to sell more shares than you have!");}
       }    
else {apologize("You don't have any shares of that stock!");}
}
?>
