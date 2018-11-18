<?php

class Portfolio extends CI_Controller
{
    public $viewFolder = "";
    private $zaman = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "portfolio_v";
        if(!is_login()){
            redirect(base_url("login"));
            die;
        }
        $this->load->model("portfolio_model");
        $this->load->model("portfolio_image_model");
        $this->load->model("portfolio_category_model");
        $this->zaman = date('Y-m-d H:i:s');
    }
    /* anasayfa */
    public function index()
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $items = $this->portfolio_model->get_all(array(), "rank ASC");

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* yeni kayıt form */
    public function new_form()
    {
        $viewData = new stdClass();

        $viewData->categories = $this->portfolio_category_model->get_all(array('isActive' => 1));
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* düzenle form */
    public function edit_form($id)
    {
        $viewData = new stdClass();
        /** Tablodan verilerin getirilmesi */
        $item = $this->portfolio_model->get(
            array(
                'id' => strip_tags(str_replace(' ', '', $id))
            )
        );
        $viewData->categories = $this->portfolio_category_model->get_all(array('isActive' => 1));
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
        $this->form_validation->set_rules('title', 'Başlık', 'required|trim');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('client', 'Müşteri', 'required|trim');
        $this->form_validation->set_rules('finishedAt', 'Bitiş Tarihi', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();

        if($validate){
            $data = array(
                'title'         => $this->input->post('title'),
                'description'   => $this->input->post('description'),
                'url'           => sef($this->input->post('title')),
                'client'        => $this->input->post('client'),
                'finishedAt'    => date('Y-m-d', strtotime($this->input->post('finishedAt'))),
                'category_id'   => $this->input->post('category_id'),
                'place'         => $this->input->post('place'),
                'portfolio_url' => $this->input->post('portfolio_url'),
                'rank'          => 0,
                'isActive'      => 1,
                'createdAt'     => $this->zaman,
            );
            $insert = $this->portfolio_model->add($data);

            if($insert){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Portfolyo Başarıyla Eklendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Portfolyo Eklenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('portfolio'));
            die;
        } else{
            $viewData = new stdClass();

            $viewData->categories = $this->portfolio_category_model->get_all(array('isActive' => 1));
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
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('client', 'Müşteri', 'required|trim');
        $this->form_validation->set_rules('finishedAt', 'Bitiş Tarihi', 'required|trim');
        //mesajlar
        $this->form_validation->set_message(
            array(
                'required' => "Lütfen {field} Alanını Doldurun"
            )
        );
        $validate = $this->form_validation->run();

        if($validate){
            $where = array(
                'id' => strip_tags(str_replace(' ', '', $id))
            );
            $data = array(
                'title'         => $this->input->post('title'),
                'description'   => $this->input->post('description'),
                'url'           => sef($this->input->post('title')),
                'client'        => $this->input->post('client'),
                'finishedAt'    => date('Y-m-d', strtotime($this->input->post('finishedAt'))),
                'category_id'   => $this->input->post('category_id'),
                'place'         => $this->input->post('place'),
                'portfolio_url' => $this->input->post('portfolio_url'),
            );
            $update = $this->portfolio_model->edit($where, $data);

            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Portfolyo Başarıyla Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Portfolyo Güncellenemedi'
                );
            }
            $this->session->set_flashdata('alert', $alert);
            redirect(base_url('portfolio'));
            die;
        } else{
            $viewData = new stdClass();
            /** Tablodan verilerin getirilmesi */
            $item = $this->portfolio_model->get(
                array(
                    'id' => strip_tags(str_replace(' ', '', $id))
                )
            );
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "edit";
            $viewData->form_error = TRUE;
            $viewData->item = $item;
            $viewData->categories = $this->portfolio_category_model->get_all(array('isActive' => 1));
            $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
        }
    }
    /* silme işlemi */
    public function delete($id)
    {
        $where = array(
            'id' => strip_tags(str_replace(' ', '', $id))
        );
        $delete = $this->portfolio_model->delete($where);

        if($delete){
            $alert = array(
                'type' => 'success',
                'title' => 'Başarılı',
                'message' => 'Portfolyo Başarıyla Silindi'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Portfolyo Silinemedi'
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
            $update = $this->portfolio_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Portfolyo Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Portfolyo Durumu Güncellenemedi'
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
            $get_item = $this->portfolio_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->portfolio_model->edit($where, $sort_data);
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
                'message' => 'Portfolyolar Başarıyla Sıralandı'
            );
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Portfolyolar Sıralanamadı'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* resim ekleme form */
    public function image_form($id)
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->portfolio_model->get(array('id' => $id));

        $image_where = array('portfolio_id' => $id);
        $viewData->item_images = $this->portfolio_image_model->get_all($image_where, "rank ASC");
        $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/index', $viewData);
    }
    /* image ekleme işlemi */
    public function image_upload($id)
    {
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $file_name = sef(pathinfo($_FILES['file']['name'], PATHINFO_FILENAME)).'.'.$ext;

        $image_255x157 = upload_media($_FILES['file']['tmp_name'], "uploads/".$this->viewFolder."/", 255, 157,$file_name);
        $image_1080x426 = upload_media($_FILES['file']['tmp_name'], "uploads/".$this->viewFolder."/", 1080, 426,$file_name);

        if($image_255x157 && $image_1080x426){
            $data = array(
                'portfolio_id'  => $id,
                'img_url'     => $file_name,
                'rank'        => 0,
                'isActive'    => 1,
                'isCover'     => 0,
                'createdAt'   => $this->zaman,
            );
            $add = $this->portfolio_image_model->add($data);
            if($add){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Portfolyo Resmi Başarıyla Eklendi.'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Portfolyo Resmi Eklenemedi'
                );
            }
        } else{
            $alert = array(
                'type' => 'error',
                'title' => 'Hata!',
                'message' => 'Portfolyo Resmi Yüklenemedi'
            );
        }
        echo json_encode($alert);
        die;
    }
    /* image list dom load */
    public function refresh_image_list($id)
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item = $this->portfolio_model->get(array('id' => $id));

        $image_where = array('portfolio_id' => $id);
        $viewData->item_images = $this->portfolio_image_model->get_all($image_where, "rank ASC");
        $render_html = $this->load->view($viewData->viewFolder.'/'.$viewData->subViewFolder.'/image_list_v', $viewData, true);
        echo $render_html;
        die;
    }
    /* kapak fotoğrafı değiştirme */
    public function change_portfolio_cover($id,$port_id)
    {
        if($id && $port_id){
            $set_cover = $this->input->post('set_cover');
            $where = array('id' => $id, 'portfolio_id' => $port_id);
            $data = array('isCover' => $set_cover);
            $update = $this->portfolio_image_model->edit($where, $data);
            if($update){
                $where = array('id !=' => $id, 'portfolio_id' => $port_id);
                $data = array('isCover' => 0);
                $this->portfolio_image_model->edit($where, $data);
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Kapak Resmi Güncellendi',
                    'port_id' => $port_id
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Kapak Resmi Güncellenemedi',
                    'port_id' => $port_id
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
            $update = $this->portfolio_image_model->edit($where, $data);
            if($update){
                $alert = array(
                    'type' => 'success',
                    'title' => 'Başarılı',
                    'message' => 'Portfolyo Resmi Durumu Güncellendi'
                );
            } else{
                $alert = array(
                    'type' => 'error',
                    'title' => 'Hata!',
                    'message' => 'Portfolyo Resmi Durumu Güncellenemedi'
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
            $get_item = $this->portfolio_image_model->get($where);
            if($sort_data['rank'] != $get_item->rank){
                $update = $this->portfolio_image_model->edit($where, $sort_data);
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
        $img_info = $this->portfolio_image_model->get($where);
        $delete = $this->portfolio_image_model->delete($where);

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