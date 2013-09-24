<script type="text/javascript">
    $(document).ready(function(){

        var counter = 1;

        $("#addsubButton_<?php echo $_REQUEST['str']; ?>").click(function () {

            if(counter>10){
                alert("Only 10 textboxes allow");
                return false;
            }

            var dec	= counter - 1;
            var divAfter = "#TextBoxDiv<?php echo $_REQUEST['str']; ?>"+dec;
            var newTextBoxDiv = $(document.createElement('div'))
                .attr("id", 'TextBoxDiv<?php echo $_REQUEST['str']; ?>'+counter);
            //alert(divAfter);
            newTextBoxDiv.after(divAfter).html('<div class="control-group"><label class="control-label" for="input01">Answer:'+counter+'</label>' + '<div class="controls">'+'<label class="control-label">'+'<input class="input-medium" type="text" name="Answer<?php echo $_REQUEST["str"]?>[]" id="Answer<?php echo $_REQUEST["str"]?>" value="" />'+'<input type="hidden" name="Ansid<?php echo $_REQUEST["str"]?>" id="Ansid<?php echo $_REQUEST["str"]?>" value="'+counter+'"></label></div></div>');


            newTextBoxDiv.appendTo("#TextBoxesGroup<?php echo $_REQUEST['str']; ?>");

           //alert(newTextBoxDiv);
            counter++;
        });

        $("#removesubButton_<?php echo $_REQUEST['str']; ?>").click(function () {
            if(counter==2){
                alert("No more textbox to remove");
                return false;
            }

            counter--;

            $("#TextBoxDiv<?php echo $_REQUEST['str']; ?>" + counter).remove();

        });

        $("#getButtonValue").click(function () {

            var msg = '';
            for(i=1; i<counter; i++){
                msg += "\n Answer " + i + " : " + $('#Answer' + i).val();
            }
            alert(msg);
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#addquestion').hide();
        $('#addquest').click(function(){
            $('#addquestion').show();
        });
        $('.clsControl').live('click',function(){
            var id = $(this).attr('name');
alert(id);


    });
</script>



<script type="text/javascript">
    function getid(quest)
    {
//  alert(quest);
        if(quest=="")
        {
            document.getElementById("showans").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("showans").innerHTML=xmlhttp.responseText;
            }
        }

        var url="answer.php?ans="+quest;

        xmlhttp.open("GET",url,true);

        xmlhttp.send();
    }
</script>




<div id="addquestion" style="border:#ccc 1px solid; padding:10px;">

              		<div class="control-group">
                  	<label class="control-label" for="input01"><span style=" color : red;">*</span>Question:</label>
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


			<div class="control-group" id="TextBoxesGroup<?php echo $_REQUEST['str']; ?>">
			<div id="TextBoxDiv1<?php echo $_REQUEST['str']; ?>">
                   </div>



                	</div>

			<div class="control-group">
                  	<label class="control-label" for="input01"></label>
                  	<div class="controls">
			<input type='button' class="btn" value='Add Answer' id='addsubButton_<?php echo $_REQUEST['str']; ?>' name="<?php echo $_REQUEST['str']; ?>">
			<input type='button' class="btn" value='Remove Answer' id='removesubButton_<?php echo $_REQUEST['str']; ?>' name="<?php echo $_REQUEST['str']; ?>">
                    	</div>
                	</div>



		</div>