<?php

class Email extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "email_v";
        if(!is_login()){
            redirect(base_url("login"));
        }
        $this->load->model("email_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $user = is_login();
        $items = $this->email_model->get_all(array());

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
        $item = $this->email_model->get(
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
        $this->form_validation->set_rules('protocol', 'Protokol Numarası', 'required|trim');
        $this->form_validation->set_rules('host', 'E-Posta Sunucusu', 'required|trim');
        $this->form_validation->set_rules('port', 'Port Numarası', 'required|trim');
        $this->form_validation->set_rules('user_name', 'Başlık', 'required|trim');
        $this->form_validation->set_rules('user', 'E-Posta (User)', 'required|trim|valid_email');
        $this->form_validation->set_rules('from', 'Kimden Gidecek (From)', 'required|trim|valid_email');
        $this->form_validation->set_rules('to', 'Kime Gidecek (To)', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Şifre', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email' => "Lütfen Geçerli <b>{field}</b> Adresi Girin",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $data = array(
                'protocol'   => $this->input->post('protocol'),
                'host'       => $this->input->post('host'),
                'port'       => $this->input->post('port'),
                'user_name'  => $this->input->post('user_name'),
                'user'       => $this->input->post('user'),
                'from'       => $this->input->post('from'),
                'to'         => $this->input->post('to'),
                'password'   => $this->input->post('password'),
                'isActive'   => 1,
                'createdAt'  => $this->zaman,
            );
            $insert = $this->email_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'E-Mail Ayarı Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'E-Mail Ayarı Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('email'));
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
        $this->form_validation->set_rules('protocol', 'Protokol Numarası', 'required|trim');
        $this->form_validation->set_rules('host', 'E-Posta Sunucusu', 'required|trim');
        $this->form_validation->set_rules('port', 'Port Numarası', 'required|trim');
        $this->form_validation->set_rules('user_name', 'Başlık', 'required|trim');
        $this->form_validation->set_rules('user', 'E-Posta (User)', 'required|trim|valid_email');
        $this->form_validation->set_rules('from', 'Kimden Gidecek (From)', 'required|trim|valid_email');
        $this->form_validation->set_rules('to', 'Kime Gidecek (To)', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Şifre', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email' => "Lütfen Geçerli <b>{field}</b> Adresi Girin",
            )
        );
        $validate = $this->form_validation->run();

        if($validate){

            $data = array(
                'protocol'   => $this->input->post('protocol'),
                'host'       => $this->input->post('host'),
                'port'       => $this->input->post('port'),
                'user_name'  => $this->input->post('user_name'),
                'user'       => $this->input->post('user'),
                'from'       => $this->input->post('from'),
                'to'         => $this->input->post('to'),
                'password'   => $this->input->post('password'),
            );
            $where = array('id' => $id);
            $update = $this->email_model->edit($where, $data);

            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'E-Mail Ayarı Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'E-Mail Ayarı Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('email'));
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->email_model->get(
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
        $delete = $this->email_model->delete($where);

        if($delete){
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'E-Mail Ayarı Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'E-Mail Ayarı Silinemedi'
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
            $update = $this->email_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'E-Mail Ayarı Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'E-Mail Ayarı Durumu Güncellenemedi'
                );
            }
            echo json_encode($alert);
            die;
        }
    }
}