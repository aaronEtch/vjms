<script>
		$(function() {
		//auto complete for varietals and varietalUpdate field
		$( "#varietal, #varietalUpdate" ).autocomplete({
			source: availableVarietals
		});
		});
		// for auto suggest varietals
		var availableVarietals = [];
		<?php if(isset($varietalRows)) : foreach($varietalRows as $vr) : ?>
		availableVarietals.push('<?php echo $vr->varietalName ?>');
		<?php endforeach; ?>
		<?php endif; ?>
		
</script>
	<div id="dialogWineConDelete" title="Delete Item?" style="display:none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
	</div>
	<h2>Your Wine Dashboard</h2>     
	<table id="tableListView" cellpadding="3">   		   		
		<?php if(isset($rows)) : foreach($rows as $r) : ?>
		<tr id="lv<?php echo $r->wineId; ?>">
			<td>
				<b><span class="formName"><?php echo anchor('site/detail_view/'.$r->wineId, $r->wineName); ?></span</b>				
			</td>	
			<td>
				<div>
					<div class="dashboardLabel">
					<div class=" ui-corner-all winePro" >
						<span class="ui-icon ui-icon-none"></span>						
					</div>
					<div class="dashboardLabelFont">Wine</div></div>
					<p class="dashboardText">Varietal: <span class="formVarietal"><?php if(isset($r->varietalName)) : echo $r->varietalName; else : ?>-- <?php endif;?></span></p>	
					<p class="dashboardText">Vintage: <span class="formVintage"><?php if(isset($r->vintage)) : echo $r->vintage; else : ?>-- <?php endif;?></span></p>	
					<p class="dashboardText">Quantity: <span class="formQuantity"><?php if(isset($r->quantity)) : echo $r->quantity; else : ?>-- <?php endif;?></span> Gallons</p>	 
					<p class="dashboardText">Container: <span class="formContainer"><?php if(isset($r->container)) : echo $r->container; else : ?>-- <?php endif;?></span></p>
					<p class="dashboardText">Last Action: <?php if(isset($r->lastAction)) : echo $r->lastAction; ?> on <?php echo mysqldatetime_to_date($r->lastActionDate); else : ?>-- <?php endif;?></span></p>			
					<p class="dashboardText">Next Action: <?php if(isset($r->nextAction)) : echo $r->nextAction; ?> on <?php echo mysqldatetime_to_date($r->nextActionDate); else : ?>-- <?php endif;?></span></p>
				</div>	
				<div>
					<div class="dashboardLabel">
						<div class=" ui-corner-all oak">
							<span class="ui-icon ui-icon-none"></span>						
						</div>
					<div class="dashboardLabelFont">Oak</div>
					</div> <!-- end dashboardLabel -->
					<p class="dashboardText">Last Oak Addition:<?php if(isset($r->lastOakAction)) : echo $r->lastOakAction; ?> on <?php echo mysqldatetime_to_date($r->lastOakActionDate); else : ?>-- <?php endif;?></p>		
				</div>
			</td>						
			<td>
			<div>	
				<div class="dashboardLabel">
					<div class=" ui-corner-all s02">
						<span class="ui-icon ui-icon-none"></span>
					</div>
					<div class="dashboardLabelFont">S02</div>
				</div><!-- end dashboardLabel -->	
				<p class="dashboardText">Last Free S02 Check Value: <?php if(isset($r->lastS02CheckVal)) : echo $r->lastS02CheckVal; ?>ppm on <?php echo mysqldatetime_to_date($r->lastS02CheckDate); else : ?>-- <?php endif;?></p>		
				<p class="dashboardText">Last additon of K<sub>2</sub>S<sub>2</sub>O<sub>5</sub>: <?php if(isset($r->lastS02AddVal)) : echo $r->lastS02AddVal; ?>ppm on <?php echo mysqldatetime_to_date($r->lastS02AddDate); else : ?>-- <?php endif;?></p>					
			</div>
			<div>
				<div class="dashboardLabel">
					<div class=" ui-corner-all ph">
					<span class="ui-icon ui-icon-none"></span>						
					</div>
					<div class="dashboardLabelFont">PH - TA</div>	
				</div><!-- close dashboardLabel -->
				<p class="dashboardText">Last PH Check Value: <?php if(isset($r->lastPHCheckVal)) : echo $r->lastPHCheckVal; ?> on <?php echo mysqldatetime_to_date($r->lastPHCheckDate); else : ?>-- <?php endif;?></p>
				<p class="dashboardText">Last PH Addition: <?php if(isset($r->lastPHActionDesc)) : echo $r->lastPHActionDesc; ?> in value of <?php echo $r->lastPHActionValue; ?> on <?php echo mysqldatetime_to_date($r->lastPHActionDate); else : ?>-- <?php endif;?></p>
				<p class="dashboardText">Last TA Check Value: <?php if(isset($r->lastTACheckVal)) : echo $r->lastTACheckVal; ?> on <?php echo mysqldatetime_to_date($r->lastTACheckDate); else : ?>-- <?php endif;?></p>			
				<p class="dashboardText">Last TA Addition: <?php if(isset($r->lastTAActionDesc)) : echo $r->lastTAActionDesc; ?> in value of <?php echo $r->lastTAActionValue; ?> on <?php echo mysqldatetime_to_date($r->lastTAActionDate); else : ?>-- <?php endif;?></p>
			</div>			
			</td>
			<td>
				<div  class="ui-state-default ui-corner-all ui-state-active" style="float:left;margin-left:1px;width:17px;">
					<div  id="updateWineButton" class="dlv<?php echo $r->wineId; ?>" ><span class="ui-icon ui-icon-pencil"></span></div>
				</div>
				<div class="ui-state-default ui-corner-all ui-state-active" style="float:left;margin-left:1px;width:17px;cursor:pointer;">
					<div id="confirmDeleteButton" class="dlv<?php echo $r->wineId; ?>">
						<span class="ui-icon ui-icon-closethick"></span>
					</div>
				</div>
			</td>		
		</tr>		
		<tr class="separator" />
		<?php endforeach; ?>
			<?php else : ?>	
	<p><br>No wines added yet<br><br></p>
	<?php endif; ?>
	</table>
		<button id="addWine">Add New Wine</button>
