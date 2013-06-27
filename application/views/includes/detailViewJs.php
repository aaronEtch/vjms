<script>
	
	$(function() {
		$( "#processSelectType, #processSelectTypeUpdate" ).selectable(); 
		// date picker
		$( "#datepicker, #datepickerUpdate" ).datepicker({
			showOn: "button",
			buttonImage: "http://vintners.tastecaliforniawines.com/img/calendar.gif",
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
	$('#processSelectTypeUpdate li').click(function(){
	var updateAction = $('#processSelectTypeUpdate .ui-selected').attr('id'); 
	//alert("proc select selected: "+updateAction);
	$('#wineActionUpdate').removeClass( "ui-state-error" );
	$('#labActionUpdate').removeClass( "ui-state-error" );
	if (updateAction == 'wineActionUpdate'){
		$("#labProcessUpdate").hide(200);
		$("#labProcessValueUpdate").hide(400);
		$("#labProcessUnitsUpdate").hide(400);
		$("#wineProcessUpdate").show(200);
		$("#processNotesUpdate").show("slow");
		//alert("proc select selected - in wine update: "+updateAction);
		}
	else if (updateAction == 'labActionUpdate'){
		$("#wineProcessUpdate").hide(200);
		$("#labProcessUpdate").show(200);
		$("#labProcessValueUpdate").show(400);
		$("#labProcessUnitsUpdate").show(600);
		$("#processNotesUpdate").show("slow");
		//alert("proc select selected - in lab update: "+updateAction);
		}
	updateAction = '';
	});	
	});
// more jquery ...

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
					  url: 'http://vintners.tastecaliforniawines.com/site/deleteTheMaking/'+ theOneToDelete,
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
			// add selectable - was echo $this->uri->segment(3); 
			var wineId = location.href.substring(58),
			notes = $( "#notes" ),
			notesUpdate = $( "#notesUpdate" ),
			date = $( "#datepicker" ),
			dateUpdate = $( "#datepickerUpdate" ),
			//wine proccess
			wineProcess = $("#wineProcessType"),
			wineProcessUpdate = $("#wineProcessTypeUpdate"),
			// lab process
			labProcess = $("#labProcessType"),
			labProcessUpdate = $("#labProcessTypeUpdate"),
			labValue = $("#labValue"),
			labValueUpdate = $("#labValueUpdate"),
			unitValue = $("#labUnit"),
			unitValueUpdate = $("#labUnitUpdate"),

			
			allFields = $( [] ).add( notes ).add( date ).add( wineProcess ).add( labProcess ).add( labValue ).add( unitValue ).add( notesUpdate ).add( dateUpdate ).add( wineProcessUpdate ).add( labProcessUpdate ).add( labValueUpdate ).add( unitValueUpdate ),
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
						bValid = bValid && checkRegexp( unitValue, /([0-9a-z_%])+$/i, "Please Select Unit Type" );
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
													  url: '<?php echo base_url();?>site/addNewWineEvent',
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
						
						//alert('form passed\n'+newWineData);
							
					} // end if bValid
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					
				}
			},
			close: function() {
				//clear();
				$("#processSelectType li").removeClass('ui-selected');
				//;
				//$( "#dialog-form" ).remove();
			//			$("#labProcess").hide(200);
	//	$("#labProcessValue").hide(400);
	//	$("#labProcessUnits").hide(400);
	//	$("#wineProcess").hide(200);
		//$("#processNotes").css('display','none');
		//		$("#labProcess").css("display:none");

		//		$("#wineProcess").css("display:none");

				

				allFields.val( "" ).removeClass( "ui-state-error" );				
			}
		});
		$( "#addWine" )
			.button()
			.click(function() {
		$("#labProcess").hide();
		$("#labProcessValue").hide();
		$("#labProcessUnits").hide();
		$("#wineProcess").hide();
		$("#processNotes").hide();
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
					var actionTypeUpdate = $('#processSelectTypeUpdate .ui-selected').attr('id');
					//alert ("action type: "+actionType);
					var calIdToUpdate = $(this).data('calIdToUpdateKey');
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && isDate(dateUpdate);
					//var functionDate = date.val()
					//alert ("date: " +functionDate + " isdate: "+isDate(functionDate));
					if (actionTypeUpdate == undefined && bValid == true ){
						bValid = bValid && false;
						$('#wineActionUpdate').addClass( "ui-state-error" );
						$('#labActionUpdate').addClass( "ui-state-error" );
						//updateTips( "Please Select Additon Type" );
						
					}
					else if (actionTypeUpdate == 'labActionUpdate'){
						bValid = bValid && checkRegexp( labProcessUpdate, /([0-9a-z_])+$/i, "Please Select Unit Type" );
						bValid = bValid && checkRegexp( labValueUpdate, /([0-9])+$/i, "Unit Value must consist of numbers 0-9" );					
						bValid = bValid && checkRegexp( unitValueUpdate, /([0-9a-z_%])+$/i, "Please Select Unit Type" );
					}
					else if (actionTypeUpdate == 'wineActionUpdate'){
						bValid = bValid && checkRegexp( wineProcessUpdate, /([0-9a-z_])+$/i, "Please Select Unit Type" );
					}
					if ( bValid ) {
						
						
						var newWineData = 'call Id='+calIdToUpdate+' \ndate='+dateUpdate.val()+' \nnotes='+notesUpdate.val()+
						'\n Action='+actionTypeUpdate+' \nlab Process Id='+labProcessUpdate.val()+
						' \nwine process Id'+wineProcessUpdate.val()+' \nlab value'+labValueUpdate.val()+' \nunit val'+unitValueUpdate.val();
						// ajax
							$.ajax({
													  type: "POST",
													  url: '<?php echo base_url();?>site/updateWineEvent',
													  data: { 	
													  			calendarIdPostUpdate: calIdToUpdate,
													  			datePostUpdate: dateUpdate.val(),
													  			notesPostUpdate: notesUpdate.val(),
													  			actionTypePostUpdate: actionTypeUpdate,
													  			labActionIdPostUpdate: labProcessUpdate.val(),
													  			wineActionIdPostUpdate: wineProcessUpdate.val(),
													  			labValuePostUpdate: labValueUpdate.val(),
													  			unitValuePostUpdate: unitValueUpdate.val()			  	
													  	},
													  		  success: function(data) {
										 						location.reload();	
										 					
										  					}
								})
							// end ajax
						
						$( this ).dialog( "close" );
						
						//alert('form passed\n'+newWineData);
							
					} // end if bValid
				},
				Cancel: function() {
					$( this ).dialog( "close" );
					
				}
			},
			close: function() {
				// might not need 2 below
				$("#dialog-update #processSelectTypeUpdate #wineActionUpdate").removeClass('ui-selected');
				$("#dialog-update #processSelectTypeUpdate #labActionUpdate").removeClass('ui-selected');	
				
			}
		});
		 // select update form and fill in date
		$( "#updateWineEventButton" ).live('click', function() {
		// hide div process div fields
		$("#labProcessUpdate").hide();
		$("#labProcessValueUpdate").hide();
		$("#labProcessUnitsUpdate").hide();
		$("#wineProcessUpdate").hide();
		$("#processNotesUpdate").hide();
			var calIdToUpdate = $(this).attr('class').substring(3);
			// date
			var fDate = $("#dv"+calIdToUpdate+" .formDate").text();
			$("#dialog-update #datepickerUpdate").val(fDate);
			// process
			fProcess = $("#dv"+calIdToUpdate+" .formProcess").text();
			$("#dialog-update #processUpdate").val(fProcess);
			// lab value
			fLabValue = $("#dv"+calIdToUpdate+" .formLabValue").text();
			$("#dialog-update #labValueUpdate").val(fLabValue);
			// lab 
			fLabUnit = $("#dv"+calIdToUpdate+" .formLabUnit").text();
			$("#dialog-update #labUnitUpate").val(fLabUnit);
			// whatever
			$("#dialog-update #processSelectTypeUpdate #wineActionUpdate").removeClass('ui-selected');
			$("#dialog-update #processSelectTypeUpdate #labActionUpdate").removeClass('ui-selected');	
			if (fLabValue) {

				$("#dialog-update #processSelectTypeUpdate #labActionUpdate").addClass('ui-selected');
				
				$('#dialog-update #processSelectTypeUpdate #labActionUpdate').trigger('click');
				// lab process type
				var fLabProcess = $("#dv"+calIdToUpdate+" .formProcess").text();
				$('#dialog-update #labProcessUpdate #labProcessTypeUpdate option').filter(function() {
			    return $(this).text() == fLabProcess; 
				}).attr('selected', true);
				// units type
				var fLabProcessUnits = $("#dv"+calIdToUpdate+" .formLabUnit").text();
				$('#dialog-update #labProcessUnitsUpdate #labUnitUpdate option').filter(function() {
			    return $(this).text() == fLabProcessUnits; 
				}).attr('selected', true);
				//alert("lab action , and lab process: "+fLabProcess);	
			}
			else {
				$("#dialog-update #processSelectTypeUpdate #wineActionUpdate").addClass('ui-selected');
				
				$('#dialog-update #processSelectTypeUpdate #wineActionUpdate').trigger('click');
				// update wine
				var fProcess = $("#dv"+calIdToUpdate+" .formProcess").text();
				// add selected to the select option that matches fProcess
				$('#dialog-update #wineProcessUpdate #wineProcessTypeUpdate option').filter(function() {
			    return $(this).text() == fProcess; 
				}).attr('selected', true);

				
				//alert("wine action and: form process: "+fProcess);
			}
			// notes update 
			fNotes = $("#dv"+calIdToUpdate+" .formNotes").text();
			$("#dialog-update #notesUpdate").val(fNotes);
			
			//alert("it is:"+calIdToUpdate+"\ndate: "+fDate+"\nprocess"+fProcess+"\nLab Value: "+fLabValue+"\nLab Unit: "+fLabUnit+"\nNotes: "+fNotes);
			//fQuantity = $("#lv"+calIdToUpdate+" .formQuantity").text();
			//$("#dialog-update #quantityUpdate").val(fQuantity);
			
			//fContainer = $("#dv"+calIdToUpdate+" .formContainer").text();
			//$("#dialog-update #wineContainerUpdate #"+fContainer).addClass('ui-selected');
			
			//alert("update wine:"+fName+"<br>varietal: "+fVarietal+"<br>vin: "+fVintage+"<Br>container: "+fContainer);
			// attach wine id data to the element
	
			$( "#dialog-update" ).data('calIdToUpdateKey',calIdToUpdate );
			$( "#dialog-update" ).dialog( "open" );
			//alert("open dialog");
			});
	});

	</script>