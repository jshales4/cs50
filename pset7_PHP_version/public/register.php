<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        
         else if (($_POST["password"])!=($_POST["confirmation"]))
        {
            apologize("Your passwords do not match.");
        }
// query database for user
        $rows = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["username"]);

        // if username already exists, complain
        if (count($rows) > 0 )
        {
            apologize("User already registered with that name!"); 
        }
        else     
    {if(CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", 
    $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT)) !=0)
    {$rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
        $_SESSION["id"] = $rows[0]["id"];
        redirect("/");
    }
    }}

?>