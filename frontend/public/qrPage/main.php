<html>
    <head>
        <title>Gate Check | QR Code Scan</title>
        <link rel="icon" type="image/x-icon" href="https://www.gate.com/frontend/src/images/logo.png"/>
        <script src="https://www.gate.com/frontend/lightSrc/assets/js/libs/jquery-3.1.1.min.js"></script>
        <script src="https://www.gate.com/frontend/src/js/functions/qrcode.js"></script>
        <script src="https://www.gate.com/frontend/src/js/functions/qrcode.min.js"></script>
    </head>
    <body style="margin: 0;">
        <center><div id="qrcode" style="margin-top: 100px;"></div></center>
    </body>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 500,
	height : 500
});

function makeCode () {		
	var elText = "https://www.gate.com/frontend/public/formEdit/mainForm";
	qrcode.makeCode(elText);
}

makeCode();
</script>
</html>