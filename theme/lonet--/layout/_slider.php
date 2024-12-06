<?php
$type = 'video';
$is_logged_in = (isloggedin() && !isguestuser());
global $SESSION;
global $USER;
if (!empty($PAGE->theme->settings->banner1image)) {
    $banner1image = $PAGE->theme->setting_file_url('banner1image', 'banner1image');
} else {
    $banner1image = $OUTPUT->image_url('banner1image', 'theme');
}
$banner1heading = get_string('site_heading', 'theme_lonet');

$language = substr($SESSION->lang ?? 'en', 0, 2);
$consultation_urls = [
    'en' => 'language-tutor-consultation',
    'lv' => 'ka-izveleties-labako-svesvalodas-skolotaju',
    'ru' => 'konsultacija-skype-repetitor',
];
$consultation_url = $consultation_urls[$language] ?? $consultation_urls['en'];
?>

<style>
    #btn-consultation {
        transition: opacity 1s;
        border-radius: 6px;
        padding: 0;
        padding-right: 24px;
        font-size: 18px;
        border: none;
        font-weight: bold;
        text-transform: uppercase;
    }
    #btn-consultation span {
        display: inline-block;
        background: white;
        color: #499306;
        padding: 12px 24px;
        margin-right: 24px;
        font-size: inherit;
        border-radius: 6px 0 0 6px;
    }
    #btn-consultation:hover {
        opacity: 0.75;
        background: #499306;
        color: white;
    }
    @media screen and (max-width: 500px) {
        #btn-consultation {
            padding: 12px 24px;
            background: linear-gradient(to bottom, white 50%, #499306 50%);
        }
        #btn-consultation span {
            background: none;
            display: block;
            margin: 0;
            padding: 0;
            padding-bottom: 16px;
        }
    }
    
    .container-video {
        position: relative;
        top: -20px;
        padding-bottom: 40%;
        background-image: url(<?= $banner1image ?>);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .container-video video {
        overflow: hidden;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        z-index: 1;
        width: 100%;
        height: 100%;
        object-fit: cover;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .container-video > .container-overlay {
        width: 100%;
        position: absolute;
        text-align: center;
        top: 40%;
        transform: translateY(-40%);
        z-index: 1;
    }
    .container-video > .container-overlay h1 {
        color: #ffffff;
        font-size: 55px;
        font-size: calc(100vw / 30);
        margin: 0 15px 30px;
        line-height: normal;
    }
    .container-video > .container-overlay .btn-lonet {
        border-color: #499306;
        margin-top: 30px;
        font-size: x-large;
        text-transform: uppercase;
        font-weight: bold;
        padding: 10px 20px 10px 20px;
    }
    .container-video > .container-overlay .btn-lonet:hover {
        color: #ffffff;
        background: #002b46;
        border-color: #002b46;
    }
    @media screen and (max-width: 1199px) {
        .container-video {
            top: 40px;
            padding-bottom: 50%;
        }
    }
    @media screen and (max-width: 767px) {
        .container-video {
            top: 55px;
            padding-bottom: 55%;
        }
    }
</style>

<div class="container-video">
<?php if (!$is_mobile) { ?>
    <video loop muted <?= ($is_mobile ? '' : 'autoplay') ?> preload="auto" width="100%" style="background-image: url(<?= $banner1image ?>);">
        <source src="/theme/lonet/pix/lonet.mp4" type="video/mp4">
    </video>
<?php 
 } ?>
    <div class="container-overlay">
        <h1 class="regular hidden-xs"><?= $banner1heading ?></h1>
        <a href="/<?= $consultation_url ?>" id="btn-consultation" class="btn btn-success btn-lg"><span><?= get_string('freeconsultation', 'theme_lonet') ?></span><?= get_string('apply', 'theme_lonet') ?></a>
    <?php if (!$is_logged_in) { ?>
        <div class="row visible-xs">
            <div class="col-xs-12 text-center">
                <a href="<?= $CFG->wwwroot ?>/login/signup.php" class="btn btn-success btn-lonet"><?= get_string('register', 'theme_lonet') ?></a>
            </div>
        </div>
    <?php } ?>
    </div>
</div>
