$(document).on('change', '.file-field input[type="file"]', function () {
     var file_field = $(this).closest('.file-field');
     var path_input = file_field.find('input.file-path');
     var files      = $(this)[0].files;
     var file_names = [];
     for (var i = 0; i < files.length; i++) {
       file_names.push(files[i].name);
     }
     path_input.val(file_names.join(", "));
     path_input.trigger('change');
   });
if(document.getElementsByTagName('tbody').length>0)
{
    //console.log(document.getElementsByTagName('tbody').length);
    var tables = document.getElementsByTagName('tbody');
    //var tables = document.getElementsByTagName('tbody.pdflist');
	
    var table = tables[tables.length - 1];
    var rows = table.rows;
    for(var i = 0, td; i < rows.length; i++){
        td = document.createElement('td');
        td.appendChild(document.createTextNode(i + 1));
        rows[i].insertBefore(td, rows[i].firstChild);
    }
}	

