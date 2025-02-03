<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="uploadfilemulti.css" rel="stylesheet">
<script src="jquery-1.8.0.min.js"></script>
<script src="jquery.fileuploadmulti.min.js"></script>
</head>
<body>

<div id="mulitplefileuploader">Upload</div>

<div id="status"></div>
<script>

$(document).ready(function()
{

var settings = {
	url: "upload.php",
	method: "POST",
	allowedTypes:"jpg,png,gif,doc,pdf,zip",
	fileName: "myfile",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$("#status").html("<font color='green'>Upload is success</font>");
        },
        afterUploadAll:function()
        {
                alert("all images uploaded!!");
        },
	onError: function(files,status,errMsg)
	{		
		$("#status").html("<font color='red'>Upload is Failed</font>");
	}
}
$("#mulitplefileuploader").uploadFile(settings);

});
</script>
</body>