<?php

require APPPATH . 'libraries/REST_Controller.php';

class Planes extends REST_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("api/PlanesModel","planes");
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

            $row = $this->planes->GetRow($id);

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
                        "message"=>"Plan no esta activo",
                        "data"=>array(),
                    );
                    $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
                }
            }else{
                $response = array(
                    "status"=>400,
                    "message"=>"Plan no existe",
                    "data"=>array(),
                );
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }

        }
        else{

            $row = $this->planes->PlanesListado();

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
                    "message"=>"No Planes Disponibles",
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
        $this->input->raw_input_stream;
        $input_data = json_decode($this->input->raw_input_stream, true);

        $correo = $input_data["correo"];
        $password = encrypt($input_data["password"],'eNcRiPt_K3Y');


        $resp = $this->auth->login($correo,$password);

        if($resp){

            $response = array(
                "status"=>200,
                "message"=>"Success",
                "data"=>$resp,
            );
            $this->response($response, REST_Controller::HTTP_OK);
        }
        else{
            $response = array(
                "status"=>400,
                "message"=>"Datos Incorrectos"
            );
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
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