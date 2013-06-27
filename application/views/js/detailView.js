
	$(function() {
		$( "#processSelectType, #processSelectTypeUpdate" ).selectable(); 
		// date picker
		$( "#datepicker, #datepickerUpdate" ).datepicker({
			showOn: "button",
			buttonImage: "<?php echo base_url();?>img/calendar.gif",
			buttonImageOnly: true
		});
	});
	// next
	$(function() {
	//$('#processSelectType li').click(function() {
   // var ids = $('#processSelectType .ui-selected').map(function() {
    //    return $(this).data('userid');
   	//	 });
    //	var wineContainer = ids.toArray().join(',');
    //	alert(wineContainer);	
	$('#processSelectType li').bind('click',function(){
	var action = $('#processSelectType .ui-selected').attr('id'); 
	//alert(action);
	$('#wineAction').removeClass( "ui-state-error" );
	$('#labAction').removeClass( "ui-state-error" );
	if (action == 'wineAction'){
		$("#labProcess").hide(200);
		$("#labProcessValue").hide(400);
		$("#labProcessUnits").hide(400);
		$("#wineProcess").show(200);
		$("#processNotes").show("slow");
		}
	else if (action == 'labAction'){
		$("#wineProcess").hide(200);
		$("#labProcess").show(200);
		$("#labProcessValue").show(400);
		$("#labProcessUnits").show(600);
		$("#processNotes").show("slow");
		}
	action = '';
	});
	// foldout for update form
	$('#processSelectTypeUpdate li').bind('click',function(){
	var updateAction = $('#processSelectTypeUpdate .ui-selected').attr('id'); 
	//alert(action);
	$('#wineActionUpdate').removeClass( "ui-state-error" );
	$('#labActionUpdate').removeClass( "ui-state-error" );
	if (updateAction == 'wineAction'){
		$("#labProcessUpdate").hide(200);
		$("#labProcessValueUpdate").hide(400);
		$("#labProcessUnitsUpdate").hide(400);
		$("#wineProcessUpdate").show(200);
		$("#processNotes").show("slow");
		}
	else if (updateAction == 'labAction'){
		$("#wineProcessUpdate").hide(200);
		$("#labProcessUpdate").show(200);
		$("#labProcessValueUpdate").show(400);
		$("#labProcessUnitsUpdate").show(600);
		$("#processNotesUpdate").show("slow");
		}
	updateAction = '';
	});	
	});
