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
            die;
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
            die;
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
                        setcookie('loginUserData', serialize($user), time() + 365*24*60*60, '/');
                    }
                    setUserRoles();
                    redirect(base_url());
                    die;
                } else{
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Hesabınız Engellenmiştir'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('login'));
                    die;
                }

            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Giriş Bilgilerinizi Kontrol Edin'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('login'));
                die;
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
        setcookie('loginUserData', "", time() - 365*24*60*60, '/');
        redirect(base_url('login'));
        die;
    }
    /* şifre sıfırla form */
    public function forget_password()
    {
        if(is_login()){
            redirect(base_url());
            die;
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
            die;
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
                $this->load->helper('string');
                $temp_password = random_string();

                $send = sendEmail($user->email, 'Şifre Sıfırlama', "CMS'e geçici olarak <b>{$temp_password}</b> ile giriş yapabilirsiniz.");
                if($send){
                    $this->user_model->edit(array('id' => $user->id), array('password' => sha1($temp_password)));
                    $alert = array(
                        'type' => 'success',
                        'title' => 'Başarılı',
                        'message' => 'Şifreniz Başarıyla Sıfırlandı. Lütfen E-Postanızı Kontrol Ediniz.'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('login'));
                    die;
                } else{
                    //echo $this->email->print_debugger();
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'E-Posta Gönderilemedi'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('sifremi-unuttum'));
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
                die;
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