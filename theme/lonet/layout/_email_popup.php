<?php
use local_lonet\category;

if (get_config('local_lonet', 'showpopup')) {
?>

    <style>
        #image-popup {
            padding-top: 10vh;
        }
        #image-popup .modal-content {
            width: 100%;
            max-width: 700px;
            margin: auto;
            animation-name: zoom;
            animation-duration: 0.6s;
            text-align: center;
            color: #002b46;
        }
        #image-popup .modal-title {
            font-size: 18px;
            background-color: #499306;
            color: #fff;
            padding: 10px;
            margin: 0;
            border-radius: 6px 6px 0 0;
            text-align: center;
        }
        #image-popup .modal-body {
            padding: 20px 35px;
            background-color: #f0f1f2;
            border-radius: 0 0 6px 6px;
        }
        @keyframes zoom {
            from {transform:scale(0)} 
            to {transform:scale(1)}
        }
        #image-popup button {
            text-transform: uppercase;
            padding: 12px;
            font-size: 1.1em;
            border: none;
            -webkit-font-smoothing: antialiased;
        }
        #image-popup input {
            padding: 10px 15px;
            font-size: 1.2em;
            width: 300px;
            -webkit-font-smoothing: antialiased;
        }
        #image-popup h2, #image-popup h3{
            color: #002b46;
            text-transform: uppercase;
            font-weight: normal;
        }
        #image-popup h3 {
            color: #fff;
        }
    </style>

    <script>
        $(document).ready(function() {
            if ($('#show-special-offer').length > 0) {
                if (<?= (isset($_COOKIE['special_offer_shown']) ? $_COOKIE['special_offer_shown'] : 0) ?> != 1) {
                    var _ouibounce = ouibounce(document.getElementById('image-popup'), {
                        aggressive: true,
                        timer: 0,
                        callback: function() { $('#image-popup').modal('show'); }
                    });
                    $('#form-subscribe').submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'post',
                            data: $(this).serialize(),
                            success: function() {
                                $('#image-popup').modal('hide');
                                swal({
                                    icon: 'success',
                                    timer: 2000,
                                });
                            }
                        });
                    });
                }
            }
        });
    </script>

    <div id="image-popup" class="modal fade" role="dialog">
        <!--<button id="button-close" type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="fa fa-remove"></span></button>-->
        <div class="modal-content">
            <div class="modal-title">
                <h3><?= get_string('popuptitle', 'local_lonet') ?></h3>
            </div>
            <div class="modal-body">
                <h2><?= get_string('popupsubtitle', 'local_lonet') ?></h2>
                <form method="post" id="form-subscribe" class="subscribeform" action="<?php echo $CFG->httpswwwroot; ?>/local/lonet/subscribe.php">
                    <div class="inputarea">
                        <label><strong><?= get_string('popupemailtitle', 'local_lonet') ?></strong></label>
                        <input type="email" name="Subscriber[email]" class="form-control" style="margin: 0 auto !important;" required>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success"><strong><?= get_string('popupbutton', 'local_lonet') ?></strong></button>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>
