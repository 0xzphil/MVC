<!DOCTYPE html>
<html lang="en">
<head>        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <title>NTQ Solution Admin Control Panel</title>

    <link rel="icon" type="image/ico" href="view/favicon.ico"/>
    
    <link href="<?php echo PATH; ?>/public/css/stylesheets.css" rel="stylesheet" type="text/css" />
    
</head>
<body>
    
    <div class="loginBox">        
        <div class="loginHead">
            <img src="<?php echo PATH; ?>/public/img/logo.png" alt="NTQ Solution Admin Control Panel" title="NTQ Solution Admin Control Panel"/>
        </div>
        <form class="form-horizontal" action="index.php?controller=user&action=login" method="POST">            
            <div class="control-group">
                <label for="inputUsername" >Username</label> 
                <?php if(isset($error['username'])) echo $error['username']; ?>               
                <input type="text" id="inputUsername"  name="username" value="" />
            </div>
            <div class="control-group">
                <label for="inputPassword">Password</label>    
                <?php if(isset($error['password'])) echo $error['password']; ?>            
                <input type="password" id="inputPassword"  name="password" value="" />                
            </div>
            <div class="control-group" style="margin-bottom: 5px;">                
                <label class="checkbox"><input type="checkbox" name="remember_me"> Remember me</label>                                                
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-block" name="login" value="Login">Sign in</button>
            </div>
        </form>        
        
    </div>    
    
</body>
</html>
