<?php require_once( '../inc/DB.inc.php' ); ?>
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HC14' - Screen</title>
  <link rel="stylesheet" href="">
</head>

<body>
    
    <div id="screen">
    
        <div id="msg">
        
            <?php
                $sql = "SELECT * FROM `tbl_qna` WHERE ( onscreen = '1' ) LIMIT 1";
                $res = mysql_query( $sql );
                $num_rows = mysql_num_rows( $res );

                if ( $num_rows > 0 )
                {
                    while( $row = mysql_fetch_array( $res ) )
                    {
                        print $row['q'];
                    }
                }
            ?>
            
        </div> <!--/msg-->
        
    </div> <!--/screen-->
    
  <script src="js/libs/jquery.min.js"></script>
    
    <script src="js/scripts.js"></script>
    
    <script>
    
        setInterval(function(){
            
            getSCRMsgs();
            
        }, 1000);
        
        function getSCRMsgs()
        {
            $.post( window.API_PATH, { r: "json", a: "GET_SCRMSGS" }, function( opJSONObj ) {
                
                console.log( opJSONObj );
                
                if ( opJSONObj.action == 'success' )
                {
                    if ( opJSONObj.data )
                    {
                        var msgHtml = opJSONObj.msg.q;
                        
                        $("#msg").html( msgHtml );
                    }
                    else
                    {
                        $("#msg").html( 'NO QUESTIONS' );
                    }
                    
                }
                
            }, "json");
        }
        
    </script>
</body>
</html>
<?php mysql_close( $connection ); ?>
