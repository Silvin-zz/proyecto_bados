<?php
	require_once("./constant.php");
	require_once(__ROOT__DB__."config.php");
	require_once(__ROOT__MODEL__."m_categorie.php");
        require_once(__ROOT__MODEL__."m_mark.php");
        require_once(__ROOT__MODEL__."m_product.php");
	
	/*echo __ROOT__ .'<br>';
	echo __ROOT__MODEL__ .'<br>';*/
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
            <div id="ProductTableContainer" style="width: 1000px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#ProductTableContainer').jtable({
				title: 'Catalogo de Instrumentos',
				paging: true, //Enable paging
                                pageSize: 10, //Set page size (default: 10)
                                sorting: true, //Enable sorting                                
				defaultSorting: 'NombreInstrumento ASC',
				actions: {
					listAction:   'controller/c_product.php?action=list',
					createAction: 'controller/c_product.php?action=create',
					updateAction: 'controller/c_product.php?action=update',
					deleteAction: 'controller/c_product.php?action=delete'
				},
				fields: {
					NPK_Instrunento: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
                                        SKU: {
						title: 'SKU',
						width: '40%'
					},
					NombreInstrumento: {
						title: 'Nombre',
						width: '40%'
					},
                                        DescripcionInstrumento: {
						title: 'Descripcion',
						width: '40%'
					},
					InstrumentoActivo: {
						title: 'Activo',                                                
						width: '20%',
                                                create: false,
						edit: false
					},
					FechaAlta: {
						title: 'Fecha Alta',
						width: '30%',
						type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			$('#ProductTableContainer').jtable('load');

		});
                            </script>
                            
            <br><br>
             <div id="MarkTableContainer" style="width: 600px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#MarkTableContainer').jtable({
				title: 'Catalogo de Marcas',
				paging: true, //Enable paging
                                pageSize: 10, //Set page size (default: 10)
                                sorting: true, //Enable sorting                                
				defaultSorting: 'NombreMarca ASC',
				actions: {
					listAction:   'controller/c_mark.php?action=list',
					createAction: 'controller/c_mark.php?action=create',
					updateAction: 'controller/c_mark.php?action=update',
					deleteAction: 'controller/c_mark.php?action=delete'
				},
				fields: {
					NPK_Marca: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					NombreMarca: {
						title: 'Nombre',
						width: '40%'
					},
                                        DescripcionMarca: {
						title: 'Descripcion',
						width: '40%'
					},
					MarcaActivo: {
						title: 'Activo',                                                
						width: '20%',
                                                create: false,
						edit: false
					},
					FechaAlta: {
						title: 'Fecha Alta',
						width: '30%',
						type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			$('#MarkTableContainer').jtable('load');

		});
                            </script>
                
            <div id="CategorieTableContainer" style="width: 600px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#CategorieTableContainer').jtable({
				title: 'Catalogo de Categorias',
				paging: true, //Enable paging
                                pageSize: 10, //Set page size (default: 10)
                                sorting: true, //Enable sorting
                                /*paging: true,
				pageSize: 15,
				sorting: true,*/
				defaultSorting: 'NombreCategoria ASC',
				actions: {
					listAction:   'controller/c_categorie.php?action=list',
					createAction: 'controller/c_categorie.php?action=create',
					updateAction: 'controller/c_categorie.php?action=update',
					deleteAction: 'controller/c_categorie.php?action=delete'
				},
				fields: {
					NPK_Categoria: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					NombreCategoria: {
						title: 'Nombre',
						width: '40%'
					},
					ActivoCategoria: {
						title: 'Activo',                                                
						width: '20%',
                                                create: false,
						edit: false
					},
					FechaAlta: {
						title: 'Fecha Alta',
						width: '30%',
						type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			$('#CategorieTableContainer').jtable('load');

		});

	</script>
	</body>
</html>