<?php
# Timestamp
date_default_timezone_set("Asia/Colombo");
$timestamp = strtotime(date("Y-m-d H:i:s"));

# DB
require_once( '../inc/DB.inc.php' );

# Get DATA
$sql = "SELECT * FROM tbl_qna";
$res = mysql_query( $sql );
?>

<table>
    
    <tr> <th>#</th> <th>TABLE ID</th> <th>Q</th> <th>A</th> <th>TIMESTAMP</th> <th>&nbsp;</th> </tr>
    
    <?php $i=1; ?>
    
    <?php while( $row = mysql_fetch_array($res) ) { ?>
    
        <tr> 
            <td><?php print $i; ?></td> <td><?php print $row['table_id']; ?></td> <td><?php print $row['q']; ?></td> <td><?php print $row['a']; ?></td>
            
            <td><span><?php print $row['timestamp']; ?></td> <td><?php if ( $row['status']=='0' ) { print 'APPROVE'; } else { print 'DISAPPROVE'; } ?></span></td> 
            
        </tr>
    
    <?php $i++; ?>
    
    <?php } ?>
    
</table>

<script>

    function aprroveTheMsg()
    {
        alert( 'aprroveTheMsg()' );
    }
    
</script>

<?php
mysql_close( $connection );

print date('Y-m-d H:i:s');

// EOF.