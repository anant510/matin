<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LetterPad</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>
  window.addEventListener("load", window.print());
</script> -->
	<style type="text/css">
		.container
		{
			width: 85%;
			height: 11rem;
			padding: 0px 7%;
		}
		h1, h2, h3, h4, h5, h6, p
		{
			margin-top: 5px;
    margin-bottom: 5px;
    font-weight: bold;
    font-family: system-ui;
		}
	hr{
		width: 73%;
    float: right;
    height: 5px;
    background: orange;
    border: 0px;
	}
	#heading
	{
		    font-size: 39px;
    font-family: sans-serif;
    color: #16167c;
	}
	#ptext
	{    font-size: 19px;
    font-family: system-ui;
    font-weight: 600;
    letter-spacing: 3px;
}




	</style>

</head>
<body>
	
<div class="container">
	<div style="width: 10%; float: left; background-color:black;">
		<img src="{{ asset('logo/logo.png') }}" width="100%" >
	</div>
    <div style="width: 90%; float: right; padding-top: 20px;">
	<h1 id="heading">Matin Softech<hr></h1>	
	<p id="ptext">One Stop destination for website development, App development &<br> ecommerce solution</p>
	</div>
</div>
<div class="container" style="height: 11rem;">
	<div style="width: 65%; float: left;">
		<!-- <p>Shahbaz <span style="color: orange;">Ali</span></p>
		<p style="margin-top: 13px;">CEO</p> -->
		<p> <span style="color: orange;">A</span><span style="font-weight: 100;"> : Matrika marg above hazi store, 2nd floor, Biratnagar-7</span></p>
	<p> <span style="color: orange;">W</span><span style="font-weight: 100;"> : www.matinsoftech.com</span></p>
	<p> <span style="color: orange;">P</span><span style="font-weight: 100;"> : +977-9800971310 / +91-7543800768</span></p>

		
	</div>
<div style="width: 30%; float: right;">
		<p style="margin-top: 106px; font-weight: 600;">Date :  {{ $letterpad->date }}</p>
	</div>
</div>


<div class="container" style="height: 10rem; background-image: url('2.png');background-repeat: no-repeat; background-position: center;    background-position: center;" >
    {!! $letterpad->content !!}
</div>

<div class="container" style="height: 7rem;">
	<div style="width: 65%; float: left;">
		<p>Shahbaz Ali</p>
		<p style="font-weight:100;">Manager</p>

		
	</div>
<div style="width: 30%; float: right;">
	
		</div>
</div>



<div class="container" style="height: 3rem; padding-top: 40px;     width: 80%;">
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


<div class="container" style="height:3rem; background: rgb(255,165,0);background: linear-gradient(133deg, rgba(255,165,0,1) 66%, rgba(255,255,255,1) 66%, rgba(255,255,255,1) 67%, rgba(20,12,116,1) 67%, rgba(20,12,116,1) 73%, rgba(255,255,255,1) 73%, rgba(255,255,255,1) 74%, rgba(255,165,0,1) 74%, rgba(255,165,0,1) 76%, rgba(255,255,255,1) 76%);">


</div>


</body>
</html>