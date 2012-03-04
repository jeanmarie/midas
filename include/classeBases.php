<?php	
require_once('_classePath.php');
// version 1.03 du 18/12/2006

// PARAMETRAGE :
DEFINE('DESCRIPTION_BASE','_classeBases_description.php');
# Classes 
# Bdd :
# ------------------------------------------
#   ->bdd_connecter_base()
#   ->bdd_connecter()
#   ->bdd_execsql()
#   ->bdd_lire_ligne()
#   ->bdd_resultats_vers_tableau() :
#   ->bdd_lire_champ()
#   ->bdd_lire_dateheure()
#   ->bdd_lire_date()
#   ->bdd_lire_heure()
#   ->bdd_dateheure_courante()       : retourne une chaine de l'heure courante au format "jj/mm/aaaa hh:mm"
#   ->bdd_date_courante()            : retourne une chaine de l'heure courante au format "aaaa-mm-jj"
#   ->bdd_datetime_courant()         : retourne une chaine de l'heure courante au format "aaaa-mm-jj hh:mm:ss"
#   ->bdd_convertir_timestamptodate  :
#   ->bdd_listerchamps()             : retourne un tableau des champs de la table
#   ->bdd_creationrequete()          : 	creer une requete automatiquement UPDATE ou INSERT
#   ->bdd_nomchampsverstableau()
#	  ->bdd_tableversliste()           : pour alimenter les fonctions de classeForms.php qui manipulent des listes
#   ->bdd_tableversarray()           : retourne un tableau de tableau de toutes les valeurs de la requetes (1ere ligne = indice 0)
#   ->bdd_tableversarrayjs()         : retourne un tableau JS
#   ->bdd_table2xml()        	     : retourne un objet au format XML
#   ->bdd_fermer()
#   ->bdd_base_ouverte()
#   ->bdd_formatsql()                : retourne une chaine prete pour une requete sql ex: "fdsf'qs" devient "fdsf''qs"

#   ->bdd_auto_init()                : configurer le nom de la table en cours, sa clef primaire et éventuellement le nom de la page a brancher     
#   ->bdd_auto_security()            : vérifier avant chaque modification ou effacement qu'un champ a une valeur precise (ex code client) évite qu'un client 
#                                      modifie des enregistrement qui ne lui appartiennent pas
#   ->bdd_auto_sql()                 : "A", "M" ou "C" effectuer ->bdd_creationrequete() sur la base définie prealablement
#   ->bdd_auto_header()              : Effectue un   "header('Location: org_liste.php'); " 

#   ->bdd_param_init()                : configurer le nom de la table des parametres, le nom du champ clef
#                                       et le nom du champ valeur
#   ->bdd_param_security()            : Affecte une valeur constante à un champ
#   ->bdd_param_rec()                 : pour enregistrer le parametre
#   ->bdd_param_load()                : pour charger le parametre


class Bdd
{
	var $baseouverte;
	var $baseOK;
	var $typebase;
	var $link;
	var $resultat_requete;
	var $lignelue;
	var $mysqlitype = array( 1=>"TINYINT", 3=>"INTEGER", 4=>"FLOAT", 7=>"TIMESTAMP", 10 =>"DATE",  11=>"TIME", 12 =>"DATETIME", 252=>"BLOB", 253=>"LONGBLOB", 254=>"CHAR" );
	
	var $auto_table;
	var $auto_clef;
	var $auto_header;
	var $auto_sauverequete;
	var	$auto_sec_field = '';
	var	$auto_sec_value = '';
	var $xml_nbre = 0;
	var $xml_lastname = '';

	function bdd_connecter_base($nombase)
	{
		$nombase = strtoupper($nombase);
		$tablebases = array();
		require( DESCRIPTION_BASE );
		if ( is_array($tablebases[$nombase]) ) {
			$ouvrirbase = $nombase;
			if (isset($tablebases[$nombase][4])) $ouvrirbase = $tablebases[$nombase][4];
			switch ($tablebases[$nombase][0]) {
			//	$tablebases["NOM_BASE"]  = array("MYSQLI","NOM_HOST","USER","PWD","nombase");
			   case "ODBC":
			   		return $this->bdd_connecter("ODBC","",	$ouvrirbase,"","");
				   	break;

			   case "MYSQL":
			   		return $this->bdd_connecter("MYSQL",	$tablebases[$nombase][1],
															$ouvrirbase,
															$tablebases[$nombase][2],
															$tablebases[$nombase][3]);
				   	break;

			   case "MYSQLI":
			   		return $this->bdd_connecter("MYSQLI",	$tablebases[$nombase][1],
															$ouvrirbase,
															$tablebases[$nombase][2],
															$tablebases[$nombase][3]);
				   	break;
					
			   default:
					echo "<!--\n########################################################################\n";
			   		echo "ERREUR dans la fonction \$x->Bdd_connecter_base('$nombase') :\n";
					echo "cette fonction ne gere pas ce type de base : ".$tablebases[$nombase][0];
			   		echo "\n\t->verifier le tableau \$tablebases[] dans le fichier ".DESCRIPTION_BASE;
					echo "\n########################################################################\n--!>";

			}

		} else {
			echo "<!--\n########################################################################\n";
	   		echo "ERREUR dans la fonction \$x->Bdd_connecter_base('$nombase') :\n";
			echo "LA BASE N'EST PAS DECLAREE DANS LE FICHIER DE DESCRIPTION\n";
	   		echo "\t->renseigner le tableau \$tablebases[] dans le fichier ".DESCRIPTION_BASE;
			echo "\n########################################################################\n\n--!>";
			exit;
		}

	}

