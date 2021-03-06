<?php
// sef url
function sef($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true,
    );

    // Merge options
    $options = array_merge($defaults, $options);

    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );

    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }

    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

//tarih fonksiyonu
function get_date($date){
    return strftime('%e %B %Y', strtotime($date));
}

// is_login
function is_login(){
    $t = &get_instance();
    $user = $t->session->userdata("user");
    if($user){
        return $user;
    }else{
        $t = &get_instance();
        $user = get_cookie("loginUserData");
        $t->session->set_userdata("user", unserialize($user));
        if($user){
            setUserRoles();
            return $t->session->userdata("user");
        } else{
            return false;
        }
    }
}

function setUserRoles(){
    $t = &get_instance();
    $t->load->model("user_role_model");
    $user_roles = $t->user_role_model->get_all(array('isActive' => 1));
    $roles = array();
    foreach ($user_roles as $role){
        $roles[$role->id] = $role->permission;
    }
    $t->session->set_userdata("user_roles", $roles);
}

function getUserRoles(){
    $t = &get_instance();
    return $t->session->userdata("user_roles");
}

// send email
function sendEmail($toEmail, $subject, $message){
    $t = &get_instance();
    $t->load->model('email_model');

    $email_setting = $t->email_model->get(array('isActive' => 1));
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

function get_settings(){
    $t = &get_instance();
    if($t->session->userdata("settings")){
        $settings = $t->session->userdata("settings");
    } else{
        $t->load->model('setting_model');
        $settings = $t->setting_model->get();
        if(!$settings){
            $settings = new stdClass();
            $settings->company_name = 'CMS Default';
            $settings->logo = 'default.png';
        }
        $t->session->set_userdata('settings', $settings);
    }
    return $settings;
}

function get_category_title($category_id){
    $t = &get_instance();
    $t->load->model('portfolio_category_model');
    $category = $t->portfolio_category_model->get(array('id' => $category_id));
    if($category){
        $title = $category->title;
    } else{
        $title = "Tanımlı Değil";
    }
    return $title;
}

function upload_media($file, $path, $width, $height, $name){
    $t = &get_instance();
    $t->load->library('simpleimagelib');
    if(!is_dir($path."/".$width."x".$height)){
        mkdir($path."/".$width."x".$height);
    }
    $upload_error = FALSE;
    try {
        $simpleImage = $t->simpleimagelib->SimpleImageInit();

        $simpleImage
            ->fromFile($file)
            ->thumbnail($width, $height,'center')
            ->toFile($path."/".$width."x".$height."/$name", NULL, 75);

    } catch(Exception $err) {
        $upload_error = TRUE;
    }
    if($upload_error){
        return FALSE;
    }else{
        return TRUE;
    }
}

function get_media($path="", $img_name="", $resolution="50x50"){
    if($img_name != ''){
        if(file_exists(FCPATH."uploads/$path/$resolution/$img_name")){
            $img_path = base_url("uploads/$path/$resolution/$img_name");
        } else{
            $img_path = base_url("assets/assets/images/default_image.png");
        }
    } else{
        $img_path = base_url("assets/assets/images/default_image.png");
    }

    return $img_path;
}

function getPageList($page=NULL){
    $page_list = array(
        "home_v"            => "Anasayfa",
        "about_v"           => "Hakkımızda Sayfası",
        "news_list_v"       => "Haberler Sayfası",
        "product_list_v"    => "Ürünler Sayfası",
        "portfolio_list_v"  => "Portfolyo Sayfası",
        "reference_list_v"  => "Referanslar Sayfası",
        "service_list_v"    => "Hizmetler Sayfası",
        "course_list_v"     => "Eğitimler Sayfası",
        "brand_list_v"      => "Markalar Sayfası",
        "contact_v"         => "İletişim Sayfası",
        "gallery_list_v"    => "Galeri Sayfası",
    );

    return is_null($page) ? $page_list : $page_list[$page];
}

function getControllerList(){
    $t = &get_instance();
    $t->load->helper("file");
    $controllers = array();

    $files = get_dir_file_info(APPPATH."controllers", FALSE);

    foreach (array_keys($files) as $file){
        if($file != "Dashboard.php"){
            $controllers[] = strtolower(str_replace(".php", "", $file));
        }
    }

    return $controllers;
}