<!-- insert new wine form --><!-- insert new wine form --><!-- insert new wine form -->	
<!-- insert new wine form --><!-- insert new wine form --><!-- insert new wine form -->				
	<div id="dialogWineInsert" title="Add New Wine">
	<p class="validateTips">All form fields are required.</p>
	<form>
	<fieldset>
		<label for="wineName">Wine Name:</label>
		<input type="text" name="wineName" id="wineName" class="text ui-widget-content ui-corner-all" />
		<label for="varietal">Varietal:</label>
		<input type="text" name="varietal" id="varietal" class="text ui-widget-content ui-corner-all" />
		<label for="vintage">Vintage:</label>
		<input type="text" name="vintage" id="vintage" value="" class="text ui-widget-content ui-corner-all" />
		<label for="quantity">Quantity:</label>
		<input type="text" name="quantity" id="quantity" value="" class="text ui-widget-content ui-corner-all" />
		<label for="wineContainer">Wine Container:</label>
		<ul id="wineContainer">
			<li id="Oak" class="ui-state-default" >Oak</li>
			<li id="Glass" class="ui-state-default" >Glass</li>
			<li id="Stainless" class="ui-state-default" >Stainless</li>
			<li id="Plastic" class="ui-state-default" >Plastic</li>
			<li id="Other" class="ui-state-default" >Other</li>
		</ul>		
		<input style="display:none" name="wineUserId" id="wineUserId" value="<?php echo $userIdNumber->userId; ?>" />
	</fieldset>
	</form>
</div> <!-- close insert new wine form -->
<!--  update wine form --><!--  update wine form --><!--  update wine form -->
<!--  update wine form --><!--  update wine form --><!--  update wine form -->
	<div id="dialogWineUpdate" title="Update Wine">
	<p class="validateTips">All form fields are required.</p>
	<form>
	<fieldset>
		<label for="wineName">Wine Name:</label>
		<input type="text" name="wineNameUpdate" id="wineNameUpdate" class="text ui-widget-content ui-corner-all" />
		<label for="varietal">Varietal:</label>
		<input type="text" name="varietalUpdate" id="varietalUpdate" class="text ui-widget-content ui-corner-all" />
		<label for="vintage">Vintage:</label>
		<input type="text" name="vintageUpdate" id="vintageUpdate" value="" class="text ui-widget-content ui-corner-all" />
		<label for="quantity">Quantity:</label>
		<input type="text" name="quantityUpdate" id="quantityUpdate" value="" class="text ui-widget-content ui-corner-all" />
		<label for="wineContainer">Wine Container:</label>
		<ul id="wineContainerUpdate">
			<li id="Oak" class="ui-state-default" >Oak</li>
			<li id="Glass" class="ui-state-default" >Glass</li>
			<li id="Stainless" class="ui-state-default" >Stainless</li>
			<li id="Plastic" class="ui-state-default" >Plastic</li>
			<li id="Other" class="ui-state-default" >Other</li>
		</ul>		
		<input style="display:none" name="wineUserId" id="wineUserId" value="<?php echo $userIdNumber->userId; ?>" />
	</fieldset>
	</form>
</div> <!-- close dialog form -->