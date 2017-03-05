<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Get a Quote"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["stock_quote"]))
        {apologize("Please enter a quote");}
        $stock = lookup($_POST["stock_quote"]);
        if ($stock==false)
        {apologize("Invalid stock symbol!");}
        render("quote_result.php", ["quote" => $stock]); 
    }

?>
