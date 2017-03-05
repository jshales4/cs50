<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (preg_match("/^\d+$/", $_POST["stock_shares"]) != true) 
            {apologize("Please enter a positive integer amount of stock to purchase");}
        // query database for user
        $value = lookup(strtoupper($_POST["stock_symbol"]));
        if ($value == false)
        {apologize("Invalid symbol entered!");}
        $cash = CS50::query("Select cash FROM users where id = ?",$_SESSION["id"]);
        $cash=$cash[0];
        if (($value["price"]*$_POST["stock_shares"])<=$cash["cash"])
            {$rows = CS50::query("SELECT shares, id FROM Portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], strtoupper($_POST["stock_symbol"]));
            if (count($rows) == 1)
                {$rows = $rows[0];
                CS50::query("UPDATE Portfolios SET shares = shares + ? WHERE id = ?",$_POST["stock_shares"], $rows["id"]);}
            else
                {CS50::query("INSERT INTO Portfolios (user_id, symbol, shares) VALUES(?, ?, ?)", $_SESSION["id"], strtoupper($_POST["stock_symbol"]), $_POST["stock_shares"]);}
            CS50::query("UPDATE users SET cash = cash - ? * ? WHERE id = ?",$_POST["stock_shares"], $value["price"], $_SESSION["id"]);
            CS50::query("INSERT INTO Transaction_History (User_id, Symbol, Number_Shares, Share_Price, Buy_Sell) VALUES(?, ?, ?, ?, ?)", $_SESSION["id"], strtoupper($_POST["stock_symbol"]), $_POST["stock_shares"], $value["price"], "Buy");
            redirect("/");}
        else {apologize("You don't have enough money to buy those shares!");}
        }

?>
