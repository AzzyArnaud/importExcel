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

              $rupture=$this->Model->getRequete("SELECT COUNT(*) AS N FROM (SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT  )-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE  FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))<=0) table1");


$seuil=$this->Model->getRequete("SELECT COUNT(*) AS N FROM (SELECT p.*, ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT)) as NOMBRE  FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))>0 AND ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu where ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage where ID_PRODUIT=p.ID_PRODUIT))<10) table2");


// $peremption=$this->Model->getRequete("SELECT COUNT(NOM_PRODUIT) AS N FROM (SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage)) table3");

$today=date("Y-m-d");

$peremption=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$today."'");

$date = new DateTime($today); // Y-m-d
$date->add(new DateInterval('P30D'));
$new_date=$date->format('Y-m-d');

$peremption_dat=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$new_date."' and DATE_PERAMPTION>='".$today."'");

$date1 = new DateTime($today); // Y-m-d
$date1->add(new DateInterval('P180D'));
$new_date1=$date1->format('Y-m-d');

$peremption_dat1=$this->Model->getRequete("SELECT* FROM (SELECT p.* FROM saisie_produit p WHERE ((SELECT IFNULL(SUM(QUANTITE),0) from req_requisition  rq where rq.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_VENTE_DETAIL) from vente_vente v join vente_detail vd on v.ID_VENTE=vd.ID_VENTE where vd.ID_PRODUIT=p.ID_PRODUIT)-(SELECT IFNULL(SUM(QUANTITE),0) from req_stock_disparu disp where disp.ID_PRODUIT=p.ID_PRODUIT)-(SELECT COUNT(ID_STOCK_ENDOMAGE) from req_stock_endomage st_end where st_end.ID_PRODUIT=p.ID_PRODUIT))>0) pr JOIN req_barcode req_b  on pr.ID_PRODUIT=req_b.ID_PRODUIT join req_requisition req_req on req_b.ID_REQUISITION=req_req.ID_REQUISITION WHERE ID_BARCODE not in(select ID_BARCODE FROM vente_detail) AND ID_BARCODE not in(select ID_BARCODE FROM req_stock_endomage) and DATE_PERAMPTION<'".$new_date1."' and DATE_PERAMPTION>='".$new_date."'");

// echo $date->format('Y-m-d') . "\n";

$tot=$rupture[0]['N']+$seuil[0]['N']+count($peremption)+count($peremption_dat)+count($peremption_dat1);


   
              // $droits= $this->Model->getOne('config_profil_droit',array('PROFIL_ID'=>$user['PROFIL_ID']));
              // echo'<pre>';
              // print_r($droits);
             

                  $session = array(
                              'STRAPH_ID_USER' => $user['ID_USER'],
                              'STRAPH_NOM' => $user['NOM'],
                              'STRAPH_PRENOM' => $user['PRENOM'],
                              'STRAPH_USERNAME' => $user['USERNAME'],
                              'STRAPH_PROFIL_ID' => $user['PROFIL_ID'],
                              'STRAPH_ID_SOCIETE'=>$user['ID_SOCIETE'],
                              'ID_EMPLOYE' => $user['ID_EMPLOYE'],
                              'tot' => $tot,
                              'rupture' => $rupture[0]['N'],
                              'seuil' => $seuil[0]['N'],
                              'peremption' => count($peremption),
                              'peremption_dat' => count($peremption_dat),
                              'peremption_dat1' => count($peremption_dat1),
                               );
                              //  print_r($session);
                              //  exit;
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
          $this->Model->update('config_user',array('USER_ID'=>$USER_ID),array('PASSWORD'=>md5($p1)));
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

          $this->Model->update('rh_employe',array('ID_EMPLOYE'=>$user['ID_EMPLOYE']), array('PASSWORD'=>md5($PASSWORD)));

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