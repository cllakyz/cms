<?php

class User extends VS_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "user_v";
        if(!is_login()){
            redirect(base_url("login"));
            die;
        }
        $this->load->model("user_model");
        $this->load->model("user_role_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        $where = array();
        /** Tablodan verilerin getirilmesi */
        $items = $this->user_model->get_all($where);

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
        $viewData->subViewFolder = "list";

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* düzenle form */
    public function edit_form($id)
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $item = $this->user_model->get(
            array(
                'id' => strip_tags(str_replace(' ', '', $id))
            )
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "edit";
        $viewData->item = $item;
        $viewData->user_roles = $this->user_role_model->get_all(array("isActive" => 1));

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* yeni kayıt işlemi*/
    public function save()
    {
        $this->load->library('form_validation');
        //kurallar
        $this->form_validation->set_rules('user_name', 'Kullanıcı Adı', 'required|trim|is_unique[users.user_name]');
        $this->form_validation->set_rules('full_name', 'Ad Soyad', 'required|trim');
        $this->form_validation->set_rules('email', 'E-Posta', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('user_role', 'Yetki Grubu', 'required|trim');
        $this->form_validation->set_rules('password', 'Şifre', 'required|trim|min_length[6]|max_length[8]');
        $this->form_validation->set_rules('re_password', 'Şifre Tekrar', 'required|trim|min_length[6]|max_length[8]|matches[password]');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email' => "Lütfen Geçerli <b>{field}</b> Adresi Girin",
                'is_unique'   => "<b>{field}</b> Daha Önceden Kullanılmış",
                'matches'     => "Şifreler Uyuşmuyor",
                'min_length'  => "<b>{field}</b> En Az 6 Karakter Olmalıdır",
                'max_length'  => "<b>{field}</b> En Fazla 8 Karakter Olmalıdır",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $data = array(
                'user_name'   => $this->input->post('user_name'),
                'full_name'   => $this->input->post('full_name'),
                'email'       => $this->input->post('email'),
                'user_role'   => $this->input->post('user_role'),
                'password'    => sha1($this->input->post('password')),
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $insert = $this->user_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Kullanıcı Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Kullanıcı Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('user'));
            die;
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = TRUE;
            $viewData->user_roles = $this->user_role_model->get_all(array("isActive" => 1));

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* güncelleme işlemi */
    public function edit($id)
    {
        $this->load->library('form_validation');
        /** Tablodan verilerin getirilmesi */
        $item = $this->user_model->get(
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
        $this->form_validation->set_rules('user_role', 'Yetki Grubu', 'required|trim');

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
                'user_role'  => $this->input->post('user_role'),
            );
            $where = array('id' => $id);
            $update = $this->user_model->edit($where, $data);

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
            redirect(base_url('user'));
            die;
        } else{
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "edit";
            $viewData->form_error = TRUE;
            $viewData->item = $item;
            $viewData->user_roles = $this->user_role_model->get_all(array("isActive" => 1));

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* silme işlemi */
    public function delete($id)
    {
        $where = array(
            'id' => strip_tags(str_replace(' ', '', $id))
        );
        $delete = $this->user_model->delete($where);

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
            $update = $this->user_model->edit($where, $data);
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
        $item = $this->user_model->get(
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
            $update = $this->user_model->edit($where, $data);

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
            redirect(base_url('user'));
            die;
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->user_model->get(
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