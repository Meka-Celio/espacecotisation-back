<?php 

	if (isset($_POST['submit']))
	{
		var_dump($_POST);
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=devicewidth, initialscale=1">
	<title>Filtre sur année</title>

	<style type="text/css">
	/* .hide {
		visibility: hidden;
	} */	


</style>

</head>
<body>

	<form action="#" method="post">
		2021<input class="cel hide" type="checkbox" name="notPaid[]" id="37" value="2021 - 500" aria-details="0">
		2020<input class="cel hide" type="checkbox" name="notPaid[]" id="36" value="2020 - 700" aria-details="1">
		2019<input class="cel hide" type="checkbox" name="notPaid[]" id="35" value="2017 - 700" aria-details="2">
		2018<input class="cel hide" type="checkbox" name="notPaid[]" id="34" value="2017 - 700" aria-details="3">
		2017<input class="cel hide" type="checkbox" name="notPaid[]" id="33" value="2017 - 700" aria-details="4">

		<input type="submit" name="submit" value="Regler ma cotisation">
	</form>

<script>

window.addEventListener("DOMContentLoaded", (event) => {

    var mesCheck = document.querySelectorAll("input[type=checkbox]")
    var newT = []
    var reverseT = []
    var submitBTN = document.querySelector('input[type=submit]')
    console.log(mesCheck)

    for (let index = mesCheck.length-1; index >= 0; index--) {
        reverseT.push(mesCheck[index]) 
    }

    for (let index = 0; index < mesCheck.length; index++) {
        newT.push(mesCheck[index])
    }

    submitBTN.addEventListener('submit', (e) => {

    })

    newT.forEach(input => {
    	input.addEventListener('click', () => {
    		let nbr = input.getAttribute('aria-details')
    		for (let i = nbr; i < newT.length; i++){
    			if (newT[i].checked)
    			{
    				input.checked = true
    				console.log(input)
    			}
    			else {
    				input.checked = false
    			}
    		}
    	})
    })


});

</script>


</body>
</html>
