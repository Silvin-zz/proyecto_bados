<?php
	require_once("./constant.php");
	require_once(__ROOT__DB__."config.php");
	//require_once(__ROOT__MODEL__."m_categorie.php");
        require_once(__ROOT__MODEL__."m_mark.php");
        //require_once(__ROOT__MODEL__."m_product.php");
	
	
?>


<html>
    <head>
        <link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<!-- link href="Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" /-->
        <link href="Scripts/jtable/themes/metro/darkgray/jtable.css" rel="stylesheet" type="text/css" />
	
        <script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
    </head>
	<body>
           
                            
            <br><br>
             <div id="MarkTableContainer" style="width: 1000px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#MarkTableContainer').jtable({
				title: 'Catalogo de Marcas',
				
				paging: true, //Enable paging
				pageSize: 15, //Set page size (default: 10)
				sorting: true, //Enable sorting                                
				defaultSorting: 'Nombre ASC',
				
				messages: {
					addNewRecord: '+ Agregar Marca'
				},

				actions: {
					listAction:   'controller/c_mark.php?action=list',
					createAction: 'controller/c_mark.php?action=create',
					updateAction: 'controller/c_mark.php?action=update',
					deleteAction: 'controller/c_mark.php?action=delete'
				},
				fields: {
					Marca: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					Nombre: {
						title: 'Nombre',
						width: '20%'
					},
                    Descripcion: {
						title: 'Descripcion',
						width: '40%'
					},
					Estado: {
						title: 'Activo',                                                
						width: '20%',
                                                create: false,
						edit: false
					},
					fechaAlta: {
						title: 'Fecha Alta',
						width: '20%',
						type: 'date',
						create: false,
						edit: false
					}
				},
				toolbar: {
					items: [{
						icon: '/images/excel.png',
						text: 'Export to Excel',
						click: function () {
							//perform your custom job...
						}
					},{
						icon: '/images/pdf.png',
						text: 'Export to Pdf',
						click: function () {
							//perform your custom job...
						}
					}]
				}
				
			});

			//Load person list from server
			$('#MarkTableContainer').jtable('load');

		});
                            </script>
                
          
	</script>
	</body>
</html>