// new jquery coming up

	// for delete dialog box [id^='confirmDeleteButton']
	$(function() {
	$("#confirmDeleteButton").live('click', function() {
		// get the class of the row to delete. will start with ddv so get digits after
		var theOneToDelete = $(this).attr('class').substring(3);
		

		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:140,
			modal: true,
			buttons: {
				"Delete item": function() {
					// ajac
					$.ajax({
					  url: '<?php echo base_url();?>site/deleteTheMaking/'+ theOneToDelete,
					  success: function(data) {
					   $("#dv"+ theOneToDelete).hide('slow'); 
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
}); // ci load jq


// open add new dialogue
$(function() {
			// add selectable
		var wineId = <?php echo $this->uri->segment(3); ?>,
			notes = $( "#notes" ),
			date = $( "#datepicker" ),
			//wine proccess
			wineProcess = $("#wineProcessType"),
			wineProcessUpdate = $("#wineProcessTypeUpdate"),
			// lab process
			labProcess = $("#labProcessType"),
			labValue = $("#labValue"),
			unitValue = $("#labUnit"),
			
			allFields = $( [] ).add( notes ).add( date ).add( wineProcess ).add( labProcess ).add( labValue ).add( unitValue ),
			tips = $( ".validateTips" );		
		
		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
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
		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		// check date
		function isDate(txtDate)
		{
		  var currVal = txtDate.val();
		  
		  if(currVal == ''){
		    updateTips( "No Value entered" );
		    txtDate.addClass( "ui-state-error" );
		    return false;
		    }
		  
		  //Declare Regex  
		  var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; 
		  var dtArray = currVal.match(rxDatePattern); // is format OK?
		
		  if (dtArray == null){
		  updateTips( "Date format must be mm/dd/yyyy" );
		  txtDate.addClass( "ui-state-error" );
		     return false;}
		 
		  //Checks for mm/dd/yyyy format.
		  dtMonth = dtArray[1];
		  dtDay= dtArray[3];
		  dtYear = dtArray[5];
		  
		  if (dtMonth < 1 || dtMonth > 12){
		      txtDate.addClass( "ui-state-error" );
		      updateTips( "Month numbers must be 1 to 12" );
		      return false;}
		  else if (dtDay < 1 || dtDay> 31){
		  	txtDate.addClass( "ui-state-error" );
		  	updateTips( "Day numbers to high or low" );
		  	return false;
		  }
		      
		  else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31){
		  	txtDate.addClass( "ui-state-error" );
		  	updateTips( "Day numbers to high or low" );
		  	return false;
		  }		      
		  else if (dtMonth == 2)
		  {
		     var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
		     if (dtDay> 29 || (dtDay ==29 && !isleap)){
		     	txtDate.addClass( "ui-state-error" );
		     	updateTips( "Day numbers to high or low" );
		  		return false;
		  		}	
		  }
		  return true;
		}
		// add new wine event dialgue box
		$( "#dialog-form" ).dialog({
			autoOpen: false,
			height: 500,
			width: 550,
			modal: true,
			buttons: {
				"Add New Wine Event": function() {
					var actionType = $('#processSelectType .ui-selected').attr('id');
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && isDate(date);
					//var functionDate = date.val()
					//alert ("date: " +functionDate + " isdate: "+isDate(functionDate));
					if (actionType == undefined && bValid == true ){
						bValid = bValid && false;
						$('#wineAction').addClass( "ui-state-error" );
						$('#labAction').addClass( "ui-state-error" );
						updateTips( "Please Select Additon Type" );
						
					}
					else if (actionType == 'labAction'){
						bValid = bValid && checkRegexp( labProcess, /([0-9a-z_])+$/i, "Please Select Unit Type" );
						bValid = bValid && checkRegexp( labValue, /([0-9])+$/i, "Unit Value must consist of numbers 0-9" );					
						bValid = bValid && checkRegexp( unitValue, /([0-9a-z_])+$/i, "Please Select Unit Type" );
					}
					else if (actionType == 'wineAction'){
						bValid = bValid && checkRegexp( wineProcess, /([0-9a-z_])+$/i, "Please Select Unit Type" );
					}
					if ( bValid ) {
						
						
						var newWineData = 'wine Id='+wineId+' \ndate='+date.val()+' \nnotes='+notes.val()+
						'\n Action='+actionType+' \nlab Process Id='+labProcess.val()+
						' \nwine process Id'+wineProcess.val()+' \nlab value'+labValue.val()+' \nunit val'+unitValue.val();
						// ajax
							$.ajax({
													  type: "POST",
													  url: 'http://vintners.tastecaliforniawines.com/site/addNewWineEvent',
													  data: { 	wineIdPost: wineId,
													  			datePost: date.val(),
													  			notesPost: notes.val(),
													  			actionTypePost: actionType,
													  			labActionIdPost: labProcess.val(),
													  			wineActionIdPost: wineProcess.val(),
													  			labValuePost: labValue.val(),
													  			unitValuePost: unitValue.val()			  	
													  	},
													  		  success: function(data) {
										 						location.reload();	
										 					
										  					}
								})	
							// end ajax
						
						$( this ).dialog( "close" );
						
					//	alert('form passed\n'+newWineData);
							
					} // end if bValid
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );				
			}
		});
		$( "#addWine" )
			.button()
			.click(function() {
				$( "#dialog-form" ).dialog( "open" );
			});
				// add new wine event dialgue box
		$( "#dialog-update" ).dialog({
			autoOpen: false,
			height: 500,
			width: 550,
			modal: true,
			buttons: {
				"Update Wine Event": function() {
					var actionType = $('#processSelectTypeUpdate .ui-selected').attr('id');
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && isDate(dateUpdate);
					//var functionDate = date.val()
					//alert ("date: " +functionDate + " isdate: "+isDate(functionDate));
					if (actionType == undefined && bValid == true ){
						bValid = bValid && false;
						$('#wineAction').addClass( "ui-state-error" );
						$('#labAction').addClass( "ui-state-error" );
						updateTips( "Please Select Additon Type" );
						
					}
					else if (actionType == 'labAction'){
						bValid = bValid && checkRegexp( labProcess, /([0-9a-z_])+$/i, "Please Select Unit Type" );
						bValid = bValid && checkRegexp( labValue, /([0-9])+$/i, "Unit Value must consist of numbers 0-9" );					
						bValid = bValid && checkRegexp( unitValue, /([0-9a-z_])+$/i, "Please Select Unit Type" );
					}
					else if (actionType == 'wineAction'){
						bValid = bValid && checkRegexp( wineProcess, /([0-9a-z_])+$/i, "Please Select Unit Type" );
					}
					if ( bValid ) {
						
						
						var newWineData = 'wine Id='+wineId+' \ndate='+date.val()+' \nnotes='+notes.val()+
						'\n Action='+actionType+' \nlab Process Id='+labProcess.val()+
						' \nwine process Id'+wineProcess.val()+' \nlab value'+labValue.val()+' \nunit val'+unitValue.val();
						// ajax

							// end ajax
						
						$( this ).dialog( "close" );
						
						alert('form passed\n'+newWineData);
							
					} // end if bValid
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );				
			}
		});
		 // select update form and fill in date
		$( "#updateWineEventButton" ).live('click', function() {
			var calIdToUpdate = $(this).attr('class').substring(3);
			// date
			var fDate = $("#dv"+calIdToUpdate+" .formDate").text();
			$("#dialog-update #datepicker").val(fDate);
			// process
			fProcess = $("#dv"+calIdToUpdate+" .formProcess").text();
			$("#dialog-update #processUpdate").val(fProcess);
			// lab value
			fLabValue = $("#dv"+calIdToUpdate+" .formLabValue").text();
			$("#dialog-update #labValueUpdate").val(fLabValue);
			// lab 
			fLabUnit = $("#dv"+calIdToUpdate+" .formLabUnit").text();
			$("#dialog-update #labUnitUpate").val(fLabUnit);
			
			if (fLabValue) {
				$("#dialog-update #processSelectTypeUpdate #labAction").addClass('ui-selected');
				$('#processSelectTypeUpdate li').trigger('click');
				// maybe try to use -this- instead
				//$("#dialog-update #processSelectType #wineAction").removeClass('ui-selected');
				alert("lab action");	
			}
			else {
				$("#dialog-update #processSelectTypeUpdate #wineAction").addClass('ui-selected');
				$('#processSelectTypeUpdate li').trigger('click');
				//$("#dialog-update #processSelectType #labAction").removeClass('ui-selected');				
				alert("wine action");
			}
			// notes update 
			fNotes = $("#dv"+calIdToUpdate+" .formNotes").text();
			$("#dialog-update #notesUpdate").val(fNotes);
			
			alert("it is:"+calIdToUpdate+"\ndate: "+fDate+"\nprocess"+fProcess+"\nLab Value: "+fLabValue+"\nLab Unit: "+fLabUnit+"\nNotes: "+fNotes);
			//fQuantity = $("#lv"+calIdToUpdate+" .formQuantity").text();
			//$("#dialog-update #quantityUpdate").val(fQuantity);
			
			//fContainer = $("#dv"+calIdToUpdate+" .formContainer").text();
			//$("#dialog-update #wineContainerUpdate #"+fContainer).addClass('ui-selected');
			
			//alert("update wine:"+fName+"<br>varietal: "+fVarietal+"<br>vin: "+fVintage+"<Br>container: "+fContainer);
			// attach wine id data to the element
			$( "#dialog-update" ).data('calIdToUpdateKey',calIdToUpdate );
			$( "#dialog-update" ).dialog( "open" );
			alert("open");
			});
	});

