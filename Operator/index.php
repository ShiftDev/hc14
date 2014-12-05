<?php require_once( '../inc/DB.inc.php' ); ?>
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HC14' - Operator</title>
  <link rel="stylesheet" href="">
    
    <style>

        tr.onscreen {background:#ccc;}
        
    </style>

</head>

<body>
    
    <div id="dashboard">
        
        <div class="connectivity">&nbsp;</div> <!--/connectivity-->
    
        <table id="tbl-msgs">
    
            <tr id="tds"> <th>#</th> <th>TABLE ID</th> <th>Q</th> <th>A</th> <th>TIMESTAMP</th> <th>STATUS</th> <th>&nbsp;</th> </tr>
            
            <?php

                //reste
                $sql = "UPDATE ``tbl_qna` SET `opscreen` = '0' ";
                mysql_query( $sql );

                $statusArray = array( 'Pending', 'Approved', 'On Screen' );
                $cmdArray = array( 'Approve', 'Send to Screen', 'Revoke' );
                $statusClassArray = array('stmsg stmsg-pending','stmsg stmsg-approved','stmsg stmsg-screen');

                //$sql = "SELECT * FROM `tbl_qna` WHERE ( status = '1' )";
                //$sql = "SELECT * FROM `tbl_qna` ORDER BY status ASC";
                $sql = "SELECT * FROM `tbl_qna` ORDER BY id DESC";
                $res = mysql_query( $sql );
                $num_rows = mysql_num_rows( $res );

                if ( $num_rows > 0 )
                {
                    while( $row = mysql_fetch_array( $res ) )
                    {
                        $id = $row['id'];
                        
                        $status_text = $statusArray[$row['status']];
                        
                        if ( ($row['status'] == '2') && ($row['onscreen'] == '0') )
                        {
                            $status_text = '';
                        }
                        
                        $tr_class = 'r';
                        if ( $row['onscreen'] == '1' )
                        {
                            $tr_class = $tr_class.' onscreen';
                        }
                        
                        print '<tr id="r-'.$id.'" class="'.$tr_class.'"> 
                                    <td>'.$id.'</td> 
                                    <td>'.$row['table_id'].'</td> 
                                    <td>'.$row['q'].'</td> 
                                    <td>'.$row['a'].'</td> 
                                    <td>'.date("Y-m-d H:i:s",$row['timestamp']).'</td>                      
                                    <td><span id="it-'.$row['id'].'" class="'.$statusClassArray[$row['status']].'">'.$status_text.'</span></td> 
                                    <td>
                                        <button data-iid="'.$row['id'].'" data-ist="'.$row['status'].'" onclick="ctrlOpt(this);">'.$cmdArray[$row['status']].'</button>
                                    </td>
                                </tr>';
                        
                        //update
                        $innerSql = "UPDATE `tbl_qna` SET `opscreen` = '1' WHERE `id` = '$id';";
                        mysql_query( $innerSql );
                    }
                }
            ?>
    
        </table>
        
    </div> <!--/dashboard-->
    
  <script src="js/libs/jquery.min.js"></script>
    
    <script src="js/scripts.js"></script>
    
    <script>
        
        window.statusArray = "Pending,Approved,OnScreen";
        window.cmdArray = "Approve,Send to Screen,Revoke";
        window.statusClassArray = "stmsg stmsg-pending, stmsg stmsg-approved, stmsg stmsg-screen";
    
        setInterval(function(){
            
            getOpMsgs();
            
        }, 1000);
        
        function ctrlOpt( e )
        {   
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
                val = val +1;
            }
            
            $.post( window.API_PATH, { r: "json", a: "OPT_CHANGE", id: iid, val: val }, function( opJSONObj ) {
                
                console.log( opJSONObj );

                if ( opJSONObj.action == 'success' )
                {
                    var val2 = val;
                    
                    //approve
                    if ( ist == '0' )
                    {
                        $(".stmsg").removeClass( 'stmsg-pending' );
                        $(".stmsg").addClass( 'stmsg-approve' );
                    }
                    
                    //send to screen
                    if ( ist == '1' )
                    {
                        $(".stmsg-screen").text("");
                        $(".stmsg").removeClass( 'stmsg-screen' );
                        $(".stmsg").addClass( 'stmsg-done' );
                         $("#it-"+iid).addClass( 'stmsg-screen' );
                        
                        $("tr.r").removeClass( 'onscreen' );
                        $("tr#r-"+iid).addClass( 'onscreen' );
                         $("#it-"+iid).removeClass( 'stmsg-done' );
                    }
                    
                    //revoke
                    if ( ist == '2' )
                    {
                        val2 = val2*1;
                        val2 = val2 -1;
                        
                        val2 = val2 -1;
                        
                        $("tr#r-"+iid).removeClass( 'onscreen' );
                        $(".stmsg").removeClass( 'stmsg-done' );
                        $(".stmsg").addClass( 'stmsg-approved' );
                        
                        var tmp = window.statusArray;
                        tmp = tmp.split(',');
                        $("#it-"+iid).text( tmp[1] );
                    }
                    
                    
                    $( e ).data('ist',val2);
                    var tmp = window.cmdArray;
                    tmp = tmp.split(',');
                    $( e ).text( tmp[ val2 ] );
                    
                    var tmp = window.statusArray;
                    tmp = tmp.split(',');
                    $("span#it-"+iid).text( tmp[ val2 ] );
                }

            }, "json");
            
        }
        
        function getOpMsgs()
        {
            $.post( window.API_PATH, { r: "json", a: "GET_OPMSGS" }, function( opJSONObj ) {
                  
                console.log( opJSONObj );

                if ( opJSONObj.action == 'success' )
                { 
                    $(".connectivity").text( "Connection:OK" );
                    
                    if ( opJSONObj.data )
                    {
                        var tmp1 = window.statusArray;
                        tmp1 = tmp1.split(',');
                        var tmp2 = window.cmdArray
                        tmp2 = tmp2.split(',');
                        var tmp3 = window.statusClassArray;
                        tmp3 = tmp3.split(',');
                        
                        for ( var i=0; i<opJSONObj.msgs.length; i++ )
                        {
                            //var tblRow = '<tr id="tr-'+opJSONObj.msgs[i].id+'"> <td>'+opJSONObj.msgs[i].id+'</td> <td>'+opJSONObj.msgs[i].table_id+'</td> <td>'+opJSONObj.msgs[i].q+'</td> <td>'+opJSONObj.msgs[i].a+'</td> <td>'+opJSONObj.msgs[i].timestamp+'</td> <td><span id="'+opJSONObj.msgs[i].id+'">'+tmp1[opJSONObj.msgs[i].status]+'<span></td> <td>SEND</td> </tr>';
                            
                            var tblRow = '<tr id="tr-'+opJSONObj.msgs[i].id+'"> <td>'+opJSONObj.msgs[i].id+'</td> <td>'+opJSONObj.msgs[i].table_id+'</td> <td>'+opJSONObj.msgs[i].q+'</td> <td>'+opJSONObj.msgs[i].a+'</td> <td>'+opJSONObj.msgs[i].timestamp+'</td> <td><span class="'+tmp3[opJSONObj.msgs[i].status]+'" id="it-'+opJSONObj.msgs[i].id+'">'+tmp1[opJSONObj.msgs[i].status]+'<span></td> <td><button data-iid="'+opJSONObj.msgs[i].id+'" data-ist="'+opJSONObj.msgs[i].status+'" onclick="ctrlOpt(this);">'+tmp2[opJSONObj.msgs[i].status]+'</button></td> </tr>';
                            
                            
                            //$("table#tbl-msgs").prepend( tblRow );
                            
                            $( tblRow ).insertAfter( "tr#tds" );
                            
                        } 
                    }
                }
                else
                {
                    $(".connectivity").text( "Connection:Fail" );
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
