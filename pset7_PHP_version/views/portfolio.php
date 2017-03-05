<form action="quote_result.php" method="GET">
        <table style="width:120%" align="center">
            <table border="1" cellpadding="5" cellspacing="5">
                <col width="80">
                <col width="300">
                <col width="150">
                <col width = "80">
  <tr>
    <td style="font-weight:bold" align="center">Symbol</td>
    <td style="font-weight:bold" align="center">Company Name</td> 
    <td style="font-weight:bold" align="center">Number of Shares</td>
    <td style="font-weight:bold" align="center">Price</td>
  </tr>
<?php foreach ($positions as $position): ?>  
  <tr>
    <td><?=$position["symbol"]?></td>
    <td><?=$position["name"]?></td>
    <td><?=$position["shares"]?></td>
    <td><?=$position["price"]?></td>
  </tr>
<?php endforeach ?>
<td></td>
<td>Cash</td>
<td><?=number_format ($cash, 2)?></td>
<td>1.00</td>
</table>

        </div>
    </fieldset>
</form>