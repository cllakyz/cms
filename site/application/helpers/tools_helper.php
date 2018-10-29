<?php
// prodoct cover
function get_product_cover_image($prd_id){
    $t = &get_instance();
    $t->load->model('product_image_model');
    $cover_image = $t->product_image_model->get(
        array(
            'isCover'    => 1,
            'product_id' => $prd_id,
        )
    );

    if(empty($cover_image)){
        $cover_image = $t->product_image_model->get(
            array(
                'product_id' => $prd_id
            )
        );
    }

    return !empty($cover_image) ? $cover_image->img_url : NULL;
}
//tarih fonksiyonu
function get_date($date){
    return strftime('%e %B %Y', strtotime($date));
}
//portfolio category title
function get_portfolio_category_title($cat_id){
    $t = &get_instance();
    $t->load->model('portfolio_category_model');
    $category = $t->portfolio_category_model->get(array('id' => $cat_id));
    return empty($category) ? false : $category->title;
}
// portfolio cover
function get_portfolio_cover_image($portfolio_id){
    $t = &get_instance();
    $t->load->model('portfolio_image_model');
    $cover_image = $t->portfolio_image_model->get(
        array(
            'isCover'      => 1,
            'portfolio_id' => $portfolio_id,
        )
    );

    if(empty($cover_image)){
        $cover_image = $t->portfolio_image_model->get(
            array(
                'portfolio_id' => $portfolio_id
            )
        );
    }

    return !empty($cover_image) ? $cover_image->img_url : NULL;
}
//get settings
function get_settings(){
    $t = &get_instance();
    $settings = $t->session->userdata('settings');
    if(empty($settings)){
        $t->load->model('setting_model');
        $settings = $t->setting_model->get();
        $t->session->set_userdata("settings", $settings);
    }
    return $settings;
}
// send email
function sendEmail($toEmail, $subject, $message){
    $t = &get_instance();
    $t->load->model('email_model');

    $email_setting = $t->email_model->get(array('isActive' => 1));
    if(empty($toEmail)){
        $toEmail = $email_setting->to;
    }
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
    $t->load->library('email', $config);
    $t->email->from($email_setting->from, $email_setting->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);

    return $t->email->send();
}