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

	$query = "SELECT dbname,REPLACE(url, "http://", "") AS domain, slice FROM wiki WHERE url IS NOT NULL AND is_closed=0;";
	$result = mysql_query($query);
	
	if (!$result) die ("Database access failed: " . mysql_error());
	?>

</tbody>
</table>
<br />
<p>Acknowledgements to <a href="http://tools.wmflabs.org/erwin85/">erwin85</a> for the 
original tool, and to <a href="http://tools.wmflabs.org/pathoschild-contrib/">Pathoschild</a> 
for creating the extensive suite of tools that I used as an example.</p>
</body>
</html>
