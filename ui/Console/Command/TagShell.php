<?php

class TagShell extends AppShell {

    public $uses = array('Tag');

    public function main() {
        $this->mapTags();
    }

    public function mapTags() {
        $maxNewsId = $this->Tag->News->field('id', array(), array('News.id' => 'DESC'));
        $tags = $this->Tag->find('all', array(
            'conditions' => array(
                'Tag.last_news_id <' => $maxNewsId,
            )
        ));
        foreach ($tags AS $tag) {
            $items = $this->Tag->News->NewsInfo->find('all', array(
                'conditions' => array(
                    'NewsInfo.news_id >' => $tag['Tag']['last_news_id'],
                    'OR' => array(
                        'NewsInfo.title LIKE' => "%{$tag['Tag']['name']}%",
                        'NewsInfo.body LIKE' => "%{$tag['Tag']['name']}%",
                    ),
                ),
            ));
            foreach ($items AS $item) {
                $this->Tag->NewsTag->create();
                $this->Tag->NewsTag->save(array('NewsTag' => array(
                        'news_id' => $item['NewsInfo']['news_id'],
                        'tag_id' => $tag['Tag']['id'],
                        'count' => substr_count($item['NewsInfo']['title'], $tag['Tag']['name']) + substr_count($item['NewsInfo']['body'], $tag['Tag']['name']),
                )));
                $tag['Tag']['count'] += 1;
            }
            $this->Tag->id = $tag['Tag']['id'];
            $this->Tag->save(array('Tag' => array(
                    'last_news_id' => $maxNewsId,
                    'count' => $tag['Tag']['count'],
            )));
        }
    }

}
