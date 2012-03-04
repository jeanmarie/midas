<html>
<head>
	<title>ActiveWidgets Grid :: Examples</title>
	<style> body, html {margin:0px; padding: 0px; overflow: hidden;} </style>

	<!-- ActiveWidgets stylesheet and scripts -->
	<link href="../../classeGrid/styles/classic/grid.css" rel="stylesheet" type="text/css" ></link>
	<script src="../../classeGrid/lib/grid.js"></script>

	<!-- grid format -->
	<style>
		.active-controls-grid {height: 100%; font: menu;}

		.active-column-0 {width:  80px; text-align: right;}
		.active-column-1 {width: 150px; background-color: threedlightshadow;}
		.active-column-2 {width: 100px; }
		.active-column-3 {width: 120px; text-align: right;}
		.active-column-4 {width: 120px; text-align: right;}


		.active-grid-column {border-right: 1px solid threedshadow;}
		.active-grid-row {border-bottom: 1px solid threedlightshadow;}
	</style>
</head>
<body>
<?php
	    include('classeBases.php');
		include('classeTableau.php');
		include('classeTableauXML.php');
		
	    $requete2  = "SELECT agent_id, agent_nom, agent_prenom, agent_date_creation FROM agents ORDER BY agent_nom,agent_prenom"; 

	    $base = New Bdd;
        $base->bdd_connecter_base("annuaire");
        $base->bdd_execsql($requete2);

		$tjs = New XmlTab;
		$nomauto = $tjs->xml_new('myData1');

   		$ligne = $base->bdd_lire_ligne();
		while  ($ligne) {
		
			
			$tjs->xml_addcol( $base->bdd_lire_champ("agent_id") );
			$tjs->xml_addcol( $base->bdd_lire_champ("agent_nom") );
			$tjs->xml_addcol( $base->bdd_lire_champ("agent_prenom") );
			$tjs->xml_addcol( $base->bdd_lire_date("agent_date_creation",true) );
			$tjs->xml_addline();
			
			$ligne = $base->bdd_lire_ligne();
		} 
		$nelement1 = $tjs->xml_close();
	
		$base->bdd_fermer();
?>


<script>


	//	create data formats
	var string  = new Active.Formats.String;
	var number1 = new Active.Formats.Number;
	var date1   = new Active.Formats.Date;

	//	define formatting rule for text output
	number1.setTextFormat("#######");
	
	date1.setTextFormat("dd/mm/yyyy");
	date1.setDataFormat("yyyy-mm-dd");

	
	
	
	
	//	create ActiveWidgets data model - XML-based table
	var table = new Active.XML.Table;

	//  get reference to the xml data island node
	var xml, node = document.getElementById('myData1');

	//	IE
	if (window.ActiveXObject) {
		xml = node;
	}
	//	Mozilla
	else {
		xml = document.implementation.createDocument("","", null);
		xml.appendChild(node.selectSingleNode("*"));
	}

	//	set column formatting
	table.setFormats([number1, string, string, date1, string]);
	
	//	provide data XML
	table.setXML(xml);

	

	
	
	//	define column labels
	var columns = ["agent_id","agent_nom", "agent_prenom", "agent_date_creation"];

	//	create ActiveWidgets Grid javascript object
	var obj = new Active.Controls.Grid;

	//	provide column labels
	obj.setColumnProperty("texts", columns);

	//	provide external model as a grid data source
	obj.setDataModel(table);
	obj.sort(0, "ascending"); 
	obj.setSelectionProperty("index", 5); 

// obj.setSelectionProperty("multiple", 5,10 ); 


	//	write grid html to the page
	document.write(obj);

	</script>
</body>
</html>