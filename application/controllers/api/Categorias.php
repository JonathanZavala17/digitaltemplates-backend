<?php

require APPPATH . 'libraries/REST_Controller.php';

class Categorias extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("api/CategoriasModel","categorias");
        $this->load->helper("Utilities_helper");
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get($id = 0)
    {

        if(!empty($id)){

            $row = $this->categorias->GetRow($id);

            if($row){

                if($row->estado=="Activo"){
                    $response = array(
                        "status"=>200,
                        "message"=>"Success",
                        "data"=>$row,
                    );
                    $this->response($response, REST_Controller::HTTP_OK);
                }else{
                    $response = array(
                        "status"=>400,
                        "message"=>"Categoria no esta activa",
                        "data"=>array(),
                    );
                    $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
                }
            }else{
                $response = array(
                    "status"=>400,
                    "message"=>"Categoria no existe",
                    "data"=>array(),
                );
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }

        }
        else{

            $row = $this->categorias->RowsList();

            if($row){
                $response = array(
                    "status"=>200,
                    "message"=>"Success",
                    "data"=>$row,
                );
                $this->response($response, REST_Controller::HTTP_OK);
            }else{
                $response = array(
                    "status"=>400,
                    "message"=>"No Categorias Disponibles",
                    "data"=>array(),
                );
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_post()
    {
        $input = $this->input->post();
        $this->db->insert('items',$input);

        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('items', $input, array('id'=>$id));

        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete($id)
    {
        $this->db->delete('items', array('id'=>$id));

        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
    }

}