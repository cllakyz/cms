<?php

class Home extends CI_Controller{

    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "homepage";
    }

    public function index()
    {

    }

    public function product_list()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = "product_list_v";
        $this->load->model('product_model');
        $this->load->helper('text');
        $viewData->products = $this->product_model->get_all(array('isActive' => 1), "rank ASC");
        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function product_detail($url)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = "product_v";
        $this->load->model('product_model');
        $this->load->model('product_image_model');
        $viewData->product = $this->product_model->get(
            array('url' => $url, 'isActive' => 1)
        );

        $viewData->product_images = $this->product_image_model->get_all(
            array('isActive' => 1, 'product_id' => $viewData->product->id), "rank ASC"
        );

        $this->load->helper('text');
        $viewData->other_products = $this->product_model->get_all(
            array('isActive' => 1, 'id !=' => $viewData->product->id),
            "rand()",
            array('start' => 0, 'count' => 3)
        );
        $this->load->view($viewData->viewFolder, $viewData);
    }

    public function portfolio_list()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = "portfolio_list_v";
        $this->load->model('portfolio_model');
        $this->load->helper('text');
        $viewData->portfolios = $this->portfolio_model->get_all(array('isActive' => 1), "rank ASC");
        $this->load->view($viewData->viewFolder, $viewData);
    }
}