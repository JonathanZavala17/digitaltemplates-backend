<?php

require APPPATH . 'libraries/REST_Controller.php';

class Registro extends REST_Controller {

    private $table = "usuarios";
    private $pk = "id_usuario";

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("api/RegistroModel","registro");
        $this->load->model("UtilsModel","utils");
        $this->load->helper("Utilities_helper");
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get()
    {
        $this->response('No method supported', REST_Controller::HTTP_NOT_FOUND);
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

        $nombre = $input_data["nombre"];
        $apellido = $input_data["apellido"];
        $telefono = $input_data["telefono"];
        $direccion = $input_data["direccion"];
        $correo = $input_data["correo"];
        $password = encrypt($input_data["password"],'eNcRiPt_K3Y');
        $form = array(
            "nombre"=>$nombre,
            "apellido"=>$apellido,
            "telefono"=>$telefono,
            "direccion"=>$direccion,
            "correo"=>$correo,
            "password"=>$password,
        );
        $this->response($form, REST_Controller::HTTP_BAD_REQUEST);

        $existe = $this->registro->existe_correo($correo);

        if($existe==0){

            $this->utils->begin();
            $id = $this->utils->insert_alt($this->table,$form);
            if($id){

                $this->utils->commit();
                $user_info = $this->registro->user_info($id);

                $response = array(
                    "status"=>201,
                    "message"=>"Creado Correctamente",
                    "data"=>$user_info,
                );
                $this->response($response, REST_Controller::HTTP_CREATED);

            }else{
                $this->utils->rollback();
                $this->response("", REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else{
            $response = array(
                "status"=>400,
                "message"=>"Ya existe un usuario con este correo"
            );
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_put()
    {
        $this->response('No method supported', REST_Controller::HTTP_NOT_FOUND);
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete()
    {
        $this->response('No method supported', REST_Controller::HTTP_NOT_FOUND);
    }

}