    # EXEMPLE :
	#	$base->bdd_connecter("MYSQL","127.0.0.1","nombase","root","");
	#	$base->bdd_connecter("ODBC","","svpinfo","","");
    // ###########################################################################################################
    // ###########################################################################################################
    function bdd_connecter($bdd_typebase,$bdd_host='',$bdd_nombase,$bdd_user='',$bdd_pwd='')
    {
        $this->baseouverte = $bdd_nombase;
		$this->baseOK = false;

	    $this->typebase    = strtoupper($bdd_typebase);
        switch ($this->typebase) {
               case "ODBC":
			         # $bdd_host N'A PAS BESOIN D'ETRE RENSEIGNE EN ODBC			   
			         $this->link = odbc_connect($this->baseouverte,$bdd_user,$bdd_pwd);
                     break;
               case "MYSQL":
			         $this->link = mysql_connect($bdd_host,$bdd_user,$bdd_pwd);
                     // mysql_select_db($bdd_nombase);
                     break;
               case "MYSQLI":
			         $this->link = new mysqli($bdd_host,$bdd_user,$bdd_pwd,$this->baseouverte);
                     break;
        }
		if (!$this->link) { 
			print "\n\n<!--\n\n\tbdd_connecter() a échoué a ouvrir la base : ".$bdd_nombase;
			print "\n\tavec comme parametre :";
			print "\n\t\t. type de base = ".$bdd_typebase;
			print "\n\t\t. nom de host  = ".$bdd_host;
			print "\n\t\t. nom de base  = ".$bdd_nombase;
			print "\n\t\t. utilisateur  = ".$bdd_user;
			print "\n\t\t. mot de passe = XXXXXXXXXX";
			print "\n\n-->\n\n";
		} else {
			$this->baseOK = true;
		}
    } // Fin de bdd_connecter()
      // ###########################################################################################################


	// AFFICHE DANS UN TABLEAU LE NOM DE LA BASE OUVERTE ET SON TYPE
	function bdd_base_ouverte() {
		print "<table border=\"1\"><tr><td colspan=\"2\"><b>bdd_base_ouverte()</b></td></tr>\n";
		print "<tr><td><b>NOM</b></td><td>".$this->baseouverte."</td></tr>";
  		print "<tr><td><b>GENRE</b></td><td>".$this->typebase."</td></tr>";
		$table_tables = $this->bdd_listertables();
 		print "\n<tr><td><b>TABLES</b></td><td>".count($table_tables)."</td></tr>";
		foreach ($table_tables as $tableunitaire) {
			$table_nomchamps = $this->bdd_listerchamps($tableunitaire);
			$table_champs = $this->bdd_listertypechamps($tableunitaire);
	 		print "\n<tr><td><ul><pre>$tableunitaire<br> (".count($table_nomchamps)." champs)</pre></td><td>";
			foreach ($table_nomchamps as $un_champ) {
				print $un_champ;
				print "&nbsp;&nbsp;&nbsp;&nbsp;(".strtolower($table_champs[$un_champ]["TYPE"]);
				print "&nbsp;,&nbsp;".$table_champs[$un_champ]["LEN"];
				print "&nbsp;)<br>";
			}
			print "\n</td></tr>";
		}
		print "\n</table>";
	} 
      // ###########################################################################################################

	
	
    function bdd_execsql($bdd_requete)
    {
		if ( empty($bdd_requete) ) {
			print "\n\n<!--\n\n La fonction bdd_execsql() attend une chaine requete SQL valide comme paramètre \n\n--!>\n";
			return false;
		}
		if (!$this->baseOK) return;
        switch ($this->typebase) {
		
               case "ODBC":
			         $this->resultat_requete = odbc_exec($this->link,$bdd_requete);
					 break;
					 
               case "MYSQL":
			         mysql_select_db($this->baseouverte);
			         $this->resultat_requete = mysql_query($bdd_requete); 
					 break;
					 
               case "MYSQLI":
			         $this->resultat_requete = $this->link -> query($bdd_requete); 
					 break;

        }
		if ($this->resultat_requete === false) {
			print "\n\n\n<!--\n\n\tbdd_execsql() retourne une erreur pour la requete : \n\n\t". $bdd_requete ."\n\tsur la base = " . $this->baseouverte . "\n\n--!>\n\n";
		} else {
			$this->lignelue = 0;
		}
    } // Fin de bdd_execsql()
      // ###########################################################################################################
	
	
    function bdd_lire_ligne()
    {
		if ( ($this->resultat_requete === false) || (!$this->baseOK) ) return;
		$this->lignelue = 1;
        switch ($this->typebase) {
		
               case "ODBC":
			         return odbc_fetch_row($this->resultat_requete);
					 
               case "MYSQL":
			         $this->row  = mysql_fetch_array($this->resultat_requete,MYSQL_BOTH);
					 return $this->row;
					 
               case "MYSQLI":
			         $this->row  = $this->resultat_requete -> fetch_array(MYSQLI_BOTH);
					 return $this->row;
					 
        }
    } // Fin de bdd_lire_ligne()
      // ###########################################################################################################

	
    function bdd_lire_champ($nom_num_champ=1)
    {
		if ($this->lignelue == 0) $this->bdd_lire_ligne();
		if (is_string($nom_num_champ)) $nom_num_champ = strtoupper($nom_num_champ);
        switch ($this->typebase) {
               case "ODBC":
			   		 // un indice de champ commence en 1 pour ODBC
			         return odbc_result($this->resultat_requete,$nom_num_champ);
               case "MYSQL":
			   		 // ...et en 0 pour mySQL
					  if (!is_string($nom_num_champ)) $nom_num_champ--;         
			         return (isset($this->row[$nom_num_champ])) ?  $this->row[$nom_num_champ] : $this->row[strtolower($nom_num_champ)] ;
               case "MYSQLI":
			   		 // ...et en 0 pour mySQLi
					  if (!is_string($nom_num_champ)) $nom_num_champ--;         
			         return (isset($this->row[$nom_num_champ])) ?  $this->row[$nom_num_champ] : $this->row[strtolower($nom_num_champ)] ;

        }
    } // Fin de bdd_lire_champ()
      // ###########################################################################################################

