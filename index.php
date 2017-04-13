<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style/css/bootstrap.css">
 <style>
        #right{
            margin-top: -340px;
            margin-left: 500px;
            width:800px;
            padding: 20px;
            background-color: azure;
        }
        #left{
            margin-left: 30px;
            margin-top: 0px;
            padding-bottom: 40px;
            background-color: aliceblue;
            width:400px;
            
        }
        .row{
            width:300px;
            
            margin-left: 40px;
        }
        @font-face{
            font-family: newfont;
            src: url(style/font/overpass/Overpass-ExtraLight.ttf);
        }
        h1{
           margin: auto;
            margin-left:55px;
            font-family: newfont;
        }
        .icon-addon{
            position: relative;
            color:#555;
            display: block;
        }
        .icon-addon:after,
        .icon-addon:before{
            display: table;
            content:" ";
        }
        .icon-addon:after{
            clear:both;
        }
        .icon-addon.addon-lg .glyphicon{
            position: absolute;
            z-index:2;
            left:10px;
            font-size:16px;
            width: 20px;
            margin-left: -2.5px;
            text-align: center;
            padding: 10px 0;
            top: 5px;
        }
        .icon-addon.addon-lg .form-control{
            line-height: 1.33;
            height: 46px;
            font-size:18px;
            padding: 10px 16px 10px 40px;
        }
        .head{
            margin-left: -50px;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        .framebox{
            margin-left: 0px;
            width:750px;
        }
    </style>
    </head>
    <body>
        
        <div class="container" id="left">
            
            <div class="row" style="margin-top: 5%">
             <form action="process.php" method="post">
                <div class="page-header">
                    <h1>Admin Login</h1>
                </div>
                <div class="form-group">
                    <div class="icon-addon addon-lg">
                        <label class="glyphicon glyphicon-user" rel="tooltip"></label>
                        <input id="user" required type="text" placeholder="Userid" class="form-control" name="user">
                    </div>
                </div>
                <div class="form-group">
                    <div class="icon-addon addon-lg">
                        <label class="glyphicon glyphicon-lock" rel="tooltip"></label>
                        <input id="pass" required type="password" placeholder="Password" class="form-control" name="pass">
                    </div>
                </div>
                 <button class="btn btn-primary btn-block" name="submit">Login</button>
            </form>
                 </div>
        </div>
        <div class="container" id="right">
            <div class="head">
                <h1>Test List</h1>
            </div>
            <div class="framebox">

    <?php               
        include("connection.php");
                session_start();
        //query & result        
        $query = "SELECT * FROM testinfo ORDER BY test_date ASC, start_time ASC";
        $result = mysqli_query($conn,$query); ?>

        <table class="table table-responsive table-bordered">
        <tr>
        <th>Teacher Name</th>
        <th>TestName</th>
        <th>Start time</th>
        <th>Test Date</th>
        <th>Start</th>
        </tr>
        <?php
        if(mysqli_num_rows($result)>0){
            // we have data /
            // output the data
            
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>". $row['teacher_name']."</td><td>". $row['test_name']."</td><td>".$row['start_time']."</td><td>". $row['test_date']."</td>";
                
                date_default_timezone_set("Asia/kolkata");
                if(!strcmp($row['test_date'],date("Y-m-d")) && (strcmp($row['start_time'],date("H:i:s"))<=0) && (strcmp($row['end_time'],date("H:i:s"))>0)){
                    $_SESSION['testid']=$row['No']; $_SESSION['tablename']=$row['teacher_name'].$row['test_name'];
                echo '<td> <a href="user_login.php?id='.$row['No'].'" type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span> Click To Start </a></td>';
                }
                else{echo '<td> <a type="button" class="btn btn-danger btn-sm " onclick="disable()" disabled><strike><span class="glyphicon glyphicon-remove-sign"></span> Click To Start</strike> </a></td>';
                     echo "<script> function disable(){ alert('This test is about to be stated');}</script> ";
                    }
                echo"</tr>";
            }
        }
        else{
            echo "<div class='alert alert-warning'>No Test</div>";
        }
        
        ?>
                
                
                </div>
        </div>
    
    </body>

</html>