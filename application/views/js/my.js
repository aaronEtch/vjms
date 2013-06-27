// *********************************
// jquery for list view page
// *********************************
	// for delete dialog box 
	$(function() {
	$("#confirmDeleteButton").live('click', function() {
		// get the class of the row to delete. will start with ddv so get digits after
		// substring gets everything after the 3 digit
		
		var theOneToDelete = $(this).attr('class').substring(3);
		
		$( "#dialogWineConDelete" ).dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Delete item": function() {
					// ajac
					$.ajax({
					  url: 'http://vintners.tastecaliforniawines.com/site/deleteWine/'+ theOneToDelete,
					  success: function(data) {
					   $("#lv"+ theOneToDelete).hide('slow'); 
					  }
					});
					// end ajax site/deleteTheMaking/$whr->wineId/$whr->calendarId
					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	
		});// close click

		// add wine selecting container
		$( "#wineContainer" ).selectable(); 
		$( "#wineContainerUpdate" ).selectable(); 

		//   create form objects
		var wineName = $( "#wineName" ),
			wineNameUpdate = $( "#wineNameUpdate" ),
			varietal = $( "#varietal" ),
			varietalUpdate = $( "#varietalUpdate" ),
			vintage = $( "#vintage" ),
			vintageUpdate = $( "#vintageUpdate" ),
			quantity = $( "#quantity" ),
			quantityUpdate = $( "#quantityUpdate" ),
			wineUserId = $("#wineUserId"),
			// to clear			
			allFields = $( [] ).add( wineName ).add( varietal ).add( vintage ).add( quantity ).add( wineNameUpdate ).add( varietalUpdate ).add( vintageUpdate ).add( quantityUpdate ),
			tips = $( ".validateTips" );
			

		// shows tips to fix form errors
		// t is the text string for error
		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
		// check string length 
		// o = object, n = name associated, min = min char, max -= max char
		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );			
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				
				return false;
			} else {
				return true;
			}
		}
		// check reg expression allowed
		// o = object, regexp = regular expression criteria, n = name associated.
		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		// insert new wine dialog form		
		$( "#dialogWineInsert" ).dialog({
			autoOpen: false,
			height: 500,
			width: 350,
			modal: true,
			buttons: {
				
				"Add New Wine": function() {
					var container = $('#wineContainer .ui-selected').attr('id');	
					var bValid = true;
					allFields.removeClass( "ui-state-error" );
					bValid = bValid && checkLength( wineName, "Wine Name", 3, 16 );
					bValid = bValid && checkLength( vintage, "Vintage", 2, 4 );
					bValid = bValid && checkRegexp( wineName, /([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					bValid = bValid && checkRegexp( vintage, /([0-9])+$/i, "Vintage may consist of numbers 0-9" );					
					if ( bValid ) {
						
						
						var newWineData = 'wineName='+wineName.val()+'&varietal='+varietal.val()+'&vintage='+vintage.val()+
						'&quantity='+quantity.val()+'&wineContainer='+container+'&userId='+wineUserId.val();
						// ajax
							$.ajax({
								  type: "POST",
								  url: 'http://vintners.tastecaliforniawines.com/site/addNewWine',
								  data: { 	wineNamePost: wineName.val(),
								  			userIdPost: wineUserId.val(),
								  			varietalPost: varietal.val(),
								  			vintagePost: vintage.val(),
								  			quantityPost: quantity.val(),
								  			wineContainerPost: container			  	
								  	},
								  		  success: function(data) {
					 						location.reload();	
					 					//	alert('success');
					  					}
								})
							// end ajax
						
						$( this ).dialog( "close" );
						
					//	alert('form passed '+newWineData);
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );				
			}
		}// end button

		);
 // end dialog form
		$( "#addWine" )
			.button()
			.click(function() {
				$( "#dialogWineInsert" ).dialog( "open" );
			});
// update form
		$( "#dialogWineUpdate" ).dialog({
			autoOpen: false,
			height: 500,
			width: 350,
			modal: true,
			buttons: {
				"Update Wine": function() {
					allFields.removeClass( "ui-state-error" );
					var containerUpdate = $('#wineContainerUpdate .ui-selected').attr('id');	
					var theOneToUpdate = $(this).data('theOneToUpdateKey');
					var bValid = true;
					bValid = bValid && checkLength( wineNameUpdate, "Wine Name", 3, 16 );					
					bValid = bValid && checkLength( vintageUpdate, "Vintage", 2, 4 );
					bValid = bValid && checkRegexp( wineNameUpdate, /([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
					bValid = bValid && checkRegexp( vintageUpdate, /([0-9])+$/i, "Vintage may consist of numbers 0-9" );					
					if ( bValid ) {
						
						
						var newWineData = 'update wineID: '+theOneToUpdate+'wineNameUpdate='+wineNameUpdate.val()+'&varietal='+varietalUpdate.val()+'&vintageUpdate='+vintageUpdate.val()+
						'&quantity='+quantityUpdate.val()+'&wineContainer='+containerUpdate;
						// ajax
							$.ajax({
								  type: "POST",
								  url: 'http://vintners.tastecaliforniawines.com/site/updateWine',
								  data: { 	wineNameUpdatePost: wineNameUpdate.val(),
								  			wineIdUpdatePost: theOneToUpdate,
								  			varietalUpdatePost: varietalUpdate.val(),
								  			vintageUpdatePost: vintageUpdate.val(),
								  			quantityUpdatePost: quantityUpdate.val(),
								  			wineContainerUpdatePost: containerUpdate			  	
								  	},
								  		  success: function(data) {
					 						location.reload();	
					 						//alert('success');
					  					}
								})	
							// end ajax
						
						$( this ).dialog( "close" );
						
						//alert('form passed '+newWineData);
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					// remove contianer type
					$("#dialogWineUpdate #wineContainerUpdate #"+fContainer).removeClass('ui-selected');
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
				// remove contianer type
				$("#dialogWineUpdate #wineContainerUpdate #"+fContainer).removeClass('ui-selected');				
			}
		});
 // end update form form
 
 // select update form and fill in date
		$( "#updateWineButton" ).live('click', function() {
			var theOneToUpdate = $(this).attr('class').substring(3);
			var fName = $("#lv"+theOneToUpdate+" .formName").text();
			$("#dialogWineUpdate #wineNameUpdate").val(fName);
			fVarietal = $("#lv"+theOneToUpdate+" .formVarietal").text();
			$("#dialogWineUpdate #varietalUpdate").val(fVarietal);
			fVintage = $("#lv"+theOneToUpdate+" .formVintage").text();
			$("#dialogWineUpdate #vintageUpdate").val(fVintage);
			fQuantity = $("#lv"+theOneToUpdate+" .formQuantity").text();
			$("#dialogWineUpdate #quantityUpdate").val(fQuantity);
			fContainer = $("#lv"+theOneToUpdate+" .formContainer").text();
			$("#dialogWineUpdate #wineContainerUpdate #"+fContainer).addClass('ui-selected');
			
			//alert("update wine:"+fName+"<br>varietal: "+fVarietal+"<br>vin: "+fVintage+"<Br>container: "+fContainer);
			// attach wine id data to the element
			$( "#dialogWineUpdate" ).data('theOneToUpdateKey',theOneToUpdate );
			$( "#dialogWineUpdate" ).dialog( "open" );
			});
	});