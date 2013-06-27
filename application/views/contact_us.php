


  <script type="text/javascript">
		// function to submit form to controller
		SubmittingForm=function() {
			// get form values
			var nameInput = $('#nameInput').val();
			var emailInput = $('#emailInput').val();
			var messageInput = $('#messageInput').val();
			// post form values

			// swap form with thank you
			$('#showContactForm').fadeOut('slow', function(){$('#showContactThanks').fadeIn("slow")});
		
		} //	end SubmittingForm	
		$(document).ready(function() {
			// validate the selected form
			$("#contactUsForm").validate({
				// create handler for form related events
				submitHandler:function(form) {
					// if form is valid do this...
					SubmittingForm();
				},
				// set rules for name, email, and message
				rules: {
					name: "required",		// simple rule, converted to {required:true}
					email: {				// compound rule
						required: true,
						email: true
					},
					message: {
						required: true
					}
				},
				messages: {
					// create pre-defined error messages
					name: "Please enter a name.",
					email: "Please enter a valid email.",
					message: "Please enter a message."
				}
			});
		});



	
	</script>

	<style type="text/css">
	#showContactForm, #showContactThanks {
	  font-size:15px;	  
	  opacity:0.99;
	filter:alpha(opacity=99);
	}
.formContact {
  padding: 10px;
  width: 100%;

}

.formContact .contactSubmit {
  margin-left: 10.5%;
  margin-top: 10px;
  	background: -moz-linear-gradient(top,  rgba(188,190,228,0.76) 0%, rgba(188,190,228,0.78) 3%, rgba(190,198,236,0.78) 93%, rgba(190,198,236,0.76) 97%, rgba(190,198,236,0.51) 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(188,190,228,0.76)), color-stop(3%,rgba(188,190,228,0.78)), color-stop(93%,rgba(190,198,236,0.78)), color-stop(97%,rgba(190,198,236,0.76)), color-stop(100%,rgba(190,198,236,0.51))); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top,  rgba(188,190,228,0.76) 0%,rgba(188,190,228,0.78) 3%,rgba(190,198,236,0.78) 93%,rgba(190,198,236,0.76) 97%,rgba(190,198,236,0.51) 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top,  rgba(188,190,228,0.76) 0%,rgba(188,190,228,0.78) 3%,rgba(190,198,236,0.78) 93%,rgba(190,198,236,0.76) 97%,rgba(190,198,236,0.51) 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top,  rgba(188,190,228,0.76) 0%,rgba(188,190,228,0.78) 3%,rgba(190,198,236,0.78) 93%,rgba(190,198,236,0.76) 97%,rgba(190,198,236,0.51) 100%); /* IE10+ */
	background: linear-gradient(to bottom,  rgba(188,190,228,0.76) 0%,rgba(188,190,228,0.78) 3%,rgba(190,198,236,0.78) 93%,rgba(190,198,236,0.76) 97%,rgba(190,198,236,0.51) 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c28b0d00', endColorstr='#828d1508',GradientType=0 ); /* IE6-9 */
}

.formContact .label {
  display: block;
  float: left;
  width: 90px;
  text-align: right;
  margin-right: 5px;
}
.formContact label.error {
  width: 190px;
  display: block;

  color: red;
  padding-left: 10px;
}

.formContact .form-row {
  padding: 5px 0;
  clear: both;
  width: 100%;
}
.formContact input[type=text], select, textarea {
  width: 40%;
  float: left;
}

.formContact textarea {
  height: 100px;
  width:50%;
}
	</style>

<!-- and the html... -->




<body>
<div style="height:270px">
<div id="showContactForm" >
	Please use the contact form to get in touch with us. Thanks!
<div class="formContact">

 	<form id="contactUsForm" method="post" action="">
  		<div class="form-row">
      <span class="label">Name *</span>
      <input type="text" id="nameInput" name="name" class="text ui-widget-content ui-corner-all">
  		</div>
  		<div class="form-row">
      <span class="label">E-Mail *</span>
      <input id="emailInput" type="text" name="email" class="text ui-widget-content ui-corner-all">
  		</div>

  		<div class="form-row">
      <span class="label">Message *</span>
      <textarea id="messageInput" name="message" class="text ui-widget-content ui-corner-all"></textarea>
  		</div>
  		<div class="form-row">
      <input class="contactSubmit ui-button ui-state-default ui-corner-all ui-button-text-only" type="submit" value="Submit">
  		</div>
 	</form>
</div>
</div> <!-- end showContactForm -->
<div id="showContactThanks" style="display:none">
	Thanks,<br> Your Message has been set.
	 </div>
</div>