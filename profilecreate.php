<?php
?>
<div class="col-md-8">
    <form method="post" action="">
        <fieldset>
            <label for="label">Label : </label>
            <input type="text" name="label" id="label" maxlength="35" />
            <label for="type">Type : </label>
            <select id="type">
                <option value="current">Current</option>
                <option value="saving">Savings</option>
                <option value="joint">Joint</option>
            </select>
            <label for="currency">Currency : </label>
            <select id="currency">
                <option value="euro">Euro</option>
                <option value="dollar">Dollar</option>
            </select>
            <label for="balance">Initial Balance : </label>
            <input type="text" name="balance" id="balance" maxlength="10" />
    </form>
</div>
<?php