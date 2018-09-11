<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Software Sales</title>

</head>

<body style="background:#CCC">

 <div style="width:550px; margin:0px auto; border:solid 1px #999; margin-top:20px; background:#FFF">
     <table cellpadding="0" cellspacing="0" style="width:100%; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; line-height:18px;">
<tr>
<td style="	border-bottom: 5px solid #2196F3;padding:10px; text-align:center;background-color: #e2027c;">
<img alt="SOFTWARE SALES Logo" src="https://softwaresales.com.au/images/footer-logo.png" width="150">
</td>
</tr>    
            <tr>
                <td style="padding:0px 10px;">
                 <p>Dear <strong><?=$fname.'&nbsp;'.$lname?>,</strong></p>
                    <p>You have successfully registered yourself on <a href="<?=base_url()?>">SOFTWARE SALES</a></p>
                    <p>Following are your login details:<br />
                       User-id: <?=$email?><br />
                       Password: <?=$password?></p>
                    <p>
                     Welcome to <strong>SOFTWARE SALES</strong> Kindly use these login details for website access and enquiry/Order generation. For any other assistance, write to us at <a href="#">info@softwaresales.com.au</a> or visit our website <a href="<?=base_url()?>">SOFTWARE SALES</a>
                    </p>  
                    <p>Thank you, <br />Warm Regards,</p> <p>Team <br /><strong>SOFTWARE SALES</strong></p>
                    <p style="text-transform:uppercase;">This is a system Generated Mail. Please Do Note Reply To it </p>

                </td>
            </tr>
        </table>
    </div>

</body>
</html>