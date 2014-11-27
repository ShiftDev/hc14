<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HC14' - Screen</title>
  <link rel="stylesheet" href="">
</head>

<body>
    
    <div id="dashboard">
    
        <!-- {dashboard.php} -->
        
    </div> <!--/dashboard-->
    
  <script src="js/libs/jquery.min.js"></script>
    
    <script>
    
        setInterval(function(){
            
            $("#dashboard").load('screen.php');
            
        }, 1000);
        
    </script>
</body>
</html>
