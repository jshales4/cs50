<form action="history.php" method="GET">
        <table style="width:120%" align="center">
            <table border="1" cellpadding="5" cellspacing="5">
                <col width="250">
                <col width="200">
                <col width="200">
                <col width = "200">
                <col width = "200">
                <col width = "200">
  <tr>
    <td style="font-weight:bold" align="center">Transaction Time and Date</td>
    <td style="font-weight:bold" align="center">Action</td> 
    <td style="font-weight:bold" align="center">Number of Shares</td>
    <td style="font-weight:bold" align="center">Price</td>
    <td style="font-weight:bold" align="center">Symbol</td>
    <td style="font-weight:bold" align="center">User</td>
  </tr>
<?php foreach ($transactions as $transaction): ?>  
  <tr>
    <td><?=$transaction["Date_Time"]?></td>
    <td><?=$transaction["Buy_Sell"]?></td>
    <td><?=$transaction["Number_Shares"]?></td>
    <td><?=$transaction["Share_Price"]?></td>
    <td><?=$transaction["Symbol"]?></td>
    <td><?=$transaction["User"]?></td>
        
  </tr>
<?php endforeach ?>
</table>

        </div>
    </fieldset>
</form>