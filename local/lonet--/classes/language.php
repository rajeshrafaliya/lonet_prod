<?php
namespace local_lonet;

defined('MOODLE_INTERNAL') || die();

class language {
    public static function get_by_id($id) {
        global $DB;
        return $DB->get_record('lonet_language', ['id' => $id]);
    }
    
    public static function get_by_code($code) {
        global $DB;
        return $DB->get_record('lonet_language', ['code' => $code]);
    }
	
    public static function get_code_by_name($name) {
        global $DB;
        $record = $DB->get_record('lonet_language', ['name' => $name]);
        return $record->code;
    }
        
    public static function get_by_url($url) {
        global $DB;
        if (!$url || strpos($url, '=') !== false) {
            return null;
        }
        $url_lower = strtolower($url);
        return $DB->get_record_sql("
            SELECT l.*
            FROM {lonet_language} l
            WHERE l.isactive = 1
                AND (
                    LOWER(l.url) = '$url_lower'
                    OR LOWER(l.url_en) = '$url_lower'
                    OR LOWER(l.url_es) = '$url_lower'
                    OR LOWER(l.url_lv) = '$url_lower'
                    OR LOWER(l.url_ru) = '$url_lower'
                    OR LOWER(l.code) = '$url_lower'
                )
            LIMIT 1
        ");
    }
    
    public static function get_all() {
        global $DB;
        return $DB->get_records_sql("
            SELECT l.*
            FROM {lonet_language} l
            WHERE l.isactive = 1
                AND (
                    SELECT uid.id
                    FROM {user_info_data} uid
                    WHERE uid.fieldid = 10
                        AND uid.data LIKE CONCAT('%\"', l.code, '\"%')
                    LIMIT 1
                ) IS NOT NULL
            ORDER BY l.sortorder ASC, l.name ASC
        ");
    }
    
    public static function get_all_with_teachers() {
        global $DB;
        return $DB->get_records_sql("
            SELECT DISTINCT l.*
            FROM {lonet_language} l
            LEFT JOIN {lonet_lesson} ll ON SUBSTRING(ll.language FROM 1 FOR 2) = SUBSTRING(l.code FROM 1 FOR 2) OR ll.language = ''
            LEFT JOIN {user} u ON u.id = ll.teacherid
            LEFT JOIN {user_info_data} uid_langs ON uid_langs.userid = u.id AND uid_langs.fieldid = 10
            " . teacher::getTeacherListJoinCondition() . "
            WHERE l.isactive = 1
                AND uid_langs.data LIKE CONCAT('%\"', SUBSTRING(l.code FROM 1 FOR 2), '%')
                AND ll.isactive = 1
                " . teacher::getActiveCondition() . "
            ORDER BY l.sortorder ASC, l.name ASC
        ");
    }
    
    public static function get_url(&$language, $lang = null) {
        global $SESSION;
        $lang = $lang ?: substr($SESSION->lang ?? 'en', 0, 2);
        return strtolower($language->{'url_' . $lang} ?: ($language->code ?: ''));
    }
	
    public static function get_full_url(&$language, $lang = null) {
        global $SESSION;
        $url = '/';
        $lang = $lang ?: substr($SESSION->lang ?? 'en', 0, 2);
        switch ($lang) {
            case 'es':
                $url .= 'profesores-online';
                break;
            case 'lv':
                // $url .= 'valodu-pasniedzeji-online';
                $url .= 'valodu-kursi';
                break;
            case 'ru':
                // $url .= 'repetitory-online';
                $url .= 'repetitor';
                break;
            default:
                // $url .= 'language-teachers-online';
                $url .= 'language-teachers';
        }
        if ($lang_url = self::get_url($language, $lang)) {
            $url .= '/' . $lang_url;
        }
        //echo $url;
        //die;
        return $url;
    }
    
    public static function get_full_url_by_code(&$code, $lang = null) {
        if ($model = self::get_by_code($code)) {
            return self::get_full_url($model, $lang);
        }
        return '/';
    }
    
    public static function get_url_by_code(&$code) {
        if ($model = self::get_by_code($code)) {
            return self::get_url($model);
        }
        return $code;
    }
    public static function get_code_by_url(&$url) {
        if ($model = self::get_by_url($url)) {
            return $model->code;
        }
        return $url;
    }
	//added by Nitesh
	public static function get_url_by_code_group(&$code) {
        if ($model = self::get_by_code_group($code)) {
            return self::get_url_group($model);
        }
        return $code;
    }  
	
	public static function get_by_code_group($code) {
        global $DB;
        return $DB->get_record('lonet_language_group', ['code' => $code]);
    }  
	
	public static function get_url_group(&$language, $lang = null) {
		global $SESSION;
		$lang = $lang ?: substr($SESSION->lang ?? 'en', 0, 2);
		return strtolower($language->{'url_' . $lang} ?: ($language->code ?: ''));
	} 	
	
	public static function get_grouplesson_page_url($lang = null) {
        global $SESSION;
        $url = '/';
        switch ($lang) {
            case 'es':
                $url .= 'cursos-online';
                break;
            case 'lv':
                $url .= 'kursi-online';
                break;
            case 'ru':
                $url .= 'uroki-online';
                break;
            default:
                $url .= 'courses-online';
        }
        return $url;
    }
	
    public static function get_full_url_group(&$language, $lang = null) {
        global $DB,$SESSION;
        $url = '/';
        $lang = $lang ?: substr($SESSION->lang ?? 'en', 0, 2);
        switch ($lang) {
            case 'es':
                $url .= 'cursos-online';
                break;
            case 'lv':
                $url .= 'kursi-online';
                break;
            case 'ru':
                $url .= 'uroki-online';
                break;
            default:
                $url .= 'courses-online';
        }
		$code = !empty($lang) ? $lang : 'en';
		$languagesql  = $DB->get_record_sql("SELECT * FROM {lonet_language_group} WHERE code='".$code."' AND isactive =1");
		$url .= '/'.$languagesql->{'url_' . $language}.'?language_teacher='.$code;
        // if ($lang_url = self::get_url_group($language, $lang)) {
            // $url .= '/' . $lang_url;
        // }
        // echo $url;
        // die;
        return $url;
    }
}
?>