<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>LinkLiv Education Payment Failed</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Poppins:300,400,700' rel='stylesheet' type='text/css'>
	<style type="text/css">
	body {background: #f5f5f5;font-family: 'Poppins', 'arial', sans-serif;font-weight: normal;margin: 0;padding: 0;text-align: center;height: 100vh;overflow: hidden;}
	.container.paypage {margin-left:  auto;margin-right:  auto;padding: 10% 15px;} 
	.paypage h2{font-size: 3em;font-weight: 700;margin: 20px 0 10px 0; line-height: 1.1} 
	.paypage h3 {font-size: 2em;font-weight: 300;margin: 0} 
	.paypage p{margin: 0 0 10px;font-size: 14px;font-weight: 400;} 
	.paypage a.but{color: #fff;background:#16bec3;text-decoration: none !important; font-weight: 700;padding: 15px 25px; text-transform: uppercase;display: inline-block; margin-top: 20px;}
	.paypage a.but:hover, a.but:focus {background: #f79100;}
	svg {
      width: 100px;
      display: block;
      margin: 40px auto 0;
    }
    .path {
      stroke-dasharray: 1000;
      stroke-dashoffset: 0;
    }
    .path.circle {
      -webkit-animation: dash 0.9s ease-in-out;
      animation: dash 0.9s ease-in-out;
    }
    .path.line {
      stroke-dashoffset: 1000;
      -webkit-animation: dash 0.9s 0.35s ease-in-out forwards;
      animation: dash 0.9s 0.35s ease-in-out forwards;
    }
    .path.check {
      stroke-dashoffset: -100;
      -webkit-animation: dash-check 0.9s 0.35s ease-in-out forwards;
      animation: dash-check 0.9s 0.35s ease-in-out forwards;
    }
    p {
      text-align: center;
      margin: 20px 0 60px;
      font-size: 1.25em;
    }
    p.success {
      color: #73AF55;
    }
    p.error {
      color: #D06079;
    }
    @-webkit-keyframes dash {
      0% {
        stroke-dashoffset: 1000;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }
    @keyframes dash {
      0% {
        stroke-dashoffset: 1000;
      }
      100% {
        stroke-dashoffset: 0;
      }
    }
    @-webkit-keyframes dash-check {
      0% {
        stroke-dashoffset: -100;
      }
      100% {
        stroke-dashoffset: 900;
      }
    }
    @keyframes dash-check {
      0% {
        stroke-dashoffset: -100;
      }
      100% {
        stroke-dashoffset: 900;
      }
    }
	.headstart, .footer {display:none;}</style>

</head>
<body>
	
	<div class="container text-center paypage">
	    <div class="row">
	    	<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12"><br>
	    	    <a href="http://linkliveducation.localhost.com/" class="logo">LinkLiv Education</a><br>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                  <circle class="path circle" fill="none" stroke="#D06079" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1"/>
                  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
                  <line class="path line" fill="none" stroke="#D06079" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
                </svg>
                <p class="error">OOps!</p>
	    	    
    	    	<h2>Some Error Occured!</h2>
    	        <p>Your payment could not be complete please try again.</p>
	    		<p><a class="but" href="http://linkliveducation.localhost.com/">Go Back to Home</a></p><br>
	    	</div>
	    </div>
	</div>

</body>
</html>