    function bdd_resultats_vers_tableau()
    {
        switch ($this->typebase) {
               case "ODBC":
			         return  odbc_fetch_array($this->resultat_requete);
               case "MYSQL":
			         return mysql_fetch_array($this->resultat_requete,MYSQL_BOTH);
               case "MYSQLI":
			         return $this->resultat_requete -> fetch_array(MYSQLI_BOTH);
        }
    } // Fin de bdd_tableau_resultats()
      // ###########################################################################################################


    function bdd_lire_dateheure($nom_num_champ,$formatpourtri=false)
    {
	    $datelue = $this->bdd_lire_champ($nom_num_champ);
		if ( empty($datelue) ) return;
		if ( substr($datelue,0,4) == "0000") return;
		if ($formatpourtri) {
				$datelue = str_replace('-','/',$datelue);
		} else {
				$datelue = substr($datelue,8,2) . "/" . substr($datelue,5,2) . "/". substr($datelue,0,4) . " " .
				           substr($datelue,11,5);
		}
		return $datelue;
    } // Fin de bdd_lire_dateheure()
      // ###########################################################################################################




    function bdd_lire_date($nom_num_champ,$formatpourtri=false)
    {
	    $datelue = $this->bdd_lire_dateheure($nom_num_champ,$formatpourtri);
		$datelue = substr($datelue,0,10);
		if ( substr($datelue,0,4) == "0000") return;
		return $datelue;
    } // Fin de bdd_lire_date()
      // ###########################################################################################################





    function bdd_lire_heure($nom_num_champ)
    {
	    $datelue = $this->bdd_lire_dateheure($nom_num_champ);
		$datelue = substr($datelue,11,5);
		return $datelue;
    } // Fin de bdd_lire_heure()
      // ###########################################################################################################


    function bdd_dateheure_courante()
    {
		return date("d/m/Y H:i",time());
    } 

    function bdd_datetime_courant()
    {
		return date("Y-m-d H:i:s",time());
    } 

    function bdd_date_courante()
    {
		return date("Y-m-d",time());
    } 
	
	
    function bdd_convertir_timestamptodate($time_stamp)
    {
		return 	date("Y-m-d H:i:s",$time_stamp);
    } // Fin de bdd_lire_dateheure()
      // ###########################################################################################################

	
    function bdd_listerchamps($nomtable)
    {
        $table = array();	
		$cptchamp = 0;
        switch ($this->typebase) {
               case "ODBC":
		           $listechamps = odbc_columns($this->link, $this->baseouverte, "", $nomtable );				   
	               while ( odbc_fetch_row($listechamps) ) {
	                   array_push($table, strtoupper(odbc_result($listechamps,"COLUMN_NAME")));
					   $cptchamp++;
	               }  
				   if ($cptchamp==0) print "\n<br><b>bdd_listerchamps(\"$nomtable\")</b> : Cette table est inexistante dans la base \"$this->baseouverte \"<br>";
				   return $table;
				   
               case "MYSQL":
			       mysql_select_db($this->baseouverte);
                   $result = mysql_query("select * from " . $nomtable);
                   $i = 0;
                   while ($i < mysql_num_fields($result)) {
                      $meta = mysql_fetch_field($result);
                      if (!$meta) {
                          return array();
                      }
                      array_push($table, strtoupper($meta->name));
                      $i++;
                   }
				   return $table;
				   
               case "MYSQLI":
                   $result = $this->link -> query("select * from " . $nomtable);
                   $i = 0;
                   while ($i < mysqli_num_fields($result)) {
                      $meta = mysqli_fetch_field($result);
                      if (!$meta) {
                          return array();
                      }
                      array_push($table, strtoupper($meta->name));
                      $i++;
                   }
				   return $table;	     }
    } // fin de bdd_listerchamps()
      // ###########################################################################################################

    function bdd_listertypechamps($nomtable)
    {
        $table = array();	
		$cptchamp = 0;
        switch ($this->typebase) {
               case "ODBC":
		           $listechamps = odbc_columns($this->link, $this->baseouverte, "", $nomtable );				   
	               while ( odbc_fetch_row($listechamps) ) {
				        $type  = strtoupper(odbc_result($listechamps,"TYPE_NAME"));
				        $name  = strtoupper(odbc_result($listechamps,"COLUMN_NAME")); 
				        $len   =            odbc_result($listechamps,"COLUMN_SIZE");
						$table[$name] = array("NAME"=>$name,"TYPE"=>$type, "LEN"=>$len, "FLAGS"=>"");
					    $cptchamp++;
	               }  
				   if ($cptchamp==0) print "\n<br><b>bdd_listerchamps(\"$nomtable\")</b> : Cette table est inexistante dans la base \"$this->baseouverte \"<br>";
				   return $table;
				   
               case "MYSQL":
			       mysql_select_db($this->baseouverte);
                   $result = mysql_query("select * from " . $nomtable);
					for ($i=0; $i < mysql_num_fields($result); $i++) {
				        $type  = strtoupper(mysql_field_type($result, $i));
				        $name  = strtoupper(mysql_field_name($result, $i));
				        $len   = mysql_field_len($result, $i);
					    $flags = mysql_field_flags($result, $i);
						$table[$name] = array("NAME"=>$name,"TYPE"=>$type, "LEN"=>$len, "FLAGS"=>$flags);
				    }
				   return $table;

               case "MYSQLI":
                   $result =  $this->link -> query("select * from " . $nomtable);			   
					for ($i=0; $i < mysqli_num_fields($result); $i++) {
						// MYSQLI retourne un type au format numerique qu'il faut retranscrire en chaine type par l'intermediaire de la table $this->mysqlitype
   						$finfo = $result->fetch_field_direct($i);
 				        $name  = strtoupper($finfo->name);
						if ( isset($this->mysqlitype[$finfo->type]) )
				        	$type  = strtoupper($this->mysqlitype[$finfo->type]);
						else
							$type = $finfo->type;
						
						$table[$name] = array("NAME"=>$name,"TYPE"=>$type, "LEN"=>$finfo->max_length, "FLAGS"=>$finfo->flags);
				    }
				   return $table;

	     }
    } // fin de bdd_listerchamps()
      // ###########################################################################################################


