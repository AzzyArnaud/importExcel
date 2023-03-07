<?php
ini_set('max_execution_time', '0');
ini_set('memory_limit','-1');

/**
 * 
 */
class RAPPORT_PRODUIT_VENTE extends CI_Controller
{


	public function index($annee='', $mois='',$pro=''){

		$products="";
	    $requisition_m="";
	    $requisition_q="";

	    $montant_t=0;
	    $qt_t=0;
	    $condition="";
	    if($pro)
$condition=" and ID_PRODUIT=".$pro;
    
		if(!$annee)$annee=date('Y');

		
// echo "There was $d days in October 2005";

		// echo $mois;

		if($mois>0){

			$d=cal_days_in_month(CAL_GREGORIAN,$mois,$annee)+1;

			for ($j=1; $j < $d; $j++) { 
				
	$m=$j;
				if($j<10)$m='0'.$j;

				$condition1=" AND DATE_TIME_VENTE LIKE '%".$annee."-".$mois."-".$m."%' ";


				$query_m=$this->Model->getRequeteOne("SELECT IFNULL(SUM(PRIX_UNITAIRE),0)  as m from vente_vente vv left join vente_detail vd on vv.ID_VENTE=vd.ID_VENTE where  vv.ID_SOCIETE=1 ".$condition.$condition1);
				$query_q=$this->Model->getRequeteOne("SELECT count(ID_VENTE_DETAIL) as q from vente_detail vd  join vente_vente vv ON vv.ID_VENTE=vd.ID_VENTE  where  vv.ID_SOCIETE=1".$condition.$condition1);

	// echo $query_m['m'];
				
				// echo $annee."-".$m." ".$query_m['m']."<br>";
				$products.="'".$annee."-".$mois."-".$m."',";
			    $montant_t+=$query_m['m'];
			    $requisition_m.=$query_m['m'].",";
			    $requisition_q.=$query_q['q'].",";
			    $qt_t+=$query_q['q'];

			}

		}else

		for ($i=1; $i <13 ; $i++) { 
			$m=$i;
			if($i<10)$m='0'.$i;

			$condition1=" AND DATE_TIME_VENTE LIKE '%".$annee."-".$m."%' ";



			$month_name=array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août",
"Septembre","Octobre","Novembre","Décembre");

			$query_m=$this->Model->getRequeteOne("SELECT IFNULL(SUM(PRIX_UNITAIRE),0)  as m from vente_vente vv left join vente_detail vd on vv.ID_VENTE=vd.ID_VENTE where  vv.ID_SOCIETE=1 ".$condition.$condition1);
			$query_q=$this->Model->getRequeteOne("SELECT count(ID_VENTE_DETAIL) as q from vente_detail vd  join vente_vente vv ON vv.ID_VENTE=vd.ID_VENTE  where  vv.ID_SOCIETE=1".$condition.$condition1);

// echo $query_m['m'];
			
			// echo $annee."-".$m." ".$query_m['m']."<br>";
			$products.="'".$month_name[$i]."',";
		    $montant_t+=$query_m['m'];
		    $requisition_m.=$query_m['m'].",";
		    $requisition_q.=$query_q['q'].",";
		    $qt_t+=$query_q['q'];

		    
		}
		// echo $products; 
			$products.="|";
		    $requisition_m.="|";
		    $requisition_q.=",|";

			$products=str_replace(",|", "", $products);
		    $requisition_m=str_replace(",|", "", $requisition_m);
		    $requisition_q=str_replace(",|", "", $requisition_q);
		

		$data['products']= $products;
		$data['requisition_m']=$requisition_m;
		$data['requisition_q']=$requisition_q;
		$data['montant_t']= $montant_t;
		$data['qt_t']= $qt_t;
		$data['']='';
		$data['annee']=$annee;
		$data['mois']=$mois;
		$data['pro']=$pro;
		$data['prod']=$this->Model->getRequete('SELECT * FROM `saisie_produit` WHERE 1 order by NOM_PRODUIT');

 
		// exit();
    $this->load->view("RAPPORT_PRODUIT_VENTE_view",$data);
	}

}