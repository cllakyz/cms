<?php

class UserOp extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "user_v";
        $this->load->model("user_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* login form */
    public function login()
    {
        if(is_login()){
            redirect(base_url());
        }
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";
        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* login işlemi */
    public function do_login()
    {
        if(is_login()){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        //kurallar
        if(strpos($this->input->post('user_email'), '@') !== FALSE){
            $this->form_validation->set_rules('user_email', 'E-Posta', 'required|trim|valid_email');
            $key = 'email';
        } else{
            $this->form_validation->set_rules('user_email', 'Kullanıcı Adı', 'required|trim');
            $key = 'user_name';
        }

        $this->form_validation->set_rules('user_password', 'Şifre', 'required|trim|min_length[6]|max_length[8]');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email' => "Lütfen Geçerli <b>{field}</b> Adresi Girin",
                'min_length'  => "<b>{field}</b> En Az 6 Karakter Olmalıdır",
                'max_length'  => "<b>{field}</b> En Fazla 8 Karakter Olmalıdır",
            )
        );
        $validate = $this->form_validation->run();
        if($validate){
            $user = $this->user_model->get(
                array(
                    $key       => $this->input->post('user_email'),
                    'password' => sha1($this->input->post('user_password'))
                )
            );
            if($user){
                if($user->isActive == 1){
                    $remember = $this->input->post('remember_me');
                    $this->session->set_userdata("user", $user);
                    if($remember != ''){
                        //setcookie('user', serialize($user), time() + 365*24*60*60, '/');
                    }
                    redirect(base_url());
                } else{
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Hesabınız Engellenmiştir'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('login'));
                }

            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Giriş Bilgilerinizi Kontrol Edin'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('login'));
            }
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = TRUE;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* logout işlemi */
    public function logout()
    {
        $this->session->unset_userdata("user");
        redirect(base_url('login'));
    }
    /* şifre sıfırla form */
    public function forget_password()
    {
        if(is_login()){
            redirect(base_url());
        }
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "forget_password";
        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* Şifre sıfırlama işlemi */
    public function reset_password()
    {
        if(is_login()){
            redirect(base_url());
        }
        $this->load->library('form_validation');
        //kurallar
        $this->form_validation->set_rules('email', 'E-Posta', 'required|trim|valid_email');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required'    => "Lütfen <b>{field}</b> Alanını Doldurun",
                'valid_email' => "Lütfen Geçerli <b>{field}</b> Adresi Girin",
            )
        );
        $validate = $this->form_validation->run();
        if($validate){
            $where = array(
                'isActive'  => 1,
                'email'     => $this->input->post('email'),
            );
            $user = $this->user_model->get($where);
            if($user){
                $this->load->model('email_model');
                $email_setting = $this->email_model->get(array('isActive' => 1));

                $config = array(
                    "protocol"      => $email_setting->protocol,
                    "smtp_host"     => $email_setting->host,
                    "smtp_port"     => $email_setting->port,
                    "smtp_user"     => $email_setting->user,
                    "smtp_pass"     => $email_setting->password,
                    "starttls"      => true,
                    "charset"       => "utf-8",
                    "mailtype"      => "html",
                    "wordwrap"      => true,
                    "newline"       => "\r\n"
                );
                $this->load->library('email', $config);
                $this->email->from($email_setting->from, $email_setting->user_name);
                $this->email->to($user->email);
                $this->email->subject('CMS için Email Çalışmaları');
                $this->email->message('CMS için Email Çalışmaları');

                $send = $this->email->send();
                if($send){
                    echo 'E-Posta başarıyla gönderilmiştir';
                    die;
                } else{
                    echo $this->email->print_debugger();
                    die;
                }
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Bu E-Postaya Ait Kullanıcı Bulunamadı'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('sifremi-unuttum'));
            }
        } else{
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "forget_password";
            $viewData->form_error = TRUE;
            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
}