    function bdd_listertables()
    {
		$tabretour = array();
        switch ($this->typebase) {
            case "ODBC":
				// pour tout voir :   odbc_result_all(odbc_tables($this->link));
				$tablelist = odbc_tables($this->link);

				while (odbc_fetch_row($tablelist)) { 
					if (odbc_result($tablelist, 4) == "TABLE") 
						array_push($tabretour, strtoupper(odbc_result($tablelist, 3)) );
				} 
				break;
				
            case "MYSQL":
			    $result = mysql_list_tables($this->baseouverte);   
			    if (!$result) {
			        print "<b>bdd_listertablesErreur</b> : impossible de lister les bases de donn&eacute;es\n";
			        print 'Erreur MySQL : ' . mysql_error();
			        exit;
			    }   
				while ($row = mysql_fetch_row($result)) {
			   		array_push($tabretour, strtoupper($row[0]) );
    			}
				break;		

            case "MYSQLI":
			    $result = $this->link -> list_tables($this->baseouverte);   
			    if (!$result) {
			        print "<b>bdd_listertablesErreur</b> : impossible de lister les bases de donn&eacute;es\n";
			        print 'Erreur MySQL : ' .  $this->link -> error();
			        exit;
			    }   
				break;		
	    }
		return $tabretour;

    } // fin de bdd_listertables()
      // ###########################################################################################################




	// $nomtable            	nom de la table concernee
	// $nomchampclef 			Nom du champ clef primaire
	// $action            		(A)jouter ou (M)odifier (C)hercher (E)Effacer (T)Tester ou rien
	//               			si rien on ne retourne que les champs
	// $tableauvaleur :		 	tableau des valeurs (par defaut = $_POST)
	
	// cette fonction a été écrite pour creer une requete automatiquement UPDATE, INSERT, DELETE
    function bdd_creationrequete($nomtable,$nomchampclef="",$action="M",$tableauvaleur='',$champ_qui_doit_etre_egal='',$a_cette_valeur='')
    {
        $tablechamps     = $this->bdd_listerchamps($nomtable);
        $tabletypechamps = $this->bdd_listertypechamps($nomtable);
		$requetecree = "";
		$nomchampclef = strtoupper($nomchampclef);
		$action = strtoupper($action);
		$conditionsupplementaire="";
		// CONDITION QUI DOIT ETRE VERIFIEE AUSSI A LA RECHERCHE
		if (!empty($champ_qui_doit_etre_egal) && !empty($a_cette_valeur)) {
			$conditionsupplementaire = " AND ".$champ_qui_doit_etre_egal."='".$a_cette_valeur."'";
		}

		if ( empty($nomchampclef) ) {
			print "\n<br><b> bdd_creationrequete()</b> : il faut toujours preciser le nom de la clef primaire<br>";
		}
		// si aucune table de valeur n'est passé alors on prend  $_POST
		if (empty($tableauvaleur)) $tableauvaleur = $_POST;
		// on convertit toutes les clefs en majuscule
		array_change_key_case($tableauvaleur, CASE_UPPER);

		switch ($action) {
			case "A" :
				$listechamps  = "";
				$listevaleurs = "";
				// on ajoute les champs qui doivent etre remplis de force (ex numéro de client qui doit prendre une valeur fixe)
				if (!empty($champ_qui_doit_etre_egal) && !empty($a_cette_valeur)) {
					$listechamps = $champ_qui_doit_etre_egal." ";
					$listevaleurs = "'".$a_cette_valeur."' ";
				}

				// pour chaque champ de la table on rapproche sa valeur dans $tableauvaleur()
				foreach($tablechamps as $nomchamptable) {
					if( isset($tableauvaleur[$nomchamptable]) ) {
						$valeuraecrire   = $tableauvaleur[$nomchamptable];
						// on exclut toujours la clef primaire de la liste des champs a ajouter
						if ( !($nomchamptable==$nomchampclef) ) {
						    if (!empty($listechamps))  $listechamps  .= ",";
						    if (!empty($listevaleurs)) $listevaleurs .= ",";
							$guillemet ="'";
							if ( (strtoupper($valeuraecrire)=="TRUE") || (strtoupper($valeuraecrire)=="FALSE") ) $guillemet = "";
							$listechamps  .= $nomchamptable;
							if ( empty($valeuraecrire) && strlen($valeuraecrire)==0)  {
								if ( $tabletypechamps[$nomchamptable]['TYPE']=='VARCHAR' )
									$valeuraecrire = "NULL";							
								else
									$valeuraecrire = "NULL";					
							} else {
								if ( ($tabletypechamps[$nomchamptable]['TYPE']=='DATETIME') || ($tabletypechamps[$nomchamptable]['TYPE']=='DATE') ) {
									$valeuraecrire = $this->bdd_datetosql($valeuraecrire);
								}
								$valeuraecrire = str_replace("'","''",stripslashes($valeuraecrire));
								$valeuraecrire = str_replace("\\","\\\\",$valeuraecrire);
								$valeuraecrire = $guillemet . $valeuraecrire .$guillemet;
							}
							$listevaleurs .= $valeuraecrire;
						}
					} 		
				}
				$requetecree = "INSERT INTO ".$nomtable." (".$listechamps.") VALUES (".$listevaleurs.")";
				break;


			case "M" :
				// pour chaque champ de la table on rapproche sa valeur dans $tableauvaleur()
				foreach($tablechamps as $nomchamptable) {
					if( isset($tableauvaleur[$nomchamptable]) ) {
						$nepasecrirechamp = 0;
						$valeuraecrire   = $tableauvaleur[$nomchamptable];
						// on exclut toujours la clef primaire de la liste des champs a modifier
						if ($nomchamptable==$nomchampclef) $nepasecrirechamp++;
						// on ecrit le champ que si $nepasecrirechamp = 0
						if ($nepasecrirechamp==0) {
						    if (!empty($requetecree)) $requetecree .= ",";
							$guillemet ="'";
							if ( (strtoupper($valeuraecrire)=="TRUE") || (strtoupper($valeuraecrire)=="FALSE") ) $guillemet = "";
							if ( empty($valeuraecrire) && strlen($valeuraecrire)==0) {
								if ( $tabletypechamps[$nomchamptable]['TYPE']=='VARCHAR' )
									$valeuraecrire = "NULL";							
								else {
									$valeuraecrire = "NULL";							
									// print "\nTYPE=".$tabletypechamps[$nomchamptable]['TYPE'];
								}
							} else {
								if ( ($tabletypechamps[$nomchamptable]['TYPE']=='DATETIME') || ($tabletypechamps[$nomchamptable]['TYPE']=='DATE') ) {
									$valeuraecrire = $this->bdd_datetosql($valeuraecrire);
								}
								$valeuraecrire = str_replace("'","''",stripslashes($valeuraecrire));
								$valeuraecrire = str_replace("\\","\\\\",$valeuraecrire);
								$valeuraecrire = $guillemet . $valeuraecrire .$guillemet;
							}
							$requetecree .= $nomchamptable . "=" . $valeuraecrire;
						}
					} 		
				}
				$requetecree = "UPDATE " .$nomtable." SET " . $requetecree . " WHERE " .$nomchampclef."=".$tableauvaleur[$nomchampclef].$conditionsupplementaire;
				break;

			case "C" :
				$requetecree = "SELECT * FROM " .$nomtable." WHERE " .$nomchampclef."=".$_REQUEST[strtoupper($nomchampclef)].$conditionsupplementaire;				
				break;

			case "T" :
				$requetecree = "SELECT COUNT(*) FROM " .$nomtable." WHERE " .$nomchampclef."=".$_REQUEST[strtoupper($nomchampclef)].$conditionsupplementaire;				
				break;

			case "E" :
				$requetecree = "DELETE  FROM " .$nomtable." WHERE " .$nomchampclef."=".$_REQUEST[strtoupper($nomchampclef)].$conditionsupplementaire;
				break;
		}
		return $requetecree;
		
    } // fin de bdd_creationrequete()

