<div id="homeColOne" >
<div id="grapeImage"></div>
<h3>Welcome Vintners Journal</h3>
<p>Vintners Journal is a web based wine management system. 
	To get started <?php echo anchor('auth/signup', 'create an account');?> and log in. 
	Once logged in you can create profiles for each of your wines. 
	For each wine you can add dated events like crushing and fermintation. Mobile website coming soon...</p>
</div>

<div id="login_form">

<?php echo form_open("auth/login");?>

  <p>Email:
    <input type="text" name="identity"></>         
  </p>      
  <p>Password:
    <input type="password" name="password"></>      
  </p>      
  <p>
   <label for="remember">Remember Me:</label>
      <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
 </p><br>
  <p><?php echo form_submit('submit', 'Login');?></p>      
<?php echo form_close();?>
</div><!-- end login_form-->


	
