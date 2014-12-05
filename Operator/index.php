<?php require_once( '../inc/DB.inc.php' ); ?>
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HC14' - Operator</title>
  <link rel="stylesheet" href="">
</head>

<body>
    
    <div id="dashboard">
    
        <table id="tbl-msgs">
    
            <tr> <th>#</th> <th>TABLE ID</th> <th>Q</th> <th>A</th> <th>TIMESTAMP</th> <th>&nbsp;</th> </tr>
            
            <?php

                $statusArray = array( 'Pending', 'Approved', 'Send', 'Revoke' );

                //$sql = "SELECT * FROM `tbl_qna` WHERE ( status = '1' )";
                $sql = "SELECT * FROM `tbl_qna` ORDER BY status ASC";
                $res = mysql_query( $sql );
                $num_rows = mysql_num_rows( $res );

                if ( $num_rows > 0 )
                {
                    while( $row = mysql_fetch_array( $res ) )
                    {
                        print '<tr> <td>'.$row['id'].'</td> <td>'.$row['table_id'].'</td> <td>'.$row['q'].'</td> <td>'.$row['a'].'</td> <td>'.date("Y-m-d H:i:s",$row['timestamp']).'</td> <td>'.$row['status'].'</td> <td onclick="sendMSG( this, '.$row['id'].' );">SEND</td> </tr>';
                    }
                }
            ?>
    
        </table>
        
    </div> <!--/dashboard-->
    
  <script src="js/libs/jquery.min.js"></script>
    
    <script src="js/scripts.js"></script>
    
    <script>
    
        setInterval(function(){
            
            getOpMsgs();
            
        }, 1000);
        
        function getOpMsgs()
        {
            $.post( window.API_PATH, { r: "json", a: "GET_OPMSGS" }, function( opJSONObj ) {
                  
                console.log( opJSONObj );

                if ( opJSONObj.action == 'success' )
                {   
                    if ( opJSONObj.data )
                    {
                        for ( var i=0; i<opJSONObj.msgs.length; i++ )
                        {
                            var tblRow = '<tr id="tr-'+opJSONObj.msgs[i].id+'"> <td>'+opJSONObj.msgs[i].id+'</td> <td>'+opJSONObj.msgs[i].table_id+'</td> <td>'+opJSONObj.msgs[i].q+'</td> <td>'+opJSONObj.msgs[i].a+'</td> <td>'+opJSONObj.msgs[i].timestamp+'</td> <td>'+opJSONObj.msgs[i].status+'</td> <td onclick="sendMSG( this, '+opJSONObj.msgs[i].id+');">SEND</td> </tr>';
                            
                            $("table#tbl-msgs").append( tblRow );
                            
                        } 
                    }
                }

            }, "json");
        }
        
        function sendMSG( e, id )
        {   
            $.post( window.API_PATH, { r: "json", a: "SEND_OPMSGS", id: id }, function( opJSONObj ) {
                
                console.log( opJSONObj );
                
                if ( opJSONObj.action == 'success' )
                {
                    $( e ).text("ON SCREEN");
                }
            
            }, "json");
            
        }
        
    </script>
</body>
</html>
<?php mysql_close( $connection ); ?>
