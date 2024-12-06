<?php

use local_lonet\category;
use local_lonet\language;
use local_lonet\teacher;
use local_lonet\user;
// use local_lonet\wallet;

global $CFG;
global $OUTPUT;
global $USER;

require_once($CFG->dirroot . '/user/profile/lib.php');
require_once($CFG->dirroot . '/local/lonet/lib.php');

$useragent = (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
$is_mobile = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));

if (!$user) {
    echo '<div class="alert alert-danger">User #' . $id . ' not found. </div>';
} else {
$nameParts = explode(" ", $user->lastname);
$lastNameInitial = $nameParts[0][0] . ".";
$userfullname = $user->firstname.' '.$lastNameInitial;
?>
    <script>
        $(document).ready(function() {
            $('.btn-view-schedule').click(function(e) {
                e.stopPropagation();
                $.ajax({
                    type: 'GET',
                    url: '/local/lonet/ajax_schedule_container.php?teacherid=' + $(this).attr('data-teacherid'),
                    dataType: 'text',
                    success: function(result) {
                        if (result) {
                            $('#schedule-modal .modal-content').html(result);
                            $('#schedule-modal').modal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        swal('Server Error Occured', xhr.responseText, 'error');
                    }
                });
            });
            $('.btn-view-reviews').click(function(e) {
                e.stopPropagation();
                $.ajax({
                    type: 'GET',
                    url: '/local/lonet/ajax_reviews.php?teacherid=' + $(this).attr('data-teacherid'),
                    dataType: 'text',
                    success: function(result){
                        if (result) {
                            $('#reviews-modal .modal-body').html(result);
                            $('#reviews-modal').modal();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        swal('Server Error Occured', xhr.responseText, 'error');
                    }
                });
            });
            $('.btn-delete-account').click(function(e) {
                swal({
                    title: '<?= get_string('areyousuredelete', 'local_lonet') ?>',
                    text: '',
                    icon: 'warning',
                    buttons: {
                        cancel: {
                            text: '<?= get_string('no') ?>',
                            value: false,
                            visible: true,
                            className: 'btn-danger',
                            closeModal: true,
                        },
                        confirm: {
                            text: '<?= get_string('yes') ?>',
                            value: true,
                            visible: true,
                            className: 'btn-success',
                            closeModal: true
                        }
                    },
                    dangerMode: true,
                }).then((isSure) => {
                    if (isSure) {
                        $.ajax({
                            type: 'POST',
                            url: '/local/lonet/delete.php',
                            dataType: 'json',
                            success: function(result) {
                                if (result.status == true) {
                                    swal(result.message, '', 'info');
                                } else if ($result.message) {
                                    swal(result.message, '', 'error');
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                swal('Server Error Occured', xhr.responseText, 'error');
                            }
                        });
                    }
                });
            });
            <?= (isset($_GET['book']) ? "$('.btn-view-schedule').click();" : '') ?>
            $('.btn-add-to-wallet').click(function(e) {
                $('#wallet-modal').modal('show');
            });
            $(document).on('click', '.expandgroup', function(e) {
				$('.grouplessoncontainer').slideToggle();
			});  
            $(document).on('click', '.expandindi', function(e) {
				$('.indilessoncontainer').slideToggle();
			});	
        })
    </script>

    <?php if ($show_teacher) {?>
        <h1><?= get_string('h1_teacher', 'local_lonet', $userfullname) ?></h1>
        <div class="row">
            <div class="col-sm-12" style="margin-top: 5px;">
                <?php $shown = [];
                foreach (teacher::get_languages($id) as $full_code => $language) {
                    $code = explode('_', $full_code)[0];
                    if (!in_array($code, $shown)) {
                        $btn_text = get_string('viewalllanguageteachers', 'local_lonet', category::get_name($code));
                        echo '<a href="' . language::get_full_url_by_code($full_code) . '" class="btn btn-success" style="margin: 0 10px 5px -' . ($shown ? '' : '1') . '5px;"><span class="fa fa-angle-left"></span> ' . $btn_text . '</a>';
                        $shown[] = $code;
                    }
                } ?>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-8">
            <?php if ($show_teacher && $videourl = user::get_video_embed_url($user)) { ?>
                <div class="row user-row">
                    <div class="col-sm-12">
                        <div class="media-16x9" style="margin-top:5px;">
                            <iframe src="<?= $videourl ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($is_mobile && $is_teacher && $show_teacher && !$is_self) { ?>
                <div class="row visible-xs btn-book-top">
                    <div class="col-xs-12" style="padding-top:15px;">
                        <p><button type="button" class="btn btn-block btn-success btn-view-schedule login-required" data-teacherid="<?= $user->id ?>"><?= get_string('booklesson', 'local_lonet') ?></button></p>
                    </div>
                </div>
            <?php } ?>
            <?php if ($is_self) { ?>
                <div class="row user-row">
                    <div class="col-sm-12">
                        <h4><?= get_string('Refer_a_friend_get', 'theme_lonet') ?><h4>
                                <p><?= get_string('share_it_with_friends', 'theme_lonet') ?>
                                <a href="/local/lonet/invite.php" class="btn btn-info"><?= get_string('Invite_now', 'theme_lonet') ?> &rarr;</a></p>
                    </div>
                </div>
<!--                <div class="row user-row">
                    <div class="col-sm-12">
                        <a href="/language-gift-cards" target="_blank">
                        <h2><?= get_string('h1_page_giftcard', 'theme_lonet') ?></h2>
                        <img src="/local/lonet/pix/Gift_card_christmas_profile1.png" alt="Gift Card" width="100%"></a>
                    </div>
                </div>-->
            <?php } ?>
            <div class="row user-row">
                <div class="col-sm-3 no-padding-r">
                    <div class="user-picture-container">
                        <?= $OUTPUT->user_picture($user, ['size' => '100']) ?>
                        <h1 style="font-size: 1.4em; color: #1a1a1a; line-height: normal;"><?= ($show_teacher ? $userfullname : $user->firstname) ?> <div class="indicator <?= (user::is_online($user) ? 'online' : '') ?>"></div>
                        </h1>
                        <!--<p class="user-timezone"><?= (new \DateTime('now', core_date::get_user_timezone_object($user)))->format('H:i \U\T\CP') ?></p>-->
                        <?php if ($user->country) { ?>
                            <p class="user-location">
                                <!--<span class="glyphicon glyphicon-map-marker"></span>--><span class="fa fa-map-marker"></span> <?= get_string($user->country, 'core_countries') ?>
                            </p>                            
                        <?php } ?>
                        <?php if ($show_teacher) { ?>
                        <p style="line-height: 1.15;"><small><?= get_string('lessoncount_label', 'local_lonet') ?></small><br><?= teacher::get_lesson_count($user) ?></p>
                        <p style="line-height: 1.15;"><small><?= get_string('studentcount_label', 'local_lonet') ?></small><br><?= teacher::get_student_count($user) ?></p>
                        <?php } else { ?>
                        <p style="line-height: 1.15;"><small><?= get_string('lessoncount_label', 'local_lonet') ?></small><br><?= user::get_lesson_count($user) ?></p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-9">
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($show_teacher) { ?>
                                <p class="user-languages"><b><?= get_string('teaches', 'local_lonet') ?></b>: <?= user::get_languages_from_data($user->profile_field_languagesteaching) ?></p>
                            <?php } else { ?>
                                <p class="user-languages"><b><?= get_string('learns', 'local_lonet') ?></b>: <?= user::get_languages_from_data($user->profile_field_languageslearning) ?></p>
                            <?php } ?>
                            <p class="user-languages"><b><?= get_string('speaks', 'local_lonet') ?></b>: <?= user::get_languages_from_data($user->profile_field_languagesspeaking) ?></p>
                            <p class="user-languages"><b><?= get_string('nativelanguage', 'local_lonet') ?></b>: <?= user::get_languages_from_data($user->profile_field_languagesnative) ?></p>
                            <p class="user-languages"><b><?= get_string('membersince', 'local_lonet') ?>:</b> <?= date('F j, Y', $user->timecreated); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="user-languages"><span class="fa fa-graduation-cap"></span> <?= ($user->profile_field_education ? $user->profile_field_education : get_string('noeducationlisted', 'local_lonet')) ?></p>
                            <p class="user-languages"><span class="fa fa-briefcase"></span> <?= ($user->profile_field_occupation ? $user->profile_field_occupation : get_string('nooccupationlisted', 'local_lonet')) ?></p>
                            <?php $progress = ($show_teacher ? teacher::get_acceptance_rate($user->id) : user::get_profile_completion($user));
                            $label = ($show_teacher ? get_string('Acceptance_Rate', 'theme_lonet') : get_string('Profile_Completion', 'theme_lonet')); ?>
                            <div style="font-size:0.9em"><?= $label ?></div>
                            <div class="progress-bar">
                                <div class="completed" style="width:<?= $progress ?>%;"><?= $progress ?>%</div>
                            </div>
                            <?php if (!$show_teacher) { ?>
                                <p><a class="btn btn-success" href="/user/<?= $user->id ?>/edit" target="_blank" rel="noopener noreferrer"><?= get_string('completeprofile', 'theme_lonet') ?></a></p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php if ($show_teacher) { ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-xs-12 user-detail" data-slideto="#ratings">
                                    <div style="font-size: 1.2em;"><b><?= floatval(number_format(teacher::get_rating($user), 1)) ?></b></div>
                                    <?= teacher::render_rating($user) ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-xs-12 user-detail" data-slideto="#ratings">
                                    <?php $review_count = teacher::get_rating_count($user); ?>
                                    <div style="font-size: 1.2em;"><b><?= $review_count ?></b></div>
                                    <p><?= get_string(($review_count ? 'reviews' : 'notreviewed'), 'local_lonet') ?></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-xs-12 user-detail">
                                    <img alt="price" title="price" src="/theme/lonet/pix/icons/shopping-bags.png">
                                    <p style="margin-bottom: 0;"><?= get_string('from', 'local_lonet') //get_string('price', 'local_lonet').' '. ?> <b>&euro;<?= teacher::get_trial_price($user) ?></b></p>
                                    <!--<div style="font-size: 1.2em;"></div>
                                    <p><button type="button" class="btn btn-block btn-success btn-view-schedule login-required" data-teacherid="<?= $user->id ?>"><?= get_string('bookagain', 'local_lonet') ?></button></p>-->
                                </div>
                            </div>
                        </div>
                    <?php }
                    $tags = core_tag_tag::get_item_tags('core', 'user', $user->id); 
                    if ($tags) { ?>
                        <div class="row">
                            <div class="col-md-12">
                            <h5><?= get_string('interestsandhobbies', 'local_lonet') ?> <img alt="price" title="price" src="/theme/lonet/pix/icons/puzzle-piece.png"></h5>
                            <?= $OUTPUT->tag_list($tags, '') ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row user-row">
                <div class="col-xs-12 user-description-full">
                   <?php if (isset($user->profile_field_teacherdescription['text']) && $user->profile_field_teacherdescription['text']) { ?>
                        <img src="/theme/lonet/pix/icons/raised-hand.png">
                        <?= ($user->profile_field_teacherdescription['text'] ?? '') ?>
                    <?php } ?>
                </div>
            </div>
            <?php if (!$show_teacher) { ?>
                <div class="row user-row">
                    <div class="col-xs-12 text-center user-description-full">
                        <?= get_string('userprofile_featuretext', 'local_lonet',$user->firstname) ?>
                    </div>
            <?php 
            if($user->profile_field_languageslearning != '')
                $languages = "'" . implode ( "', '", $user->profile_field_languageslearning) . "'";
            elseif($user->profile_field_wantlearnlang != '')
                $languages = "'" . language::get_code_by_name($user->profile_field_wantlearnlang) . "'";
            //    $languages = "'" . implode ( "', '", $user->profile_field_languageslearning) . "'";
            foreach (teacher::get_relatedteachers($user->id,$languages) as $key => $val) { 
                if($val['teacherid'] != $user->id)
                {
                $teacher = user::get_by_id($val['teacherid']);
                ?>
                    <div class="col-sm-4 text-center">
                        <div class="user-picture-container">
                            <?= $OUTPUT->user_picture($teacher, ['size' => '100']) ?>
                            <h1 class="card-title" style="font-size: 1.4em; color: #1a1a1a; line-height: normal;"><?= fullname($teacher, true) ?> <div class="indicator <?= (user::is_online($teacher) ? 'online' : '') ?>"></div>
                                </h1>
                            <p><button type="button" class="btn btn-block btn-success btn-view-schedule login-required" data-teacherid="<?= $teacher->id ?>"><?= get_string($val['buttonname'], 'local_lonet') ?></button></p>
                        </div>
                    </div>
                  <?php }
              } ?>  
                </div>
            <?php 
            }
            
            if (!$show_teacher) { ?>
                <div class="row user-row" style="display:none;">
                    <div class="profile-banner"><h1><?= get_string('challenge_title', 'local_lonet') ?></h1></div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-3 text-center"><?= $OUTPUT->user_picture($user, ['size' => '100']) ?></div>
                                <div class="col-sm-9">
                                    <?php
                                        $percentage = 0; 
                                        $outof = user::get_lesson_count($user,true);
                                        $total = (user::get_userdata($user->id,'learningchallenge') * 52);
                                        if($outof > 0 && $total > 0)
                                            $percentage = number_format($outof/$total * 100, 2);
                                    ?>
                                    <div><h5><?= get_string('challenge_value', 'local_lonet', ['outof' => $outof, 'total' => $total]) ?></h5></div>
                                    <div class="progress-bar" style="height: 25px !important">
                                        <div class="completed" style="font-size:15px !important;line-height:25px !important;width:<?php echo $percentage; ?>%;">
                                            <?php echo $percentage; ?>%</div>
                                    </div>
                                    <div><?= get_string('challenge_message', 'local_lonet') ?></div>
                                    <div class="social top center">
                                        <a class="fbtn fbtn-twitter" href="https://twitter.com/intent/tweet?text=<?= get_string('challenge_title', 'local_lonet') ?>&amp;url=<?= $CFG->wwwroot?>/user/<?= $user->id ?>&amp;via=creativedevs"><i class="fa fa-twitter"></i></a>
                                        <!-- LinkedIn Share Button -->
                                        <a class="fbtn fbtn-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?= $CFG->wwwroot?>/user/<?= $user->id ?>&amp;title=<?= get_string('challenge_title', 'local_lonet') ?>&amp;source=<?= $CFG->wwwroot?>/user/<?= $user->id ?>/"><i class="fa fa-linkedin"></i></a>
                                     </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12"><h4><?= get_string('challenge_textlink2', 'local_lonet') ?></h4></div>
                            </div>
                        </div>
                </div>
            <?php
            }
            if ($can_edit) { ?>
                <?= renderFile($CFG->dirroot . '/local/lonet/_lessons.php', ['user' => $user, 'fullhistory' => false, 'role' => ($show_teacher ? 'teacher' : 'learner')]) ?>
            <?php 
        		}

            if (!$show_teacher && isset($user->profile_field_aboutme['text']) && $user->profile_field_aboutme['text']) { ?>
                <div class="row user-row">
                    <div class="col-xs-12 user-description-full">
                        <h4><?= get_string('aboutme', 'local_lonet') ?></h4>
                        <?= $user->profile_field_aboutme['text'] ?>
                    </div>
                </div>
            <?php } 

            if ($show_teacher && $reviews = teacher::get_reviews($user->id)) { ?>
                <div class="row user-row" id="ratings">
                    <div class="col-sm-12">
                        <h3><?= get_string('reviews', 'local_lonet') ?></h3>
                    </div>
                    <?= renderFile($CFG->dirroot . '/local/lonet/_reviews.php', ['reviews' => $reviews]) ?>
                </div>
            <?php } ?>
        </div>
        <div class="col-sm-4"><!--col-options-->
            <div class="col-xs-12 user-row" style="padding-top:15px;">
                <?php if ($is_teacher) { ?>
                    <?php if ($show_teacher) { ?>
                        <?php if ($is_self) { ?>
                            <p><a class="btn btn-block btn-success" href="/user/<?= $user->id ?>"><?= get_string('viewuserprofile', 'local_lonet') ?></a></p>
                        <?php } else { ?>
                            <p><button type="button" class="btn btn-block btn-success btn-view-schedule login-required" data-teacherid="<?= $user->id ?>"><?= get_string('booklesson', 'local_lonet') ?></button></p>
                            <p><button type="button" class="btn btn-block btn-success btn-view-schedule login-required" data-teacherid="<?= $user->id ?>"><?= get_string('booklesson_extra', 'local_lonet') ?></button></p>
                            <p><button type="button" class="btn btn-block btn-success btn-view-reviews login-required" data-teacherid="<?= $user->id ?>"><?= get_string('viewreviews', 'local_lonet') ?></button></p>
                            <br/>
                            <?= get_string('teacherprofile_featuretext', 'local_lonet', fullname($user, true)) ?>
                        <?php } ?>
                    <?php } else { ?>
                        <p><a class="btn btn-block btn-success" href="/teacher/<?= $user->id ?>"><?= get_string('viewteacherprofile', 'local_lonet') ?></a></p>
                    <?php } ?>
                    <br>
                <?php } ?>

                <?php if ($can_edit || $is_bookkeeper) { ?>
                    <?php /*
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="ico ico-wallet"></span>&nbsp;&nbsp;<b>&euro;</b> <?= number_format(user::get_balance($user->id), 2) ?>
                            <br>(<?= get_string('available', 'local_lonet') ?> <b>&euro;</b> <?= number_format(user::get_available_balance($user->id), 2) ?>)
                        </div>
                        <div class="col-xs-6"><button class="btn btn-success btn-block btn-add-to-wallet" style="margin-top: 10px;"><?= get_string('addtowallet', 'local_lonet') ?></button></div>
                    </div>
                    <br>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-xs-12"><a href="/local/lonet/wallet.php?id=<?= $user->id ?>" class="btn btn-success btn-block"><?= get_string('transactionhistory', 'local_lonet') ?></a></div>
                    </div>
                    */ ?>
                    <div class="row">
                        <div class="col-xs-6"><a href="/local/lonet/wallet.php?id=<?= $user->id ?>" class="btn btn-success btn-block" style="margin-top: 10px;"><?= get_string('transactionhistory', 'local_lonet') ?></a></div>
                        <div class="col-xs-6 text-right">
                            <span class="ico ico-wallet"></span>&nbsp;&nbsp;<b>&euro;</b> <?= number_format(user::get_balance($user->id), 2) ?>
                            <br><?= get_string('available', 'local_lonet') ?> <b>&euro;</b> <?= number_format(user::get_available_balance($user->id), 2) ?>&nbsp;
                        </div>
                    </div>
                    <?php if ($show_teacher) {
                        if (teacher::can_request_payout($user)) { ?>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-xs-6"><a href="/local/lonet/payout.php?id=<?= $user->id ?>" class="btn btn-warning btn-block"><?= get_string('requestpayout', 'local_lonet') ?></a></div>
                                <div class="col-xs-6"><span class="pull-right"><b>&euro;</b> <?= number_format(user::get_available_balance($user->id), 2) ?></span></div>
                            </div>
                        <?php } elseif ($pending_amount = teacher::get_pending_payout_request_amount($user->id)) { ?>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-xs-12">Pending Payout Request<span class="pull-right"><b>&euro;</b> <?= $pending_amount ?></span></div>
                            </div>
                    <?php }
                    } ?>
                    <br>
                    <p><a class="btn btn-block btn-success" href="/local/lonet/history.php?id=<?= $user->id ?>"><?= get_string('lessonhistory', 'local_lonet') ?></a></p>
                    <br>
                    <?php if ($is_self) { ?>
                        <p><a class="btn btn-block btn-danger" href="/user/<?= $user->id ?>/edit"><?= get_string('editprofile', 'local_lonet') ?></a></p>
                        <p><a class="btn btn-block btn-danger" href="/login/change_password.php"><?= get_string('changepassword', 'local_lonet') ?></a></p>
                    <?php } else { ?>
                        <p><a class="btn btn-block btn-danger" href="/user/editadvanced.php?&id=<?= $user->id ?>" target="_blank" rel="noopener noreferrer"><?= get_string('editprofile', 'local_lonet') ?></a></p>
                    <?php } ?>
                <?php } ?>
                <?php if ($is_teacher) { ?>
                    <?php if ($can_edit) { ?>
                        <br>
                        <p><a class="btn btn-block btn-danger" href="/local/lonet/edit.php?teacherid=<?= $user->id ?>"><?= get_string('editschedule', 'local_lonet') ?></a></p>
                        <p><a class="btn btn-block btn-danger" href="/local/lonet/lessons.php?teacherid=<?= $user->id ?>"><?= get_string('editlessons', 'local_lonet') ?></a></p>
                    <?php } ?>
                <?php } ?>
                <?php if ($is_self) {
                    $can_delete = user::can_delete_account($id); ?>
                    <br>
                    <br>
                    <p><button class="btn btn-block btn-danger btn-delete-account" <?= ($can_delete ? '' : 'disabled') ?> data-toggle="tooltip" title="<?= ($can_delete ? '' : get_string('youcannotdeleteaccount', 'local_lonet')) ?>"><?= get_string('deletemyaccount', 'local_lonet') ?></button></p>
                <?php } elseif (is_siteadmin()) { ?>
                    <br>
                    <p><a class="btn btn-block btn-info" href="/course/loginas.php?user=<?= $user->id ?>&sesskey=<?= $USER->sesskey ?>">Log in As</a></p>
                    <p><a class="btn btn-block btn-info" href="/report/log/user.php?id=<?= $user->id ?>&course=1&mode=all">User Logs</a></p>
                    <!--<p><a class="btn btn-block btn-info" href="/user/preferences.php?userid=<?= $user->id ?>">Preferences</a></p>-->
                <?php } ?>
            </div>
            <div class="col-xs-12 user-row">
                <?php 
                $language = explode('_', current_language())[0];
                    if (!$show_teacher) { 
                    	if ($language == 'lv') {
							$cover_url = "/local/lonet/pix/gramata_LV.png";
                    		$ebook_pdf = "/blog/wp-content/uploads/2021/11/eBook-LV-single-page.pdf";
                    	}else{
							$cover_url = "/local/lonet/pix/gramata_ENG.png";
                    		$ebook_pdf = "/blog/wp-content/uploads/2021/11/How-To-Learn-A-Language-In-A-Record-Time.pdf";
                    	} ?>
                        <p><a class="btn btn-block btn-success" href="<?php echo $ebook_pdf; ?>" target="_blank" rel="noopener noreferrer"><?= get_string('downloadebook', 'theme_lonet') ?></a></p>
                        <p><a class="btn btn-block btn-success" href="<?php echo $ebook_pdf; ?>" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo $cover_url; ?>" alt="cover page" width="100%">
                        </a></p>
                <?php } ?>

                <?php if ($show_teacher) { ?>
                <?= teacher::set_teacherdata_in_html($user->profile_field_levelyouteach,'levelyouteach','style="font-weight:600"','<img src="/theme/lonet/pix/icons/bar-chart.png">') ?>
                <?= teacher::set_teacherdata_in_html($user->profile_field_studentageyouteach,'studentageyouteach','style="font-weight:600"','<img src="/theme/lonet/pix/icons/teacher.png">') ?>
                <?= teacher::set_teacherdata_in_html($user->profile_field_typeoflessons,'typeoflessons','style="font-weight:600"','<img src="/theme/lonet/pix/icons/information.png">') ?>
                    <p><img src="/theme/lonet/pix/icons/books.png"> <?= get_string('coursebooks', 'local_lonet') . $user->profile_field_coursebooks ?></p>
                    <?= teacher::set_teacherdata_in_html($user->profile_field_teachingmaterials,'teachingmaterials','style="font-weight:600"','<img src="/theme/lonet/pix/icons/file-folder.png">') ?>
                    <p><img src="/theme/lonet/pix/icons/clipboard.png"> <?= get_string('teachingcertificates', 'local_lonet') . $user->profile_field_teachingcertificates ?></p>
                    <?= teacher::set_teacherdata_in_html($user->profile_field_onlinetools,'onlinetools','style="font-weight:600"','<img src="/theme/lonet/pix/icons/globe-with-meridians.png">') ?>
                    <p><img src="/theme/lonet/pix/icons/green-book.png"> <?= get_string('lessonplan', 'local_lonet') . $user->profile_field_lessonplan['text'] ?></p>
                    <!--<p><?= get_string('linkedinpage', 'local_lonet') ?><a target="_blank" href="<?= $user->profile_field_linkedinpage ?>"><?= $user->profile_field_linkedinpage ?></a></p>-->
                <?php } ?>
            </div>
        </div>
    </div>

    <div id="schedule-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>
<div id="reviews-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?= get_string('close', 'core_form') ?></button>
            </div>
        </div>
    </div>
</div>
    <?php /*
    <div id="wallet-modal" class="modal" tabindex="-1" role="dialog" data-keyboard="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title pull-left"><?= get_string('addtowallet', 'local_lonet') ?></h5>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><b>&euro;</b></span>
                            <input type="number" class="form-control" name="Wallet[amount]">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><?= get_string('cancel') ?></button>
                        <button type="submit" class="btn btn-success"><?= get_string('continue') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    */ ?>
<?php } ?>