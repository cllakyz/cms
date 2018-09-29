<?php

class Product extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";
        $this->load->model("product_model");
        $this->zaman = date('Y-m-d H:i:s');
    }

    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->product_model->get_all();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }

    public function new_form()
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }

    public function save()
    {
        $this->load->library('form_validation');

        //kurallar
        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();

        if($validate){
            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url'         => sef($this->input->post('title')),
                'rank'        => 0,
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $insert = $this->product_model->add($data);

            if($insert){
                echo "İşlem Başarılı";
            } else{
                echo "Bir Hata Oluştu";
            }
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = TRUE;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
}