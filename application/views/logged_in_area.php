
	<h2>Welcome Back to Vintners Journal, <?php $user = $this->ion_auth->user()->row();echo $user->first_name; ?>!</h2>
     <p>This section represents the area that only logged in members can access.</p>
     <P>Click on <?php echo anchor('members/list_view', 'List View'); ?> to view your wines.</P>
     <P>user info: 
     	
     	</P>
	
