<?php
# Timestamp
date_default_timezone_set("Asia/Colombo");
$timestamp = strtotime(date("Y-m-d H:i:s"));

# DB
require_once( '../inc/DB.inc.php' );

# Get DATA
$sql = "SELECT * FROM tbl_qna WHERE (status='1') LIMIT 1";
$res = mysql_query( $sql );
?>

<div>

    <?php while( $row = mysql_fetch_array($res) ) { ?>
    
        <?php print $row['q']; ?>
    
    <?php } ?>
    
</div>

<?php
mysql_close( $connection );

print date('Y-m-d H:i:s');

// EOF.