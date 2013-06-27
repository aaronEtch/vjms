  <script type="text/javascript" src="<?php echo base_url();?>/js/raphael-min.js"></script>  
    <script type="text/javascript" src="<?php echo base_url();?>/js/g.raphael-min.js"></script>  
      <script type="text/javascript" src="<?php echo base_url();?>/js/g.line-min.js"></script> 
       <script type="text/javascript" src="<?php echo base_url();?>/js/date.format.js"></script>   
        <style type="text/css">  
            .graph_container {  
                width: 900px; 
                height:250px; 
                border: 1px solid #cccccc;  
            }  
        </style>  
        <script type="text/javascript"> 
window.onload = function() {  
//var currentTime = new Date();
//alert(currentTime);
    var paper = new Raphael(document.getElementById('graph_container'));  
//    var xAxisValues = [1351012111,1350925711,1350320911,1350925711,1351184911,1351444111,1351530511,1351616911];
 
 var xAxisValues = [12, 23, 31, 43, 31, 22, 43,81];

//alert(JSON.stringify(xAxisValues));

  var yAxisValues = [1, 2, 3, 4, 3, 2, 4,8];
 
 var chart = paper.linechart(
    50, 10,      // top left anchor
    750, 180,    // bottom right anchor
    xAxisValues,
    yAxisValues,
    {
   //    nostroke: false,   // lines between points are drawn
   //    axis: "0 0 1 1",   // draw axes on the left and bottom
       symbol: "disc",            // the data set is filled circles
       smooth: true,      // curve the lines to smooth turns on the chart
   //    colors: ["#995555" ]     // the line is red 
     });
    // change the x-axis labels
//    var axisItems = chart.axis[0].text.items
//    for( var i = 0, l = axisItems.length; i < l; i++ ) {
//       var date = new Date(parseInt(axisItems[i].attr("text")));
       // using the excellent dateFormat code from Steve Levithan
//       axisItems[i].attr("text", dateFormat(date, "mm/dd/yy"));
 //   }
 
 
 
 
 
} 

        </script>
	<div id="dialog-confirm" title="Delete Item?" style="display:none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
	</div>
<?php if(isset($wineHist)) :?>
       
 		   		
     		<div class="detailWineTitle"><?php echo $detailViewWineName; ?></div>	
     		<div id="graph_container"></div> 
     		<?php foreach($wineHist as $whr) : ?>		
		<div id="dv<?php echo $whr->calendarId; ?>" class="detailWineContainer clearfix" >	
			
				
				<div class="dateAndIcon">
					<div class=" ui-corner-all <?php echo $whr->actionKind; ?>">
						<span class="ui-icon ui-icon-none"></span>						
					</div>
					<span class="formDate"><?php echo mysqldatetime_to_date($whr->date); ?></span>
				
			
			
				<span class="processDescContainer"> -				
			<span class="formProcess"><?php echo $whr->process; ?></span>
			<? if ($whr->labValue): ?>
					( 
					<span class="formLabValue"><?php echo $whr->labValue; ?></span> 
					<span class="formLabUnit"><?php echo $whr->labUnit; ?></span>
					) 
			<? endif; ?> 
				</span>	
				</div>
				<p class="detailNotes">Notes: <span class="formNotes"><?php echo $whr->notes; ?></span></p>
		
			<div>
				<div class="iconContainer">
				<button  id="dlv<?php echo $whr->calendarId; ?>" class="ui-button ui-state-default ui-corner-all ui-button-text-only updateWineEventButton" >
				<span class="ui-icon ui-icon-pencil iconPosition" ></span>
				<div class="iconDef">Edit</div>	
				</button>
								
				<button id="ddv<?php echo $whr->calendarId; ?>" class="ui-button ui-state-default ui-corner-all ui-button-text-only confirmDeleteButton" >
				<span class="ui-icon ui-icon-closethick iconPosition" ></span>
				<div class="iconDef">Delete</div>
				</button>
									
				</div> <!-- close iconContainer -->	
			</div>
		</div>
		<?php endforeach; ?>
				

		<?php else : ?>	
	<p><br>No wines added yet<br><br></p>
	<?php endif; ?>
	
	
		<button id="addWine">Add New Wine Event</button>
