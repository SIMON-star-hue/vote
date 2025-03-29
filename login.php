<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>u-decide</title>


<?php include('./header.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>


</head>
<style>
	body{
		
		text-align: center;
		margin-top: 300px;
		background-color: black;
	}
#login-form{
background-color: whitesmoke;
margin-left: auto;
margin-right: auto;
width: 270px;
border-radius: 10px;
font-family:'Courier New', Courier, monospace;
font-weight: bold;
}
input{
border-radius: 8px;
height: 25px;

}
button{
	border-radius: 10px;
	height: 26px;
	font-size: 16px;
}
button:hover{
	background-color: aqua;
	color: white;
}
img{
	height: 120px;
	margin-top: -20px;

}
</style>

<body>
<img src="vote.png">
<form id="login-form" >
<label for="username" >Student-Number</label>
<input type="text" id="username" name="username" >
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" id="password" name="password" >
</div>
<button>Login</button></center>
</form>


</main>

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
$('#login-form').submit(function(e){
e.preventDefault()
$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
if($(this).find('.alert-danger').length > 0 )
$(this).find('.alert-danger').remove();
$.ajax({
url:'ajax.php?action=login',
method:'POST',
data:$(this).serialize(),
error:err=>{
console.log(err)
$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

},
success:function(resp){
if(resp == 1){
location.href ='index.php?page=home';
}else if(resp == 2){
location.href ='voting.php';
}else{
$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
}
}
})
})
</script>	
</html>