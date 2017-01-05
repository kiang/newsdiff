<?php

class Crawler_StormMediaGroup {

    public static function crawl($insert_limit) {
        $urls = array();
        for ($i = 1; $i <= 4; $i++) {
            $urls[] = 'http://www.storm.mg/articles/' . $i;
        }

        $content = '';
        foreach ($urls as $url) {
            try {
                $content .= Crawler::getBody($url);
            } catch (Exception $e) {
                error_log("StormMediaGroup {$url} failed: {$e->getMessage()}");
            }
        }

        preg_match_all('#href="(/article/[0-9]*)"#', $content, $matches);
        $insert = $update = 0;
        foreach ($matches[1] as $link) {
            $url = Crawler::standardURL("http://www.storm.mg{$link}");
            $update ++;
            $insert += News::addNews($url, 16);
            if ($insert_limit <= $insert) {
                break;
            }
        }

        return array($update, $insert);
    }

    public static function parse($body) {
        $ret = new StdClass;
        $doc = new DOMDocument('1.0', 'UTF-8');
        @$doc->loadHTML(str_replace('<meta charset="UTF-8">', '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">', $body));

        $ret->title = trim($doc->getElementById('article_title')->nodeValue);
        $ret->body = trim($doc->getElementsByTagName('article')->item(0)->nodeValue);

        return $ret;
    }

}
