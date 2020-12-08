<?php

require APPPATH . 'libraries/REST_Controller.php';

class Usuarios extends REST_Controller {

    private $table = "usuarios";

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model("api/UsuariosModel","usuarios");
        $this->load->model("UtilsModel","utils");
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

            $row = $this->usuarios->GetRow($id);

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
                    "message"=>"Usuario no existe",
                    "data"=>array(),
                );
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }

        }
        else{
            $response = array(
                "status"=>404,
                "message"=>"Error",
                "data"=>array(),
            );
            $this->response($response, REST_Controller::HTTP_NOT_FOUND);
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

        $id = $input_data["id_usuario"];
        $old2 = $input_data["antigua_password"];
        $new = encrypt($input_data["nueva_password"],'eNcRiPt_K3Y');

        $row = $this->usuarios->GetRow($id);

        $old = decrypt($row->password,'eNcRiPt_K3Y');

        if($old2==$old){

            $form = array(
                "password"=>$new,
                "updated_at"=>date("Y-m-d H:i:s"),
            );
            $where = " id_usuario='".$id."'";
            $this->utils->begin();
            $update = $this->utils->update($this->table,$form,$where);

            if($update){

                $this->utils->commit();
                $response = array(
                    "status"=>201,
                    "message"=>"Actualizado Correctamente",
                    "data"=>$row,
                );
                $this->response($response, REST_Controller::HTTP_OK);

            }else{
                $response = array(
                    "status"=>400,
                    "message"=>"No se puede actualizar los datos",
                );
                $this->utils->rollback();
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $response = array(
                "status"=>400,
                "message"=>"Contraseña antigua no coincide",
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
        $this->input->raw_input_stream;
        $input_data = json_decode($this->input->raw_input_stream, true);

        $nombre = $input_data["nombre"];
        $apellido = $input_data["apellido"];
        $telefono = $input_data["telefono"];
        $direccion = $input_data["direccion"];

        $row = $this->usuarios->GetRow($id);

        if($row){

            $form = array(
                "nombre"=>$nombre,
                "apellido"=>$apellido,
                "telefono"=>$telefono,
                "direccion"=>$direccion,
                "updated_at"=>date("Y-m-d H:i:s"),
            );
            $where = " id_usuario='".$id."'";
            $this->utils->begin();
            $update = $this->utils->update($this->table,$form,$where);

            if($update){

                $this->utils->commit();
                $response = array(
                    "status"=>201,
                    "message"=>"Actualizado Correctamente",
                    "data"=>$row,
                );
                $this->response($response, REST_Controller::HTTP_OK);

            }else{
                $response = array(
                    "status"=>400,
                    "message"=>"No se puede actualizar los datos",
                );
                $this->utils->rollback();
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            $response = array(
                "status"=>404,
                "message"=>"Usuario no existe",
            );
            $this->response($response, REST_Controller::HTTP_NOT_FOUND);
        }
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