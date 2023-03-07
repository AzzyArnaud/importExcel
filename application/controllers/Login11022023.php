<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

    }

    public function index($params = NULL) {

       if (!empty($this->session->userdata('STRAPH_ID_USER'))) {

        $datas['message']='<div class="alert alert-success text-center" id="message">Connexion bien etablie!<br> Les menus sont à gauche</div>';
        $this->session->set_flashdata($datas);         
        redirect(base_url('Acceuil'));
        } else {

            $datas['message'] = $params;
            $datas['title'] = 'Login';
            $this->load->view('Login_View', $datas);

         }
    }

    public function do_login() {
        $login = $this->input->post('USERNAME');
        $password = $this->input->post('PASSWORD');
       
        $user= $this->Model->getOne('config_user',array('USERNAME'=>$login,'STATUS'=>1));
        

        if (!empty($user)) {
          // echo 'good';
            if ($user['PASSWORD'] == md5($password))

             {


             $notif=$this->Model->getOne("notification",array("ID"=>1));
             $droits = $this->Model->getRequete("Select ID_DROIT FROM config_profil_droit WHERE PROFIL_ID = ".$user['PROFIL_ID']."");
             $listdroi[] =NULL;
             foreach ($droits as $key) {
                 $listdroi[] .= $key['ID_DROIT'];
             }
             // $listdroi .= ')';

             // $listdroi =str_replace(")",",)",$listdroi);

                  $session = array(
                              'STRAPH_ID_USER' => $user['ID_USER'],
                              'STRAPH_NOM' => $user['NOM'],
                              'STRAPH_PRENOM' => $user['PRENOM'],
                              'STRAPH_USERNAME' => $user['USERNAME'],
                              'STRAPH_PROFIL_ID' => $user['PROFIL_ID'],
                              'STRAPH_ID_SOCIETE'=>$user['ID_SOCIETE'],
                              'STRAPH_DROIT'=>$listdroi,
                              'ID_EMPLOYE' => $user['ID_EMPLOYE'],
                              'tot' => $notif['TOT'],
                              'rupture' => $notif['RUPTURE'],
                              'seuil' => $notif['SEUIL'],
                              'peremption' => $notif['PEREMPTION'],
                              'peremption_dat' => $notif['PEREMPTION_DATE'],
                              'peremption_dat1' => $notif['PEREMPTION_DATE1'],
                               );
                  // echo "<pre>";
                               // print_r($session);
                               // exit;
                 $message = "<div class='alert alert-success' id='messages'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
                 $this->session->set_userdata($session);
                 redirect(base_url());
            
            }

             else
                $message = "<div class='alert alert-danger' id='messages'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
              $this->index($message);
              
        }
       
                $message = "<div class='alert alert-success' id='messages'> Le nom d'utilisateur ou/et mot de passe incorect(s) !</div>";
                $this->session->set_userdata($session);
                redirect(base_url('Acceuil'));
           
         
            

    }

    public function do_logout(){

                $session = array(
                              'STRAPH_ID_USER' => NULL,
                              'STRAPH_NOM' => NULL,
                              'STRAPH_PRENOM' => NULL,
                              'STRAPH_USERNAME' => NULL,
                            );                   
            $this->session->set_userdata($session);
            redirect(base_url('Login'));
        }


// public function password_oublie($params=NULL,$id=0)
// {
//   $datas['message'] = $params;
//   $datas['USER_ID'] = $id;
//   $datas['title'] = 'Login';
//   $this->load->view('Forgot_Password_View', $datas);  
// }
// public function test()
// {
//   $permission = $this->Model->get_permission('Employes');