	function bdd_datetosql($date_jjmmaaaa) { // '18/02/1996'  --> '1996-02-18'
		return substr($date_jjmmaaaa,6,4).'-'.substr($date_jjmmaaaa,3,2).'-'.substr($date_jjmmaaaa,0,2).substr($date_jjmmaaaa,10);
	}
	function bdd_sqltodate($date_aaaammjj) { // '1996-02-18' --> '18/02/1996'
		return substr($date_aaaammjj,8,2).'/'.substr($date_aaaammjj,5,2).'/'.substr($date_aaaammjj,0,4).substr($date_aaaammjj,10);
	}


      // ###########################################################################################################
		 #   ->bdd_auto_init()                : configurer le nom de la table en cours, sa clef primaire et éventuellement le nom de la page a brancher     
		 #   ->bdd_auto_sql()                 : "A", "M" ou "C" effectuer ->bdd_creationrequete() sur la base définie prealablement
		 #   ->bdd_auto_header()              : Effectue un   "header('Location: org_liste.php')" 
      // ###########################################################################################################
	function bdd_auto_init($nomtable, $nomclefprimaire, $nompageabrancher='') { 
		$this->auto_table  = $nomtable;
		$this->auto_clef   = $nomclefprimaire;
		$this->auto_header = $nompageabrancher;
		$this->auto_sec_field = '';
		$this->auto_sec_value = '';
	}

	function bdd_auto_security($nomchamp, $valeur='') { 
		$this->auto_sec_field = strtoupper($nomchamp);
		$this->auto_sec_value = $valeur;
	}
	
	function bdd_auto_sql($branchement) {  // "A","M","C"
		if ($branchement=="C") {
			$this->auto_requete = $this->bdd_creationrequete($this->auto_table,$this->auto_clef,'T','',$this->auto_sec_field,$this->auto_sec_value);
			$this->bdd_execsql($this->auto_requete);
			$resultat = $this->bdd_lire_champ(1);
			if ((integer)$resultat!=1) {			
				$this->bdd_auto_header();
			}
		}
		$this->auto_requete = $this->bdd_creationrequete($this->auto_table,$this->auto_clef,$branchement,'',$this->auto_sec_field,$this->auto_sec_value);
		$this->bdd_execsql($this->auto_requete);
		return $this->auto_requete;
	}

	function bdd_auto_header() { 
		header("Location: ".$this->auto_header);
		print "<br><b>ATTENTION</b> SI VOUS VOYEZ CES LIGNES C'EST QUE LA REDIRECTION VERS ".$this->auto_header." N'A PAS FONCTIONNE !<br>";
		exit;
	}


      // ###########################################################################################################
   #   ->bdd_param_init()                : configurer le nom de la table des parametres, le nom du champ clef
   #                                       et le nom du champ valeur
   #   ->bdd_param_security()            : pour lier des parametres a un compte precis
   #   ->bdd_param_rec()                 : pour enregistrer le parametre
   #   ->bdd_param_load()                : pour charger le parametre
      // ###########################################################################################################

