<?php

class UrlController extends MainController 
{
    public function createShortUrl($request = false, $args) 
    {            
        if (empty($request['url'])) {
            // Statement for unit test
            if (!isset($_SERVER['HTTP_HOST'])) {
                $output = ['error'=>'Введите адрес.'];
                return $output;
            }
            echo json_encode(['error'=>'Введите адрес.']);
            exit(); 
        }
        $custom_short_url = false;
        $useExpiredDate = false;
        if (!empty($request['custom_short_url'])) {
            if (!preg_match("|^[a-zA-Z0-9-_]+$|", $request['custom_short_url'])) {

                // Statement for unit test
                if (!isset($_SERVER['HTTP_HOST'])) {
                    $output = ['error'=>'Недопустимые символы в поле короткого адреса. Используйте: цифры, символы, тире и знак подчеркивания.'];
                    return $output;
                }

                echo json_encode(['error'=>'Недопустимые символы в поле короткого адреса. Используйте: цифры, символы, тире и знак подчеркивания.']);
                exit();
            } 
            $custom_short_url = $request['custom_short_url'];
            $model = new Url();
            $url = $model->getByShortUrlSlug($custom_short_url);
            if ($url) {

                // Statement for unit test
                if (!isset($_SERVER['HTTP_HOST'])) {
                    $output = ['error'=>'Выбранное короткое имя уже занято.'];
                    return $output;
                }

                echo json_encode(['error'=>'Выбранное короткое имя уже занято.']);
                exit(); 
            } 
        }
        if (!empty($request['expiredDate']['use'])) {
            $validToYear = $request['expiredDate']['year'];
            $validToMonth = $request['expiredDate']['month'];
            $validToDay = $request['expiredDate']['day'];
            $useExpiredDate = true;
        }
        $model = new Url();
        if ($custom_short_url) {
            $shortUrlSlug = $custom_short_url;
            $model->short_url_slug = $shortUrlSlug;
        } else {
            while (true) {
                $shortUrlSlug = $this->generateRandomSlug();
                $model = new Url();
                $url = $model->getByShortUrlSlug($shortUrlSlug);
                if ($url) {

                    // Statement for unit test
                    if(!isset($_SERVER['HTTP_HOST'])) {
                        $output = ['error'=>'Выбранное короткое имя уже занято.'];
                        return $output;
                    }

                    echo json_encode(['error'=>'Выбранное короткое имя уже занято.']);
                    exit(); 
                } 
                if (!$url) {
                    break;
                }
            }
            $model->short_url_slug = $shortUrlSlug;
        }
        if ($useExpiredDate) {
            $model->date_expired = date("Y-m-d", strtotime($validToYear. '-' . $validToMonth .'-' . $validToDay));
        }
        $model->real_url = $request['url'];
        $data = $model->save();
        $shortUrl = 'http://' . DOMAIN . '/' . $shortUrlSlug;
        $stat_url = 'http://' . DOMAIN . '/'. 'statistic/' . $data['id'];

        // Statement for unit test
        if(!isset($_SERVER['HTTP_HOST'])) {
            $output = ['success'=>true, 'short_url'=>$shortUrl, 'stat_url'=> $stat_url];
            return $output;
        }

        echo json_encode(['success'=>true, 'short_url'=>$shortUrl, 'stat_url'=> $stat_url]); 
        exit();
    }

    private function generateRandomSlug() 
    {
        $slug = '';
        $length = 4;
        for ($i=0; $i < $length; $i++) {
            $symbolType = rand(0,1);
            switch ($symbolType) {
                case 0:
                $slug .= chr(rand(65,90));
                break;
                case 1:
                $slug .= chr(rand(97,122));
                break;
            } 
        }
        return $slug;
    }

    public function getRealUrl($request = false, $args) 
    {    
        $shortUrlSlug = $args['short_url_slug'];
        $model = new Url();
        $url = $model->getByShortUrlSlug($shortUrlSlug);
        if ($url) {
            if ($url['date_expired'] == null || strtotime($url['date_expired'])>=mktime(0, 0, 0, date("m") , date("d"), date("Y"))) {
                $modelStat = new Stat();
                $modelStat->url_id = $url['id'];

                // Statement for unit test
                if (isset($_SERVER['HTTP_HOST'])) {
                    $modelStat->user_agent = explode(' ', $_SERVER['HTTP_USER_AGENT'])[0];
                    $modelStat->ip = ip2long($_SERVER['REMOTE_ADDR']);//'217.118.81.30                
                    $ip_address = '176.13.248.255'; // IP, который будем проверять

                    /*Get user ip address details with geoplugin.net*/
                    $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
                    $addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 

                    /*Get City name by return array*/
                    $city = $addrDetailsArr['geoplugin_city']; 

                    /*Get Country name by return array*/
                    $country = $addrDetailsArr['geoplugin_countryName'];

                    $modelStat->country = $country;
                    $modelStat->city = $city;
                }
                $modelStat->date_visit = date('Y-m-d'); 
                $modelStat->save();

                // Statement for unit test
                if (!isset($_SERVER['HTTP_HOST'])) {
                    $output = $url['real_url'];
                    return $output;
                }

                header("Location: " . $url['real_url']);
                exit();
            } else {
                $modelStat = new Stat();
                $modelStat->deleteWhere('url_id='.$url['id']);
                $model->deleteById($url['id']);
            }
        } 
        $this->viewRenderer->view('404');
    }
}