//   echo "<pre>";
//   echo "Session : ".$this->session->userdata('VOE_PROFIL_ID');
//   print_r($permission);
//   echo "</pre>";
// }

 // public function demander($id=0) {
 //        $login = $this->input->post('USERNAME');
 //        $email = filter_input(INPUT_POST, 'USERNAME', FILTER_VALIDATE_EMAIL);
 //          if(($email == null)||($email == false))
 //         {
 //          $criteresmail['TELEPHONE']=$login;
 //            // ADRESE mail non valide 
 //         }
 //         else { //ADRESSE  VALIDE ;

 //          $users=$this->Model->getOne('config_user',array('USERNAME'=>$login));
 //          $criteresmail['TELEPHONE']=$users['TELEPHONE'];
 //         }

 //          $user= $this->Model->getOne('config_user',$criteresmail);
 //          if (!empty($user))
 //           {
 //            $USER_ID=$user['USER_ID'];
 //            $message = "";
 //            $this->password_recover($message,$user['USER_ID']);
 //           }

 //           else
 //           {
 //            $USER_ID=0;
 //            $message = "<div class='alert alert-danger' id='messages'> L'utilisateur n'existe pas/plus dans notre système informatique !</div>";
 //              $this->password_oublie($message);
 //           }
 //         }


  // public function password_recover($params=NULL,$id=0)
  //     {
  //     $datas['USER_ID'] = $id;
  //     $datas['message'] = $params;
  //     $datas['title'] = 'Login';
  //     $this->load->view('Recover_Password_View', $datas);  
  //     }


  public function valider() 
        {

         $USER_ID=$this->input->post('USER_ID');
         $criteres['USER_ID']=$USER_ID;
         $user= $this->Model->getOne('config_user',$criteres);
         $p1 = $this->input->post('PASSWORD');
         $this->form_validation->set_rules('PASSWORD', '', 'trim|required',array('required'=>'Le mot de passe est requis'));
         $this->form_validation->set_rules('PASSWORD_CONFIRM', '', 'trim|required|matches[PASSWORD]',array('matches'=>'Les deux mots de passe doivent etre identiques','required'=>'La confirmation du mot passe est requis'));
         if ($this->form_validation->run()==FALSE)
          {
          $datas['USER_ID'] = $USER_ID;
          $datas['message'] = '';
          $datas['title'] = 'Login';
         $this->load->view('Recover_Password_View', $datas);
          }

          else
           {
          $this->Model->update('config_user',array('USER_ID'=>$USER_ID),array('PASSWORD'=>md5($p1),"ENVOIE"=>0));
           $message = "<div class='alert alert-info' id='messages'> Récupperation du mot de passe fait avec succès !</div>"; 
           $this->index($message);
           }
         
         }


  public function password_recover($params = NULL) {

       if (!empty($this->session->userdata('BANCOBU_ID_USER'))) {

        $datas['message']='<div class="alert alert-success text-center" id="message">Connexion bien etablie!<br> Les menus sont à gauche</div>';
        $this->session->set_flashdata($datas);         
        redirect(base_url('Acceuil'));
        } else {

            $datas['message'] = $params;
            $datas['title'] = 'Forget Password';
            $this->load->view('Forgot_Password_View', $datas);

         }
    }



    public function do_reset_password() {
        $login = $this->input->post('USERNAME');
       
        $user= $this->Model->getOne('rh_employe',array('EMAIL'=>$login,'STATUS'=>1));

        if (!empty($user)) {

          $PASSWORD = $this->notifications->generate_UIID(6);

          $this->Model->update('rh_employe',array('ID_EMPLOYE'=>$user['ID_EMPLOYE']), array('PASSWORD'=>md5($PASSWORD),"ENVOIE"=>0));

          $obj = 'Reinitialisation du mot de passe';
          if ($user['ID_SEXE'] == 1) {
            $message = 'Monsieur '.$user['NOM'].' '.$user['PRENOM'].',<br>';
          }
          else{
           $message = 'Madame '.$user['NOM'].' '.$user['PRENOM'].',<br>';
          }


           $message.= 'Vous avez demande une Reinitialisation de votre mot de passe sur le système de demande et suivie de congé de la BANCOBU.<br><br> Vos nouvelles identifiants de connexion sur le système de demande et suivie de congés dans la BANCOBU sont :<br>Nom d\'utilisateur : <b>'.$user['EMAIL'].'</b><br>Mot de passe : <b>'.$PASSWORD.'</b><br><br>Lien de connexion sur la plateforme : <a href="'.base_url().'" target="_blank">Système Gestion de Congé</a> ';
          $this->notifications->newsend_mail($user['EMAIL'],$obj,NULL,$message,NULL);

          $message = "<div class='alert alert-success' id='messages'> Mot de passe change. Verifier vos mails.</div>";
          $this->password_recover($message);
        }
        else{
          $message = "<div class='alert alert-danger' id='messages'> Le nom d'utilisateur incorect !</div>";
          $this->password_recover($message);
        }
        

        
        
            

    }






}