		<div id="additionForm">			
		<h2>Add New</h2>
		<?php echo form_open('site/create');?>
		<?php echo form_hidden('wineId', $this->uri->segment(3));?>

				
			<label for="date">Date:</label>
			<input type="date" name="date" id="datepicker"/>
			
		
			<label for="processType" class="processType">Select Addtion Type:</label>
			<div id="radio">		
 			<input type="radio" value="labAction" name="processSelect" id="radio1" /><label for="radio1">Lab Action</label>
			<input type="radio" value="wineAction" name="processSelect" id="radio2" /><label for="radio2">Wine Action</label>
			</div>
<div id="addNewLeftBottom">		
		<div id="wineProcess" style="display:none">			
			<label for="process" >Wine Process:</label>
			<select name="wineProcess" >
			  <option value="select" selected >Select</option>
			  <?php foreach($formWineProcess as $fwp) : ?>
			  <option value="<?php echo $fwp->wineActionsDescId; ?>"><?php echo $fwp->desc; ?> </option>
			  <?php endforeach; ?>
			
			</select> 		
		</div>
		<div id="labProcess" class="elementSpacing" style="display:none">			
			<label for="labProcess" >Lab Prcoess:</label>
			<select name="labProcess" >
			  <option value="select" selected >Select</option>
			  <?php foreach($formLabProcess as $flp) : ?>
			  <option value="<?php echo $flp->wineActionsDescId; ?>"><?php echo $flp->desc; ?> </option>
			  <?php endforeach; ?>
			
			</select> 	
		</div>

		<div id="labProcessValue" class="elementSpacing" style="display:none">			
			<label for="value" class="notes" >Value:</label>
			<input type="text" name="value" />		
		</div>

		<div id="labProcessUnits" class="elementSpacing" style="display:none">			
			<label for="unitType" class="notes" >unit type:</label>
			<select name="labUnit" >
			  <option value="select" selected >Select</option>
			  <option value="ppm">ppm</option>
			  <option value="oz">oz</option>
			  <option value="wineAction">PH</option>
			
			</select> 		
		</div>
</div><!-- addNewLeftBottom end -->
<div id="addNewRightBottom">	
		<div id="processNotes" style="display:none">			
			<label for="notes" class="notes">Notes:</label>
			<textarea rows="4" cols="51" name="notes" /></textarea>		
		</div>
</div><!-- addNewLeftBottom end -->
<div id="addNewSubmit" class="elementSpacing">
		<div id="processSubmit" style="display:none">
			<input type="submit" value="submit">
		</div>
</div><!-- addNewSubmit end -->

		<?php echo form_close();?>
		</div> <!-- end div "additionForm"	-->