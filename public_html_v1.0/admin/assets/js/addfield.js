var i=0;
function addRowToTable(val)
{	
 alert('fgfd');
	var tbl = document.getElementById('addfield');
  	var lastRow = tbl.rows.length;
alert(lastRow);
  	var iteration = lastRow;
	if(val > (iteration-3))
	{

		var cellLeft = row.insertCell(0);
		var text = 'Thumbnail'+(iteration-2);
		var textNode = document.createTextNode(text);
		cellLeft.className='post_form_head';
		cellLeft.align='right';
		cellLeft.appendChild(textNode);
		
		var cellMiddle = row.insertCell(1);
		var el = document.createElement('input');
		el.type = 'file';
		el.name = 'thumb' + (iteration-2);
		el.id = 'thumb' + (iteration-2);
		el.size = 23;
		cellMiddle.appendChild(el);
		
		var cellRight = row.insertCell(2);
		var textNode = document.createTextNode('');
		cellRight.appendChild(textNode);
		i++;
	  
	}
}
function removeRowFromTable(val)
{
  var tbl = document.getElementById('addfield');
  var lastRow = tbl.rows.length;
  if(lastRow > 3)
  	tbl.deleteRow(lastRow - 1);
}