<!-- dialog add new wine form --><!-- dialog add new wine form -->
<!-- dialog add new wine form --><!-- dialog add new wine form -->
<!-- dialog add new wine form --><!-- dialog add new wine form -->
<div id="dialog-form" title="Add New Wine Event">
	<p class="validateTips">All form fields are required.</p>			
		<form>
			<fieldset>	
				<label for="date">Date:</label>
				<input type="text" name="date" id="datepicker"/>
				<br>
				<label for="processType" >Select Addtion Type:</label>						
				<ul id="processSelectType">
					<li id="labAction" class="ui-state-default ui-corner-all" >lab Action</li>
					<li id="wineAction" class="ui-state-default ui-corner-all" >wine Action</li>
				</ul>
				<div id="addNewLeftBottom">		
					<div id="wineProcess" style="display:none">			
						<label for="process" >Wine Process:</label>
						<select name="wineProcessType"  id="wineProcessType">
						  <option value="" selected >Select</option>
						  <?php foreach($formWineProcess as $fwp) : ?>
						  <option value="<?php echo $fwp->wineActionsDescId; ?>"><?php echo $fwp->desc; ?> </option>
						  <?php endforeach; ?>						
						</select> 		
					</div>
					<div id="labProcess" class="elementSpacing" style="display:none">			
						<label for="labProcess" >Lab Prcoess:</label>
						<select name="labProcessType" id="labProcessType">
						  <option value="" selected >Select</option>
						  <?php foreach($formLabProcess as $flp) : ?>
						  <option value="<?php echo $flp->wineActionsDescId; ?>"><?php echo $flp->desc; ?> </option>
						  <?php endforeach; ?>						
						</select> 	
					</div>		
					<div id="labProcessValue" class="elementSpacing" style="display:none">			
						<label for="value" class="notes" >Value:</label>
						<input type="text" name="value" id="labValue"/>		
					</div>
					<div id="labProcessUnits" class="elementSpacing" style="display:none">			
						<label for="unitType" class="notes" >unit type:</label>
						<select name="labUnit" id="labUnit">
						  <option value="" selected >Select</option>
						  <option value="ppm">ppm</option>
						  <option value="oz">oz</option>
						  <option value="ph">PH</option>
						<option value="%">%</option>
						</select> 		
					</div>
				</div><!-- close addNewLeftBottom -->
				<div id="addNewRightBottom">	
						<div id="processNotes" style="display:none">			
							<label for="notes" class="notes">Notes:</label>
							<textarea name="notes" id="notes"/></textarea>		
						</div>
				</div><!-- close addNewLeftBottom  -->		
			</fieldset>
		</form>
					
</div> <!-- close dialog form -->

<!-- dialog update form --><!-- dialog update form --><!-- dialog update form --><!-- dialog update form -->
<!-- dialog update form --><!-- dialog update form --><!-- dialog update form --><!-- dialog update form -->
<!-- dialog update form --><!-- dialog update form --><!-- dialog update form --><!-- dialog update form -->
<div id="dialog-update" title="Update Wine Event">
	<p class="validateTips">All form fields are required.</p>
		<form>
		<fieldset>
			<label for="date">Date:</label>
			<input type="text" name="date" id="datepickerUpdate"/>
			<br>
			<label for="processType" >Select Addtion Type:</label>						
			<ul id="processSelectTypeUpdate">
				<li id="labActionUpdate" class="ui-state-default ui-corner-all" >lab Action</li>
				<li id="wineActionUpdate" class="ui-state-default ui-corner-all" >wine Action</li>
			</ul>
			<div id="addNewLeftBottom" class="clearfix">		
				<div id="wineProcessUpdate" style="display:none">			
					<label for="process" >Wine Process:</label>
					<select name="wineProcessTypeUpdate" id="wineProcessTypeUpdate">				
					  <?php foreach($formWineProcess as $fwp) : ?>
					  <option value="<?php echo $fwp->wineActionsDescId; ?>"><?php echo $fwp->desc; ?></option>
					  <?php endforeach; ?>					
					</select> 		
				</div>
				<div id="labProcessUpdate" class="elementSpacing" style="display:none">			
					<label for="labProcess" >Lab Prcoess:</label>
					<select name="labProcessType" id="labProcessTypeUpdate">						  
					  <?php foreach($formLabProcess as $flp) : ?>
					  <option value="<?php echo $flp->wineActionsDescId; ?>"><?php echo $flp->desc;?></option>
					  <?php endforeach; ?>					
					</select> 	
				</div>			
				<div id="labProcessValueUpdate" class="elementSpacing" style="display:none">			
					<label for="value" class="notes" >Value:</label>
					<input type="text" name="value" id="labValueUpdate"/>		
				</div>			
				<div id="labProcessUnitsUpdate" class="elementSpacing" style="display:none">			
					<label for="unitType" class="notes" >unit type:</label>
					<select name="labUnit" id="labUnitUpdate" >
					
					  <option value="ppm">ppm</option>
					  <option value="oz">oz</option>
					  <option value="ph">PH</option>
					  <option value="%">%</option>					
					</select> 		
				</div>
			</div><!-- close addNewLeftBottom  -->
			<div id="addNewRightBottom" >	
				<div id="processNotesUpdate" style="display:none">			
					<label for="notes" class="notes">Notes:</label>
					<textarea name="notesUpdate" id="notesUpdate"/></textarea>		
				</div>
			</div><!-- close addNewLeftBottom  -->			
		</fieldset>
	</form>
					
</div> <!-- close dialog update form -->	
