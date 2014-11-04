<?php

class Git {

    public function search($repo_name) {
        $res = $this->getListByCurl('search/repositories?q=' . $repo_name);
        $dec_res = json_decode($res);
        $term = explode("/", $repo_name);
        $_search_name = $term[count($term) - 1];
        if ($res != false) {
            for ($i = 0; $i < count($dec_res->items); $i++) {
                if ($dec_res->items[$i]->name == $_search_name) {
                    $owner = $dec_res->items[$i]->owner->login;
                    $link = 'repos/' . $owner . '/' . $_search_name . '/commits';
                    $commit = $this->getListByCurl($link);
                    $decoded_commit = json_decode($commit);
                    
                    if ($decoded_commit != false) {
                        for ($k = 0; $k < count($decoded_commit); $k++) {
                            $arr[$k]['sha'] = $decoded_commit[$k]->sha;
                            $arr[$k]['author'] = $decoded_commit[$k]->commit->author->name;
                            $arr[$k]['committer'] = $decoded_commit[$k]->commit->committer->name;
                            $arr[$k]['date'] = $decoded_commit[$k]->commit->committer->date;
                            $arr[$k]['message'] = $decoded_commit[$k]->commit->message;
                        }
                    }
                    return($arr);
                    break;
                }
            }
        }
    }

    public function getListByCurl($str, $data = FALSE, $update = FALSE) {


        $params_str = array();
        $url = 'https://api.github.com/' . $str;
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($handle, CURLOPT_USERAGENT, 'Mozilla/34.0');
        $response = curl_exec($handle);
        return $response;
    }

}

?>