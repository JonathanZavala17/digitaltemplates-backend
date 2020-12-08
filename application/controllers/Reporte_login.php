<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("layout_helper");
        $this->load->model("UtilsModel","utils");
        $this->load->model("admin/ReporteModel","reporte");
        $this->load->helper('utilities_helper');
        validar_session($this);
    }

    public function index()
    {
        $actual = date("d-m-Y");
        $data = array(
            "desde"=> date("d-m-Y",strtotime($actual."- 1 year")),
            "hasta"=> $actual,
        );
        $extras = array(
            'css' => array(),
            'js' => array(),
        );
        layout("admin/reportes/reporte_login",$data,$extras);
    }

    public function generar(){

        $desde = $this->input->post("desde");
        $hasta = $this->input->post("hasta");

        $this->load->add_package_path(APPPATH . 'third_party/fpdf');
        $this->load->library('pdf');
        $this->fpdf = new Pdf();
        $this->fpdf->SetTopMargin(0);
        $this->fpdf->SetLeftMargin(16);
        //Numeracion de paginas
        $this->fpdf->AliasNbPages();
        //Salto automatico de pagina margen de 20 mm
        $this->fpdf->SetAutoPageBreak(true, 20);
        //Agrega la pagina a trabajar
        $this->fpdf->AddPage();
        //Seteo de fuente Times New Roman 12
        $this->fpdf->SetFont('Helvetica', 'B', 14   );

        $path = base_url("assets/img/seven.png");
        $this->fpdf->Image($path, 10, 10, 25, 25);
        $this->fpdf->Cell(280, 7,utf8_decode("SEVEN 0 SEVEN ONLINE"), 0, 1, "C");
        $this->fpdf->SetFont('Helvetica', 'B', 10);
        $this->fpdf->Cell(280, 5, utf8_decode("REPORTE DE INICIO DE SESIÓN"), 0, 1, "C");

        $this->fpdf->Cell(280, 5, utf8_decode("Desde ".$desde." hasta ".$hasta), 0, 1, "C");


        $this->fpdf->Ln(5);
        $this->fpdf->SetFillColor(50, 50, 50);
        $this->fpdf->SetTextColor(255, 255, 255);
        $this->fpdf->SetFont('Helvetica', '', 9);
        $this->fpdf->Cell(10, 5, utf8_decode("N"), 1, 0, "C", 1);
        $this->fpdf->Cell(20, 5, utf8_decode("Código"), 1, 0, "C", 1);
        $this->fpdf->Cell(55, 5, utf8_decode("Nombre"), 1, 0, "C", 1);
        $this->fpdf->Cell(25, 5, utf8_decode("Direccion IP"), 1, 0, "C", 1);
        $this->fpdf->Cell(40, 5, utf8_decode("Dispositivo"), 1, 0, "C", 1);
        $this->fpdf->Cell(20, 5, utf8_decode("Navegador"), 1, 0, "C", 1);
        $this->fpdf->Cell(30, 5, utf8_decode("Version"), 1, 0, "C", 1);
        $this->fpdf->Cell(30, 5, utf8_decode("Tiempo de Uso"), 1, 0, "C", 1);
        $this->fpdf->Cell(35, 5, utf8_decode("Fecha-Hora Acceso"), 1, 1, "C", 1);


        $this->fpdf->SetFillColor(255, 255, 255);
        $this->fpdf->SetTextColor(0, 0, 0);
        $y = $this->fpdf->GetY();

        $rows = $this->reporte->get_login(Y_m_d($desde),Y_m_d($hasta));

        if ($rows != 0) {
            $n=1;
            foreach ($rows as $row) {
                $date1 = new DateTime($row->fecha." ".$row->hora);
                $date2 = new DateTime($row->ultima_act);
                $diff = $date1->diff($date2);

                    $array_data = array(
                        0 => array($n,15,10,"L"),
                        1 => array($row->token,10,20,"L"),
                        2 => array($row->usuario,30,55,"L"),
                        3 => array($row->ip_address,20,25,"L"),
                        4 => array($row->plataforma." ".$row->mobile,20,40,"C"),
                        5 => array($row->navegador,20,20,"L"),
                        6 => array($row->navegador_version,20,30,"L"),
                        7 => array($diff->d."d ".$diff->h."h ".$diff->i."m ".$diff->s."s",40,30,"L"),
                        8 => array(d_m_Y($row->fecha)." ".hora_A_P($row->hora),40,35,"L"),
                    );

                $data=array_procesor($array_data);
                $total_lineas=count($data[0]["valor"]);
                $total_columnas=count($data);

                for ($i=0; $i < $total_lineas; $i++) {
                    for ($j=0; $j < $total_columnas; $j++) {
                        $salto=0;
                        $abajo="LRT";
                        if ($j==$total_columnas-1) {
                            $salto=1;
                        }
                        if ($i<=$total_lineas-1) {
                            $abajo="LR";
                        }
                        if ($i==$total_lineas-1) {
                            $abajo="LRB";
                        }
                        $this->fpdf->Cell($data[$j]["size"][$i],5,utf8_decode($data[$j]["valor"][$i]),$abajo,$salto,$data[$j]["aling"][$i]);
                    }
                }
                $n++;
            }
        }

        ob_clean();
        $this->fpdf->Output("reporte_login.pdf", "I");
    }

}

/* End of file Dashboard.php */