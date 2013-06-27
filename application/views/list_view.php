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
	<h2>Your Wine Dashboard <button id="addWine">Add New Wine</button>	 </h2>     
	 	  		
		<?php if(isset($rows)) : foreach($rows as $r) : ?>
		<div id="lv<?php echo $r->wineId; ?>" class="listWineContainer clearfix">
			<div class="listNameContainer clearfix">
				<button  id="hideShow<?php echo $r->wineId ?>" style="margin-right:5px;" class="ui-button ui-state-default ui-corner-all showHideDetailClick" >
						<span class="ui-icon ui-icon-plusthick" ></span>						
				</button>
				<b><span class="formName listViewWineTitle"><?php if(isset($r->wineName)) : echo $r->wineName; else : ?>-- <?php endif;?></span></b>

			</div>	
			<div id="showHideDetails<?php echo $r->wineId; ?>" style="display:none;">
			<div class="listWineOakContainer">
				
					<div class="dashboardLabel">
					<div class=" ui-corner-all winePro" >
						<span class="ui-icon ui-icon-none"></span>						
					</div>
					<div class="dashboardLabelFont">Wine Info</div></div>
					<p class="dashboardText">Varietal: <span class="formVarietal"><?php if(isset($r->varietalName)) : echo $r->varietalName; else : ?>-- <?php endif;?></span></p>	
					<p class="dashboardText">Vintage: <span class="formVintage"><?php if(isset($r->vintage)) : echo $r->vintage; else : ?>-- <?php endif;?></span></p>	
					<p class="dashboardText">Quantity: <span class="formQuantity"><?php if(isset($r->quantity)) : echo $r->quantity; else : ?>-- <?php endif;?></span> Gallons</p>	 
					<p class="dashboardText">Container: <span class="formContainer"><?php if(isset($r->container)) : echo $r->container; else : ?>-- <?php endif;?></span></p>
									<div class="dashboardLabel">
					<div class=" ui-corner-all winePro" >
						<span class="ui-icon ui-icon-none"></span>						
					</div>
					<div class="dashboardLabelFont">Wine Stats</div></div>	
					<p class="dashboardText">Last Action: <?php if(isset($r->lastAction)) : echo $r->lastAction; ?> on <?php echo mysqldatetime_to_date($r->lastActionDate); else : ?>-- <?php endif;?></span></p>			
					<p class="dashboardText">Next Action: <?php if(isset($r->nextAction)) : echo $r->nextAction; ?> on <?php echo mysqldatetime_to_date($r->nextActionDate); else : ?>-- <?php endif;?></span></p>
					
				<div>
					<div class="dashboardLabel">
						<div class=" ui-corner-all oak">
							<span class="ui-icon ui-icon-none"></span>						
						</div>
					<div class="dashboardLabelFont">Oak Stats</div>
					</div> <!-- end dashboardLabel -->
					<p class="dashboardText">Last Oak Addition:<?php if(isset($r->lastOakAction)) : echo $r->lastOakAction; ?> on <?php echo mysqldatetime_to_date($r->lastOakActionDate); else : ?>-- <?php endif;?></p>		
				</div>
			</div>	<!-- end wine oak div -->					
			<div class="listSoPhContainer clearfix">
			<div>	
				<div class="dashboardLabel">
					<div class=" ui-corner-all s02">
						<span class="ui-icon ui-icon-none"></span>
					</div>
					<div class="dashboardLabelFont">S02 Stats</div>
				</div><!-- end dashboardLabel -->	
				<p class="dashboardText">Last Free S02 Check Value: <?php if(isset($r->lastS02CheckVal)) : echo $r->lastS02CheckVal; ?>ppm on <?php echo mysqldatetime_to_date($r->lastS02CheckDate); else : ?>-- <?php endif;?></p>		
				<p class="dashboardText">Last additon of K<sub>2</sub>S<sub>2</sub>O<sub>5</sub>: <?php if(isset($r->lastS02AddVal)) : echo $r->lastS02AddVal; ?>ppm on <?php echo mysqldatetime_to_date($r->lastS02AddDate); else : ?>-- <?php endif;?></p>					
			</div>
			<div>
				<div class="dashboardLabel">
					<div class=" ui-corner-all ph">
					<span class="ui-icon ui-icon-none"></span>						
					</div>
					<div class="dashboardLabelFont">PH - TA Stats</div>	
				</div><!-- close dashboardLabel -->
				<p class="dashboardText">Last PH Check Value: <?php if(isset($r->lastPHCheckVal)) : echo $r->lastPHCheckVal; ?> on <?php echo mysqldatetime_to_date($r->lastPHCheckDate); else : ?>-- <?php endif;?></p>
				<p class="dashboardText">Last PH Addition: <?php if(isset($r->lastPHActionDesc)) : echo $r->lastPHActionDesc; ?> in value of <?php echo $r->lastPHActionValue; ?> on <?php echo mysqldatetime_to_date($r->lastPHActionDate); else : ?>-- <?php endif;?></p>
				<p class="dashboardText">Last TA Check Value: <?php if(isset($r->lastTACheckVal)) : echo $r->lastTACheckVal; ?> on <?php echo mysqldatetime_to_date($r->lastTACheckDate); else : ?>-- <?php endif;?></p>			
				<p class="dashboardText">Last TA Addition: <?php if(isset($r->lastTAActionDesc)) : echo $r->lastTAActionDesc; ?> in value of <?php echo $r->lastTAActionValue; ?> on <?php echo mysqldatetime_to_date($r->lastTAActionDate); else : ?>-- <?php endif;?></p>
			</div>			
			</div><!-- end s02 ph div -->
				<div class="iconContainer">
					<a href="<?php echo site_url('members/detail_view/'.$r->wineId) ?>" style="width: auto;" class="ui-button ui-state-default ui-corner-all ui-button-text-only timelineButton">
						<span class="ui-icon ui-icon-calendar iconPosition" ></span>
						<div class="iconDef">View Timeline</div>
					</a>				
					<a id="dlv<?php echo $r->wineId; ?>" class="ui-button ui-state-default ui-corner-all ui-button-text-only updateWineButton" >
						<span class="ui-icon ui-icon-pencil iconPosition" ></span>
						<div class="iconDef">Edit Wine</div>	
					</a>				
					<a id="dlv<?php echo $r->wineId; ?>" class="ui-button ui-state-default ui-corner-all ui-button-text-only confirmDeleteWineButton" >
						<span class="ui-icon ui-icon-closethick iconPosition" ></span><div class="iconDef">Delete Wine</div>
					</a>
					
				</div> <!-- close iconContainer -->	
				</div>	<!-- close showHide -->				
		</div>	

		<?php endforeach; ?>
			<?php else : ?>	
	<p><br>No wines added yet<br><br></p>
	<?php endif; ?>
	
		<div style="clear:both;"></div>
		<button id="addWineBottom">Add New Wine</button>
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
		<input style="display:none" name="wineUserId" id="wineUserId" value="<?php echo $userIdNumber; ?>" />
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
		<input style="display:none" name="wineUserId" id="wineUserId" value="<?php echo $userIdNumber; ?>" />
	</fieldset>
	</form>
</div> <!-- close dialog form -->