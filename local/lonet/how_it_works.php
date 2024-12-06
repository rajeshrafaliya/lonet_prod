<?php
require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('meta_title_page_howitworks', 'theme_lonet'));
$PAGE->set_url('/local/lonet/how_it_works.php');

echo $OUTPUT->header();

?>
<style>
.imagetext {
  position: relative;
}
.nav-pills>li{
    width: 25%;
}
.nav-pills>.active>a, .nav-pills>.active>a:hover, .nav-pills>.active>a:focus{
  background-color: #002b46;
}
.text-block {
  width: 45%;
  position: absolute;
  font-size: 12px !important;
  text-align: center;
  font-weight: bolder;
  top: 10px;
  left: 0px;
  background-color: #8ebf4d;
  padding-left: 5px;
  padding-right: 5px;
  text-transform: uppercase;
}
@media screen and (max-width:768px) {
.nav-pills>li{
    width: 50%;
}
.nav-pills>.active>a, .nav-pills>.active>a:hover, .nav-pills>.active>a:focus{
  background-color: #002b46;
}
.text-block {
  width: 45%;
  position: absolute;
  text-align: center;
  font-weight: bolder;
  font-size: 8px !important;
  top: 10px;
  left: 0px;
  background-color: #8ebf4d;
  padding-left: 0px;
  padding-right: 0px;
  text-transform: uppercase;
}
}
</style>
    
<div class="container">
  <h2><?= get_string('h1_howitworks_page', 'local_lonet') ?></h2>

  <ul class="nav nav-pills nav-justified">
    <li class="active"><a data-toggle="tab" href="#menu1">
<div class="imagetext">        
  <img src="/theme/lonet/pix/howitworks/howitworks_1.png" class="img-rounded" width="100%" alt="howitworks_1">
<div class="text-block">
    <h5 style="color: white;"><?= get_string('howitworks_image1_title', 'local_lonet') ?></h5>
  </div>
</div>

</a></li>
    <li><a data-toggle="tab" href="#menu2">

<div class="imagetext">        
  <img src="/theme/lonet/pix/howitworks/howitworks_2.png" class="img-rounded" width="100%" alt="howitworks_2">
<div class="text-block">
    <h5 style="color: white;"><?= get_string('howitworks_image2_title', 'local_lonet') ?></h5>
  </div>
</div>

</a></li>
    <li><a data-toggle="tab" href="#menu3">

<div class="imagetext">        
  <img src="/theme/lonet/pix/howitworks/howitworks_3.png" class="img-rounded" width="100%" alt="howitworks_3">
<div class="text-block">
    <h5 style="color: white;"><?= get_string('howitworks_image3_title', 'local_lonet') ?></h5>
  </div>
</div>

</a></li>
    <li><a data-toggle="tab" href="#menu4">

<div class="imagetext">        
  <img src="/theme/lonet/pix/howitworks/howitworks_4.png" class="img-rounded" width="100%" alt="howitworks_4">
<div class="text-block">
    <h5 style="color: white;"><?= get_string('howitworks_image4_title', 'local_lonet') ?></h5>
  </div>
</div>

</a></li>
  </ul>

  <div class="tab-content">
    <div id="menu1" class="tab-pane fade in active">
	      <h3><?= get_string('howitworks_image1_title', 'local_lonet') ?></h3>
        <?= get_string('howitworks_image1_content', 'local_lonet') ?>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3><?= get_string('howitworks_image2_title', 'local_lonet') ?></h3>
      <?= get_string('howitworks_image2_content', 'local_lonet') ?>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3><?= get_string('howitworks_image3_title', 'local_lonet') ?></h3>
      <?= get_string('howitworks_image3_content', 'local_lonet') ?>
    </div>
    <div id="menu4" class="tab-pane fade">
      <h3><?= get_string('howitworks_image4_title', 'local_lonet') ?></h3>
      <?= get_string('howitworks_image4_content', 'local_lonet') ?>
    </div>
  </div>
</div>
<?= $OUTPUT->footer() ?>
