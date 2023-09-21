<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<link rel="icon" href="Favicon.ico" type="image/x-icon">
<title>IZB-CRM</title>
    
</head>
<body>
<?php 
include 'init.php';
if($users->isLoggedIn()) {
	header('Location: ticket.php');
}
$errorMessage = $users->login();
include('inc/header.php');
?>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image justify-content-center">
                    <!-------Image-------->
                    <!-- <img src="images/white.png" alt=""> -->
                  
                </div>
                <div class="col-md-6 right">
                     <div class="input-box">
                     <?php if ($errorMessage != '') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
				<?php } ?>
      
        
				<form id="loginform" class="form-horizontal" role="form" method="POST" action="">      
                    <h1 class="text-center">Hello!</h1>
                        <p class="lead fw-normal mb-0 me-3 text-center">Sign in your account</p>                              
                                <div style="margin-bottom: 25px; margin-top: 25px; " class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Username/Email." style="background:white; padding: 25px;" required>                                        
                                </div>                                
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" style="background:white; padding: 25px;"  id="password" name="password"placeholder="Password" required>
                                </div>
                 
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit" name="login" value="Submit" class="text-white" style="background:
            rgba(177, 0, 0, 1); border: rgba(177, 0, 0, 1);">SUBMIT</button>
                        
                        <!-- <p class="lead fw-normal mb-0 me-3 text-center">Forgot Password?</p>                               -->
                            
			
				</form> 
                   
                     </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>