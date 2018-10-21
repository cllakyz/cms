<?php

class Setting extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "setting_v";
        if(!is_login()){
            redirect(base_url("login"));
            die;
        }
        $this->load->model("setting_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        /** Tablodan verilerin getirilmesi */
        $item = $this->setting_model->get();
        if($item){
            $viewData->subViewFolder = "edit";
        } else{
            $viewData->subViewFolder = "no_content";
        }
        $viewData->item = $item;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* yeni kayıt form */
    public function new_form()
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        /** Tablodan verilerin getirilmesi */
        $item = $this->setting_model->get();
        if($item){
            $viewData->subViewFolder = "edit";
        } else{
            $viewData->subViewFolder = "add";
        }
        $viewData->item = $item;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* düzenle form */
    public function edit_form($id)
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $item = $this->setting_model->get(
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
        if($_FILES['logo']['name'] == ''){
            $alert = array(
                'type' => 'info',
                'title' => 'Hata!',
                'message' => 'Lütfen Bir Görsel Seçiniz'
            );
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('setting/new_form'));
            die;
        }

        $this->form_validation->set_rules('company_name', 'Şirket Adı', 'required|trim');
        $this->form_validation->set_rules('phone_1', 'Telefon 1', 'required|trim');
        $this->form_validation->set_rules('email', 'E-Posta Adresi', 'required|trim|valid_email');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'      => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email'   => "Lütfen Geçerli <b>{field}</b> Girin",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
            $file_name = sef($this->input->post('company_name')).'.'.$ext;

            $config = array(
                "allowed_types" => "jpg|jpeg|png|JPG|JPEG|PNG",
                "upload_path"   => "uploads/".$this->viewFolder."/",
                "file_name"     => $file_name,
            );

            $this->load->library("upload", $config);
            $upload = $this->upload->do_upload("logo");
            if($upload){
                $logo = $this->upload->data("file_name");
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('setting/new_form'));
                die;
            }

            $data = array(
                'company_name'  => $this->input->post('company_name'),
                'phone_1'       => $this->input->post('phone_1'),
                'phone_2'       => $this->input->post('phone_2'),
                'fax_1'         => $this->input->post('fax_1'),
                'fax_2'         => $this->input->post('fax_2'),
                'address'       => $this->input->post('address'),
                'about_us'      => $this->input->post('about_us'),
                'mission'       => $this->input->post('mission'),
                'vision'        => $this->input->post('vision'),
                'email'         => $this->input->post('email'),
                'facebook'      => $this->input->post('facebook'),
                'twitter'       => $this->input->post('twitter'),
                'instagram'     => $this->input->post('instagram'),
                'linkedin'      => $this->input->post('linkedin'),
                'logo'          => $logo,
                'createdAt'     => $this->zaman,
            );
            $insert = $this->setting_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Site Ayarı Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Site Ayarı Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('setting'));
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
        $this->form_validation->set_rules('company_name', 'Şirket Adı', 'required|trim');
        $this->form_validation->set_rules('phone_1', 'Telefon 1', 'required|trim');
        $this->form_validation->set_rules('email', 'E-Posta Adresi', 'required|trim|valid_email');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'      => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email'   => "Lütfen Geçerli <b>{field}</b> Girin",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            if($_FILES['logo']['name'] != ''){
                $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $file_name = sef($this->input->post('company_name')).'.'.$ext;

                $config = array(
                    "allowed_types" => "jpg|jpeg|png|JPG|JPEG|PNG",
                    "upload_path"   => "uploads/".$this->viewFolder."/",
                    "file_name"     => $file_name,
                );

                $this->load->library("upload", $config);
                $upload = $this->upload->do_upload("logo");
                if($upload){
                    $logo = $this->upload->data("file_name");
                    $video_url = NULL;
                } else{
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('setting/edit_form/'.$id));
                    die;
                }
            } else{
                $logo = $this->input->post("old_logo");
            }

            $data = array(
                'company_name'  => $this->input->post('company_name'),
                'phone_1'       => $this->input->post('phone_1'),
                'phone_2'       => $this->input->post('phone_2'),
                'fax_1'         => $this->input->post('fax_1'),
                'fax_2'         => $this->input->post('fax_2'),
                'address'       => $this->input->post('address'),
                'about_us'      => $this->input->post('about_us'),
                'mission'       => $this->input->post('mission'),
                'vision'        => $this->input->post('vision'),
                'email'         => $this->input->post('email'),
                'facebook'      => $this->input->post('facebook'),
                'twitter'       => $this->input->post('twitter'),
                'instagram'     => $this->input->post('instagram'),
                'linkedin'      => $this->input->post('linkedin'),
                'logo'          => $logo,
                'updatedAt'     => $this->zaman,
            );
            $where = array('id' => $id);
            $update = $this->setting_model->edit($where, $data);

            if($update){
                if($_FILES['logo']['name'] != ''){
                    if(file_exists("uploads/".$this->viewFolder."/".$this->input->post("old_logo"))){
                        unlink("uploads/".$this->viewFolder."/".$this->input->post("old_logo"));
                    }
                }
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Site Ayarı Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Site Ayarı Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('setting'));
            die;
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->setting_model->get(
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
}