<?php
use local_lonet\category;
use local_lonet\language;
use local_lonet\subscriber;
use local_lonet\teacher;
use local_lonet\user;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('meta_title_page_landingpage', 'theme_lonet'));
$PAGE->set_heading(get_string('h1_landing_page', 'local_lonet'));
$PAGE->set_url('/find-your-language-tutor');

echo $OUTPUT->header();
?>
    <style>
        .row-questions {
            margin-bottom: 15px;
        }
        .row-questions > div {
            padding-top: 15px;
            padding-bottom: 15px;
        }
        @media screen and (min-width: 768px) {
            .row-questions > div:nth-child(2) {
                border-style: solid;
                border-color: #002b46;
                border-width: 0 2px;
            }
        }
        .text-uppercase {
            text-transform: uppercase;
        }
    </style>
    
    <h1 class="text-center"><?= get_string('h1_landing_page', 'local_lonet') ?></h1>

    <div class="row">
        <div class="col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" style="margin-top: 5px;">
            <div class="media-16x9">
                <iframe src="<?= get_string('landing_page_videolink', 'local_lonet') ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" autoplay="1" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="row text-center row-questions" style="margin-top: 15px;">
        <div class="col-sm-4"><strong>
            <?= get_string('landingq1', 'local_lonet') ?></strong>
        </div>
        <div class="col-sm-4"><strong>
            <?= get_string('landingq2', 'local_lonet') ?></strong>
        </div>
        <div class="col-sm-4"><strong>
            <?= get_string('landingq3', 'local_lonet') ?></strong>
        </div>
    </div>
    <p class="text-center">
        <a href="<?= get_string('booklesson_url', 'local_lonet') ?>" target="_blank" class="btn btn-primary btn-large text-uppercase"><?= get_string('booklesson', 'local_lonet') ?></a>
    </p>
    <div class="row text-center row-questions" style="margin-top: 15px;">
        <div class="col-sm-4">
            <?= get_string('consultq1', 'local_lonet') ?>
        </div>
        <div class="col-sm-4">
            <?= get_string('consultq2', 'local_lonet') ?>
        </div>
        <div class="col-sm-4">
            <?= get_string('consultq3', 'local_lonet') ?>
        </div>
    </div>
    <p class="text-center">
        <?= get_string('consultanswer', 'local_lonet') ?>
    </p>
    <p class="text-center">
        <a href="<?= get_string('applyfreeconsulation_url', 'local_lonet') ?>" target="_blank" class="btn btn-primary btn-large text-uppercase"><?= get_string('applyforconsultation', 'theme_lonet') ?></a>
    </p>
<?= $OUTPUT->footer() ?>
