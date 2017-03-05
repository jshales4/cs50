<form action="quote_result.php" method="GET">
        <table style="width:120%" align="center">
            <table border="1" cellpadding="5" cellspacing="5" align= "center">
                <col width="200">
                <col width="300">
                <col width="200">
  <tr>
    <td style="font-weight:bold" align="center">Symbol</td>
    <td style="font-weight:bold" align="center">Company Name</td> 
    <td style="font-weight:bold" align="center">Price</td>
  </tr>
  <tr>
    <td><?=$quote["symbol"]?></td>
    <td><?=$quote["name"]?></td> 
    <td><?=$quote["price"]?></td>
  </tr>

</table>
        </div>
    </fieldset>
</form>
