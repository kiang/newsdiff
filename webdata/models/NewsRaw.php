<?php

class NewRawRow extends Pix_Table_Row {

    public function getInfo() {
        $news = News::find($this->news_id);
        $url = $news->url;

        return NewsRaw::getInfo($this->raw, $url);
    }

}

class NewsRaw extends Pix_Table {

    public function init() {
        $this->_name = 'news_raw';
        $this->_primary = array('news_id', 'time');
        $this->_rowClass = 'NewRawRow';

        $this->_columns['news_id'] = array('type' => 'int');
        $this->_columns['time'] = array('type' => 'int');
        $this->_columns['header'] = array('type' => 'text');
        $this->_columns['raw'] = array('type' => 'longtext');
    }

    public static function insertNew($data) {
        $table = NewsRaw::getTable();
        $db = NewsRaw::getDb();
        $db->query(sprintf("INSERT INTO %s (`news_id`, `time`, `header`, `raw`) VALUES (%d, %d, %s, %s)", 'news_raw', $data['news_id'], $data['time'], $db->quoteWithColumn($table, $data['header'], 'header'), $db->quoteWithColumn($table, $data['raw'], 'raw')
        ));
    }

    public static function getInfo($raw, $url) {
        $host = parse_url($url, PHP_URL_HOST);

        if (strlen($raw) < 10) {
            $ret = new StdClass;
            $ret->title = $ret->body = $raw;
            return $ret;
        }

        switch ($host) {
            case 'www.chinatimes.com':
                $ret = Crawler_Chinatimes::parse($raw, $url);
                break;

            case 'www.appledaily.com.tw':
                $ret = Crawler_Appledaily::parse($raw, $url);
                break;

            case 'www.nownews.com':
                $ret = Crawler_Nownews::parse($raw, $url);
                break;

            case 'www.ettoday.net':
                $ret = Crawler_Ettoday::parse($raw, $url);
                break;

            case 'newtalk.tw':
                $ret = Crawler_Newtalk::parse($raw, $url);
                break;

            case 'iservice.libertytimes.com.tw':
            case 'news.ltn.com.tw':
                $ret = Crawler_Libertytimes::parse($raw, $url);
                break;

            case 'www.libertytimes.com.tw':
                $ret = Crawler_Libertytimes::parse2($raw, $url);
                break;

            case 'www.cna.com.tw':
                $ret = Crawler_CNA::parse($raw, $url);
                break;

            case 'udn.com':
                $ret = Crawler_UDN::parse($raw, $url);
                break;

            case 'news.tvbs.com.tw':
                $ret = Crawler_TVBS::parse($raw, $url);
                break;

            case 'www.bcc.com.tw':
                $ret = Crawler_BCC::parse($raw, $url);
                break;

            case 'news.pts.org.tw':
                $ret = Crawler_PTS::parse($raw, $url);
                break;

            case 'www.ttv.com.tw':
                $ret = Crawler_TTV::parse($raw, $url);
                break;

            case 'news.cts.com.tw':
                $ret = Crawler_CTS::parse($raw, $url);
                break;

            case 'news.ftv.com.tw':
                $ret = Crawler_FTV::parse($raw, $url);
                break;
            case 'www.setn.com':
            case 'www.setnews.net':
                $ret = Crawler_SETNews::parse($raw, $url);
                break;
            case 'www.storm.mg':
            case 'www.stormmediagroup.com':
                $ret = Crawler_StormMediaGroup::parse($raw, $url);
                break;
            
            case 'www.thenewslens.com':
                $ret = Crawler_TheNewsLens::parse($raw, $url);
                break;

            default:
                throw new Exception('unknown host: ' . $url);
        }

        if (!is_object($ret)) {
            $ret = new StdClass;
            $ret->title = $ret->body = '--';
            error_log('parser error:' . $url);
        } else {
            if (empty($ret->title)) {
                $ret->title = '--';
                error_log('找不到標題:' . $url);
            }

            if (empty($ret->body)) {
                $ret->body = '--';
                error_log('找不到內容:' . $url);
            }
        }

        return $ret;
    }

}
