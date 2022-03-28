<?php

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

//api key setup 
$woocommerce = new Client(
    'http://sobetronic.com/Wordpress/', 
    'ck_98e2960b0a6f7e4d540ab71295910454eaf392e4', 
    'cs_118d816bb69e6e447e59a46700e97a45df1de329',
    [
        'version' => 'wc/v3',
    ]
);

$products = $woocommerce->get('products');
?>
<style>
    .container{
        width:560px;
        margin: 0 auto;
        display:flex;
        justify-content:center;
        align-items: center;
        height:100vh;
        flex-wrap: wrap;
    }

    input,select{
        width:100%;
        height:70px;
        margin-bottom:20px;
        padding: 20px;
        font-size: 20px;
    }
</style>
<div class="container">
<form id="idform" action="products.php" method="post">
<label for="">Product Name</label>
<select name="product_id" id="product_name">
<option value="">Select Your Product Name</option>
<?php foreach($products as $product){ ?>

 <option value="<?php echo $product->id?>"><?php echo $product->name; ?></option>
    
<?php } ?>
</select>
<label>Product Price</label>
<input type="text" value="" id="product_price" name="product_price">
<label for="">Product Stock</label>
<input type="text" value="" id="product_stocks" name="product_stocks">
<input type="hidden" value="" id="old_product_price" name="old_product_price">
<input type="hidden" value="" id="old_product_stocks" name="old_product_stocks">
<input type="submit" value="Submit">
</form>
<div id="message" ></div>
</div>
<?php 
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $("#product_name").change(function() {
					var product_id = $(this).val();
                    //alert(newTheme);
					$.ajax({
						type:"POST",
						url: "product_info.php",
						data: {
							product_id:product_id
						},
						success: function(result) { 
                            //parse json
	                        result = JSON.parse(result);
							console.log(result); 
                            $('#product_price').val(result.regular_price);
                            $('#product_stocks').val((result.stock_quantity ==null)?'null':result.stock_quantity);
                            $('#old_product_price').val(result.regular_price);
                            $('#old_product_stocks').val((result.stock_quantity ==null)?'null':result.stock_quantity);
							//location.reload(); 
						}
					});
				});

                $("#idform").submit(function(event) {
                    event.preventDefault();
                    //alert("hello");
                    var pData = $(this).serialize();
                    
                    console.log(pData);
                    $.ajax({
                        
                        type: "POST",
                        url: "update.php",
                        data: pData, // serializes the form's elements.
                        success: function(result)
                        {   console.log(result);
                            
                            
                        if(result =="updated"){
                            
                            $("#message").html("<span style='border: 2px solid blue; font-size: 28px; padding:20px'>Product Price and Stock updated successfully</span>");
                            var price = $('#product_price').val();
                            var stock = $('#product_stocks').val();
                            $('#old_product_price').val(price);
                            $('#old_product_stocks').val(stock);
                        } else if(result =="priceupdate"){
                            
                            $("#message").html("<span style='border: 2px solid blue; font-size: 28px; padding:20px'>Product price updated successfully</span>");

                            var price = $('#product_price').val();
                            var stock = $('#product_stocks').val();
                            $('#old_product_price').val(price);
                            $('#old_product_stocks').val(stock);
                        }else if(result =="stockupdate"){
                            
                            $("#message").html("<span style='border: 2px solid blue; font-size: 28px; padding:20px'>Product stock quantity updated successfully</span>");
                            var price = $('#product_price').val();
                            var stock = $('#product_stocks').val();
                            $('#old_product_price').val(price);
                            $('#old_product_stocks').val(stock);
                        }else if(result =="noupdate"){
                            
                            $("#message").html("<span style='border: 2px solid red; font-size: 28px; padding:20px'>You did not update anythings!!</span>");
                            var price = $('#product_price').val();
                            var stock = $('#product_stocks').val();
                            $('#old_product_price').val(price);
                            $('#old_product_stocks').val(stock);
                        }

                        }
                    });
                });



    });

</script>