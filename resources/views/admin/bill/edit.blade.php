<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>INVOICE</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
//   window.addEventListener("load", window.print());
</script>
	<style type="text/css">
		.container
		{
			width: 85%;
			height: 5rem;
			padding: 0px 7%;
		}
		h1, h2, h3, h4, h5, h6, p
		{
			margin-top: 5px;
    margin-bottom: 5px;
    font-weight: bold;
		}
		th, td{
			    padding: 9px;
    text-align: left;

		}
	</style>
</head>
<body>
<div class="container">
	<div style="width: 40%; float: left;">
		<img src="http://matinsoftech.com/uploads/img/general/1653038034-matin%20logo2.png" width="45%">
	</div>
<div style="width: 40%; float: right; padding-top: 20px;">
	<b>Note : </b><span>This is system generated bill. Cannot be used as a prper AT bill.</span>	
	</div>
</div>
<form action="{{ route('bill.update',[$bill->id]) }}" method="post">
    @csrf
    @method('PUT')
<div class="container" style="background: orange; height: 50px;"><div style="width: 55%; float: left;"></div><div style="width: 19%; float: right; background:white; font-size: 44px; text-align: center;">INVOICE</div></div>
<div class="container" style="height: 8rem;">
	<div style="width: 65%; float: left;">
		<h2>Invoice to : </h2>
		<p style="margin-top: 13px;">Name : {{ $bill->user->name }} </p>
		<p>Phone : {{ $bill->user->phone }}</p>
		<p>Address : {{ $bill->user->address }}</p>
	</div>
<div style="width: 30%; float: right; padding-top: 20px;">
	<p style="margin-top: 43px;">Invoice No. : MS{{ $bill->user_id }}</p>
		<p name="date">Date : {{ $bill->date }}</p>
        <p>Staus:</p>
        <select name="status" id="">
            <option>{{ $bill->status }} </option>
            @if( $bill->status == "paid")
                <option value="unpaid">Unpaid</option>
            @else
                 <option value="paid">Paid</option>
            @endif  
         
        </select>
	</div>
</div>


<div class="container" style="height: 17rem;">
	<table style="    width: 100%; border-spacing: 0px; border: 1px solid #dfdfdf;">
		<thead style="background:#0e0e64; color: white;">
			<tr>
				<th>SL.</th>
				<th>Item Description</th>
				<th>Price</th>
				<th>Qty.</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
            <?php 
            $data = 0;
            $total = $data++;
            ?>

			<tr style="background: white; height: 40px">
				<td><input style="width: 30px;" type="text" name="sn" id="" class="" value="{{ $bill->sn }}" ></td>
				<td><input style="width: 600px;" type="text" name="name" id="" class="" value="{{ $bill->name }}" ></td>
				<td><input style="width: 100px;" type="text" name="price" id="price" value="{{ $bill->price }}" ></td>
				<td><input style="width: 50px;" type="text" name="quantity" id="quantity"  value="{{ $bill->quantity }}" ></td>
				<td><input style="width: 100px;" type="text" name="total" id="total"  value="{{ $bill->total }}" ></td>
				
			</tr>
			<tr style="background: #e5e6e9; height: 40px">
			    <td><input style="width: 30px;" type="text" name="sn_one" id="" class="" value="{{ $bill->sn_one }}" ></td>
				<td><input style="width: 600px;" type="text" name="name_one" id="" class="" value="{{ $bill->name_one }}"></td>
				<td><input style="width: 100px;" type="text" name="price_one" id="price_one" value="{{ $bill->price_one }}" ></td>
				<td><input style="width: 50px;" type="text" name="quantity_one" id="quantity_one" value="{{ $bill->quantity_one }}" ></td>
				<td><input style="width: 100px;" type="text" name="total_one" id="total_one" value="{{ $bill->total_one }}" ></td>
				
			</tr>
			<tr style="background: white; height: 40px">
                <td><input style="width: 30px;" type="text" name="sn_two" id="" class="" value="{{ $bill->sn_two }}"  ></td>
				<td><input style="width: 600px;" type="text" name="name_two" id="" class="" value="{{ $bill->name_two }}"></td>
				<td><input style="width: 100px;" type="text" name="price_two" id="price_two" value="{{ $bill->price_two }}" ></td>
				<td><input style="width: 50px;" type="text" name="quantity_two" id="quantity_two" value="{{ $bill->quantity_two }}" ></td>
				<td><input style="width: 100px;" type="text" name="total_two" id="total_two" value="{{ $bill->total_two }}" ></td>
				
			</tr>
			<tr style="background: #e5e6e9; height: 40px">
                <td><input style="width: 30px;" type="text" name="sn_three" id="" class="" value="{{ $bill->sn_three }}"  ></td>
				<td><input style="width: 600px;" type="text" name="name_three" id="" class="" value="{{ $bill->name_three }}"></td>
				<td><input style="width: 100px;" type="text" name="price_three" id="price_three" value="{{ $bill->price_three }}" ></td>
				<td><input style="width: 50px;" type="text" name="quantity_three" id="quantity_three" value="{{ $bill->quantity_three }}" ></td>
				<td><input style="width: 100px;" type="text" name="total_three" id="total_three" value="{{ $bill->total_three }}" ></td>
				
			</tr>
			<tr style="background: white; height: 60px">
                <td><input style="width: 30px;" type="text" name="sn_four" id="" class="" value="{{ $bill->sn_four }}"  ></td>
				<td><input style="width: 600px;" type="text" name="name_four" id="" class="" value="{{ $bill->name_four }}"></td>
				<td><input style="width: 100px;" type="text" name="price_four" id="price_four" value="{{ $bill->price_four }}" ></td>
				<td><input style="width: 50px;" type="text" name="quantity_four" id="quantity_four" value="{{ $bill->quantity_four }}"  ></td>
				<td><input style="width: 100px;" type="text" name="total_four" id="total_four" value="{{ $bill->total_four }}" ></td> 
				
			</tr>
		</tbody>
	</table>
