<?php
require_once($CFG->dirroot . '/theme/bootstrapbase/renderers.php');
require_once('course_renderer.php');
require_once('user_renderer.php');

class theme_lonet_core_renderer extends theme_bootstrapbase_core_renderer {
	public function context_header($headerinfo = null, $headinglevel = 1) {
		if ($this->should_render_logo($headinglevel)) {
			return html_writer::tag('div', '', array('class' => 'logo'));
		}
		return parent::context_header($headerinfo, $headinglevel);
	}
	protected function should_render_logo($headinglevel = 1) {
		global $PAGE;
		// Only render the logo if we're on the front page or login page
		// and the theme has a logo.
		if ($headinglevel == 1 && !empty($this->page->theme->settings->logo)) {
			if ($PAGE->pagelayout == 'frontpage' || $PAGE->pagelayout == 'login') {
				return true;
			}
		}
		return false;
	}
	//Added by Nitesh
    protected function navbar_button() {
        global $CFG,$DB,$USER;

        if (empty($CFG->custommenuitems) && $this->lang_menu() == '') {
            return '';
        }

        $iconbar = html_writer::tag('span', '', array('class' => 'icon-bar'));
        $button = html_writer::tag('a', $iconbar . "\n" . $iconbar. "\n" . $iconbar, array(
            'class'       => 'btn btn-navbar',
            'data-toggle' => 'collapse',
            'data-target' => '.nav-collapse'
        ));
		$unreadmsg = $DB->count_records_sql("SELECT count(id) FROM {message} WHERE useridto=".$USER->id."");
		if($unreadmsg > 0){
			$button .= '<div class="count-container for-mobile" data-region="count-container" style="margin-top: 10px; margin-right: 10px;">'.$unreadmsg.'</div>';
		}
        return $button;
    }
	public function navbar_home($returnlink = true) {
		global $CFG;
		if ($this->should_render_logo() || empty($this->page->theme->settings->smalllogo)) {
			// If there is no small logo we always show the site name.
			return $this->get_home_ref($returnlink);
		}
		$imageurl = $OUTPUT->get_compact_logo_url()->out(false);
		$image = html_writer::img($imageurl, get_string('sitelogo', 'theme_' . $this->page->theme->name),
		array('class' => 'small-logo'));
		if ($returnlink) {
			$logocontainer = html_writer::link($CFG->wwwroot, $image,
			array('class' => 'small-logo-container', 'title' => get_string('home')));
		} else {
			$logocontainer = html_writer::tag('span', $image, array('class' => 'small-logo-container'));
		}
		// Sitename setting defaults to true.
		if (!isset($this->page->theme->settings->sitename) || !empty($this->page->theme->settings->sitename)) {
			return $logocontainer . $this->get_home_ref($returnlink);
		}
		return $logocontainer;
	}
	protected function get_home_ref($returnlink = true) {
		global $CFG, $SITE;
		$sitename = format_string($SITE->shortname, true, array('context' => context_course::instance(SITEID)));
		if ($returnlink) {
			return html_writer::link($CFG->wwwroot, $sitename, array('class' => 'brand', 'title' => get_string('home')));
		}
		return html_writer::tag('span', $sitename, array('class' => 'brand'));
	}
	public function user_menu($user = null, $withlinks = null) {
		global $USER, $CFG;
		require_once($CFG->dirroot . '/user/lib.php');

		if (is_null($user)) {
			$user = $USER;
		}

		// Note: this behaviour is intended to match that of core_renderer::login_info,
		// but should not be considered to be good practice; layout options are
		// intended to be theme-specific. Please don't copy this snippet anywhere else.
		if (is_null($withlinks)) {
			$withlinks = empty($this->page->layout_options['nologinlinks']);
		}

		// Add a class for when $withlinks is false.
		$usermenuclasses = 'usermenu';
		if (!$withlinks) {
			$usermenuclasses .= ' withoutlinks';
		}

		$returnstr = "";

		// If during initial install, return the empty return string.
		if (during_initial_install()) {
			return $returnstr;
		}

		$loginpage = $this->is_login_page();
		$loginurl = get_login_url();
		// If not logged in, show the typical not-logged-in string.
		if (!isloggedin()) {
			$returnstr = get_string('loggedinnot', 'moodle');
			if (!$loginpage) {
				$returnstr .= " (<a href=\"$loginurl\">" . get_string('login') . '</a>)';
			}
			return html_writer::div(
				html_writer::span(
					$returnstr,
					'login'
				),
				$usermenuclasses
			);

		}

		// If logged in as a guest user, show a string to that effect.
		if (isguestuser()) {
			$returnstr = get_string('loggedinasguest');
			if (!$loginpage && $withlinks) {
				$returnstr .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
			}

			return html_writer::div(
				html_writer::span(
					$returnstr,
					'login'
				),
				$usermenuclasses
			);
		}

		// Get some navigation opts.
		$opts = user_get_user_navigation_info($user, $this->page);
		 $userinfo = new stdClass();
		$avatarclasses = "avatars";
		$avatarcontents = html_writer::span($opts->metadata['useravatar'], 'avatar current');
		// $usertextcontents = $opts->metadata['userfullname'];
		$usertextcontents = $userinfo->title=$user->firstname .' ' . $user->lastname;

		// Other user.
		if (!empty($opts->metadata['asotheruser'])) {
			$avatarcontents .= html_writer::span(
				$opts->metadata['realuseravatar'],
				'avatar realuser'
			);
			$usertextcontents = $opts->metadata['realuserfullname'];
			$usertextcontents .= html_writer::tag(
				'span',
				get_string(
					'loggedinas',
					'moodle',
					html_writer::span(
						$opts->metadata['userfullname'],
						'value'
					)
				),
				array('class' => 'meta viewingas')
			);
		}

		// Role.
		if (!empty($opts->metadata['asotherrole'])) {
			$role = core_text::strtolower(preg_replace('#[ ]+#', '-', trim($opts->metadata['rolename'])));
			$usertextcontents .= html_writer::span(
				$opts->metadata['rolename'],
				'meta role role-' . $role
			);
		}

		// User login failures.
		if (!empty($opts->metadata['userloginfail'])) {
			$usertextcontents .= html_writer::span(
				$opts->metadata['userloginfail'],
				'meta loginfailures'
			);
		}

		// MNet.
		if (!empty($opts->metadata['asmnetuser'])) {
			$mnet = strtolower(preg_replace('#[ ]+#', '-', trim($opts->metadata['mnetidprovidername'])));
			$usertextcontents .= html_writer::span(
				$opts->metadata['mnetidprovidername'],
				'meta mnet mnet-' . $mnet
			);
		}

		$returnstr .= html_writer::span(
			html_writer::span($usertextcontents, 'usertext') .
			html_writer::span($avatarcontents, $avatarclasses),
			'userbutton'
		);

		// Create a divider (well, a filler).
		$divider = new action_menu_filler();
		$divider->primary = false;

		$am = new action_menu();
		$am->set_menu_trigger(
			$returnstr
		);
		$am->set_alignment(action_menu::TR, action_menu::BR);
		$am->set_nowrap_on_items();
		if ($withlinks) {
			$navitemcount = count($opts->navitems);
			$idx = 0;
			// Adds username to the first item of usermanu.

			$userinfo->itemtype = 'text';
			$userinfo->title = $user->firstname . ' ' . $user->lastname;
			$userinfo->url = new moodle_url('/user/profile.php', array('id' => $user->id));
			$userinfo->pix = 'i/user';
			array_unshift($opts->navitems, $userinfo);
			foreach ($opts->navitems as $key => $value) {

				switch ($value->itemtype) {
					case 'divider':
						// If the nav item is a divider, add one and skip link processing.
						$am->add($divider);
						break;

					case 'invalid':
						// Silently skip invalid entries (should we post a notification?).
						break;
					case 'text':
						$al = new action_menu_link_secondary(
							// $value->url,
							new moodle_url('/'),
							$pix = new pix_icon($value->pix, $value->title, null, array('class' => 'iconsmall')),
							$value->title,
							array('class' => 'text-username')
						);

						$am->add($al);
						break;
					case 'link':
						if($user->profile['role'] != 'Learner'){
							if(strtolower($value->title) == 'student profile'){continue;}
						}
						// Process this as a link item.
						$pix = null;
						if (isset($value->pix) && !empty($value->pix)) {
							$pix = new pix_icon($value->pix, $value->title, null, array('class' => 'iconsmall'));
						} else if (isset($value->imgsrc) && !empty($value->imgsrc)) {
							$value->title = html_writer::img(
								$value->imgsrc,
								$value->title,
								array('class' => 'iconsmall')
							) . $value->title;
						}
						$al = new action_menu_link_secondary(
							$value->url,
							$pix,
							$value->title,
							array('class' => 'icon')
						);
						if (!empty($value->titleidentifier)) {
							$al->attributes['data-title'] = $value->titleidentifier;
						}
						$am->add($al);
						break;
				}

				$idx++;

				// Add dividers after the first item and before the last item.
				if ($idx == 1 || $idx == $navitemcount - 1) {
					// $am->add($divider);
				}
			}
		}

		return html_writer::div(
			$this->render($am),
			$usermenuclasses
		);
	}

}