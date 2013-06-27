
	<div id="dialog-confirm" title="Delete Item?" style="display:none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
	</div>
<?php if(isset($wineHist)) :?>
       
 		   		
     		<div class="detailWineTitle"><?php echo $detailViewWineName; ?> <button id="addWineEvent" >Add New Wine Event</button></div>	
     		<div id="graph_container"></div><!--   -->
     		<?php foreach($wineHist as $whr) : ?>		
		<div id="dv<?php echo $whr->calendarId; ?>" class="detailWineContainer clearfix" >	
			<div class="dateAndIcon">
				<a  id="hideShow<?php echo $whr->calendarId; ?>" class="showHideDetailClick ui-button ui-state-default ui-corner-all" >
						<span class="ui-icon ui-icon-plusthick" ></span>						
				</a>
				
					<span class="formDate"><?php echo mysqldatetime_to_date($whr->date); ?></span>
				
			
			
				<span class="processDescContainer"> - </span>				
				<div class="iconAndProcess">
					<div style="margin:2px 1px 0 4px;" class=" ui-corner-all <?php echo $whr->actionKind; ?>">
						<span class="ui-icon ui-icon-none"></span>						
					</div>
			<span class="formProcess"><?php echo $whr->process; ?></span>
			<? if ($whr->labValue): ?>
					( 
					<span class="formLabValue"><?php echo $whr->labValue; ?></span> 
					<span class="formLabUnit"><?php echo $whr->labUnit; ?></span>
					) 
			<? endif; ?> 
				
					</div>
				</div>
				<div id="showHideDetails<?php echo $whr->calendarId; ?>" style="display:none;">
				<p class="detailNotes">Notes: <span class="formNotes"><?php echo $whr->notes; ?></span></p>
		
			
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
			
			</div><!-- close showHideDetails -->	
		</div>
		<?php endforeach; ?>
				

		<?php else : ?>	
	<p><br>No wines added yet<br><br></p>
	<?php endif; ?>
	
	
		<button id="addWineEventBottom">Add New Wine Event</button>
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
						<ul id="wineProcessType">
						 
						  <?php foreach($formWineProcess as $fwp) : ?>
						  <li id="<?php echo $fwp->wineActionsDescId; ?>" class="ui-state-default ui-corner-all"><?php echo $fwp->desc; ?> </li>
						  <?php endforeach; ?>						
						</ul> 		
					</div>
					<div id="labProcess" class="elementSpacing" style="display:none">			
						<label for="labProcess" >Lab Prcoess:</label>
						<ul id="labProcessType">						 
						  <?php foreach($formLabProcess as $flp) : ?>
						  <li id="<?php echo $flp->wineActionsDescId; ?>" class="ui-state-default ui-corner-all"><?php echo $flp->desc; ?> </li>
						  <?php endforeach; ?>						
						</ul> 	
					</div>		
					<div id="labProcessValue" class="elementSpacing" style="display:none">			
						<label for="value" class="notes" >Insert Value and Select Unit Type:</label>
						<input type="text" name="value" id="labValue" class="labProcessValueInput"/>						
						<ul id="labUnit">				
						  <li id="ppm" class="ui-state-default ui-corner-all">ppm</li>
						  <li id="oz" class="ui-state-default ui-corner-all">oz</li>
						  <li id="ph" class="ui-state-default ui-corner-all">PH</li>
						<li value="%" class="ui-state-default ui-corner-all">%</li>
						</ul> 		
				
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
					<ul name="wineProcessTypeUpdate" id="wineProcessTypeUpdate">				
					  <?php foreach($formWineProcess as $fwp) : ?>
					  <li id="<?php echo $fwp->wineActionsDescId; ?>" class="ui-state-default ui-corner-all"><?php echo $fwp->desc; ?></li>
					  <?php endforeach; ?>					
					</ul> 		
				</div>
				<div id="labProcessUpdate" class="elementSpacing" style="display:none">			
					<label for="labProcess" >Lab Prcoess:</label>
					<ul name="labProcessType" id="labProcessTypeUpdate">						  
					  <?php foreach($formLabProcess as $flp) : ?>
					  <li id="<?php echo $flp->wineActionsDescId; ?>" class="ui-state-default ui-corner-all"><?php echo $flp->desc;?></li>
					  <?php endforeach; ?>					
					</ul> 	
				</div>			
				<div id="labProcessValueUpdate" class="elementSpacing" style="display:none">			
					<label for="value" class="notes" >Select Value and Units</label>
					<input type="text" name="value" id="labValueUpdate" class="labProcessValueInput"/>						
					<ul id="labUnitUpdate" >					
					  <li id="ppm" class="ui-state-default ui-corner-all">ppm</li>
					  <li id="oz" class="ui-state-default ui-corner-all">oz</li>
					  <li id="ph" class="ui-state-default ui-corner-all">PH</li>
					  <li id="%" class="ui-state-default ui-corner-all">%</li>					
					</ul> 		
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
