<?php

class Testimonial extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "testimonial_v";
        if(!is_login()){
            redirect(base_url("login"));
            die;
        }
        $this->load->model("testimonial_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->testimonial_model->get_all(array(), "rank ASC");

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
        $item = $this->testimonial_model->get(
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
            redirect(base_url('testimonial/new_form'));
            die;
        }

        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');
        $this->form_validation->set_rules('description', 'Mesaj', 'required|trim');
        $this->form_validation->set_rules('full_name', 'Ad Soyad', 'required|trim');
        $this->form_validation->set_rules('company', 'Şirket Adı', 'required|trim');
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

            $image_90x90 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 90, 90,$file_name);

            if(!$image_90x90){
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('testimonial/new_form'));
                die;
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'full_name'   => $this->input->post('full_name'),
                'company'     => $this->input->post('company'),
                'img_url'     => $file_name,
                'rank'        => 0,
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $insert = $this->testimonial_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Ziyaretçi Notu Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Ziyaretçi Notu Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('testimonial'));
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
        $this->load->library('form_validation');
        //kurallar

        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');
        $this->form_validation->set_rules('description', 'Mesaj', 'required|trim');
        $this->form_validation->set_rules('full_name', 'Ad Soyad', 'required|trim');
        $this->form_validation->set_rules('company', 'Şirket Adı', 'required|trim');
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

                $image_90x90 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 90, 90,$file_name);

                if(!$image_90x90){
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('testimonial/edit_form/'.$id));
                    die;
                }
            } else{
                $file_name = $this->input->post("old_img_url");
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'full_name'   => $this->input->post('full_name'),
                'company'     => $this->input->post('company'),
                'img_url'     => $file_name,
            );
            $where = array('id' => $id);
            $update = $this->testimonial_model->edit($where, $data);

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
                    'message' => 'Ziyaretçi Notu Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Ziyaretçi Notu Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('testimonial'));
            die;
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->testimonial_model->get(
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
        $item = $this->testimonial_model->get($where);
        $delete = $this->testimonial_model->delete($where);

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
                'message' => 'Ziyaretçi Notu Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Ziyaretçi Notu Silinemedi'
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
            $update = $this->testimonial_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Ziyaretçi Notu Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Ziyaretçi Notu Durumu Güncellenemedi'
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
            $get_item = $this->testimonial_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->testimonial_model->edit($where, $sort_data);
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
                'message' => 'Ziyaretçi Notları Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Ziyaretçi Notları Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
}