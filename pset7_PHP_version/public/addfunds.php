<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render form
        render("funds_form.php", ["title" => "Add Funds"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["add_amount"] >0)
        {CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?",$_POST["add_amount"], $_SESSION["id"]);
        CS50::query("INSERT INTO Transaction_History (User_id, Symbol, Number_Shares, Share_Price, Buy_Sell) VALUES(?, ?, ?, 1, ?)", $_SESSION["id"], "CASH",  $_POST["add_amount"], "Add Funds");
        redirect("/");}
        else
        {apologize("Please enter a positive number of dollars to add to your account!");}}
       ?>     