<html>
<head>
<title>Welcome</title>

<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<?php include 'db.php';?>
</head>
<body>


<h1>Button should be enabled if at least one checkbox is checked</h1>

<form>
    <div>
        <input type="checkbox" name="option-1" id="option-1"> <label for="option-1">Option 1</label>
    </div>
    <div>
        <input type="checkbox" name="option-2" id="option-2"> <label for="option-2">Option 2</label>
    </div>
    <div>
        <input type="checkbox" name="option-3" id="option-3"> <label for="option-3">Option 3</label>
    </div>
    <div>
        <input type="checkbox" name="option-4" id="option-4"> <label for="option-4">Option 4</label>
    </div>
    <div>
        <input type="checkbox" name="option-5" id="option-5"> <label for="option-5">Option 5</label>
    </div>
    
    <div>
        <input type="submit" value="Do thing" disabled>
    </div>
</form>



<script>
	var checkboxes = $("input[type='checkbox']"),
	    submitButt = $("input[type='submit']");

	checkboxes.click(function() {
	    submitButt.attr("disabled", !checkboxes.is(":checked"));
	});
</script>