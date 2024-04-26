<?php
class Produit  extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->Is_Connected();

      }

      public function Is_Connected()
       {
       if (empty($this->session->userdata('STRAPH1_ID_USER')))
        {
         redirect(base_url('Login/'));
        }
       }

        


  
    public function index()
    {

      $data['title']='Produit';
      $data['profil']=$this->Model->getRequete('SELECT * FROM `produit` order by ID_PRODUIT');
      $this->load->view('includes/produit_insert_view',$data);

    }



    public function add()
    {

  $NOM_PRODUCT=$this->input->post('PRODUCT_NAME');
  $ORDER_PRICE=$this->input->post('ORDER_UNIT_PRICE');
  $PAYMENT_PRICE=$this->input->post('PETMENT_UNIT_PRICE');
  $PRODUCT_PRICE=$PAYMENT_PRICE + $ORDER_PRICE;


  $this->form_validation->set_rules('PRODUCT_NAME', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('ORDER_UNIT_PRICE', 'Avnce', 'required',array('required'=>'le champs  est  obligatoire!!'));
  $this->form_validation->set_rules('PETMENT_UNIT_PRICE', '', 'required',array('required'=>'le champs  est  obligatoire!!'));

   if ($this->form_validation->run() == FALSE){
    $message = "<div class='alert alert-danger'>
                            Produit non enregistr&eacute; de cong&eacute; non enregistr&eacute;
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    // $this->session->set_flashdata(array('message'=>$message));
    $data['title']='Produit';
    $data['profil']=$this->Model->getRequete('SELECT * FROM `produit` order by ID_PRODUCT');
    $this->load->view('includes/produit_insert_view',$data);
   }
   else{

    $datasuser=array(
                       'PRODUCT_NAME'=>$NOM_PRODUCT,
                       'ORDER_UNIT_PRICE'=>$ORDER_PRICE,
                       'PETMENT_UNIT_PRICE'=>$PAYMENT_PRICE,
                       'PRODUCT_UNIT_PRICE'=>$PRODUCT_PRICE
                      );
                      
    $this->Model->insert_last_id('produit',$datasuser);  

    $message = "<div class='alert alert-success' id='message'>
                            Produit enregistr&eacute; avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
    $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Produit/listing'));  
   }

    }

    

    public function listing()
    {
      

      $data['resultat']=$this->Model->getRequete('SELECT * FROM `produit`');
      $tabledata=array();
      

      $data['title']='Produit';
      $this->load->view('includes/produit_list_view',$data);

    }



    public function index_update($id)
    {

      $data['title']='Produit';
      $data['data']=$this->Model->getRequeteOne('SELECT * FROM `produit` WHERE ID_PRODUcT = '.$id.'');
      // $data['profil']=$this->Model->getRequete('SELECT NOM_PRODUIT FROM `produit` order by ID_PRODUIT');
      $this->load->view('includes/Produit_Update_View',$data);

    }



    public function update()
    {

      $NAME_PRODUCT=$this->input->post('PRODUCT_NAME');
      $ORDER_PRICE=$this->input->post('ORDER_UNIT_PRICE');
      $PEYMENT_UNIT=$this->input->post('PETMENT_UNIT_PRICE');
      $PRODUCT_PRICE=$ORDER_PRICE + $PEYMENT_UNIT;
      $ID_USER=$this->input->post('ID_USER');
      
    
      $this->form_validation->set_rules('PRODUCT_NAME', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
      $this->form_validation->set_rules('ORDER_UNIT_PRICE', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
      $this->form_validation->set_rules('PETMENT_UNIT_PRICE', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
      $this->form_validation->set_rules('PRODUCT_UNIT_PRICE', '', 'required',array('required'=>'le champs  est  obligatoire!!'));
      
    
       if ($this->form_validation->run() == FALSE){
        $message = "<div class='alert alert-danger'>
                                Produit non modifi&eacute; de cong&eacute; non enregistr&eacute;
                                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
        $this->session->set_flashdata(array('message'=>$message));
        $data['title']='Produit';
        $data['data']=$this->Model->getRequeteOne('SELECT * FROM `produit` WHERE ID_PRODUCT = '.$ID_USER.'');
      //   $data['profil']=$this->Model->getRequete('SELECT * FROM `produit` order by ID_PRODUIT');
        $this->load->view('includes/produit_Update_View',$data);
       }
       else{
    
        $dataproduct=array(
                           'PRODUCT_NAME'=>$NAME_PRODUCT,
                           'ORDER_UNIT_PRICE'=>$ORDER_PRICE,
                           'PETMENT_UNIT_PRICE'=>$PEYMENT_UNIT,
                           'PRODUCT_UNIT_PRICE'=>$PRODUCT_PRICE
                           
                          );
                          
        $this->Model->update('produit',array('ID_PRODUCT'=>$ID_USER),$dataproduct); 


          redirect(base_url('configuration/Produit/listing'));  
       }
    
  
    }


    public function desactiver($id)
    {
      $this->Model->update('produit',array('ID_PRODUCT'=>$id),array('STATUS'=>0));
      $message = "<div class='alert alert-success' id='message'>
                            Produit désactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Produit/listing'));  
    }

  public function reactiver($id)
    {
      $this->Model->update('produit',array('ID_PRODUCT'=>$id),array('STATUS'=>1));
      $message = "<div class='alert alert-success' id='message'>
                            Produit Réactivé avec succés
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                      </div>";
      $this->session->set_flashdata(array('message'=>$message));
      redirect(base_url('configuration/Produit/listing'));  
    }

    
    


}