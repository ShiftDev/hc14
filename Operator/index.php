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
    
        </table>
        
    </div> <!--/dashboard-->
    
  <script src="js/libs/jquery.min.js"></script>
    
    <script src="js/scripts.js"></script>
    
    <script>
    
        setInterval(function(){
            
            //$("#dashboard").load('dashboard.php');
            getMsgs( '0' );
            
        }, 1000);
        
        function getMsgs( s )
        {
            $.post( window.API_PATH, { r: "json", a: "GET_OPMSGS", s: s }, function( opJSONObj ) {
                  
                console.log( opJSONObj );

                if ( opJSONObj.action == 'success' )
                {   
                    if ( opJSONObj.data )
                    {
                        for ( var i=0; i<opJSONObj.msgs.length; i++ )
                        {
                            var tblRow = '<tr id="tr-'+opJSONObj.msgs[i].id+'"> <td>'+opJSONObj.msgs[i].id+'</td> <td>'+opJSONObj.msgs[i].table_id+'</td> <td>'+opJSONObj.msgs[i].q+'</td> <td>'+opJSONObj.msgs[i].a+'</td> <td>'+opJSONObj.msgs[i].timestamp+'</td> <td onclick="sendMSG( this, '+opJSONObj.msgs[i].id+');">SEND</td> </tr>';
                            
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
