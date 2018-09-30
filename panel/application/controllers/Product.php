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
        $this->load->model("product_image_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->product_model->get_all(array(), "rank ASC");

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* yeni kayıt form */
    public function new_form()
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* düzenle form */
    public function edit_form($id)
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $item = $this->product_model->get(
            array(
                'id' => strip_tags(str_replace(' ', '', $id))
            )
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "edit";
        $viewData->item = $item;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* yeni kayıt işlemi*/
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

            // TODO alert sistemi eklenecek
            if($insert){
                redirect(base_url('product'));
            } else{
                redirect(base_url('product'));
            }
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = TRUE;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* güncelleme işlemi */
    public function edit($id)
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
            $where = array(
                'id' => strip_tags(str_replace(' ', '', $id))
            );
            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url'         => sef($this->input->post('title')),
            );
            $update = $this->product_model->edit($where, $data);

            // TODO alert sistemi eklenecek
            if($update){
                redirect(base_url('product'));
            } else{
                redirect(base_url('product'));
            }
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->product_model->get(
                array(
                    'id' => strip_tags(str_replace(' ', '', $id))
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "edit";
            $viewData->form_error = TRUE;
            $viewData->item = $item;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* silme işlemi */
    public function delete($id)
    {
        $where = array(
            'id' => strip_tags(str_replace(' ', '', $id))
        );
        $delete = $this->product_model->delete($where);

        // TODO alert sistemi eklenecek
        if($delete){
            redirect(base_url('product'));
        } else{
            redirect(base_url('product'));
        }
    }
    /* durum değiştirme işlemi */
    public function change_status($id)
    {
        if($id){
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $data = array('isActive' => $status);
            $update = $this->product_model->edit($where, $data);
            if($update){

            } else{

            }
        }
    }
    /* sıralama işlemi*/
    public function sort()
    {
        $data = $this->input->post('data');
        parse_str($data, $order);
        $items = $order['sort'];
        $eklenen = 0;
        $eklenmeyen = 0;
        foreach($items as $key => $value){
            $where = array('id' => $value);
            $sort_data = array('rank' => $key+1);
            $get_item = $this->product_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->product_model->edit($where, $sort_data);
                if($update){
                    $eklenen++;
                } else{
                    $eklenmeyen++;
                }
            }
        }
    }
    /* resim ekleme form */
    public function image_form($id)
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->product_model->get(array('id' => $id));

        $image_where = array('product_id' => $id);
        $viewData->item_images = $this->product_image_model->get_all($image_where, "rank ASC");
        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }

    public function image_upload($id)
    {
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $file_name = sef(pathinfo($_FILES['file']['name'], PATHINFO_FILENAME)).'.'.$ext;

        $config = array(
            "allowed_types" => "jpg|jpeg|png|JPG|JPEG|PNG",
            "upload_path"   => "uploads/".$this->viewFolder."/",
            "file_name"     => $file_name,
        );

        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("file");
        if($upload){
            $file = $this->upload->data("file_name");
            $data = array(
                'product_id'  => $id,
                'img_url'     => $file,
                'rank'        => 0,
                'isActive'    => 1,
                'isCover'     => 0,
                'createdAt'   => $this->zaman,
            );
            $add = $this->product_image_model->add($data);
        } else{
            echo "hata";
        }
    }

    public function refresh_image_list($id)
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->product_model->get(array('id' => $id));

        $image_where = array('product_id' => $id);
        $viewData->item_images = $this->product_image_model->get_all($image_where, "rank ASC");
        $render_html = $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/image_list_v', $viewData, true);
        echo $render_html;
        die;
    }
}