<form action="sell.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="stock_symbol" placeholder="Symbol" type="text"/>
        </div>
         <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="stock_shares" placeholder="Sell how many?" type="int"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Sell!
            </button>
        </div>
    </fieldset>
</form>