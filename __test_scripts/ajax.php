<script>
function search(str){
	if(str.length == 0){
		document.getElementById("results").innerHTML = "";
		return;
	} else {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById("results").innerHTML = xmlhttp.responseText;
			}
		};
		xmlhttp.open("GET", "search.php?q=" + str, true);
		xmlhttp.send();
	}
}
</script>