$(document).ready(function(){
    //$('#example').DataTable();
$('#example2').DataTable({
    "language":{
       "lengthMenu":"Mostrar _MENU_  Registros",
       "zeroRecords":"no se encontraron resultados",
       "info":"registros del _START_ al _END_ de un total de _TOTAL_ registros",
       "infoEmpty":"no hay registros",
       "infoFiltered":"(filtrado de un total de _MAX_ registros)",
       "sSearch":"buscar por fecha o lugar de donacion:",
       "oPaginate":{
          "sFirst":"primero",
          "sLast":"ultimo",
          "sNext":"siguiente",
          "sPrevious":"anterior"
       },
       "sProcessing":"procesando....",
    },
    responsive: "true",
    dom: 'Bfrtilp',       
    buttons:[ 
     {
        extend:    'excelHtml5',
        text:      'Reporte <i class="fa fa-file-excel-o"></i> ',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
     },
     {
        extend:    'pdfHtml5',
        text:      'reporte <i class="fa fa-file-pdf-o"></i> ',
        titleAttr: 'Exportar a PDF',
        className: 'btn btn-danger'
     }
      
  ]
  });
});