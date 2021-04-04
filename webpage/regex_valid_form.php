<?php

	$pattern="";
	$text="";
	$replaceText="";
	$replacedText="";

	$match="Not checked yet.";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$pattern=$_POST["pattern"];
	$text=$_POST["text"];
	$replaceText=$_POST["replaceText"];
    // $replacedText = preg_replace($pattern, $replaceText, $text);
    $replacedText = "AF";

	if(preg_match($pattern, $text)) {
        $match="Match!";
    } else {
        $match="Does not match!";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Valid Form</title>
</head>
<body>
	<form style="width: 400px; margin: 15% auto;" action="regex_valid_form.php" method="post">
		<dl>
			<dt>Pattern</dt>
			<dd><input style="width: 100%; min-height: 20px" type="text" name="pattern" value="<?= $pattern ?>"></dd>

			<dt>Text</dt>
            <dd><textarea style="width: 100%; min-height: 20px" name="text" rows="6"><?= $text ?></textarea></dd>

			<dt>Replace Text</dt>
			<dd><input style="width: 100%; min-height: 20px" type="text" name="replaceText" value="<?= $replaceText ?>"></dd>

			<dt>Output Text</dt>
			<dd><?=	$match ?></dd>

			<dt>Replaced Text</dt>
			<dd> <code><?=	$replacedText ?></code></dd>

			<dt>&nbsp;</dt>
			<dd><input type="submit" value="Check"></dd>
		</dl>

	</form>
</body>
</html>
