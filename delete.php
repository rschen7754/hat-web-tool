<html>
<head><title>Delete</title></head>
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
<body>
This will be a replacement for erwin85's delete tool.<br />
<h1>WARNING: this is a beta tool. You are responsible for your own deletions; please check before you delete!</h1>

<table id="projects" class="tablesorter">
<thead>
<tr><th>Wiki</th><th>Admins</th><th>Last action</th><th>Page name</th><th>Last author</th><th>Last revision</th><th>Edit summary</th></tr>
</thead>
<tbody>
	<?php
	require_once 'login.php';
	$db_server = mysql_connect("metawiki.labsdb", $db_username, $db_password);
	if (!$db_server) die ("Unable to connect to MySQL: " . mysql_error());
	
	mysql_select_db("meta_p", $db_server) or die ("Unable to select database: " . mysql_error());

	$query = "SELECT dbname,REPLACE(url, 'http://', 'https://') AS domain, slice FROM wiki WHERE url IS NOT NULL AND is_closed=0;";
	$result = mysql_query($query);
	
	if (!$result) die ("Database access failed: " . mysql_error());
	
	$rows = mysql_num_rows($result);

	for ($j = 0; $j < $rows; ++$j)
	{
		$row = mysql_fetch_row($result);
		
		$db_server_temp = mysql_connect($row[2], $db_username, $db_password);
		if (!$db_server_temp) die ("Unable to connect to MySQL: " . mysql_error());
	
		mysql_select_db($row[0]."_p", $db_server_temp) or die ("Unable to select database: " . mysql_error());

		$query2 = "SELECT sum(if(ug_group = 'sysop', 1, 0)) FROM user_groups;";
		$result2 = mysql_query($query2);
	
		if (!$result2) die ("Database access failed: " . mysql_error());
		
		$row2 = mysql_fetch_row($result2);
		
		if ($row2[0] <= 0) {
		
		$query3 = "SELECT pl_title FROM pagelinks LEFT JOIN page ON page_id = pl_from WHERE page_title = 'Delete' AND page_namespace = 10 AND page_is_redirect = 1 LIMIT 1;";
		$result3 = mysql_query($query3);
	
		if (!$result3) die ("Database access failed: " . mysql_error());
		
		$template = "Delete";
		
		if (!$result3) {
            $template = "Delete";
        } elseif (mysql_num_rows($result3) == 1) {
            $template = mysql_result($result3, 0);
        } else {
            $template = "Delete";
        }
        
        $query4 = "SELECT page_title, rev_timestamp, rev_user_text, rev_comment FROM page LEFT JOIN templatelinks ON tl_from = page_id LEFT JOIN revision ON rev_page = page_id WHERE tl_title = '" . $template . "' AND tl_namespace=10 AND rev_timestamp = (SELECT max(rev_timestamp) FROM revision AS r WHERE rev_page = page_id)";
		$result4 = mysql_query($query4);
	
		if (!$result4) die ("Database access failed: " . mysql_error());
		
		$rows4 = mysql_num_rows($result4);
		
		for ($k = 0; $k < $rows4; ++$k)
			{
				$rowD = mysql_fetch_row($result4);
				echo "<tr><td><a href=\"" . $row[1] . "\">". $row[0] . "</a></td>";
				echo "<td><a href=\"" . $row[1]. "/wiki/Special:ListUsers/sysop\">".$row2[0]."</td>\n";
				echo "<td></td>";
				echo "<td><a href=\"" . $row[1]. "/wiki/".$rowD[0]."\">".$rowD[0]."</td>\n";
				echo "<td><a href=\"" . $row[1]. "/wiki/".$rowD[0]."\">".$rowD[2]."</td>\n";
				echo "<td></td>";
				echo "<td><a href=\"" . $row[1]. "/wiki/".$rowD[0]."\">".$rowD[3]."</td>\n";
			}
		}
	}
	?>

</tbody>
</table>
<br />
<p>Acknowledgements to <a href="http://tools.wmflabs.org/erwin85/">erwin85</a> for the 
original tool, and to <a href="http://tools.wmflabs.org/pathoschild-contrib/">Pathoschild</a> 
for creating the extensive suite of tools that I used as an example.</p>
</body>
</html>