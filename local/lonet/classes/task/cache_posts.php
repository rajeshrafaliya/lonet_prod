<?php
namespace local_lonet\task;

defined('MOODLE_INTERNAL') || die();

class cache_posts extends \core\task\scheduled_task {
    public function get_name() {
        return get_string('cacheposts', 'local_lonet');
    }

    public function execute() {
/*        global $CFG;
        $all_posts = [];
        $content = '';
        $post_tags = [
            'en' => '18,38',
            'lv' => '30,42',
            'ru' => '20,36,40',
        ];
        foreach ($post_tags as $lang => $tags) {
            $c = curl_init();
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_URL, "https://lonet.academy/blog/wp-json/wp/v2/posts?tags=$tags");
            $result = curl_exec($c);
            curl_close($c);
            $posts = json_decode($result, true);
            $posts = array_slice($posts, 0, 3);
            foreach ($posts as $i => $post) {
                $image_url = '';
                if ($post['featured_media']) {
                    $c = curl_init();
                    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($c, CURLOPT_URL, "https://lonet.academy/blog/wp-json/wp/v2/media/{$post['featured_media']}");
                    $result = curl_exec($c);
                    curl_close($c);
                    $media = json_decode($result);
                    $image_url = $media->source_url;
                }
                $all_posts[$lang][] = [
                    'title' => $post['title']['rendered'],
                    'content' => trim($post['excerpt']['rendered'], ''),
                    'url' => $post['link'],
                    'image_url' => $image_url,
                ];
            }
        }
        file_put_contents($CFG->dirroot . '/local/lonet/posts.json', json_encode($all_posts, JSON_UNESCAPED_SLASHES));
*/
        global $CFG;
        $host="localhost";
        $user_name="c0blog";
        $passwd="rgXwoYW7!Am";
        $cms_database="c0blog";
            
        //error_reporting(0);
        $cn=mysqli_connect($host,$user_name,$passwd);
        mysqli_select_db($cn,$cms_database) or die("Database not found");
            
        mysqli_query('SET NAMES \'utf8\'');
        mysqli_query ("set character_set_results='utf8'");
        mysqli_query("SET character_set_results=utf8");
        mysqli_query("SET names=utf8");
        mysqli_query("SET character_set_client=utf8");
        mysqli_query("SET character_set_connection=utf8");
        mysqli_query("SET collation_connection=utf8_general_ci");

        $res = mysqli_query($cn, "SELECT DISTINCT post_title AS title, LEFT(post_content, 400) AS content, GROUP_CONCAT(wt.name SEPARATOR ', ') AS tags, wyi.open_graph_image AS image_url, wyi.permalink AS url
    FROM wp_posts wp
    INNER JOIN wp_term_relationships wpr ON wp.ID = wpr.object_id
    INNER JOIN wp_term_taxonomy wtt ON wpr.term_taxonomy_id = wtt.term_taxonomy_id
    INNER JOIN wp_terms wt ON wt.term_id = wtt.term_id AND wtt.taxonomy = 'post_tag'
    INNER JOIN wp_yoast_indexable wyi ON wp.ID = wyi.object_id
    WHERE wp.post_type = 'post' AND wp.post_status = 'publish'
    GROUP BY wp.post_title, wp.post_content
    ORDER BY wt.`name`, wp.ID DESC");

        $response = array();
        $new_array = array();

        while ($row1 = mysqli_fetch_array($res)) {
            $stu = array();
            $stu["title"] = $row1['title'];
            $stu["content"] = $row1['content'];
            $stu["tags"] = $row1['tags'];
            $stu["image_url"] = $row1['image_url'];
            $stu["url"] = $row1['url'];

            if (isset($new_array[$row1['tags']]) && count($new_array[$row1['tags']]) >= 3) {
                continue;
            } else {
                $new_array[$row1['tags']][] = $stu;
            }
        }
        file_put_contents($CFG->dirroot . '/local/lonet/posts.json', json_encode($new_array, JSON_UNESCAPED_SLASHES));
    }
}