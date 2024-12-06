<?php
use local_lonet\user;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/user/profile/lib.php');
require_once($CFG->dirroot . '/local/lonet/lib.php');

class theme_lonet_core_user_myprofile_renderer extends \core_user\output\myprofile\renderer {
    public function render_tree(core_user\output\myprofile\tree $tree) {
        global $CFG;
        global $DB;
        global $USER;

        $id = (isset($_GET['id']) ? $_GET['id'] : $USER->id);
        $user = $DB->get_record('user', array('id' => $id));
        $is_teacher = user::is_teacher($user);
        $is_self = ($USER->id === $user->id);
        $teacher_profile_setting = (isset($_GET['teacher_profile']) ? $_GET['teacher_profile'] : false);
        $teacher_profile = ($teacher_profile_setting || ($is_teacher && !$is_self));

        profile_load_data($user);
        
        return renderFile($CFG->dirroot . '/theme/lonet/views/profile.php', [
            'id' => $id,
            'user' => $user,
            'is_teacher' => $is_teacher,
            'is_self' => $is_self,
            'can_edit' => ($is_self || is_siteadmin()),
            'is_bookkeeper' => user::is_bookkeeper(),
            'teacher_profile_setting' => $teacher_profile_setting,
            'teacher_profile' => $teacher_profile,
            'show_teacher' => ($is_teacher && $teacher_profile),
        ]);
    }
}