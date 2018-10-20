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
        $viewData->subViewFolder = "add";

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
        /** Tablodan verilerin getirilmesi */
        $item = $this->setting_model->get(
            array(
                'id' => strip_tags(str_replace(' ', '', $id))
            )
        );
        //kurallar

        if($item->user_name != $this->input->post('user_name')){
            $this->form_validation->set_rules('user_name', 'Kullanıcı Adı', 'required|trim|is_unique[users.user_name]');
        }
        if($item->email != $this->input->post('email')){
            $this->form_validation->set_rules('email', 'E-Posta', 'required|trim|valid_email|is_unique[users.email]');
        }

        $this->form_validation->set_rules('full_name', 'Ad Soyad', 'required|trim');

        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email' => "Lütfen Geçerli <b>{field}</b> Adresi Girin",
                'is_unique'   => "<b>{field}</b> Daha Önceden Kullanılmış",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $data = array(
                'user_name'  => $this->input->post('user_name'),
                'full_name'  => $this->input->post('full_name'),
                'email'      => $this->input->post('email'),
            );
            $where = array('id' => $id);
            $update = $this->setting_model->edit($where, $data);

            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Kullanıcı Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Kullanıcı Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('setting'));
            die;
        } else{
            $viewData = new stdClass();
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
        $delete = $this->setting_model->delete($where);

        if($delete){
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Kullanıcı Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Kullanıcı Silinemedi'
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
            $update = $this->setting_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Kullanıcı Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Kullanıcı Durumu Güncellenemedi'
                );
            }
            echo json_encode($alert);
            die;
        }
    }
    /* Şifre düzenle form */
    public function edit_password_form($id)
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $item = $this->setting_model->get(
            array(
                'id' => strip_tags(str_replace(' ', '', $id))
            )
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "password";
        $viewData->item = $item;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* güncelleme işlemi */
    public function edit_password($id)
    {
        $this->load->library('form_validation');
        //kurallar
        $this->form_validation->set_rules('password', 'Şifre', 'required|trim|min_length[6]|max_length[8]');
        $this->form_validation->set_rules('re_password', 'Şifre Tekrar', 'required|trim|min_length[6]|max_length[8]|matches[password]');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'matches'     => "Şifreler Uyuşmuyor",
                'min_length'  => "<b>{field}</b> En Az 6 Karakter Olmalıdır",
                'max_length'  => "<b>{field}</b> En Fazla 8 Karakter Olmalıdır",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $data = array(
                'password'     => sha1($this->input->post('password')),
            );
            $where = array('id' => $id);
            $update = $this->setting_model->edit($where, $data);

            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Şifre Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Şifre Güncellenemedi'
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
            $viewData->subViewFolder = "password";
            $viewData->form_error = TRUE;
            $viewData->item = $item;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
}