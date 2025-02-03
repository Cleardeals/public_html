$(document).ready( function () {
  var dragSrc = null;  //Globally track source cell
  var cells = null;  // All cells in table
  
  var table = $('#myTable').DataTable({
    pageLength: 10,
    columnDefs: [ {
      targets: '_all',
      
      // Set HTML5 draggable for all cells
      createdCell: function (td, cellData, rowData, row, col) {
        $(td).attr('draggable', 'true');
      }
    } ],
    drawCallback: function () {
      // Apply HTML5 drag and drop listeners to all cells
      cells = document.querySelectorAll('#myTable tr');
        [].forEach.call(cells, function(cell) {
          cell.addEventListener('dragstart', handleDragStart, false);
          cell.addEventListener('dragenter', handleDragEnter, false)
          cell.addEventListener('dragover', handleDragOver, false);
          cell.addEventListener('dragleave', handleDragLeave, false);
          cell.addEventListener('drop', handleDrop, false);
          cell.addEventListener('dragend', handleDragEnd, false);
        });
    }
  });
  
  

function handleDragStart(e) {
  this.style.opacity = '1';  // this / e.target is the source node.
  dragSrc = this;  // Keep track of source cell

  // Allow moves
  e.dataTransfer.effectAllowed = 'move';
  
  // Get the cell data and store in the transfer data object
  e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }

  // Allow moves
  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
}

function handleDragEnter(e) {
  // this / e.target is the current hover target.
  
  // Apply drop zone visual
  this.classList.add('over');
}

function handleDragLeave(e) {
  // this / e.target is previous target element.
  
  // Remove drop zone visual
  this.classList.remove('over');  
}
function handleDrop(e) {
  // this / e.target is current target element.

  if (e.stopPropagation) {
    e.stopPropagation(); // stops the browser from redirecting.
  }

  // Don't do anything if dropping the same column we're dragging.
  if (dragSrc != this) {
    // Set the source column's HTML to the HTML of the column we dropped on.
    dragSrc.innerHTML = this.innerHTML;
    
    // Set the distination cell to the transfer data from the source
    this.innerHTML = e.dataTransfer.getData('text/html');

    // Invalidate the src cell and dst cell to have DT update its cache then draw
    table.cell(dragSrc).invalidate();
    table.cell(this).invalidate().draw(false);
  }
  //alert("sfsdf");

///////////// start code change atate display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'contentController.php?mode=change_state_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change atate display order ///////////////////////////////// 


///////////// start code change city display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'contentController.php?mode=change_city_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
            //alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change city display order/////////////////////////////////


///////////// start code change property display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'propertyController.php?mode=change_property_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
            //alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change property display order/////////////////////////////////


///////////// start code change sold property display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'soldPropertyController.php?mode=change_sold_property_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
            //alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change sold property display order/////////////////////////////////


///////////// start code change team display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
  //alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'teamController.php?mode=change_team_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change team display order/////////////////////////////////  

///////////// start code change blog display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'blogController.php?mode=change_blog_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change blog display order///////////////////////////////// 


///////////// start code change review display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'reviewController.php?mode=change_review_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change review display order/////////////////////////////////  


///////////// start code change faq display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'faqController.php?mode=change_faq_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change faq display order/////////////////////////////////  

///////////// start code change career display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'careerController.php?mode=change_career_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change career display order///////////////////////////////// 


///////////// start code change package list display order /////////////////////////////////  

  var tdata = $.param($('#changes span').map(function() {
    return {
        name: $(this).attr('id')
        //value: $(this).text().trim()
    };
  }));
 // alert(tdata);
  var str = tdata.substring(0, tdata.length - 1);
  var tdata1 = str.split("=&");
  
  var turl = 'packageController.php?mode=change_package_list_order&tdata=' + tdata1 ;
  //alert(turl);
  $.ajax({
           // alert(tdata);
			url:turl,
            //data: tdata + '&tcount=<?=$count?>',
            success:function(response){
                //alert(response);
               // document.getElementById("msg").innerHTML = "Status Successfully Changed";
               // alert("Status changed successfully.");
            }
   });

///////////// end code change package list display order///////////////////////////////// 


  return false;
}

function handleDragEnd(e) {
  // this/e.target is the source node.
  this.style.opacity = '1.0';
  [].forEach.call(cells, function (cell) {
    // Make sure to remove drop zone visual class
    cell.classList.remove('over');
  });
  
}



} );
  ;