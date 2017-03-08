<?php

class CleanShell extends AppShell {

    public $uses = array('News');

    public function main() {
        $this->cleanNews();
    }

    public function cleanNews() {
        $days7 = strtotime('-10 days');
        $this->News->query('TRUNCATE TABLE news_raw');
        $this->News->query('DELETE FROM news WHERE created_at < ' . $days7);
        $this->News->query('DELETE FROM news_info WHERE time < ' . $days7);
    }

}
