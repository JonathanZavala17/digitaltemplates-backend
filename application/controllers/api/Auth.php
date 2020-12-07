<?php

require APPPATH . 'libraries/REST_Controller.php';

class Auth extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("AuthModel","auth");
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
            $data = $this->db->get_where("categorias", ['id_categoria' => $id])->row_array();
        }else{
            $data = $this->db->get("categorias")->result();
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_post()
    {
        $correo = $this->input->post("correo");
        $password = encrypt($this->input->post("password"),'eNcRiPt_K3Y');

        $existe = $this->auth->login($correo,$password);

        if($existe){
            $this->response(['Success'], REST_Controller::HTTP_OK);
        }
        else{
            $this->response($password, REST_Controller::HTTP_OK);
        }
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