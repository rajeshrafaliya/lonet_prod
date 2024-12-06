<?php
use local_lonet\order_product;

require_once('../../config.php');
require_once($CFG->dirroot.'/local/lonet/lib.php');

global $DB;
global $USER;

require_login();

$lessonid = (isset($_GET['lessonid']) ? $_GET['lessonid'] : null);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['OrderProduct'])) {
	$attributes = $_POST['OrderProduct'];
	$DB->update_record('lonet_order_product', $attributes);
}

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title('Rate Teacher');
$PAGE->set_heading('Rate Teacher');
$PAGE->set_url('/local/lonet/rate.php?lessonid=' . $lessonid);

echo $OUTPUT->header();

$lesson = order_product::get_by_id($lessonid);
if (order_product::can_rate($lesson)) {
    $teacher = $DB->get_record('user', ['id' => $lesson->teacherid]);
    ?>
    <script>
        $(document).ready(function() {
            $('#rating-form').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/local/lonet/rate.php',
                    dataType: 'text',
                    data: $(this).serialize(),
                    success: function(result){
                        if (result) {
                            $('#rating-modal').modal('toggle');
                            swal('Thank You', '', 'success');
                        } else {
                            swal('Error Occured', 'Rating not saved!', 'error');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        swal('Server Error Occured', xhr.responseText, 'error');
                    }
                });
            });
        });
    </script>
    
    <p>
        <img src="/theme/lonet/pix/logo-icon.png" alt="LONET.academy" width="35px">&nbsp;<strong><?= get_string('youropinion', 'local_lonet') ?></strong>
    </p>
    <form id="rating-form" action="/local/lonet/rate.php">
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-12">
                    <label class="control-label" for="comment"><?= get_string('rating', 'local_lonet', ['name' => order_product::get_name($lesson, true), 'teacher' => fullname($teacher, true)]) ?></label>
                    <input type="hidden" id="id" name="OrderProduct[id]" value="<?= $lesson->id ?>">
                    <div class="rating">
                        <input type="radio" id="star5" name="OrderProduct[rating]" value="5" required><label for="star5"><span class="fa fa-star"></span></label>
                        <input type="radio" id="star4" name="OrderProduct[rating]" value="4" required><label for="star4"><span class="fa fa-star"></span></label>
                        <input type="radio" id="star3" name="OrderProduct[rating]" value="3" required><label for="star3"><span class="fa fa-star"></span></label>
                        <input type="radio" id="star2" name="OrderProduct[rating]" value="2" required><label for="star2"><span class="fa fa-star"></span></label>
                        <input type="radio" id="star1" name="OrderProduct[rating]" value="1" required><label for="star1"><span class="fa fa-star"></span></label>
                    </div>
                </div>
                <div class="col-xs-12">
                    <label class="control-label" for="comment"><span class="text-green"><?= get_string('comments', 'local_lonet') ?>:</span></label>
                    <textarea id="comment" class="form-control" name="OrderProduct[comment]" rows=5 style="width: 90%;"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success"><?= get_string('submit', 'core_moodle') ?></button>
    </form>
<?php } else { ?>
    <div class="alert alert-danger">
        <?= get_string('lessonnotfound', 'local_lonet') ?>
    </div>
<?php } ?>
<?= $OUTPUT->footer() ?>