	function bdd_param_init($nomtable, $nomchampclef, $nomchampvaleur) { 
		$this->auto_param_table  = $nomtable;
		$this->auto_param_clef   = $nomchampclef;
		$this->auto_param_valeur = $nomchampvaleur;
		
		$this->auto_param_security_clef = "";
		$this->auto_param_security_valeur = "";		
		$this->auto_param_security_condition = "";		
	}
	
	function bdd_param_security($nomchampsecuriteclef, $nomchampsecuritevaleur) { 
		$this->auto_param_security_condition = " AND ".$nomchampsecuriteclef."='".$nomchampsecuritevaleur."'";
		$this->auto_param_security_clef   = $nomchampsecuriteclef;
		$this->auto_param_security_valeur = $nomchampsecuritevaleur;
	} 

	function bdd_param_rec($clef_a_trouver,$valeur_a_enregistrer='') {
		// SI LA VALEUR N'EST PAS PRECISEE ALORS ON TENTE $_REQUEST SUR LE MEME NOM QUE LA CLEF A TROUVER
		if (empty($valeur_a_enregistrer)) $valeur_a_enregistrer=$_REQUEST[$clef_a_trouver];
		$ma_requete = "SELECT ".$this->auto_param_clef.",".$this->auto_param_valeur." FROM ".$this->auto_param_table." WHERE ".$this->auto_param_clef."='".$clef_a_trouver."'".$this->auto_param_security_condition;
		$this->bdd_execsql( $ma_requete );
		if( $this->bdd_lire_champ($this->auto_param_clef) ) {
//			print $ma_requete . " <b> EST UN UPDATE";
			// SI ON L'A TROUVE C'EST UN UPDATE
			$ma_requete = "UPDATE ".$this->auto_param_table." SET ".$this->auto_param_valeur."='".$valeur_a_enregistrer."' WHERE ".$this->auto_param_clef."='".$clef_a_trouver."'".$this->auto_param_security_condition;
			$this->bdd_execsql( $ma_requete );
		} else {
//			print $ma_requete . " <b> EST UN INSERT";
			// SINON C'EST UN INSERT
			$ma_requete = "INSERT INTO ".$this->auto_param_table." (".$this->auto_param_clef.",".$this->auto_param_valeur;
			if (!empty($this->auto_param_security_clef)) {
				$ma_requete .= ",".$this->auto_param_security_clef;
			}
			$ma_requete .= ") VALUES ('".$clef_a_trouver."','".$valeur_a_enregistrer."'";
			if (!empty($this->auto_param_security_clef)) {
				$ma_requete .= ",'".$this->auto_param_security_valeur."'";
			}
			$ma_requete .= ")";
			// print  $ma_requete;
			$this->bdd_execsql( $ma_requete );
		}
	}
 
	function bdd_param_load($clef_a_trouver,$valeur_par_defaut=false) { 
		if( is_bool($valeur_par_defaut) ) {
			$valeur_si_introuvable = '';
		} else {
			$valeur_si_introuvable = $valeur_par_defaut;
		}
		$ma_requete = "SELECT ".$this->auto_param_clef.",".$this->auto_param_valeur." FROM ".$this->auto_param_table." WHERE ".$this->auto_param_clef."='".$clef_a_trouver."'".$this->auto_param_security_condition;
		$this->bdd_execsql( $ma_requete );
		$valeur_lue = $this->bdd_lire_champ($this->auto_param_valeur);
		if ( empty($valeur_lue) ) {
			return  $valeur_si_introuvable;
		} else {
			return $valeur_lue;
		}
	}
	
	
	
      // ###########################################################################################################
    function bdd_formatsql($valeuraecrire)
    {
		return str_replace("'","''",stripslashes($valeuraecrire));
	}

      // ###########################################################################################################
    function bdd_nomchampsverstableau($nomtable, $nomchampclef, $nomchampvaleur)
    {
	    $tableau = array();
		# LE 1ER CHAMP DE LA TABLE EST LE NOM DE CELLE CI
        $this->bdd_execsql("SELECT $nomchampclef,$nomchampvaleur FROM $nomtable ORDER BY $nomchampvaleur");
		while ( $this->bdd_lire_ligne() ) {
	          $tableau[$this->bdd_lire_champ(1)] = $this->bdd_lire_champ(2);
	    } 
		return $tableau;
    } // fin de nomchampsverstableau()
	
      // ###########################################################################################################





	// $pointeurbase            pointeur sur l'objet 
	// $nomtable :           	nom de la table concernee
	// $table_champs_a_lire  	liste des champs a concaténer :
	//                       	le premier champ servant de clef, 
	//							le ou les autres de value 
	// cette fonction a été écrite pour alimenter les fonctions de classeForms.php qui manipulent des listes
    function bdd_tableversliste($table_champs_a_lire)
    {		
		// si le parametre est une chaine on retourne un tableau a une dimension
		if ( !is_array($table_champs_a_lire) ) {
			$tableau_en_sortie = array();
		    while ( $this->bdd_lire_ligne() ) {
				array_push($tableau_en_sortie, $this->bdd_lire_champ($table_champs_a_lire));
			}
			return $tableau_en_sortie;
		}
		// sinon ce doit etre un tableau a au moind 2 elements
		$tailletableau = count($table_champs_a_lire);
		if ( $tailletableau<2  ) {
			print "<br>La fonction <b>bdd_tableversliste()</b> attend un tableau en paramètre avec au moins 2 éléments (clef,valeur) !<br>";
			print "ou bien une chaine contenant le nom du champ a retourner";
			exit;
		}
		$tableau_en_sortie = array();		
	    while ( $this->bdd_lire_ligne() ) {
			$chaineretour = "";
			for ($i=1;$i<$tailletableau;$i++)	{
				$chaineretour .= " " . $this->bdd_lire_champ( $table_champs_a_lire[$i] );
			}
			$tableau_en_sortie[ $this->bdd_lire_champ($table_champs_a_lire[0]) ] = ltrim($chaineretour);
		}
		return $tableau_en_sortie;
		
    } // fin de bdd_tableversliste
     // #######################################################################################


