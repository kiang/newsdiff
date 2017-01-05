<?php

class Crawler_TVBS {

    public static function crawl($insert_limit) {
        $types = array('news', 'politics', 'local', 'life', 'sports',
            'entertainment', 'china', 'world', 'tech', 'travel', 'fun');
        $urls = array();
        foreach ($types as $type) {
            $urls[] = 'http://news.tvbs.com.tw/news/realtime/' . $type;
        }

        $content = '';
        foreach ($urls as $url) {
            $content .= Crawler::getBody($url);
        }
        preg_match_all('#href=[\'"]/(' . implode('|', $types) . ')/([0-9]*)[\'"]#i', $content, $matches);
        $links = array();
        $links = array_unique($matches[0]);
        $insert = $update = 0;
        foreach ($links as $link) {
            $update ++;
            $link = 'http://news.tvbs.com.tw' . substr($link, 6, -1);
            $insert += News::addNews($link, 9);
            if ($insert_limit <= $insert) {
                break;
            }
        }
        return array($update, $insert);
    }

    public static function parse($body) {
        $doc = new DOMDocument('1.0', 'UTF-8');
        @$doc->loadHTML($body);
        $ret = new StdClass;

        foreach ($doc->getElementsByTagName('div') as $div_dom) {
            switch ($div_dom->getAttribute('class')) {
                case 'newsdetail-h2':
                    $ret->title = trim(Crawler::getTextFromDom($div_dom));
                    break;
                case 'newsdetail-content':
                    $ret->body = trim(Crawler::getTextFromDom($div_dom));
                    break;
            }
        }
        return $ret;
    }

}
