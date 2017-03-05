<!DOCTYPE html>
<div>
    Thank you for using my finance website! Here at CS50 Finance your business is very important to us.
To add money to your account, please send funds in cash to: <br></br><p>ATTN: Milton Wadams<br>
2443 Spruce Street 
<br>Charlesworth, KY 40006</p> Enter how many dollars you sent us in the box below and we will update your account (Honor system, people!!)

-MGMT
<p></p>
</div>
<form action="addfunds.php" method="post">

    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="add_amount" placeholder="Please enter amount" type="text"/>
        </div>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Add funds!
            </button>
        </div>
    </fieldset>
</form>
