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
    
            <tr> <th>#</th> <th>TABLE ID</th> <th>Q</th> <th>A</th> <th>TIMESTAMP</th> <th>STATUS</th> <th>&nbsp;</th> </tr>
            
            <?php

                $statusArray = array( 'Pending', 'Approved', 'On Screen' );
                $cmdArray = array( 'Approve', 'Send to Screen', 'Revoke' );

                //$sql = "SELECT * FROM `tbl_qna` WHERE ( status = '1' )";
                $sql = "SELECT * FROM `tbl_qna` ORDER BY status ASC";
                $res = mysql_query( $sql );
                $num_rows = mysql_num_rows( $res );

                if ( $num_rows > 0 )
                {
                    while( $row = mysql_fetch_array( $res ) )
                    {
                        print '<tr> 
                                    <td>'.$row['id'].'</td> 
                                    <td>'.$row['table_id'].'</td> 
                                    <td>'.$row['q'].'</td> 
                                    <td>'.$row['a'].'</td> 
                                    <td>'.date("Y-m-d H:i:s",$row['timestamp']).'</td>                      
                                    <td><span id="it-'.$row['id'].'">'.$statusArray[$row['status']].'</span></td> 
                                    <td>
                                        <button data-iid="'.$row['id'].'" data-ist="'.$row['status'].'" onclick="ctrlOpt(this);">'.$cmdArray[$row['status']].'</button>
                                    </td>
                                </tr>';
                    }
                }
            ?>
    
        </table>
        
    </div> <!--/dashboard-->
    
  <script src="js/libs/jquery.min.js"></script>
    
    <script src="js/scripts.js"></script>
    
    <script>
    
        setInterval(function(){
            
            //getOpMsgs();
            
        }, 1000);
        
        function ctrlOpt( e )
        {   
            window.statusArray = "Pending,Approved,OnScreen";
            window.cmdArray = "Approve,Send to Screen,Revoke";
            
            var iid = $( e ).data('iid');
            var ist = $( e ).data('ist');
            
            // 0=aprrove
            if ( ist == '0' )
            {   
                var val = ist*1;
                val = val +1;
            }
            
            // 1=Send To Screen
            if ( ist == '1' )
            {
                var val = ist*1;
                val = val +1;
            }
            
            // 2=revoke
            if ( ist == '2' )
            {
                var val = ist*1;
                val = val -1;
            }
            
            $.post( window.API_PATH, { r: "json", a: "OPT_CHANGE", id: iid, val: val }, function( opJSONObj ) {
                
                console.log( opJSONObj );

                if ( opJSONObj.action == 'success' )
                {
                    $( e ).data('ist',val);
                    var tmp = window.cmdArray;
                    tmp = tmp.split(',');
                    $( e ).text( tmp[ val ] );
                    
                    var tmp = window.statusArray;
                    tmp = tmp.split(',');
                    $("span#it-"+iid).text( tmp[ val ] );
                }

            }, "json");
            
        }
        
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
                            var tblRow = '<tr id="tr-'+opJSONObj.msgs[i].id+'"> <td>'+opJSONObj.msgs[i].id+'</td> <td>'+opJSONObj.msgs[i].table_id+'</td> <td>'+opJSONObj.msgs[i].q+'</td> <td>'+opJSONObj.msgs[i].a+'</td> <td>'+opJSONObj.msgs[i].timestamp+'</td> <td>'+opJSONObj.msgs[i].status+'</td> <td onclick="ctrlOpt( this, '+opJSONObj.msgs[i].id+');">SEND</td> </tr>';
                            
                            $("table#tbl-msgs").append( tblRow );
                            
                        } 
                    }
                }
                else
                {
                    alert( 'Connection Issue' );
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
