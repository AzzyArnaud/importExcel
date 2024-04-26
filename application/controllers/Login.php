<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index() {
        if (!empty($this->session->userdata('STRAPH1_ID_USER'))) {

            // $datas['message']='<div class="alert alert-success text-center" id="message">Connexion bien etablie!<br> Les menus sont à gauche</div>';
            $message='<div class="alert alert-success text-center" id="message" style="background-color:#4338ca; color:#fff;">Connexion bien etablie!<br> Les menus sont à gauche</div>';
            $this->session->set_flashdata($datas);     
           
            $this->session->set_flashdata(array('message'=>$message));    
            redirect(base_url('Acceuil'));
            // $this->do_logout();
            } else {
                if (!empty($this->session->flashdata('message'))) {
                    $message= $this->session->flashdata('message');
                }
                else{
                    $message= NULL;
                }
                // if()
                                 
    
                $datas['message'] = $message;
                $datas['title'] = 'Login';
                $this->load->view('Login_View', $datas);
    
             }
    }

    public function do_login() {
        $login = $this->input->post('USERNAME');
        $password = $this->input->post('PASSWORD');
     
        $user= $this->Model->getOne('config_user',array('USERNAME'=>$login,'STATUS'=>1));
        
        // print_r($user);
        if (!empty($user)) {
          // echo 'good';
            if ($user['PASSWORD'] == md5($password))

             {


            //  $notif=$this->Model->getOne("notification",array("ID"=>1));
             $droits = $this->Model->getRequete("Select ID_DROIT FROM config_profil_droit WHERE PROFIL_ID = ".$user['PROFIL_ID']."");
             $listdroi[] =NULL;
             foreach ($droits as $key) {
                 $listdroi[] .= $key['ID_DROIT'];
             }
         
             // $listdroi .= ')';

             // $listdroi =str_replace(")",",)",$listdroi);
             $message='<div class="alert alert-success text-center" id="message " >Connexion bien etablie!<br> Les menus sont à gauche</div>';
             $session = array(
                              'STRAPH1_ID_USER' => $user['ID_USER'],
                              'STRAPH1_NOM' => $user['NOM'],
                              'STRAPH1_PRENOM' => $user['PRENOM'],
                              'STRAPH1_USERNAME' => $user['USERNAME'],
                              'STRAPH1_PROFIL_ID' => $user['PROFIL_ID'],
                              'STRAPH1_ID_SOCIETE'=>$user['ID_SOCIETE'],
                              'STRAPH1_DROIT'=>$listdroi,
                              'ID_EMPLOYE' => $user['ID_EMPLOYE'],
                             
                            //   'tot' => $notif['TOT'],
                            //   'rupture' => $notif['RUPTURE'],
                            //   'seuil' => $notif['SEUIL'],
                            //   'peremption' => $notif['PEREMPTION'],
                            //   'peremption_dat' => $notif['PEREMPTION_DATE'],
                            //   'peremption_dat1' => $notif['PEREMPTION_DATE1'],
                               );
                  // echo "<pre>";
                               // print_r($session);
                               // exit;
                 $message = "<div class='alert alert-success' id='messages'> Bonne Connexion</div>";
                 $this->session->set_userdata($session);
                 // $this->index($message);
                 // $this->session->set_flashdata(array('message'=>$message));

                 // $this->session->set_flashdata(array('message'=>$message));
                 redirect(base_url());
            
            }

             else
                $message = "<div class='alert alert-danger' id='messages'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
            $this->session->set_flashdata(array('message'=>$message));
            redirect(base_url());
              // $this->index($message);
              
        }
       
                $message = "<div class='alert alert-danger text-center' id='messages'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
                $this->session->set_flashdata(array('message'=>$message));
                redirect(base_url());
                // $this->session->set_userdata($session);
                // $this->session->set_flashdata(array('message'=>$message));
                // redirect(base_url('Acceuil'));
                // $this->index($message);
           
         
            

    }

    public function do_logout(){

                $session = array(
                              'STRAPH1_ID_USER' => NULL,
                              'STRAPH1_NOM' =>NULL,
                              'STRAPH1_PRENOM' => NULL,
                              'STRAPH1_USERNAME' => NULL,
                              'STRAPH1_PROFIL_ID' => NULL,
                              'STRAPH1_ID_SOCIETE'=>NULL,
                              'STRAPH1_DROIT'=>NULL,
                              'ID_EMPLOYE' => NULL,
                            //   'tot' => NULL,
                            //   'rupture' => NULL,
                            //   'seuil' => NULL,
                            //   'peremption' => NULL,
                            //   'peremption_dat' => NULL,
                            //   'peremption_dat1' => NULL,
                               );                
            $this->session->set_userdata($session);
            redirect(base_url('Login'));
        }





 








}
