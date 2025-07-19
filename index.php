<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="index.css" />

        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
       
        <div class="col-md-3"></div>
        <div class="col-md-6 well">
                <h3 class="text-primary">Login and Registration</h3>
                <hr style="border-top:1px dotted #ccc;"/>
                <div class="col-md-2"></div>
                <div class="col-md-8">
                        
                        <form action="logquery.php" method="POST">  
                                <h4 class="text-success">Login here...</h4>
                                <hr style="border-top:1px groovy #000;">
                                <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username" />
                                </div>
                                <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" />
                                </div>
                                <br />
                                <div class="form-group">
                                        <button class="btn btn-primary form-control" name="login"  href="home.php">Login</button>
                                </div>
                                <a href="registration.php">Registration</a>
                        </form>
                </div>
        </div>
</body>
</html>