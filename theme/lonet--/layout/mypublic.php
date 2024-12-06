<?php
require_once(dirname(__FILE__).'/_header.php');
?>

<body <?php echo $OUTPUT->body_attributes(); ?>>
    <?php echo $OUTPUT->standard_top_of_body_html() ?> 
    <div id="page">
        <?php require_once(dirname(__FILE__).'/_menu.php'); ?>

        <div id="page-content" class="row-fluid bg-padded-top">
            <div class="container-fluid">
                <?php echo $OUTPUT->main_content(); ?>
            </div>
        </div>

        <?php require_once(dirname(__FILE__).'/_footer.php'); ?>
