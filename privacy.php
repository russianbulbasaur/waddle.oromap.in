<?php
echo '
<html>
<head>
<body bgcolor="#002B36">
<br><br>
<div class="mail" style="display:inline-block;text-align:centre;">
<label style="width:100%;font-size:100px;display:inline-block;text-align:center;color:#FFFFFF;">Waddle Privacy Policy</label>
<br><br><br>
<div style="width:100%;display:inline-block;text-align:center;">
<p style="word-spacing:3px;font-size:300%;line-height: normal;width: 90%;color: #FFFFFF;display: inline-block;text-align:start;">'.fread(fopen("privacy.txt","r"),filesize("privacy.txt")).'</p>
</div>
</div>
</body>
</html>
';
?>