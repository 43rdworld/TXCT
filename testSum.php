<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript">
        function calculateSum() {
            var sum = 0;
            $(".price").each(function() {
                //add only if the value is number
                if(!isNaN(this.value) && this.value.length!=0) {
                    sum += parseFloat(this.value);
                }
            });
            $("#sum").html('&pound;' + sum.toFixed(2));
        }
        $(document).ready(function(){
            $('.del').live('click',function(){
                $(this).parent().parent().remove();
            });
            $('.add').live('click',function(){
                $(this).val('Delete');
                $(this).attr('class','del');
                var appendTxt = "<tr><td><input name='item[]' type='text' size='40' /></td><td><input name='qty[]' type='text' size='5' value='0' /></td><td><input class='price' name='price[]' id='price' type='text' size='20' value='0.00' /></td><td><input type='button' class='add' value='Add Row' /></td></tr>";
                $("tr:last").after(appendTxt);
            });
            $('.price').live('keyup', function() {
                calculateSum();
            });
        });
    </script>
</head>
<body>
<table id="options-table">
    <tr>
        <td>Item</td>
        <td>Qty</td>
        <td>Price</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><input name="item[]" type="text" size="40" /></td>
        <td><input name="qty[]" type="text" value="0" size="5" /></td>
        <td><input name="price[]" class="price" id="price" type="text" value="0.00" size="20" /></td>
        <td><input type="button" class="add" value="Add Row" /></td>
    </tr>
</table>
<br /><br />
<div id="sum">&pound;0.00</div>
</body>
</html>