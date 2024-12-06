<?php
namespace local_lonet;

use \core_user;

defined('MOODLE_INTERNAL') || die();

class subscriber {
	public static function getSubscriberEmailContent($email) {
        $content = '
<table align="center" border="0" width="100%" bgcolor="fbfbfc" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td style="padding-top:28px;padding-right:0;padding-bottom:80px;padding-left:0;margin:0" width="100%">
				<table align="center" border="0" width="600" cellpadding="0" cellspacing="0" style="border-top-left-radius:0px;border-top-right-radius:0px">
					<tbody>
						<tr>
							<td style="background-color:#002b46;border-top-left-radius:0px;border-top-right-radius:0px;" width="100%">
								<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%">
									<tbody><tr>
										<td valign="top" align="center" style="padding-top:14px;padding-right:0px;padding-bottom:13px;padding-left:0;margin:0">
											<a href="https://lonet.academy" title="LONET.academy" target="_blank">
												<img src="https://lonet.academy/theme/lonet/pix/logo-white.png" alt="LONET.academy" border="0" height="60" style="border:0 none transparent;display:block">
											</a>
										</td>
									</tr>
								</tbody></table>
							</td>
						</tr>
						<tr>
							<td align="center" bgcolor="#ffffff" style="padding:30px 11px 16px;margin:0;color:rgb(40,43,49);font-size:26px;font-family:&quot;Helvetica Neue&quot;,Helvetica,sans-serif;">
                                ' . get_string('subscriber_title', 'local_lonet') . '
							</td>
						</tr>
						<tr>
							<td valign="top" align="center" bgcolor="#ffffff" style="padding:0;margin:0">
								<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" style="margin:0;padding:0">
									<tbody>
										<tr>
											<td valign="top" align="left" style="padding:10px 23px;margin:0">
												<div style="height:1px;line-height:1px;border-top-width:1px;border-top-style:solid;border-top-color:#e6e6e7">
													<img alt="" width="1" height="1" style="display:block">
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left" bgcolor="#ffffff" style="line-height:1.5;padding:20px 21px 15px 21px;margin:0;color:#646464;font-weight:normal;font-size:14px;font-family:&#39;Helvetica Neue&#39;,Helvetica,sans-serif">
								<p>' . get_string('hello', 'local_lonet') . '!</p>
								<p>' . get_string('subscriber_thankyou', 'local_lonet') . '</p>
								<p>' . get_string('subscriber_news', 'local_lonet') . '</p>
								<p>&nbsp;</p>
								<p style="text-align:center;">' . get_string('subscriber_step1', 'local_lonet') . '</p>
								<p style="text-align:center;font-size:36px;margin:0;">↓</p>
								<p style="text-align:center;">' . get_string('subscriber_step2', 'local_lonet') . '</p>
								<p>' . get_string('subscriber_lessonnote', 'local_lonet') . '</p>
								<p style="text-align:center">' . get_string('subscriber_paymentnote', 'local_lonet') . '</p>
								<p style="text-align:center;font-size:36px;margin:0;">↓</p>
								<p style="text-align:center">' . get_string('subscriber_step3', 'local_lonet') . '</p>
								<p>&nbsp;</p>
								<p>' . get_string('subscriber_footer', 'local_lonet') . '</p>
								<p>&nbsp;</p>
								<p>' . get_string('subscriber_signature', 'local_lonet') . '</p>
							</td>
						</tr>
						<tr>
							<td align="left" style="padding:28px 19px 25px;margin:0">
								<table align="center" border="0" cellpadding="0" width="100%" cellspacing="0">
									<tbody>
										<tr>
											<td align="left" style="padding:0;margin:0">
												<table align="center" border="0" cellpadding="0" width="100%" cellspacing="0">
													<tbody>
														<tr>
															<td align="left" width="72%" style="padding:0;margin:0">
																<a href="https://lonet.academy" alt="LONET.academy" target="_blank">
																	<img src="https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1534420434/logo_small.png" alt="" border="0" height="60" style="border:0px none transparent;display:block">
																</a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<!--
						<tr>
							<td align="left" style="padding:0 0 44px 19px">
								<span style="color:#d7dae4;font-weight:300;font-size:12px;font-family:&#39;Helvetica Neue&#39;,Helvetica,sans-serif;line-height:22px">
									This message was sent to <a href="mailto:' . $email . '" style="color:#00aeef;font-weight:normal;font-size:12px;font-family:&#39;Helvetica Neue&#39;,Helvetica,sans-serif;text-decoration:underline" target="_blank">' . $email . '</a> by LONET.academy</span>
							</td>
						</tr>
						-->
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
        ';        
		return $content;
	}
    
    public static function sendSubscriberEmail($email) {      
        $subject = get_string('email_subscriber_subject', 'local_lonet');
        $body = self::getSubscriberEmailContent($email);
        $text = html_to_text($body);
        $from = core_user::get_support_user();

        $to = (object) [
            'email' => $email,
            'firstname' => $email,
            'lastname' => '',
            'maildisplay' => true,
            'mailformat' => 1,
            'id' => -1,
            'firstnamephonetic' => '',
            'lastnamephonetic' => '',
            'middlename' => '',
            'alternatename' => '',
        ];
        
        return email_to_user($to, $from, $subject, $text, $body);
    }
    
    public static function getAdminEmailContent($subscriber) {
        return '
<p>New application for consultation received:</p>
<table>
    <tbody>
        <tr><td>Name: </td><td>' . $subscriber->name . '</td></tr>
        <tr><td>Email: </td><td>' . $subscriber->email . '</td></tr>
        <tr><td>Phone Number: </td><td>' . $subscriber->phone_number . '</td></tr>
        <tr><td>Skype ID: </td><td>' . $subscriber->skype . '</td></tr>
        <tr><td>Languages: </td><td>' . $subscriber->comment . '</td></tr>
    </tbody>
</table>
        ';
    }
    
    public static function sendAdminEmail($email) {
        $subject = 'Application for Consultation';
        $body = self::getAdminEmailContent($email);
        $text = html_to_text($body);
        $from = core_user::get_support_user();
        $to = $from;        
        return email_to_user($to, $from, $subject, $text, $body);
    }
}