</div>
<div class="container" style="height: 11rem;">
	<div style="width: 65%; float: left;">
		<p>Thanku you for your business</p>
		<p style="margin-top: 13px;">Payment Info: </p>
		<p>Esewa: <span style="font-weight: 100;">9800971310</span></p>

<div class="box" style="width:100%; height:5rem;">
	<div style="width: 50%; float: left;">
		<p style="padding-top: 7px;">Bank Name: <span style="font-weight: 100;">Siddhartha Bank</span></p>
		<p>A/C Holder: <span style="font-weight: 100;">Matin Softech</span></p>
		<p>A/C no: <span style="font-weight: 100;">00319681350</span></p>
	</div>
	<div style="width: 50%; float: right;">
		<img src="https://demo.matinsoftech.com/public/front/scan.png" width="22%" style="    border: 2px solid orange;">
	</div>

</div>

		
	</div>
    <div style="width: 30%; float: right; padding-top: 20px;">
   
	<p>Sub Total : <input style="width: 100px;" type="text" name="sub_total" id="sub_total"  value="{{ $bill->sub_total }}" > </p>
		<p>Vat (13%) : <input style="width: 100px;" type="text" name="vat" id="vat" value="{{ $bill->vat }}"  > </p>
		<br>
		<p style="background: orange; padding: 10px;">Total : <input style="width: 100px;" type="text" name="all_total" id="all_total"  value="{{ $bill->all_total }}" > </p>
        <button type="submit">Submit</button>
	</div>

</form>   

</div>
<div class="container" style="height:1rem;">
<hr style="height: 4px; background: orange; border: 0px;">
<div style="width: 15%; float: right; margin-right: 10%;     margin-top: -18px; background: white;">
	<hr style="width:90%">
	<p style="text-align: center;">Authorised Sign</p>
</div>
</div>

<div class="container" style="height: 3rem; padding-top: 40px;">
	<div style="width:33%; float: left; ">
		
	<div style="width: 8%;float: left;"><span style="background: orange; padding:7px;"><i class="fa fa-phone" style=" color:white;"></i></span></div><div style="width: 90%;       margin-top: -11px; float: right;"> +977-9800971310<br>
			<span>	+91-7543800768<br></div>
				</span>		



	</div>
	<div style="width:34%; float: left; ">
		
<div style="width: 8%;float: left;"><span style="background: orange; padding:7px;"><i class="fa fa-envelope" style=" color:white;"></i></span></div><div style="width: 90%;       margin-top: -11px; float: right;"> matinsoftech@gmail.com<br>
			<span>	www.matinsoftech.com<br></div>
				</span>		



	</div>
	<div style="width:33%; float: left; ">
		
