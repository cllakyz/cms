<?php

class Gallery extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "gallery_v";
        $this->load->model("gallery_model");
        $this->load->model("image_model");
        $this->load->model("video_model");
        $this->load->model("file_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->gallery_model->get_all(array(), "rank ASC");

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
        $item = $this->gallery_model->get(
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
        $this->form_validation->set_rules('gallery_name', 'Galeri Adı', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();
        $gallery_type = $this->input->post('gallery_type');
        if($validate){
            $gallery_name = $this->input->post('gallery_name');
            $path = "uploads/".$this->viewFolder."/";
            $folder_name = "-";
            if($gallery_type == 1){
                /* image ise*/
                $folder_name = sef($gallery_name);
                $path .= "images/".$folder_name;
            } elseif($gallery_type == 3){
                /* dosya ise */
                $folder_name = sef($gallery_name);
                $path .= "files/".$folder_name;
            }

            if($gallery_type != 2){
                if(!is_dir($path)){
                    $create_folder = mkdir($path,0775);
                    if(!$create_folder){
                        $alert = array(
                            'type' => 'error',
                            'title' => 'Hata!',
                            'message' => 'Galeri Klasörü Oluşturulamadı'
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url('gallery'));
                    }
                }
            }

            $data = array(
                'gallery_name' => $gallery_name,
                'gallery_type' => $gallery_type,
                'url'          => sef($gallery_name),
                'folder_name'  => $folder_name,
                'rank'         => 0,
                'isActive'     => 1,
                'createdAt'    => $this->zaman,
            );
            $insert = $this->gallery_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Galeri Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Galeri Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('gallery'));
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = TRUE;
            $viewData->gallery_type = $gallery_type;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* güncelleme işlemi */
    public function edit($id)
    {
        $this->load->library('form_validation');

        //kurallar
        $this->form_validation->set_rules('gallery_name', 'Galeri Adı', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();
        $gallery_type = $this->input->post('gallery_type');
        if($validate){
            $item = $this->gallery_model->get(array('id' => $id));
            $old_folder_name = $item->folder_name;
            $old_gallery_type = $item->gallery_type;

            $gallery_name = $this->input->post('gallery_name');
            $path = "uploads/".$this->viewFolder."/";
            $folder_name = "-";
            if($gallery_type == 1){
                /* image ise*/
                $folder_name = sef($gallery_name);
                $path .= "images/";
            } elseif($gallery_type == 3){
                /* dosya ise */
                $folder_name = sef($gallery_name);
                $path .= "files/";
            }

            if($gallery_type != 2){
                if(is_dir($path.$old_folder_name)){
                    $create_folder = rename($path.$old_folder_name, $path.$folder_name);
                    if(!$create_folder){
                        $alert = array(
                            'type' => 'error',
                            'title' => 'Hata!',
                            'message' => 'Galeri Klasörü Oluşturulamadı'
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url('gallery'));
                    }
                } else{
                    rmdir($path.$old_folder_name);
                    $path .= $folder_name;
                    $create_folder = mkdir($path,0775);
                    if(!$create_folder){
                        $alert = array(
                            'type' => 'error',
                            'title' => 'Hata!',
                            'message' => 'Galeri Klasörü Oluşturulamadı'
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url('gallery'));
                    }
                }
            } else{
                if($old_gallery_type == 1){
                    /* image ise*/
                    $path .= "images/";
                } elseif($old_gallery_type == 3){
                    /* dosya ise */
                    $path .= "files/";
                }
                if(is_dir($path.$old_folder_name)){
                    $remove_folder = rmdir($path.$old_folder_name);
                    if(!$remove_folder){
                        $alert = array(
                            'type' => 'error',
                            'title' => 'Hata!',
                            'message' => 'Galeri Klasörü Kaldırılamadı'
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url('gallery'));
                    }
                }
            }

            $where = array(
                'id' => strip_tags(str_replace(' ', '', $id))
            );
            $data = array(
                'gallery_name' => $gallery_name,
                'gallery_type' => $gallery_type,
                'folder_name'  => $folder_name,
                'url'          => sef($gallery_name),
            );
            $update = $this->gallery_model->edit($where, $data);

            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Galeri Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Galeri Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('gallery'));
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->gallery_model->get(
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
        $item = $this->gallery_model->get($where);
        $delete = $this->gallery_model->delete($where);

        if($delete){
            if($item->gallery_type != 2){
                if($item->gallery_type == 1){
                    $path = "uploads/".$this->viewFolder."/images/".$item->folder_name;
                    rmdir($path);
                } elseif ($item->gallery_type == 3){
                    $path = "uploads/".$this->viewFolder."/files/".$item->folder_name;
                    rmdir($path);
                }
            }
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Galeri Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Galeri Silinemedi'
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
            $update = $this->gallery_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Galeri Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Galeri Durumu Güncellenemedi'
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
            $get_item = $this->gallery_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->gallery_model->edit($where, $sort_data);
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
                'message' => 'Galeriler Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Galeriler Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
    /** İmage ve File İşlemleri */
    /* resim ekleme form */
    public function upload_form($id)
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "file";
        $item = $this->gallery_model->get(array('id' => $id));
        $viewData->item = $item;
        $where = array('gallery_id' => $id);
        if($item->gallery_type == 1){
            $viewData->items = $this->image_model->get_all($where, "rank ASC");
        } elseif($item->gallery_type == 3){
            $viewData->items = $this->file_model->get_all($where, "rank ASC");
        } else{
            $viewData->items = $this->video_model->get_all($where, "rank ASC");
        }
        $viewData->gallery_type = $item->gallery_type;
        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* image ekleme işlemi */
    public function file_upload($gallery_id, $gallery_type, $folder_name)
    {
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $file_name = sef(pathinfo($_FILES['file']['name'], PATHINFO_FILENAME)).'.'.$ext;

        $config = array(
            "allowed_types" => "jpg|jpeg|png|JPG|JPEG|PNG|pdf|doc|docx",
            "upload_path"   => $gallery_type == 1 ? "uploads/".$this->viewFolder."/images/".$folder_name."/" : "uploads/".$this->viewFolder."/files/".$folder_name."/",
            "file_name"     => $file_name,
        );

        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("file");
        if($upload){
            $file = $this->upload->data("file_name");
            $model_name = $gallery_type == 1 ? "image_model" : "file_model";
            $data = array(
                'gallery_id'  => $gallery_id,
                'url'         => $config["upload_path"].$file,
                'rank'        => 0,
                'isActive'    => 1,
                'createdAt'   => $this->zaman,
            );
            $add = $this->$model_name->add($data);
            if($add){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Dosya Başarıyla Eklendi.'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Dosya Eklenemedi'
                );
            }
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Dosya Yüklenemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* image list dom load */
    public function refresh_file_list($gallery_id, $gallery_type)
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "file";

        $where = array('gallery_id' => $gallery_id);
        $model_name = $gallery_type == 1 ? "image_model" : "file_model";
        $viewData->items = $this->$model_name->get_all($where, "rank ASC");
        $viewData->gallery_type = $gallery_type;
        $render_html = $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/file_list_v', $viewData, true);
        echo $render_html;
        die;
    }
    /* durum değiştirme işlemi */
    public function change_file_status($id, $gallery_type)
    {
        if($id && $gallery_type){
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $data = array('isActive' => $status);
            $model_name = $gallery_type == 1 ? "image_model" : "file_model";
            $update = $this->$model_name->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Dosya Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Dosya Durumu Güncellenemedi'
                );
            }
            echo json_encode($alert);
            die;
        }
    }
    /* fotoğraf sıralama işlemi*/
    public function file_sort($gallery_type)
    {
        $data = $this->input->post('data');
        parse_str($data, $order);
        $items = $order['sort'];
        $eklenen = 0;
        $eklenmeyen = 0;
        $model_name = $gallery_type == 1 ? "image_model" : "file_model";
        foreach($items as $key => $value){
            $where = array('id' => $value);
            $sort_data = array('rank' => $key+1);
            $get_item = $this->$model_name->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->$model_name->edit($where, $sort_data);
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
                'message' => 'Dosyalar Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Dosyalar Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* image silme işlemi */
    public function delete_file($id, $gallery_type)
    {
        $where = array(
            'id' => strip_tags(str_replace(' ', '', $id))
        );
        $model_name = $gallery_type == 1 ? "image_model" : "file_model";
        $item_info = $this->$model_name->get($where);
        $delete = $this->$model_name->delete($where);

        if($delete){
            if(file_exists($item_info->url)){
                unlink($item_info->url);
            }
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Dosya Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Dosya Silinemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
    /** Video İşlemleri */
    public function gallery_video_list($gallery_id)
    {
        $viewData = new stdClass();
        $gallery = $this->gallery_model->get(array('id' => $gallery_id));
        /** Tablodan verilerin getirilmesi */
        $items = $this->video_model->get_all(array('gallery_id' => $gallery_id), "rank ASC");

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/list";
        $viewData->items = $items;
        $viewData->gallery = $gallery;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }

    public function new_gallery_video_form()
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "video/add";

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }

    public function gallery_video_save()
    {
        $this->load->library('form_validation');

        //kurallar
        $this->form_validation->set_rules('gallery_name', 'Galeri Adı', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();
        $gallery_type = $this->input->post('gallery_type');
        if($validate){
            $gallery_name = $this->input->post('gallery_name');
            $path = "uploads/".$this->viewFolder."/";
            $folder_name = "-";
            if($gallery_type == 1){
                /* image ise*/
                $folder_name = sef($gallery_name);
                $path .= "images/".$folder_name;
            } elseif($gallery_type == 3){
                /* dosya ise */
                $folder_name = sef($gallery_name);
                $path .= "files/".$folder_name;
            }

            if($gallery_type != 2){
                if(!is_dir($path)){
                    $create_folder = mkdir($path,0775);
                    if(!$create_folder){
                        $alert = array(
                            'type' => 'error',
                            'title' => 'Hata!',
                            'message' => 'Galeri Klasörü Oluşturulamadı'
                        );
                        $this->session->set_flashdata('alert', $alert);
                        redirect(base_url('gallery'));
                    }
                }
            }

            $data = array(
                'gallery_name' => $gallery_name,
                'gallery_type' => $gallery_type,
                'url'          => sef($gallery_name),
                'folder_name'  => $folder_name,
                'rank'         => 0,
                'isActive'     => 1,
                'createdAt'    => $this->zaman,
            );
            $insert = $this->gallery_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Galeri Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Galeri Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('gallery'));
        } else{
            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = TRUE;
            $viewData->gallery_type = $gallery_type;

            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
}