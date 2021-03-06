<?php

class Crawler_PTS {

    public static function crawl($insert_limit) {
        $content = Crawler::getBody('http://news.pts.org.tw/');
        preg_match_all('#/article/[0-9]+#', $content, $matches);
        $links = array_unique($matches[0]);
        $insert = $update = 0;
        foreach ($links as $link) {
            $update ++;
            $link = 'http://news.pts.org.tw' . $link;
            $insert += News::addNews($link, 11);
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
        foreach ($doc->getElementsByTagName('meta') as $meta_dom) {
            if ('og:title' == $meta_dom->getAttribute('property')) {
                $ret->title = preg_replace('#-公視新聞網$#', '', $meta_dom->getAttribute('content'));
            }
        }

        $ret->body = '';
        foreach ($doc->getElementsByTagName('p') as $p_dom) {
            if ($p_dom->getAttribute('class') == 'Page') {
                $ret->body .= Crawler::getTextFromDom($p_dom);
            }
        }
        if ($ret->title and $ret->body) {
            return $ret;
        }

        foreach ($doc->getElementsByTagName('h1') as $h1_dom) {
            if ($h1_dom->getAttribute('class') == 'article-title') {
                $ret->title = $h1_dom->nodeValue;
                foreach ($doc->getElementsByTagName('div') as $div_dom) {
                    if ($div_dom->getAttribute('class') == 'article-content') {
                        $ret->body .= Crawler::getTextFromDom($div_dom);
                        return $ret;
                    }
                }
            }
        }

        return null;
    }

}
