<?php

class Crawler_Appledaily {

    public static function crawl($insert_limit) {
        $urls = array(
            'http://tw.appledaily.com/',
            'https://tw.appledaily.com/appledaily/todayapple',
            'https://tw.appledaily.com/recommend/realtime',
            'https://tw.entertainment.appledaily.com/realtime',
            'https://tw.news.appledaily.com/international/daily/',
            'https://tw.sports.appledaily.com/daily/',
            'https://tw.lifestyle.appledaily.com/daily',
            'https://tw.finance.appledaily.com/daily/',
            'http://home.appledaily.com.tw/',
            'https://tw.appledaily.com/forum/daily',
        );
        for ($i = 1; $i < 10; $i ++) {
            $urls[] = 'https://tw.appledaily.com/realtimenews/section/new/' . $i;
        }

        $content = '';
        foreach ($urls as $url) {
            try {
                $content .= Crawler::getBody($url);
            } catch (Exception $e) {
                error_log("Crawler_Appledaily {$url} failed: {$e->getMessage()}");
            }
        }


        preg_match_all('#/(appledaily|realtimenews)/article/[^/]*/\d+/[^"]+#', $content, $matches);
        $insert = $update = 0;
        foreach ($matches[0] as $link) {
            $url = Crawler::standardURL('https://tw.appledaily.com/' . $link);
            $update ++;
            $insert += News::addNews($url, 1);
            if ($insert_limit <= $insert) {
                break;
            }
        }

        return array($update, $insert);
    }

    public static function parse($body) {
        if ('<script>alert("該則即時新聞不存在 !");location.href="/";</script>' == trim($body)) {
            $ret = new StdClass;
            $ret->title = $ret->body = 404;
            return $ret;
        }
        if (strpos($body, '<script>alert("查無此新聞 !");location.href="/index"</script>') !== false) {
            $ret = new StdClass;
            $ret->title = $ret->body = 404;
            return $ret;
        }
        if (strpos($body, '很抱歉，您所嘗試連結的頁面出現錯誤或不存在，請稍後再試，謝謝！') !== false) {
            $ret = new StdClass;
            $ret->title = $ret->body = 404;
            return $ret;
        }
        $body = str_replace('<meta charset="utf-8" />', '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">', $body);
        $doc = new DOMDocument('1.0', 'UTF-8');
        @$doc->loadHTML($body);
        $ret = new StdClass;
        $ret->title = trim($doc->getElementById('h1')->nodeValue);
        $ret->body = '';

        if ($doc->getElementById('maincontent') and $article_dom = $doc->getElementById('maincontent')->getElementsByTagName('article')->item(0)) {
            // 廣編特輯
            $body_dom = null;
            foreach ($article_dom->getElementsByTagName('div') as $div_dom) {
                if (strpos($div_dom->getAttribute('class'), 'articulum') !== false) {
                    $ret->body = trim(Crawler::getTextFromDom($div_dom));
                    break;
                }
            }
        }
        return $ret;
    }

}