	// retourne sous forme d'un tableau multidimensionnel les résultats d'une requete quelconque
	// si appel par bdd_tableversarray() alors on obtient un tableau de la forme
	//	   $tab = array( 0 => array( "AGENT_NOM" => "DURAND" ), 1 => array( "AGENT_NOM" => "DUPONT" ) );
	// si appel par bdd_tableversarray("NOMCHAMPCLEF") alors 
	//    $tab = array( "10" => array( "AGENT_NOM" => "DURAND" ), "12" => array( "AGENT_NOM" => "DUPONT" ) );
    function bdd_tableversarray($nomchampclef="",$hash=true)
    {
		// par précaution les noms de champ sont convertis en MAJUSCULE
		$nomchampclef = strtoupper($nomchampclef);
       	$sql_en_table = array();
        switch ($this->typebase) {
               case "ODBC":
				   $tableauligne = odbc_fetch_array($this->resultat_requete);
				   break;
               case "MYSQL":
				   $tableauligne = mysql_fetch_array($this->resultat_requete,MYSQL_ASSOC);
				    break;
               case "MYSQLI":
				   $tableauligne = mysqli_fetch_array($this->resultat_requete,MYSQLI_ASSOC);
				    break;
		}
        while ( $tableauligne) {
			$tableauligne = array_change_key_case($tableauligne, CASE_UPPER);
			// si c'est un hash que l'on veut
			if ($hash) {
			   // si le champ clef est inconnu
		   	   if ( empty($nomchampclef) )
					array_push($sql_en_table, $tableauligne);
				elseif ( isset($tableauligne[$nomchampclef]) )
					$sql_en_table[ $tableauligne[$nomchampclef] ] = $tableauligne;
		    } else {
				// si c'est un tableau de valeur que l'on veut
		   	   if ( empty($nomchampclef) )
					array_push($sql_en_table, array_values($tableauligne));
				elseif ( isset($tableauligne[$nomchampclef]) )
					$sql_en_table[ $tableauligne[$nomchampclef] ] = array_values($tableauligne);
		

			}
			switch ($this->typebase) {
				case "ODBC":
					$tableauligne = odbc_fetch_array($this->resultat_requete);
					break;
				case "MYSQL":
					$tableauligne = mysql_fetch_array($this->resultat_requete,MYSQL_ASSOC);
					break;
				case "MYSQLI":
					$tableauligne = mysqli_fetch_array($this->resultat_requete,MYSQLI_ASSOC);
					break;

			}
		}
		return $sql_en_table;
    } // fin de bdd_tableversarray

	// utilisee par : bdd_arborescence(), bdd_tableversarrayjs()
    // #######################################################################################

    function bdd_tableversarrayjs($tabchamp,$libtab="MyData")
    {
		print "\n<!--- Tableau genere par la fonction bdd_tableversarrayjs()--->\n<script>\nvar ".$libtab." = [";
		$tableaucomplet = $this->bdd_tableversarray();
		$cptligne = 0;
		for ($i=0;$i<count($tableaucomplet);$i++) {
			if ($cptligne>0) { print  ","; }
			print  "\n\t[";
			$cptcol = 0;
			foreach($tabchamp as $colonne) {
				if ($cptcol>0) { print ","; }
				print  "'" . addslashes($tableaucomplet[$i][strtoupper($colonne)]) . "'";
				$cptcol++;
			}
			print  "]";
			$cptligne++;
	    }
		print "\n];\n</script>\n<!--- Nombre d'elements dans le tableau = $cptligne --->\n";		
		return $cptligne;
		
    } // fin de bdd_tableversarray
    // #######################################################################################

    function bdd_table2xml( $libtab='', $tabchamp=array() )
    {
		if (empty($libtab)) $libtab="XmlId".$this->xml_nbre;
		
		print "\n<!-- Objet XML genere par la fonction bdd_table2xml()-->\n";
		$tableaucomplet = $this->bdd_tableversarray();
		$cptligne = 0;
		print "<xml id=\"$libtab\">\n";
		print "\t<request>\n";
		
		if ( empty($tabchamp) ) {
			foreach($tableaucomplet as $table_enr) {
				print "\t\t<record>\n";
				foreach($table_enr as $nomchamp => $valeurchamp) {
					print "\t\t\t<".$nomchamp.">". $valeurchamp ."</".$nomchamp.">\n";
				}
				print "\t\t</record>\n";
				$cptligne++;
			}
		} else {
			for ($i=0;$i<count($tableaucomplet);$i++) {
				print "\t\t<record>\n";
				$cptcol = 0;
				foreach($tabchamp as $colonne) {
					print "\t\t\t<".$colonne.">".$tableaucomplet[$i][strtoupper($colonne)];
					print "</".$colonne.">\n";
					$cptcol++;
				}
				print "\t\t</record>\n";
				$cptligne++;
		    }
		}
		print "\t</request>\n";
		print "</xml>\n<!-- Nombre d'elements dans l'objet XML = $cptligne -->\n";		
		$this->xml_nbre++;
		$this->xml_lastname	= $libtab;

		return $cptligne;
		
    } // fin de bdd_tableversarray
    // #######################################################################################

    // #######################################################################################

    function bdd_xml_lastname()
    {
		return $this->xml_lastname;
    } // fin de bdd_xml_lastname

    // #######################################################################################

	// TablePereFils(1,2,3,4,5,6,7)

