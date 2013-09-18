
<div id="addquestion" style="border:#ccc 1px solid; padding:10px;">

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Question</label>
                  	<div class="controls">
                    	<textarea placeholder=" please Enter your Question" name="question_<?php echo $_REQUEST['str']; ?>" rows="3" id="question" class="input-xlarge"></textarea>
                    	</div>
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Answer Type</label>
                  	<div class="controls">
			<label class="radio"><input type="radio" name="ansoption_<?php echo $_REQUEST['str']; ?>" value="single"> Single Choice</label>
			<label class="radio"><input type="radio" name="ansoption_<?php echo $_REQUEST['str']; ?>" value="multi"> Multi Choice</label>
                    	</div>
                	</div>


			<div class="control-group" id='TextBoxesGroup_<?php echo $_REQUEST['str']; ?>'>
			
                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn" value='Add Answer' id='addButton' name="<?php echo $_REQUEST['str']; ?>">
			<input type='button' class="btn" value='Remove Answer' id='removeButton' name="<?php echo $_REQUEST['str']; ?>">
                    	</div>
                	</div>



		</div>