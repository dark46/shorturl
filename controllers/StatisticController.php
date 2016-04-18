<?php

class StatisticController extends MainController 
{
    public function getStat($request = false, $args) 
    {           
        $modelUrl = new Url();
        $url = $modelUrl->getById($args['short_link_id']);

        if (!$url) {
            $this->viewRenderer->view('404');
        }               
        $model = new Stat();
        $today = date("Y-m-d");
        $hitsCount['today'] = $model->getHitsByDate($args['short_link_id'], $today)[0]['count'];
        $hitsCount['all'] = $model->getHitsAllDates($args['short_link_id'])[0]['count'];
        $hostsCount['today'] = count($model->getHostsByDate($args['short_link_id'], $today));
        $hostsCount['all'] = count($model->getHostsAllDates($args['short_link_id']));

        // Statement for unit test
        if (!isset($_SERVER['HTTP_HOST'])) {
            $output = ['short_link_id' => $args['short_link_id'], 'hitsCount' => $hitsCount, 'hostsCount' => $hostsCount];
            return $output;
        }

        $this->viewRenderer->view('stat', ['short_link_id' => $args['short_link_id'], 'hitsCount' => $hitsCount, 'hostsCount' => $hostsCount]);
    }

    public function getStatData($request = false, $args) 
    {    
        $model = new Stat();
        $statCities = $model->getCitiesStat($request['url_id']);
        if ($statCities) {
            for ($i=0; $i<count($statCities); $i++) {
                $data['cities'][$i][] = $statCities[$i]['city'];
                $data['cities'][$i][] = intval($statCities[$i]['count']);
            }
            $model = new Stat();
            $statBrowsers = $model->getBrowserStat($request['url_id']);
            for ($i=0; $i<count($statBrowsers); $i++) {
                $data['browsers'][$i][] = $statBrowsers[$i]['user_agent'];
                $data['browsers'][$i][] = intval($statBrowsers[$i]['count']);
            }       
            if (!isset($_SERVER['HTTP_HOST'])) {
                $output = ['success'=>true, 'stat_data'=>$data];
                return $output;
            }
            echo json_encode(['success'=>true, 'stat_data'=>$data]); 
            exit();
        }

        // Statement for unit test
        if (!isset($_SERVER['HTTP_HOST'])) {
            $output = ['success'=>false];
            return $output;
        }

        echo json_encode(['success'=>false]); 
        exit();
    }    
}