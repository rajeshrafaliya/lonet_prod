<?php
global $CFG;

$language = explode('_', current_language())[0] ?? 'en';
if($language == 'es')
    $language = 'en';
$posts = json_decode(file_get_contents($CFG->dirroot . '/local/lonet/posts.json'))->$language ?? [];

if ($posts) {
?>

    <div id="blog-posts" class="row-fluid">
        <div class="container-fluid">
            <div id="site-news-forum">
                <h2><?= get_string('latestposts', 'theme_lonet') ?></h2>
                <div class="heading__line">
                    <div><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                </div>
                <a id="p1"></a>
                <div class="clearfix forumpost-con">
                    <div class="shadow-forumpost-con row-fluid">
                    <?php foreach ($posts as $i => $post) { ?>
                        <div class="forum-section span4 forum-section-0">
                            <div class="forumpost clearfix firstpost starter" role="region">
                                <div class="row header clearfix">
                                    <div class="topic firstpost starter">
                                        <div class="subject" role="heading" aria-level="2"><?= $post->title ?></div>
                                    </div>
                                </div>
                                <div class="row maincontent clearfix">
                                    <div class="left">
                                        <div class="grouppictures">&nbsp;</div>
                                    </div>
                                    <div class="no-overflow">
                                        <div class="content">
                                            <div class="posting shortenedpost">
                                                <?= ($post->image_url ? '<img src="' . $post->image_url . '" alt="' . $post->title . '" />' : '') ?>
                                                <?= $post->content ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row side">
                                    <div class="left">&nbsp;</div>
                                    <div class="options clearfix">
                                        <div class="link">
                                            <a href="<?= $post->url ?>" target="_blank" rel="noopener noreferrer"><?= get_string('readmore', 'theme_lonet') ?>...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>