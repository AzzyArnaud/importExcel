<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Avance extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Import_model', 'import');
        $this->load->helper(array('url','html','form'));
    }    
 
    public function index() {
        $data['institution']=$this->Model->getRequete('SELECT * FROM `institution_financiere` order by ID_INSTITUTION');
        $data['season']=$this->Model->getRequete('SELECT * FROM `saison` order by ID_SAISON');

        $this->load->view('import/avance',$data);
    }
	public function listing()
    {
      
		$data['resultat']=$this->Model->getRequete('SELECT 
		c.CUSTOMER_NAME,
		c.PROVINCE,
		c.COMMUNE,
		c.ZONE,
		c.COLLINE,
		co.INSTITUTION,
		co.MONTANT,
		d.QUANTITE,
		d.ID_PRODUCT,
		d.ID_PRODUCT
		from client c 
		JOIN collecte co ON c.CUSTOMER_ID=co.CUSTOMER_ID
		JOIN collecte_detail d ON co.COLLECTE_ID=d.COLLECTE_ID
		WHERE co.TYPE_COLLECTE=1;');
    //   $tabledata=array();
	   $data['title']='Saison';
      $this->load->view('includes/avance_view',$data);

    }
    public function importFile(){

  
      if ($this->input->post('submit')) {
                 
                $path = 'assets/uploads/';
                require_once APPPATH . "/third_party/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('files' => $this->upload->data());
                }
                if(empty($error)){
									$extension= "";
                  if (!empty($data['files']['file_name'])) {
                    $import_xls_file = $data['files']['file_name'];
										$extension=$data['files']['file_ext'];
							
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                 if($extension==".xlsx" || $extension==".xls"){
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
					foreach ($allDataInSheet as $rowData) {
						if($flag){
						  $flag =false;
						  continue;
						}
						  $nom = $rowData['A'];
						  $numeroIdentification = $rowData['B'];
						  $province = $rowData['C'];
						  $commune = $rowData['D'];
						  $zone = $rowData['E'];
						  $colline = $rowData['F'];
						  $uree = $rowData['G'];
						  $dap = $rowData['H'];
						  $kcl = $rowData['I'];
						  $dolomi = $rowData['J'];
						  $montantPayement = $rowData['K'];
						
						  if (!empty(array_filter($rowData))) {
							  // Identifier la colonne qui contient la valeur
							  $colonneValeur = '';
							  $idproduit="";
							  if (!empty($uree)) {
								  $colonneValeur = $uree;
								  $idproduit=1;
							  } elseif (!empty($dap)) {
								  $colonneValeur = $dap;
								  $idproduit=2;
							  } elseif (!empty($kcl)) {
								  $colonneValeur = $kcl;
								  $idproduit=3;
							  } elseif (!empty($dolomi)) {
								  $colonneValeur = $dolomi;
								  $idproduit=4;
							  }

						  }
						
						  $INSTITUTION_ID=$this->input->post('NOM_INSTITUTION');
						  $SAISON_ID=$this->input->post('SEASON_NAME');
						  $TYPE_COLLECTE=$this->input->post('TYPE_COLLECTE');

						  $institution="";
						 if ($INSTITUTION_ID == "1") {
							$institution = "BANCOBU";
						}elseif ($INSTITUTION_ID == "2") {
							$institution = "COOPEC";
						}elseif ($INSTITUTION_ID == "3") {
							$institution = "CCM";
						}elseif ($INSTITUTION_ID == "4") {
							$institution = "POSTE";
						}else{
							$institution="";
						}
						  $type_collecte="";
						  if($TYPE_COLLECTE == 1){
							  $type_collecte=1;
						  }elseif ($TYPE_COLLECTE == 2) {
							  $type_collecte=2;
						  }
						$this->form_validation->set_rules('NOM_INSTITUTION', 'Nom', 'required',array('required'=>'le champs  est  obligatoire!!'));
						$this->form_validation->set_rules('SEASON_NAME', 'Nom', 'required',array('required'=>'le champs  est  obligatoire!!'));
						$this->form_validation->set_rules('TYPE_COLLECTE', 'Nom', 'required',array('required'=>'le champs  est  obligatoire!!'));
					
						if ($this->form_validation->run() == FALSE){
						  $message = "<div class='alert alert-danger'>
												  client non modifi&eacute; de cong&eacute; non enregistr&eacute;
												  <button type='button' class='close' data-dismiss='alert'>&times;</button>
											</div>";
						  $this->session->set_flashdata(array('message'=>$message));
						  $data['title']='Utilisateur';
						  $data['institution']=$this->Model->getRequete('SELECT * FROM `institution_financiere` order by ID_INSTITUTION');
						  $data['season']=$this->Model->getRequete('SELECT * FROM `saison` order by ID_SAISON');
						  $this->load->view('includes/avance_view',$data);
						 }else{

					  // Vérifier si les données existent déjà dans la base de données
						  $existingData = $this->db->get_where('client', ['CUSTOMER_NAME' => $nom, 'PROVINCE' => $province, 'COMMUNE' => $commune, 'ZONE' => $zone, 'COLLINE' => $colline])->row();
						  // $existingData = $this->model->getOne('client', ['CUSTOMER_NAME' => $nom, 'PROVINCE' => $province, 'COMMUNE' => $commune, 'ZONE' => $zone, 'COLLINE' => $colline])->row();

						  if ($existingData) {
							  
						  // enregistre les donnees dans la table collecte
						  $identifierData = [
							  'CUSTOMER_ID' => $existingData->CUSTOMER_ID,
							  'INSTITUTION' => $institution,
							  'MONTANT' => $montantPayement,
							  'TYPE_COLLECTE' => $type_collecte,
							  'ID_SAISON' => $SAISON_ID
						  ];
					// 	  print_r($identifierData);
					//  exit();
						  $this->Model->insert_last_id('collecte', $identifierData);
						  $inserted_id = $this->db->insert_id();
						  $detailData = [
							  'COLLECTE_ID' => $inserted_id,
							  'ID_PRODUCT' => $idproduit,
							  'QUANTITE' => $colonneValeur
						  ];
						  // print_r($detailData);
						  // exit();
						  $this->Model->insert_last_id('collecte_detail', $detailData);
							  $message = "<div class='alert alert-success' id='message'>
							  client enregistr&eacute; avec succés
							  <button type='button' class='close' data-dismiss='alert'>&times;</button>
						</div>";
						 $this->session->set_flashdata(array('message'=>$message));
						  $this->index();
					  } else {
							  // Les données n'existent pas dans la table client, effectuer une insertion dans la table client
							  $null='';
							  $clientData = [
								  'CUSTOMER_NAME' => $nom,
								  'IDENTITY_NUMBER' => $null,
								  'COLLINE' => $colline,
								  'COMMUNE' => $commune,
								  'PROVINCE' => $province,
								  'BIRTH_DAY' => $null,
								  'GENDER' => $null,
								  'CATEGORY' => $null,
								  'REPRESENT_BY' => $null,
								  'MOBILE_NUMBER' => $null,
								  'NBRE_MEMBER' => $null,
								  'ZONE' => $zone
							  ];
							  $this->Model->insert_last_id('client', $clientData);

							  // Récupérer l'ID du client nouvellement inséré
							  $clientId = $this->db->insert_id();

							  // Insérer une ligne dans la table collection avec l'ID du client
							  $identifierData = [
								  'CUSTOMER_ID' => $clientId,
								  'INSTITUTION' => $institution,
								  'MONTANT' => $montantPayement,
								  'TYPE_COLLECTE' => $type_collecte,
								  'ID_SAISON' => $SAISON_ID
							  ];
							  $this->Model->insert_last_id('collecte', $identifierData);
							  
							  $inserted_id = $this->db->insert_id();
							  $detailData = [
								  'COLLECTE_ID' => $inserted_id,
								  'ID_PRODUCT' => $idproduit,
								  'QUANTITE' => $colonneValeur
							  ];
							  
							  $this->Model->insert_last_id('collecte_detail', $detailData);
							
					}
				}
			}
				$message = "<div class='alert alert-success' id='message'>
				Saison enregistr&eacute; avec succés
				<button type='button' class='close' data-dismiss='alert'>&times;</button>
				</div>";
				$this->session->set_flashdata(array('message'=>$message));
			  redirect(base_url('configuration/Avance/listing'));  

                    
                } catch (Exception $e) {
                   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
							}else {
								$files = file($inputFileName); // Nom du fichier à afficher
 
								$total = count($files); // Nombre total des lignes du fichier
								foreach ($files as $key => $row) {
									if ($key === 0) {
											continue; // Ignorer la première ligne
									}
			
									// Séparer les valeurs par le point-virgule
									$values = explode(';', $row);
			
						// Insérer les valeurs dans la base de données
							      $nom=$values[0];
									$numero=$values[1];
									$province=$values[2];
									$commune=$values[3];
									$zone=$values[4];
									$colline=$values[5];
									$uree=$values[6];
									$dap=$values[7];
									$kcl=$values[8];
									$dolomi=$values[9];
									$montantPayement=$values[10];
											}
											
						  if (!empty(array_filter($values))) {
							// Identifier la colonne qui contient la valeur
							$colonneValeur = '';
							$idproduit="";
							if (!empty($uree)) {
								$colonneValeur = $uree;
								$idproduit=1;
							} elseif (!empty($dap)) {
								$colonneValeur = $dap;
								$idproduit=2;
							} elseif (!empty($kcl)) {
								$colonneValeur = $kcl;
								$idproduit=3;
							} elseif (!empty($dolomi)) {
								$colonneValeur = $dolomi;
								$idproduit=4;
							}

						}
					  
						$INSTITUTION_ID=$this->input->post('NOM_INSTITUTION');
						$SAISON_ID=$this->input->post('SEASON_NAME');
						$TYPE_COLLECTE=$this->input->post('TYPE_COLLECTE');

						$institution="";
					   if ($INSTITUTION_ID == "1") {
						  $institution = "BANCOBU";
					  }elseif ($INSTITUTION_ID == "2") {
						  $institution = "COOPEC";
					  }elseif ($INSTITUTION_ID == "3") {
						  $institution = "CCM";
					  }elseif ($INSTITUTION_ID == "4") {
						  $institution = "POSTE";
					  }else{
						  $institution="";
					  }
						$type_collecte="";
						if($TYPE_COLLECTE == 1){
							$type_collecte=1;
						}elseif ($TYPE_COLLECTE == 2) {
							$type_collecte=2;
						}
					  $this->form_validation->set_rules('NOM_INSTITUTION', 'Nom', 'required',array('required'=>'le champs  est  obligatoire!!'));
					  $this->form_validation->set_rules('SEASON_NAME', 'Nom', 'required',array('required'=>'le champs  est  obligatoire!!'));
					  $this->form_validation->set_rules('TYPE_COLLECTE', 'Nom', 'required',array('required'=>'le champs  est  obligatoire!!'));
				  
					  if ($this->form_validation->run() == FALSE){
						$message = "<div class='alert alert-danger'>
												client non modifi&eacute; de cong&eacute; non enregistr&eacute;
												<button type='button' class='close' data-dismiss='alert'>&times;</button>
										  </div>";
						$this->session->set_flashdata(array('message'=>$message));
						$data['title']='Utilisateur';
						$data['institution']=$this->Model->getRequete('SELECT * FROM `institution_financiere` order by ID_INSTITUTION');
						$data['season']=$this->Model->getRequete('SELECT * FROM `saison` order by ID_SAISON');
						$this->load->view('includes/avance_view',$data);
					   }else{
									// Vérifier si les données existent déjà dans la base de données
						  $existingData = $this->db->get_where('client', ['CUSTOMER_NAME' => $nom, 'PROVINCE' => $province, 'COMMUNE' => $commune, 'ZONE' => $zone, 'COLLINE' => $colline])->row();
						  // $existingData = $this->model->getOne('client', ['CUSTOMER_NAME' => $nom, 'PROVINCE' => $province, 'COMMUNE' => $commune, 'ZONE' => $zone, 'COLLINE' => $colline])->row();

						  if ($existingData) {
							  
						  // enregistre les donnees dans la table collecte
						  $identifierData = [
							  'CUSTOMER_ID' => $existingData->CUSTOMER_ID,
							  'INSTITUTION' => $institution,
							  'MONTANT' => $montantPayement,
							  'TYPE_COLLECTE' => $type_collecte,
							  'ID_SAISON' => $SAISON_ID
						  ];
						  
						  $this->Model->insert_last_id('collecte', $identifierData);
						  $inserted_id = $this->db->insert_id();
						  $detailData = [
							  'COLLECTE_ID' => $inserted_id,
							  'ID_PRODUCT' => $idproduit,
							  'QUANTITE' => $colonneValeur
						  ];
						  // print_r($detailData);
						  // exit();
						  $this->Model->insert_last_id('collecte_detail', $detailData);
							  $message = "<div class='alert alert-success' id='message'>
							  client enregistr&eacute; avec succés
							  <button type='button' class='close' data-dismiss='alert'>&times;</button>
						</div>";
						 $this->session->set_flashdata(array('message'=>$message));
						  $this->index();
					  } else {
							  // Les données n'existent pas dans la table client, effectuer une insertion dans la table client
							  $null='';
							  $clientData = [
								  'CUSTOMER_NAME' => $nom,
								  'IDENTITY_NUMBER' => $null,
								  'COLLINE' => $colline,
								  'COMMUNE' => $commune,
								  'PROVINCE' => $province,
								  'BIRTH_DAY' => $null,
								  'GENDER' => $null,
								  'CATEGORY' => $null,
								  'REPRESENT_BY' => $null,
								  'MOBILE_NUMBER' => $null,
								  'NBRE_MEMBER' => $null,
								  'ZONE' => $zone
							  ];
							  $this->Model->insert_last_id('client', $clientData);

							  // Récupérer l'ID du client nouvellement inséré
							  $clientId = $this->db->insert_id();

							  // Insérer une ligne dans la table collection avec l'ID du client
							  $identifierData = [
								  'CUSTOMER_ID' => $clientId,
								  'INSTITUTION' => $institution,
								  'MONTANT' => $montantPayement,
								  'TYPE_COLLECTE' => $type_collecte,
								  'ID_SAISON' => $SAISON_ID
							  ];
							  $this->Model->insert_last_id('collecte', $identifierData);
							  
							  $inserted_id = $this->db->insert_id();
							  $detailData = [
								  'COLLECTE_ID' => $inserted_id,
								  'ID_PRODUCT' => $idproduit,
								  'QUANTITE' => $colonneValeur
							  ];
							  
							  $this->Model->insert_last_id('collecte_detail', $detailData);
							}
							}
							$message = "<div class='alert alert-success' id='message'>
							Saison enregistr&eacute; avec succés
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
						</div>";
							$this->session->set_flashdata(array('message'=>$message));
							redirect(base_url('configuration/Avance/listing'));  

                 		
								 
							}
              }else{
                  echo $error['error'];
                }
				$this->index();
        }
    }
	} 

?>

