<?php

class News extends VS_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "news_v";
        if(!is_login()){
            redirect(base_url("login"));
            die;
        }
        $this->load->model("news_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->news_model->get_all(array(), "rank ASC");

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
        $item = $this->news_model->get(
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
        $news_type = $this->input->post("news_type");

        if($news_type == 1){
            if($_FILES['img_url']['name'] == ''){
                $alert = array(
                    'type' => 'info',
                    'title' => 'Hata!',
                    'message' => 'Lütfen Bir Görsel Seçiniz'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('news/new_form'));
                die;
            }
        } elseif($news_type == 2){
            $this->form_validation->set_rules('video_url', 'Video URL', 'required|trim');
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

            if($news_type == 1){
                $ext = pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                $file_name = sef(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)).'.'.$ext;

                $image_513x289 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 513, 289,$file_name);
                $image_730x411 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 730, 411,$file_name);

                if(!$image_513x289 || !$image_730x411){
                    $alert = array(
                        'type' => 'error',
                        'title' => 'Hata!',
                        'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                    );
                    $this->session->set_flashdata('alert', $alert);
                    redirect(base_url('news/new_form'));
                    die;
                } else{
                    $video_url = NULL;
                }
            } elseif($news_type == 2){
                $file_name = NULL;
                $video_url = $this->input->post('video_url');
            } else{
                $file_name = NULL;
                $video_url = NULL;
                $alert = array(
                    'type' => 'info',
                    'title' => 'Hata!',
                    'message' => 'Lütfen En Az Bir Haber Türü Seçin'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('news/new_form'));
                die;
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url'         => sef($this->input->post('title')),
                'news_type'   => $news_type,
                'img_url'     => $file_name,
                'video_url'   => $video_url,
                'rank'        => 0,
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $insert = $this->news_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Haber Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Haber Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('news'));
            die;
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = TRUE;
            $viewData->news_type = $news_type;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* güncelleme işlemi */
    public function edit($id)
    {
        $this->load->library('form_validation');
        //kurallar
        $news_type = $this->input->post("news_type");

        if($news_type == 2){
            $this->form_validation->set_rules('video_url', 'Video URL', 'required|trim');
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

            if($news_type == 1){
                if($_FILES['img_url']['name'] != ''){
                    $ext = pathinfo($_FILES['img_url']['name'], PATHINFO_EXTENSION);
                    $file_name = sef(pathinfo($_FILES['img_url']['name'], PATHINFO_FILENAME)).'.'.$ext;

                    $image_513x289 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 513, 289,$file_name);
                    $image_730x411 = upload_media($_FILES['img_url']['tmp_name'], "uploads/".$this->viewFolder."/", 730, 411,$file_name);

                    if(!$image_513x289 || !$image_730x411){
                        $alert = array(
                            'type' => 'error',
                            'title' => 'Hata!',
                            'message' => 'Dosya Formatı JPG,PNG veya JPEG Olmalıdır'
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url('news/edit_form/'.$id));
                        die;
                    } else{
                        $video_url = NULL;
                    }
                } else{
                    $video_url = NULL;
                    $file_name = $this->input->post("old_img_url");
                }
            } elseif($news_type == 2){
                $file_name = NULL;
                $video_url = $this->input->post('video_url');
            } else{
                $file_name = NULL;
                $video_url = NULL;
                $alert = array(
                    'type' => 'info',
                    'title' => 'Hata!',
                    'message' => 'Lütfen En Az Bir Haber Türü Seçin'
                );
                $this->session->set_flashdata('alert', $alert);
                redirect(base_url('news/edit_form/'.$id));
                die;
            }

            $data = array(
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'url'         => sef($this->input->post('title')),
                'news_type'   => $news_type,
                'img_url'     => $file_name,
                'video_url'   => $video_url,
            );
            $where = array('id' => $id);
            $update = $this->news_model->edit($where, $data);

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
                    'message' => 'Haber Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Haber Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('news'));
            die;
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->news_model->get(
                array(
                    'id' => strip_tags(str_replace(' ', '', $id))
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "edit";
            $viewData->form_error = TRUE;
            $viewData->news_type = $news_type;
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
        $item = $this->news_model->get($where);
        $delete = $this->news_model->delete($where);

        if($delete){
            if($item->news_type == 1){
                $dirs = array_diff(scandir("uploads/".$this->viewFolder), array('..', '.'));
                foreach($dirs as $dir){
                    if(file_exists("uploads/$this->viewFolder/$dir/".$item->img_url)){
                        unlink("uploads/$this->viewFolder/$dir/".$item->img_url);
                    }
                }
            }

            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Haber Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Haber Silinemedi'
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
            $update = $this->news_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Haber Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Haber Durumu Güncellenemedi'
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
            $get_item = $this->news_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->news_model->edit($where, $sort_data);
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
                'message' => 'Haberler Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Haberler Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
}