<?php

class Brand extends VS_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "brand_v";
        if(!is_login()){
            redirect(base_url("login"));
            die;
        }
        $this->load->model("brand_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->brand_model->get_all(array(), "rank ASC");

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* yeni kayıt form */
    public function new_form()
    {
        if(!isAllowedWriteModule()){
            redirect(base_url($this->router->fetch_class()));
            die;
        }
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* düzenle form */
    public function edit_form($id)
    {
        if(!isAllowedEditModule()){
            redirect(base_url($this->router->fetch_class()));
            die;
        }
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $item = $this->brand_model->get(
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
        if(!isAllowedWriteModule()){
            redirect(base_url($this->router->fetch_class()));
            die;
        }
        $this->load->library('form_validation');
        //kurallar
        if($_FILES['img_url']['name'] == ''){
            $alert = array(
                'type' => 'info',
                'title' => 'Hata!',
                'message' => 'Lütfen Bir Görsel Seçiniz'
            );
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('brand/new_form'));
            die;
        }

        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $ext = pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
            $file_name = sef(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)).'.'.$ext;

            $image_350x216 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 350, 216,$file_name);

            if(!$image_350x216){
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('brand/new_form'));
                die;
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'img_url'     => $file_name,
                'rank'        => 0,
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $insert = $this->brand_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Marka Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Marka Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('brand'));
            die;
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
        if(!isAllowedEditModule()){
            redirect(base_url($this->router->fetch_class()));
            die;
        }
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

            if($_FILES['img_url']['name'] != ''){
                $ext = pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                $file_name = sef(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)).'.'.$ext;

                $image_350x216 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 350, 216,$file_name);

                if(!$image_350x216){
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('brand/edit_form/'.$id));
                    die;
                }
            } else{
                $file_name = $this->input->post("old_img_url");
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'img_url'     => $file_name,
            );
            $where = array('id' => $id);
            $update = $this->brand_model->edit($where, $data);

            if($update){
                if($_FILES['img_url']['name'] != ''){
                    $dirs = array_diff(scandir("uploads/".$this->viewFolder), array('..', '.'));
                    foreach($dirs as $dir){
                        if(file_exists("uploads/$this->viewFolder/$dir/".$this->input->post("old_img_url"))){
                            unlink("uploads/$this->viewFolder/$dir/".$this->input->post("old_img_url"));
                        }
                    }
                }
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Marka Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Marka Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('brand'));
            die;
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->brand_model->get(
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
        if(!isAllowedDeleteModule()){
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Bu İşlemi Yapmak İçin Yetkiniz Yok'
            );
            echo json_encode($alert);
            die;
        }
        $where = array(
            'id' => strip_tags(str_replace(' ', '', $id))
        );
        $item = $this->brand_model->get($where);
        $delete = $this->brand_model->delete($where);

        if($delete){
            $dirs = array_diff(scandir("uploads/".$this->viewFolder), array('..', '.'));
            foreach($dirs as $dir){
                if(file_exists("uploads/$this->viewFolder/$dir/".$item->img_url)){
                    unlink("uploads/$this->viewFolder/$dir/".$item->img_url);
                }
            }
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Marka Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Marka Silinemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* durum değiştirme işlemi */
    public function change_status($id)
    {
        if(!isAllowedEditModule()){
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Bu İşlemi Yapmak İçin Yetkiniz Yok'
            );
            echo json_encode($alert);
            die;
        }
        $status = $this->input->post('status');
        $where = array('id' => $id);
        $data = array('isActive' => $status);
        $update = $this->brand_model->edit($where, $data);
        if($update){
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Marka Durumu Güncellendi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Marka Durumu Güncellenemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* sıralama işlemi*/
    public function sort()
    {
        if(!isAllowedEditModule()){
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Bu İşlemi Yapmak İçin Yetkiniz Yok'
            );
            echo json_encode($alert);
            die;
        }
        $data = $this->input->post('data');
        parse_str($data, $order);
        $items = $order['sort'];
        $eklenen = 0;
        $eklenmeyen = 0;
        foreach($items as $key => $value){
            $where = array('id' => $value);
            $sort_data = array('rank' => $key+1);
            $get_item = $this->brand_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->brand_model->edit($where, $sort_data);
                if($update){
                    $eklenen++;
                } else{
                    $eklenmeyen++;
                }
            }
        }
        if($eklenmeyen == 0){
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Markalar Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Markalar Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
}