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
    /* kapak fotoğrafı değiştirme */
    public function change_product_cover($id,$prd_id)
    {
        if($id && $prd_id){
            $set_cover = $this->input->post('set_cover');
            $where = array('id' => $id, 'product_id' => $prd_id);
            $data = array('isCover' => $set_cover);
            $update = $this->product_image_model->edit($where, $data);
            if($update){
                $where = array('id !=' => $id, 'product_id' => $prd_id);
                $data = array('isCover' => 0);
                $this->product_image_model->edit($where, $data);
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Kapak Resmi Güncellendi',
                    'prd_id' => $prd_id
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Kapak Resmi Güncellenemedi',
                    'prd_id' => $prd_id
                );
            }
            echo json_encode($alert);
            die;
        }
    }

    /* durum değiştirme işlemi */
    public function change_image_status($id)
    {
        if($id){
            $status = $this->input->post('status');
            $where = array('id' => $id);
            $data = array('isActive' => $status);
            $update = $this->product_image_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Resim Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Resim Durumu Güncellenemedi'
                );
            }
            echo json_encode($alert);
            die;
        }
    }

    /* fotoğraf sıralama işlemi*/
    public function image_sort()
    {
        $data = $this->input->post('data');
        parse_str($data, $order);
        $items = $order['sort'];
        $eklenen = 0;
        $eklenmeyen = 0;
        foreach($items as $key => $value){
            $where = array('id' => $value);
            $sort_data = array('rank' => $key+1);
            $get_item = $this->product_image_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->product_image_model->edit($where, $sort_data);
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
                'message' => 'Resimler Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Resimler Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }

    /* image silme işlemi */
    public function delete_image($id)
    {
        $where = array(
            'id' => strip_tags(str_replace(' ', '', $id))
        );
        $img_info = $this->product_image_model->get($where);
        $delete = $this->product_image_model->delete($where);

        if($delete){
            if(file_exists("uploads/".$this->viewFolder."/".$img_info->img_url)){
                unlink("uploads/".$this->viewFolder."/".$img_info->img_url);
            }
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Resim Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Resim Silinemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
}