<?php

class Reference extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "reference_v";
        $this->load->model("reference_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->reference_model->get_all(array(), "rank ASC");

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
        $item = $this->reference_model->get(
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
        if($_FILES['img_url']['name'] == ''){
            $alert = array(
                'type' => 'info',
                'title' => 'Hata!',
                'message' => 'Lütfen Bir Görsel Seçiniz'
            );
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('reference/new_form'));
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

            $config = array(
                "allowed_types" => "jpg|jpeg|png|JPG|JPEG|PNG",
                "upload_path"   => "uploads/".$this->viewFolder."/",
                "file_name"     => $file_name,
            );

            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("img_url");
            if($upload){
                $image_url = $this->upload->data("file_name");
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('reference/new_form'));
                die;
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url'         => sef($this->input->post('title')),
                'img_url'     => $image_url,
                'rank'        => 0,
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $insert = $this->reference_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Referans Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Referans Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('reference'));
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

            if($_FILES['img_url']['name'] != ''){
                $ext = pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                $file_name = sef(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)).'.'.$ext;

                $config = array(
                    "allowed_types" => "jpg|jpeg|png|JPG|JPEG|PNG",
                    "upload_path"   => "uploads/".$this->viewFolder."/",
                    "file_name"     => $file_name,
                );

                $this->load->library("upload", $config);
                $upload = $this->upload->do_upload("img_url");
                if($upload){
                    $image_url = $this->upload->data("file_name");
                    $video_url = NULL;
                } else{
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('reference/edit_form/'.$id));
                    die;
                }
            } else{
                $image_url = $this->input->post("old_img_url");
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url'         => sef($this->input->post('title')),
                'img_url'     => $image_url,
            );
            $where = array('id' => $id);
            $update = $this->reference_model->edit($where, $data);

            if($update){
                if($_FILES['img_url']['name'] != ''){
                    if(file_exists("uploads/".$this->viewFolder."/".$this->input->post("old_img_url"))){
                        unlink("uploads/".$this->viewFolder."/".$this->input->post("old_img_url"));
                    }
                }
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Referans Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Referans Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('reference'));
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->reference_model->get(
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
        $delete = $this->reference_model->delete($where);

        if($delete){
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Referans Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Referans Silinemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* durum değiştirme işlemi */
    public function change_status($id)
    {
        if($id){
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $data = array('isActive' => $status);
            $update = $this->reference_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Referans Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Referans Durumu Güncellenemedi'
                );
            }
            echo json_encode($alert);
            die;
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
            $get_item = $this->reference_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->reference_model->edit($where, $sort_data);
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
                'message' => 'Referanslar Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Referanslar Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
}