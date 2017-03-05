<?php

    // configuration
    require("../includes/config.php"); 

// query database for user
        $rows = CS50::query("SELECT * FROM Portfolios WHERE user_id = ?",$_SESSION["id"]);
        $rows_cash = CS50::query("SELECT cash FROM users WHERE id = ?",$_SESSION["id"]);
        $rows_cash = $rows_cash[0];
$positions = [];
foreach ($rows as $row)
{
    $stock = lookup($row["symbol"]);
    if ($stock !== false)
    {
        $positions[] = [
            "name" => $stock["name"],
            "price" => $stock["price"],
            "shares" => $row["shares"],
            "symbol" => $row["symbol"]
        ];
    }
}
    // render portfolio
render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "cash" => $rows_cash["cash"]]);

?>