<div style="width: 8%;float: left;"><span style="background: orange; padding:7px;"><i class="fa fa-map" style=" color:white;"></i></span></div><div style="width: 90%;       margin-top: -11px; float: right;"> Matrika marg above hazi store,<br>
			<span>	2nd floor,Biratnagar-7<br></div>
				</span>	

	</div>
</div>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>


<script type="text/javascript">
$(document).ready(function(e){
    $('#total').keyup(function(){

var price = parseInt($("#price").val(), 10);
var quantity = parseInt($("#quantity").val(),10);
var total = parseInt(price) * parseInt(quantity);

  $("#total").val(total);


    });
});


</script>

<script type="text/javascript">
$(document).ready(function(e){
    $('#total_one').keyup(function(){

    var price = parseInt($("#price_one").val(), 10);
    var quantity = parseInt($("#quantity_one").val(),10);

    if(!price && !quantity){
        var total = 0;
    }else{
        var total = parseInt(price) * parseInt(quantity);
    }
    

    $("#total_one").val(total);

    });
});

</script>


<script type="text/javascript">

$(document).ready(function(e){
    $('#total_two').keyup(function(){

    var price = parseInt($("#price_two").val(), 10);
    var quantity = parseInt($("#quantity_two").val(),10);
    

    if(!price && !quantity){
        var total = 0;
    }else{
        var total = parseInt(price) * parseInt(quantity);
    }

    $("#total_two").val(total);

    });
});


$(document).ready(function(e){
    $('#total_three').keyup(function(){

    var price = parseInt($("#price_three").val(), 10);
    var quantity = parseInt($("#quantity_three").val(),10);
    

    if(!price && !quantity){
        var total = 0;
    }else{
        var total = parseInt(price) * parseInt(quantity);
    }

    $("#total_three").val(total);

    });
});



$(document).ready(function(e){
    $('#total_four').keyup(function(){

    var price = parseInt($("#price_four").val(), 10);
    var quantity = parseInt($("#quantity_four").val(),10);

    
    if(!price && !quantity){
        var total = 0;
    }else{
        var total = parseInt(price) * parseInt(quantity);
    }

    $("#total_four").val(total);

    });
});


$(document).ready(function(e){
    $('#sub_total').keyup(function(){

    var total = $('#total').val();
    var total_one = $('#total_one').val();
    var total_two = $('#total_two').val();
    var total_three = $('#total_three').val();
    var total_four = $('#total_four').val();

    if(total && total_one && total_two && total_three &&  total_four && total_three){
        var total = parseInt(total) +  parseInt(total_one) +  parseInt(total_two) +  parseInt(total_three) +  parseInt(total_four);
        $("#sub_total").val(total);
    }else if(total_one && total_two && total_three &&  total_four ){
        var total = parseInt(total_one) +  parseInt(total_two) +  parseInt(total_three) + parseInt(total_four);
        $("#sub_total").val(total);
    }else if(total_two &&  total_three && total_four){
        var total = parseInt(total_two) +  parseInt(total_three) + parseInt(total_four);
        $("#sub_total").val(total);
    }else if(total_four && total_three){
        var total = parseInt(total_three) +  parseInt(total_four);
        $("#sub_total").val(total);
    }else if(total_four){
        var total =  parseInt(total_four);
        $("#sub_total").val(total);
    }else if(total){
        var total =  parseInt(total);
        var total_one = 0;
        var total_two = 0;
        var total_three = 0;
        var total_four = 0;

        var added = parseInt(total) +  parseInt(total_one) + parseInt(total_two) + parseInt(total_three) + parseInt(total_four);
        $("#sub_total").val(added); 
    }


    });
});

$(document).ready(function(e){
    $('#vat').keyup(function(){

    var sub_total = $("#sub_total").val();
    var vat = 0.13; 
    var total = parseInt(sub_total) * parseFloat(vat);

    $("#vat").val(total);

    });
});


$(document).ready(function(e){
    $('#all_total').keyup(function(){

    var sub_total = $("#sub_total").val();
    var vat = 0.13; 
    var multiply = parseInt(sub_total) * parseFloat(vat);
    var all_total = parseInt(sub_total) + parseFloat(multiply);

    $("#all_total").val(all_total);

    });
});

</script>




</body>
</html>