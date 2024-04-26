<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Import extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Import_model', 'import');
        $this->load->helper(array('url','html','form'));
    }    
 
    public function index() {
        $this->load->view('import/index');
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
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                      $insertdata[$i]['CUSTOMER_NAME'] = $value['A'];
                      $insertdata[$i]['IDENTITY_NUMBER'] = $value['B'];
                      $insertdata[$i]['COLLINE'] = $value['C'];
                      $insertdata[$i]['COMMUNE'] = $value['D'];
                      $insertdata[$i]['PROVINCE'] = $value['E'];
                      $insertdata[$i]['BIRTH_DAY'] = $value['F'];
                      $insertdata[$i]['GENDER'] = $value['G'];
                      $insertdata[$i]['CATEGORY'] = $value['H'];
                      $insertdata[$i]['REPRESENT_BY'] = $value['I'];
                      $insertdata[$i]['MOBILE_NUMBER'] = $value['J'];
                      $insertdata[$i]['NBRE_MEMBER'] = $value['K'];
                      $insertdata[$i]['ZONE'] = $value['L'];
                      $i++;
                    } 
                    $result = $this->import->importData($insertdata);   
                    // $resuldata= $this->Import_model->insert($data);
                    if($result){
                        $this->session->set_flashdata("message","<div class='alert alert-success'>Successfully added</div>");
                        redirect(base_url('configuration/Customer/listing'));  
                      }else{
                       $this->session->set_flashdata("message","<div class='alert alert-danger'>failed added</div>");
                        $this->index();
                    }            
      
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
									    $CUSTOMER_NAME=$values[0];
												$IDENTITY_NUMBER=$values[1];
												$COLLINE=$values[2];
												$COMMUNE=$values[3];
												$PROVINCE=$values[4];
												$BIRTH_DAY=$values[5];
												$GENDER=$values[6];
												$CATEGORY=$values[7];
												$REPRESENT_BY=$values[8];
												$MOBILE_NUMBER=$values[9];
												$NBRE_MEMBER=$values[10];
												$ZONE=$values[11];
												
												$datacsv[] = array(
													'CUSTOMER_NAME'=>$CUSTOMER_NAME,
													'IDENTITY_NUMBER'=>$IDENTITY_NUMBER,
													'COLLINE'=>$COLLINE,
													'COMMUNE'=>$COMMUNE,
													'PROVINCE'=>$PROVINCE,
													'BIRTH_DAY'=>$BIRTH_DAY,
													'GENDER'=>$GENDER,
													'CATEGORY'=>$CATEGORY,
													'REPRESENT_BY'=>$REPRESENT_BY,
													'MOBILE_NUMBER'=>$MOBILE_NUMBER,
													'NBRE_MEMBER'=>$NBRE_MEMBER,
													'ZONE'=>$ZONE
												);
												// echo '<pre>';
												// print_r($files);
												// exit();
											}
												$result = $this->import->importData($datacsv);
												if($result){
													$this->session->set_flashdata("message","<div class='alert alert-success'>Successfully added</div>");
															redirect(base_url("configuration/customer/listing"));
											}else{
																	$this->session->set_flashdata("message","<div class='alert alert-danger'>failed added</div>");
																$this->index();
															 }
							
								 
								 
							}
              }else{
                  echo $error['error'];
                }
                 
                 
								$this->load->view('import/index');
        }
    }
	} 

?>