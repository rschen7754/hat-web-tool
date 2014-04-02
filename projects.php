<html>
<head><title>Projects</title>
<style type="text/css">@import "blue/style.css";</style>
<script type="text/javascript" src="jquery-latest.js"></script> 
<script type="text/javascript" src="jquery.tablesorter.js"></script> 
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#projects").tablesorter(); 
    } 
); 
</script>
</head>
<body>
This will be a replacement for erwin85's projects tool.

<br /><br />
<table id="projects" class="tablesorter">
<thead>
<tr><th>Wiki</th><th>sysop</th><th>bureaucrat</th><th>checkuser</th><th>oversight</th></tr>
</thead>
<tbody>
	<?php
	require_once 'login.php';
	$db_server = mysql_connect("metawiki.labsdb", $db_username, $db_password);

	if (!db_server) die ("Unable to connect to MySQL: " . mysql_error());

	mysql_select_db("meta_p", $db_server) or die ("Unable to select database: " . mysql_error());


	?>

</tbody>
</table>
<br />
<p>Acknowledgements to erwin85 for the original tool, and to Pathoschild for creating the 
extensive suite of tools that I used as an example.</p>
</body>
</html>