		// Liste des paramètres :
		//  1 . Pointeur vers l'objet Base de données "Bdd"
		//	2 . Nom de la table PERE
		//	3 . Nom de l'identifiant dans la table PERE
		//	4 . Nom du libellé dans la table PERE
		//	5 . Nom de l'identifiant dans la table FILS
		//	6 . Nom du libellé dans la table FILS
		//	7 . Pointeur de la tablea FILS vers la table PERE
		//  TOUS LES PARAMETRES SONT OBLIGATOIRES
		
	//  Une table est retournée au format attendu par la fonction frm_Objet2Listes()

	function bdd_tableperefils($ptrobjetbase, $nomtablepere, $champidpere, $champlibpere, $nomtablefils, $champidfils, $champlibfils, $pointeurperefils) {
		$_tableretour = array();
		// Balayage de la table PERE
	    $ptrobjetbase->bdd_execsql("SELECT * FROM $nomtablepere ORDER BY $champlibpere");
	    while ( $ptrobjetbase->bdd_lire_ligne() ) {
			$_tableretour[$ptrobjetbase->bdd_lire_champ($champidpere)] = $ptrobjetbase->bdd_lire_champ($champlibpere);
		}		
		// Balayage de la table FILS avec une jointure avec la table PERE
	    $ptrobjetbase->bdd_execsql("SELECT * FROM $nomtablepere, $nomtablefils WHERE  $pointeurperefils = $champidpere ORDER BY $champlibfils");
	    while ( $ptrobjetbase->bdd_lire_ligne() ) {
			$clef = $ptrobjetbase->bdd_lire_champ($pointeurperefils).".".$ptrobjetbase->bdd_lire_champ($champidfils);
			$valeur = $ptrobjetbase->bdd_lire_champ($champlibfils);
			$_tableretour[$clef] = $valeur;
		}		
		return $_tableretour;
	}
	  
	  
	function bdd_arborescence($TitreDeLaRacine,$tableparam,$branchepardefaut) {
	# passer en parametre un tableau associatif avec comme parametre :
	#  array( id=>"nom du champ",
	#         libelle=>"nom du champ libelle qui apparait",
	#         idpere=>"nom du champ pointeur vers pere",
	#         url=>"url de branchement.php?nom_du_parametre=" )

        print "\n<!---- Le code genere par la fonction bdd_arborescence() commence ici. ----->\n";
		print '<link rel="StyleSheet" href="/menu/tree/dtree.css" type="text/css" />' . "\n";
	    print '<script type="text/javascript" src="/menu/tree/dtree.js"></script>' . "\n";
		print '';
		
	    print '<p><a href="javascript: d.openAll();"><img src="/menu/tree/img/expand_all.gif" width="18" height="18" border="0" alt="Tout dérouler"/></a>' . "\n";
		print '| <a href="javascript: d.closeAll();"><img src="/menu/tree/img/collapse_all.gif" border="0" alt="Tout replier"/></a></p>' . "\n";

		print "\n" . '<script type="text/javascript"><!---- ' . "\n";
		print "\n d = new dTree('d',1);";
		print "\n d.config.useCookies = false;";	
		print "\n d.add(0,-1,'" . $TitreDeLaRacine ."'); ";
		if (!isset($branchepardefaut)) { 
		   $branchepardefaut = -1; 
		}
	    $table = $this->bdd_tableversarray();
		
		# CREATION D'UNE TABLE D'INDEXE INVERSEE
		$tableindexe = array();
		$tableindexe[0] = 0;	
		for ($i=0;$i<count($table);$i++) {
		      $j=$i+1;
			  $tableindexe[ $table["$i"][$tableparam["id"]] ] = $j;
	    }
		for ($i=0;$i<count($table);$i++) {
		    $j=$i+1;
			$k = $table["$i"][$tableparam["idpere"]];
	        print "\n d.add(" . $j . "," . $tableindexe[$k] . ",'" . addslashes($table["$i"][$tableparam["libelle"]]) . "','" . $tableparam["url"] . $table["$i"][ $tableparam["id"] ] . "'); ";
		}
		print "\n document.write(d); ";
		# SI LE NOEUD A OUVRIR A ETE PASSE EN PARAMETRE IL EST OUVERT
		if ($branchepardefaut > 0) {
		    print "\n d.openTo(" . $tableindexe[$branchepardefaut] . ",true);";
		}
		print "\n\n//--></script>";

		# COMMENTAIRE DE DEBUGGAGE
		# print "\n<!---- \n";		
	    # for ($i=0;$i<count($table);$i++) {
	    #  $j=$i+1;
	    #  print "\n$j \t " . $table["$i"][$tableparam["id"]] . " \tpere= " . $table["$i"][$tableparam["idpere"]] . "  \t tableindexe[".$i."]= " . $tableindexe["$i"] . "\t" . $table["$i"][$tableparam["idpere"]];
        #}
	    # print "\n--->\n";

        print "\n<!---- Le code genere par la fonction bdd_arborescence() se termine ici. ----->\n";

	} // fin de bdd_arborescence
      // #######################################################################################

	
    function bdd_fermer()
    {
		if (!$this->baseOK) return;
        switch ($this->typebase) {
               case "ODBC":
			         odbc_close($this->link); break;
               case "MYSQL":
			         mysql_close($this->link); break;
               case "MYSQLI":
			         mysqli_close($this->link); break;
        }
		return $this->resultat_requete;
    } // Fin de bdd_fermer()


    function bdd_mois_libelle($moisnumerique)
    {
		$tabmois = array(	"01" => "Janvier",
							"02" => "Février",
							"03" => "Mars",
							"04" => "Avril",
							"05" => "Mai",
							"06" => "Juin",
							"07" => "Juillet",
							"08" => "Août",
							"09" => "Septembre",
							"10" => "Octobre",
							"11" => "Novembre",
							"12" => "Décembre"
					);	
		return $tabmois[$moisnumerique];
    } // Fin de bdd_fermer()

			
} // Fin de la classe BDD



?>