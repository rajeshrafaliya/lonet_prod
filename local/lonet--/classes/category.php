<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

class category {
	public static function get_name($shortname, $national = false, $use_default = false) {
		global $CFG;
		global $DB;
		$name = '';
		if (!$national) {
			if ($language = $DB->get_record('lonet_language', ['code' => $shortname])) {
                $site_language = $use_default ? 'en' : explode('_', current_language())[0];
				$name = (!empty($language->{'name_' . $site_language}) ? $language->{'name_' . $site_language} : $language->name);
			}
		} else {
			if ($shortname == 'pt') return 'Português';
			if ($shortname == 'sr') return 'Српски';
			if ($shortname == 'zh') return '中文';
			
			$langconfig = $CFG->dataroot . '/lang/' . $shortname . '/langconfig.php';
			if (!is_readable($langconfig)) {
				$langconfig = $CFG->dirroot . '/install/lang/' . $shortname . '/langconfig.php';
			}
			if (is_readable($langconfig)) {
				include($langconfig);
				if (is_array($string)) {
					$name = (isset($string['thislanguage']) ? $string['thislanguage'] : $name);
				}
			}
		}
		return $name;
	}
	//Added by Nitesh
 	public static function get_name_grouplesson($shortname, $national = false, $use_default = false) {
		global $CFG;
		global $DB;
		$name = '';
		if (!$national) {
			if ($language = $DB->get_record('lonet_language_group', ['code' => $shortname])) {
                $site_language = $use_default ? 'en' : explode('_', current_language())[0];
				$name = (!empty($language->{'name_' . $site_language}) ? $language->{'name_' . $site_language} : $language->name);
			}
		} else {
			if ($shortname == 'pt') return 'Português';
			if ($shortname == 'sr') return 'Српски';
			if ($shortname == 'zh') return '中文';
			
			$langconfig = $CFG->dataroot . '/lang/' . $shortname . '/langconfig.php';
			if (!is_readable($langconfig)) {
				$langconfig = $CFG->dirroot . '/install/lang/' . $shortname . '/langconfig.php';
			}
			if (is_readable($langconfig)) {
				include($langconfig);
				if (is_array($string)) {
					$name = (isset($string['thislanguage']) ? $string['thislanguage'] : $name);
				}
			}
		}
		return $name;
	}       
    public static function get_list() {
		global $DB;
        $result = [];
        //$languages = $DB->get_records('lonet_language', ['isactive' => 1]);
        $languages = $DB->get_records_sql("
            SELECT DISTINCT l.*
            FROM {lonet_language} l
            LEFT JOIN {user_info_data} uid ON uid.data LIKE CONCAT('%', l.code, '%')
            LEFT JOIN {user_info_field} uif ON uif.id = uid.fieldid
            LEFT JOIN {user} u ON u.id = uid.userid
            LEFT JOIN {role_assignments} ra ON ra.userid = u.id
            WHERE ra.roleid IN (2, 3, 4)
                AND u.deleted = 0
                AND uif.shortname = 'languagesteaching'
            ORDER BY l.name
        ");
        foreach ($languages as $language) {
            $result[$language->code] = $language->name;
        }
        return json_encode($result);
    }
    
    public static function get_data_list() {
		global $DB;
        $result = '';
        //$languages = $DB->get_records('lonet_language', ['isactive' => 1]);
        $languages = $DB->get_records_sql("
            SELECT DISTINCT l.*
            FROM {lonet_language} l
            LEFT JOIN {user_info_data} uid ON uid.data LIKE CONCAT('%', l.code, '%')
            LEFT JOIN {user_info_field} uif ON uif.id = uid.fieldid
            LEFT JOIN {user} u ON u.id = uid.userid
            LEFT JOIN {role_assignments} ra ON ra.userid = u.id
            WHERE ra.roleid IN (2, 3, 4)
                AND u.deleted = 0
                AND uif.shortname = 'languagesteaching'
            ORDER BY l.name
        ");
        foreach ($languages as $language) {
            foreach (['en', 'es', 'lv', 'ru'] as $lang) {
                $attr = 'name_' . $lang;
                if ($language->$attr) {
                    $result .= ($result ? ', ' : '') . $language->$attr;
                }
            }
        }
        return $result;
    }
}
