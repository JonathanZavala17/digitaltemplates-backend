<?php

require APPPATH . 'libraries/REST_Controller.php';

class Documentos extends REST_Controller
{

    private $table = "documentos";

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model("api/DocumentosModel", "documentos");
        $this->load->model("UtilsModel", "utils");
        $this->load->helper("Utilities_helper");
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_get($id = 0)
    {


        if (!empty($id)) {

            $row = $this->documentos->GetRow($id);

            if ($row) {
                $tags = $this->documentos->GetTagsList($id);
                $response = array(
                    "status" => 200,
                    "message" => "Success",
                    "data" => $row,
                    "etiquetas" => $tags
                );
                $this->response($response, REST_Controller::HTTP_OK);
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "Documento no existe",
                    "data" => array(),
                );
                $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
            }

        } else {

            $id_usuario = $this->input->get("id_usuario");

            $row = $this->documentos->RowsList($id_usuario);

            if ($row) {

                $response = array(
                    "status" => 200,
                    "message" => "Success",
                    "data" => $row,
                    "count" => count($row)
                );
                $this->response($response, REST_Controller::HTTP_OK);
            } else {
                $response = array(
                    "status" => 400,
                    "message" => "No Documentos Disponibles",
                    "data" => array(),
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

        $id_usuario = $input_data["id_usuario"];
        $id_plantilla = $input_data["id_plantilla"];
        $contenido = $input_data["contenido"];
        $etiquetas = $input_data["etiquetas"];
        $form = array(
            "id_usuario" => $id_usuario,
            "id_plantilla" => $id_plantilla,
            "contenido" => $contenido,
        );
        $this->response($form, REST_Controller::HTTP_BAD_REQUEST);

        $this->utils->begin();
        $id = $this->utils->insert_alt($this->table, $form);
        if ($id) {

            for ($i = 0; $i < count($etiquetas); $i++) {

                $tag = array(
                    "id_documento" => $id,
                    "etiqueta" => $etiquetas[$i]["etiqueta"],
                    "valor" => $etiquetas[$i]["valor"],
                );
                $this->utils->insert_alt("documentos_valores", $tag);
            }

            $this->utils->commit();

            $response = array(
                "status" => 201,
                "message" => "Creado Correctamente",
            );
            $this->response($response, REST_Controller::HTTP_CREATED);

        } else {
            $this->utils->rollback();
            $this->response("No se puede actualizar", REST_Controller::HTTP_BAD_REQUEST);
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

        $row = $this->documentos->GetRow($id);

        if ($row) {
            $id_usuario = $input_data["id_usuario"];
            $id_plantilla = $input_data["id_plantilla"];
            $contenido = $input_data["contenido"];
            $etiquetas = $input_data["etiquetas"];
            $form = array(
                "id_usuario" => $id_usuario,
                "id_plantilla" => $id_plantilla,
                "contenido" => $contenido,
            );
            $this->response($form, REST_Controller::HTTP_BAD_REQUEST);

            $this->utils->begin();
            $id = $this->utils->insert_alt($this->table, $form);
            if ($id) {

                for ($i = 0; $i < count($etiquetas); $i++) {

                    $tag = array(
                        "id_documento" => $id,
                        "etiqueta" => $etiquetas[$i]["etiqueta"],
                        "valor" => $etiquetas[$i]["valor"],
                    );
                    $this->utils->insert_alt("documentos_valores", $tag);
                }

                $this->utils->commit();

                $response = array(
                    "status" => 202,
                    "message" => "Creado Correctamente",
                );
                $this->response($response, REST_Controller::HTTP_ACCEPTED);

            } else {
                $this->utils->rollback();
                $this->response("No se puede actualizar", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response("Documento no existe", REST_Controller::HTTP_NOT_FOUND);
        }


    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index_delete($id)
    {

        $row = $this->documentos->GetRow($id);

        if ($row) {

            $form = array(
                "estado" => "Borrado",
            );
            $where = " id_documento='" . $id . "'";
            $this->utils->begin();
            $update = $this->utils->update($this->table, $form, $where);
            if ($update) {

                $this->utils->commit();

                $response = array(
                    "status" => 200,
                    "message" => "Eliminado Correctamente",
                );
                $this->response($response, REST_Controller::HTTP_OK);

            } else {
                $this->utils->rollback();
                $this->response("No se puede eliminar", REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $this->response("Documento no existe", REST_Controller::HTTP_NOT_FOUND);
        }
    }

}