<?php
$string['pluginname'] = 'Lonet';
$string['pluginadministration'] = 'Lonet';
$string['modulename'] = 'Lonet';
$string['modulename_help'] = 'LONET.academy plugin';
$string['modulename_link'] = 'local/lonet/view';
$string['modulenameplural'] = 'Lonet';
$string['generalsettings'] = 'General Settings';
$string['notsetup'] = 'This teacher has not set up their lesson schedule yet.';
$string['schedule'] = 'Schedule';
$string['sendreminders'] = 'Send Reminders';
$string['sendreminders_notbooked_lesson'] = 'Send Reminders not booked lesson';
$string['sendrequestreminders'] = 'Send Request Reminders';
$string['sendstatusrequests'] = 'Send Status Requests';
$string['sendfeedbackrequests'] = 'Send Feedback Requests';
$string['expirerequests'] = 'Expire Requests';
$string['recordhistory'] = 'Record User History';
$string['updatestatuses'] = 'Update Statuses';
$string['clearschedule'] = 'Clear Schedule';
$string['cacheposts'] = 'Cache Blog Posts';
$string['lonetadmin'] = 'LONET Administration';

/* ***** Interface strings ****** */
$string['action'] = 'Action';
$string['actions'] = 'Actions';
$string['comments'] = 'Please leave a review about the lesson and the teacher (text in the below box)';
$string['date'] = 'Date';
$string['time'] = 'Time';						 
$string['duration'] = 'Duration';
$string['lessonname'] = 'Lesson Name';
$string['length'] = 'Duration';
$string['location'] = 'Location';
$string['message'] = 'Message';
$string['messagesubject'] = 'Subject';
$string['minutes'] = 'minutes';
$string['notifications'] = 'Notifications';
$string['options'] = 'Options';
$string['preview'] = 'Preview';
$string['reviews'] = 'Reviews';
$string['reminder'] = 'Reminder';
$string['save'] = 'Save';
$string['schedule'] = 'Schedule';
$string['scheduler'] = 'Scheduler';
$string['student'] = 'Student';
$string['students'] = 'Students';
$string['teacher'] = 'Teacher';
$string['learner'] = 'Learner';
$string['learners'] = 'Learners';

/* ***********  E-mail templates ************ */
$string['email_confirmdeletion_subject'] = 'Confirm account deletion on {$a->sitename}';
$string['email_confirmdeletion_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>You requested to delete your account on {$a->sitename}.
<p>To confirm the deletion of your account, please follow this link:</p>
<p><a href="{$a->link}">{$a->link}</a></p>
<p>In most mail programs, this should appear as a blue link which you can just click on.</p>
<p>If that doesn\'t work, then cut and paste the address into the address line at the top of your web browser window.</p>
';

$string['email_userdeleted_subject'] = 'A User Account Deleted';
$string['email_userdeleted_html'] = '<p>A user account has been deleted.</p>
<p>
Details:
<ul>
<li>Name: {$a->fullname}</li>
<li>Email: {$a->email}</li>
<li>Type: {$a->type}</li>
</ul>
</p>
';

$string['email_teacherrequest_subject'] = 'New Teacher Request on {$a->sitename}';
$string['email_teacherrequest_html'] = '<p>A new Teacher’s account has been requested!</p>';

$string['email_teacherwelcome_subject'] = 'Welcome to Lonet.Academy';
$string['email_teacherwelcome_html'] = '<p>Hello {$a->firstname},</p>
<p>Thank You for joining Lonet.Academy!</p>
<p>I am Kristīne - a creator of the platform, and I am happy that you would like to join our community.</p>
<p><strong>Do You strive for personal and communal growth?</strong></p>
<p><strong>Do You believe that education and learning will change lives and will make the world a better place?</strong></p>
<p>If your answer is “yes”, you are in the right place.</p>
<p>Tutors at Lonet.Academy change people\'s lives by helping people from all over the world to learn foreign languages fast, easily and efficiently.</p>
<p>
    All the teachers on our platform are totally independent:
    <ol>
        <li>teachers set their own rates for the lessons.</li>
        <li>teachers set their own schedule (hours).</li>
        <li>teachers have their own material and program as well as should be experienced in teaching online (in zoom, Skype or any other video conferencing tool).</li>
    </ol>
</p>
<p>Before your profile is going to be published and offered to Lonet.Academy learners, I would like to invite you to a short interview online. I personally meet all our teachers and I will be happy to explain you our mission and values as well as to answer all the questions you might have.</p>
<p><strong>Please send me a message on WhatsApp +371 27 344 201 to agree on the day and time of the meeting.<strong></p>
<p>Thank you and have a nice day!</p>
<p>Kristīne Baltača</p>';

$string['email_learnerwelcome_subject'] = 'Welcome to Lonet.Academy';
$string['email_learnerwelcome_html'] = '<table width="100%" border="0">
<tr><td align="center"><h2>{$a->firstname}, welcome to Lonet.Academy!</h2></td></tr>
<tr><td align="center" valign="top">
<a href="https://lonet.academy/find-your-language-tutor" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/en_welcome.png" width="325" height="273" /></a>
</td></tr>
<tr><td align="center"><h3>Next step is to choose your tutor on Lonet.Academy</h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/language-teachers" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/en_choose.png" width="150" height="40" /></a></td></tr>
<tr><td align="center"><h3 style="font-weight:normal">If you have any doubts or questions, apply for a <strong>free consultation with me</strong></h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/language-tutor-consultation" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/en_apply.png" width="150" height="40" /></a></td></tr>
</table>
<p>Have a nice day!</p>
<p>Kristine Baltach</p>';

$string['email_teacherconfirmed_subject'] = 'Confirmation of your account on {$a->sitename}';
$string['email_teacherconfirmed_html'] = '<p>{$a->fullname},</p>
<br>
<p>Your Teacher’s account has been confirmed!</p>
<p>For further instructions, please follow this link: <br>{$a->link}</p>
<p>
In most mail programs, this should appear as a blue link which you can just click on.
<br>If that doesn\'t work, then cut and paste the address into the address line at the top of your web browser window.
</p>
<p>If you need help, please reply to this email.</p>
<br>
<p>Thank you!</p>';

$string['email_teachernotconfirmed_subject'] = 'Account not confirmed';
$string['email_teachernotconfirmed_html'] = '<p>Dear {$a->fullname},</p>
<p>Referring to your tutoring application at <a href="https://lonet.academy" target="_blank">Lonet Academy</a> we appreciate your interest and thank you for the time and energy you invested in your application. We also strive for the best service for the language learners and we do our best to provide them with a choice of experienced and professional tutors.</p>
<p>
    After carefully reviewing your profile data we have to decline your tutoring application for some of the following reasons:
    <ul>
        <li>Your profile data is completed for less than 50% that makes us unable to verify the profile;</li>
        <li>No profile picture has been uploaded;</li>
        <li>No introduction video has been uploaded;</li>
        <li>No profile picture has been uploaded;</li>
        <li>Your introduction video is against our policy (e.g. mentions a name of a competing platform, contains third party’s contacts, etc);</li>
        <li>Information provided is irrelevant for the position or is against our policy;</li>
        <li>We are unable to accept more tutors at the moment;</li>
        <li>At the moment we are not offering the language that you teach;</li>
        <li>We were not able to connect with you for an interview;</li>
        <li>We haven’t got reply from you;</li>
        <li>Some other reasons that are not mentioned here and might be communicated on request.</li>
    </ul>
</p>
<p>Feel free to contact us in case you would like us to reconsider this decision by replying to this email.</p>';

$string['email_paymentreceived_subject'] = 'Payment Confirmation';
$string['email_paymentreceived_html'] = '
<p>Dear {$a->fullname},</p><br>
<p>Your payment has been successfully processed.</p>
<p>Your payment and order reference is <strong>{$a->reference}. For details please click <a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">here</a>.</strong></p>
{$a->yourproducts}
<br>
<p>Have a wonderful time!</p>
';

$string['email_paymentreceived_camp_subject'] = 'Your purchase of Meetup Camp In Barcelona, June 2023';

$string['email_paymentreceived_camp_html'] = '
<p>Dear {$a->fullname},</p><br>
<p>Your payment has been successfully processed.</p>
<p>Your payment and order reference is <strong>{$a->reference}. For details please click <a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">here</a>.</strong></p>
{$a->yourproducts}
<br>
<p>Have a wonderful time!</p>
';

$string['yourlessons'] = '<p>Please wait for the requested lessons confirmation from the tutor.</p>
<p>In case you will not get the confirmation or decline in 24 hours, please <a href="https://lonet.academy/contact-us">contact Lonet.Academy support</a> or reply to this email.</p>';
$string['yourgiftcards'] = '<p>Please find below your Gift Card to Lonet.Academy classes online:</p>{$a}';
$string['cardvalue'] = 'Card Value';
$string['how_many_cards'] = 'How many cards';
$string['email_requestreceived_subject'] = 'Lesson Request on Lonet.academy';
$string['email_requestreceived_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Your order reference is <strong>{$a->reference}</strong>.</p>
{$a->yourproducts}
<p>Please wait for the requested lessons confirmation from the Teacher.</p>
<p>In case you will not get the confirmation or decline in 24 hours, please <a href="https://lonet.academy/contact-us">contact Lonet support</a> or reply to this email.</p>';

$string['email_giftcardconfirm_subject'] = 'Your Gift Card';
$string['email_giftcardconfirm_html'] = '<p>Dear {$a->fullname},</p>
<p>Congratulations!</p>
<p>You have bought one of the best presents – A Gift Of Language!</p>
{$a->yourproducts}
<p>Your order reference number is <strong>{$a->reference}</strong>. Please find the payment details <strong><a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">here</a></strong>.</p>';

$string['email_newrequest_subject'] = 'Lesson Request on Lonet.academy';
$string['email_newrequest_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Please note that you have a new request REF {$a->reference} for {$a->count} lesson(s) on Lonet.</p>
<p>Please go to your {$a->profilelink} to confirm or decline the request.</p>
<p>Please proceed with the lesson(s) request confirmation or decline in {$a->hours} hours. 
<br>In case you fail to respond to the request in {$a->hours} hours, the request will be automatically declined.</p>
<p>In case you decline the request, please provide the reason. 
<br>Please note that the declined requests influence your response rate, which is shown on your profile. </p>
<p>In case you have any questions or need help, please reply to this email or <a href="https://lonet.academy/contact-us">contact us</a>.</p>';

$string['email_newrequestreminder_subject'] = 'Reminder: {$a->hours} hours left to confirm the lesson';
$string['email_newrequestreminder_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Please note that you have a new request REF {$a->reference} for {$a->count} lesson(s) on Lonet.</p>
<p>Please go to your {$a->profilelink} to confirm or decline the request.</p>
<p>Please proceed with the lesson(s) request confirmation or decline in {$a->hours} hours. 
<br>In case you fail to respond to the request in {$a->hours} hours, the request will be automatically declined.</p>
<p>In case you decline the request, please provide the reason. 
<br>Please note that the declined requests influence your response rate, which is shown on your profile. </p>
<p>In case you have any questions or need help, please reply to this email or <a href="https://lonet.academy/contact-us">contact us</a>.</p>';

$string['email_lessonconfirm_subject'] = 'Lesson Confirmed';
$string['email_lessonconfirm_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Please note that your <strong>{$a->lessonname}</strong> lesson, on <strong>{$a->lessondate}</strong> at <strong>{$a->lessontime}</strong> has been confirmed by the tutor {$a->teachername}.</p>
<p>You can view the details on your <a href="https://lonet.academy/user/profile.php">profile page</a>.</p>
<p>Please contact your tutor through on-site messenger available in your profile page.</p>
<p>If you need help, please reply to this email.</p>
<br>
<p>Thank you!</p>';

$string['email_lessonexpire_subject'] = 'Lesson Not Confirmed';
$string['email_lessonexpire_html'] = '<p>Dear {$a->fullname},</p>
<p>Please note that your <strong>{$a->lessonname}</strong> lesson, on <strong>{$a->lessondate}</strong> at <strong>{$a->lessontime}</strong> has <strong>NOT been confirmed</strong> by the Teacher.</p>
<p>Due to some reasons, the Teacher was not able to respond to your request.</p>
<p>We apologize for the inconvenience caused.</p>
<p><strong>The amount you have paid is available in your virtual wallet in the profile.</strong>You can use it to book any other lesson on Lonet.Academy.</p>
<p>Please try to proceed with the lesson request once again or choose any other Teacher available. Please use the &#34;Pay from Balance&#34; button during the next lesson reservation.</p>
<p>In case you have any questions or need help, please reply to this email.</p>
<p>To check the lesson booking terms, please go to Lonet {$a->termslink}.</p>';

$string['email_lessondecline_subject'] = 'Lesson Declined. Please book once again.';
$string['email_lessondecline_html'] = '<p>Dear {$a->fullname},</p>
<p>Please note that your <strong>{$a->lessonname}</strong> lesson, on <strong>{$a->lessondate}</strong> at <strong>{$a->lessontime}</strong> has <strong>been declined</strong> by the Teacher.</p>
<p>Due to some reasons, the Teacher declined your request.</p>
<p>We apologize for the inconvenience caused.</p>
<p><strong>The amount you have paid is available in your virtual wallet in the profile.</strong>You can
use it to book any other lesson on Lonet.Academy.</p>
<p>Please try to proceed with the lesson request once again or choose any other Teacher available. Please use the &#34;Pay from Balance&#34; button during the next lesson reservation.</p>
<p>To check the lesson booking terms, please go to Lonet {$a->termslink}.</p>';

$string['email_lessoncancellearner_subject'] = 'Lesson Canceled';
$string['email_lessoncancellearner_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Please note that your <strong>{$a->lessonname}</strong> lesson, on <strong>{$a->lessondate}</strong> at <strong>{$a->lessontime}</strong> has been canceled by the Teacher.</p>
<p><strong>Due to some reasons, the <u>Teacher has canceled the above mentioned lesson.</u></strong></p>
<p>We apologize for the inconvenience caused.</p>
<p>Please try to proceed with the lesson request. You are welcome to choose any other date, time and Teacher available on Lonet website.</p>
<p>In case you have any questions or need help, please reply to this email.</p>
<p>To check the cancellation terms, please read Lonet {$a->termslink}.</p>';

$string['email_lessoncancelteacher_subject'] = 'Lesson Canceled';
$string['email_lessoncancelteacher_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Please note that <strong>{$a->lessonname}</strong> lesson, on <strong>{$a->lessondate}</strong> at <strong>{$a->lessontime}</strong> has been canceled by the Student.</p>
<p><strong>Due to some reasons, the Student <u>has canceled the above mentioned lesson.</u></strong></p>
<p>We apologize for the inconvenience caused.</p>
<p>To check the cancellation terms, please read Lonet {$a->termslink}.</p>
<p>In case you have any questions or need help, please reply to this email.</p>';

$string['email_lessonremindstudent_subject'] = 'Lesson Reminder from Lonet.Academy';
$string['email_lessonremindstudent_html'] = '
<p>Dear {$a->fullname},</p>
<p>We are glad to remind you about {$a->lessonname} lesson, on {$a->lessondate} at {$a->lessontime} with Your tutor {$a->teacherfullname}.</p>
<p>For details please go to your <a href="https://lonet.academy/user/profile.php">profile page</a> on Lonet.Academy.</p>
<p>Wish you a successful learning process!</p>
<br>
<p>If you wouldn\'t like to receive such reminders, please change the settings on your <a href="https://lonet.academy/user/profile.php">profile page</a>.</p>
';

$string['email_notbookedlesson_subject'] = 'You forgot to book your lessons.';
$string['email_notbookedlesson_html'] = '<p>{$a->firstname},</p>
<p>Did You <u><i><a href="https://lonet.academy">book your language lessons</a></i></u> for this week?</p>
<p>Most of the language learners on Lonet.Academy confessed that the main reasons why they keep learning with their tutor is that their tutor motivates them, helps keep their learning process on track and disciplines them to show up and do the thing when they don\'t really feel like doing it.</p>
<p><strong><u><i><a href="https://lonet.academy/user/profile.php">Book your lessons</a></i></u> right now!</strong></p>
<p>Be persistent and progress in your language learning!</p>
<p>In case you have any questions or doubts, <u><i><a href="https://lonet.academy/language-tutor-consultation">please sign up for a free consultation with me.</a></i></u></p>
<p>&nbsp;</p>
<p>Thank you and have a nice day!</p>
<p>Kristīne Baltača</p>
';

$string['email_lessonremindteacher_subject'] = 'Lesson Reminder from Lonet.Academy';
$string['email_lessonremindteacher_html'] = '
<p>Dear {$a->fullname},</p>
<p>We are glad to remind you about {$a->lessonname} lesson, on {$a->lessondate} at {$a->lessontime} with {$a->studentfullname}.</p>
<p>For details please go to your <a href="https://lonet.academy/user/profile.php">profile page</a> on Lonet.Academy.</p>
<br>
<p>If you wouldn\'t like to receive such reminders, please change the settings on your <a href="https://lonet.academy/user/profile.php">profile page</a>.</p>
';

$string['email_lessonstatusrequeststudent_subject'] = 'Lesson Status Request';
$string['email_lessonstatusrequeststudent_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>
	Please confirm the status of the following lesson:
	<br>{$a->lessonname} lesson on {$a->lessondate} at {$a->lessontime}.
</p>
<p>
	{$a->complete} {$a->notcomplete}
</p>';

$string['email_lessonstatusrequestteacher_subject'] = 'Lesson Status Request';
$string['email_lessonstatusrequestteacher_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>
	Please confirm the status of the following lesson:
	<br>{$a->lessonname} lesson on {$a->lessondate} at {$a->lessontime}.
</p>
<p>
	{$a->complete} {$a->notcomplete}
</p>';

$string['email_lessonfeedbackrequest_subject'] = 'Your experience on Lonet.Academy';
$string['email_lessonfeedbackrequest_html'] = '<p>Dear {$a->firstname},</p>
<p>
	<br>Did you have a good experience with your tutor <strong>{$a->teacherfullname}</strong> on <strong>Lonet.Academy</strong>?
</p>
<p>
	<br>Please rate your {$a->language} lesson and {$a->button} about your teacher and your learning process with him/her. 
</p>
<p>
	<strong>This will help your teacher find more students!</strong>
	<br>This <strong>will help other language learners to make their choice</strong> when they are looking for a good teacher of {$a->language} language!
</p> 
<p>
	<br>Here, on Lonet.Academy we truly strive for doing our best in helping the world to learn foreign languages easy, effectively and in enjoyable way.
</p> 
<p>
	<br>We do our best to <strong>select the exerienced language tutors</strong> and to <strong>connect the language learners with teachers around the world</strong>.
</p> 
<p>
	<br><strong>Your experience on Lonet.Academy is very important for us.</strong> 
</p> 
<p>
	<br>We truly hope that you enjoy your language learning process on Lonet.Academy and You will help us spread the word!
</p>
<p>
	Follow Lonet.Academy on <a href="https://www.facebook.com/lonet.academy"><img src="https://facebookbrand.com/wp-content/uploads/2016/05/flogo_rgb_hex-brc-site-250.png" width="16" height="16" style="margin-right: 5px;">Facebook</a>
	<br>Follow Lonet.Academy on <a href="https://twitter.com/lonet_academy"><img src="https://abs.twimg.com/responsive-web/web/icon-ios.8ea219d08eafdfa44.png" width="16" height="16" style="margin-right: 5px;">Twitter</a>
	<br>Connect with  Lonet.Academy on <a href="https://www.linkedin.com/company/lonet/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Linkedin.svg/220px-Linkedin.svg.png" width="16" height="16" style="margin-right: 5px;">LinkedIn</a>
	<br>Subscribe for Lonet.Academy <a href="https://lonet.academy/blog">blog articles</a>
</p>
<p>
	Wish you a wonderful day and fabulous journey of language learning!
</p> 
<p>
	<br>With love and passion towards languages Yours,
</p>
<p>
	Kristīne 
	<br>Lonet.Academy creator
</p>
<p>
	<br>GSM <a href="tel:34604139040">+34 604 13 9040</a>
	<br>email: <a href="mailto:lonet@lonet.academy">lonet@lonet.academy</a>
	<br>web: <a href="https://lonet.academy">https://lonet.academy</a>
</p>
<p>
	<img src="https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1513968819/logo_small.png" alt="Lonet.Academy">
</p>';

$string['email_payoutrequestrequested_subject'] = 'Payout request';
$string['email_payoutrequestrequested_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Your payout request has been successfully submitted and will be processed accordingly.</p>
<p>Your payout request reference number is <strong>{$a->reference}. For details please click <a href="https://lonet.academy/local/lonet/payout_receipt.php?id={$a->link}">here</a>.</strong></p>
<p>Please wait for the payment confirmation/remittance copy.</p>
<p>In case you will not get the payment confirmation and/or funds in 30 calendar days, please <a href="https://lonet.academy/contact-us">contact Lonet support</a> or reply to this email.</p>
<p>Thank you for cooperation and excellent teaching!</p>';

$string['email_payoutrequestpaid_subject'] = 'Payout confirmation';
$string['email_payoutrequestpaid_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Your payout request reference number <strong>{$a->reference} has been accepted and confirmed on {$a->date}.</strong></p>
<p>In case you have any questions or need additional information, please <a href="https://lonet.academy/contact-us">contact Lonet support</a> or reply to this email.</p>
<p><strong>Thank you for being with LONET and bringing knowledge into the world.</strong></p>';

$string['email_referfriend_subject'] = '{$a->name} invited You to join Lonet.Academy';
$string['email_referfriend_html'] = '<div style="background-color:#f0f0f0">
    <table style="font-family:Helvetica,Arial,sans-serif!important" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#F0F0F0" align="center"><tbody><tr><td>
          <table width="690" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr style="background-color:#f0f0f0"><td width="100%" align="center">
        <a href="{$a->link}" target="_blank">
            <img src="https://lonet.academy/pluginfile.php/1/core_admin/logocompact/200x75/1593553383/logo_small.png" alt="Lonet.Academy" style="display:block;padding:30px" width="150" border="0"></a>
    </td>
</tr><tr><td width="100%" align="center">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center"><tbody><tr><td width="100%" align="center">
                                              </td>
                    </tr><tr><td width="100%" align="center">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="border-top-left-radius:4px;border-top-right-radius:4px" width="100%" bgcolor="#1073CB" align="center">
        <table style="background:#002b46;background:linear-gradient(135deg,rgba(0,43,70,1) 0%,rgba(0,43,70,1) 17%,rgba(74,147,6,1) 100%);border-top-left-radius:4px;border-top-right-radius:4px;padding-left:16px;padding-right:16px" width="690" cellspacing="0" cellpadding="0" border="0" bgcolor="#1073CB" align="center"><tbody><tr><td width="100%" height="56"></td></tr><tr><td width="100%" align="center">
                    <div style="display:block;border-radius:4px;border:2px solid #ffffff;overflow:hidden;width:72px;height:72px;box-sizing:content-box;">{$a->image}</div>
            </tr><tr><td width="100%" height="24"></td></tr><tr><td width="100%" align="center">
                    <table width="490" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="text-align:center" width="100%" align="center">
                                <span style="color:#ffffff;font-weight:bold;font-size:36px;line-height:41px;font-family:\'Roboto\',Helvetica,Arial,sans-serif">
                                    {$a->name} has given you EUR 10 to try Lonet.Academy!                                </span>
                            </td>
                        </tr><tr><td width="100%" height="16"></td></tr><tr><td style="text-align:center" width="100%" align="center"><span style="color:#ffffff;font-weight:normal;font-size:18px;line-height:28px;font-family:\'Roboto\',Helvetica,Arial,sans-serif">Lonet.Academy gives you the choice of best language tutors online from all around the world. Simply register on Lonet.Academy and learn languages fast and easily from any place in the world!</span></td>
                        </tr><tr><td width="100%" height="24"></td></tr><tr><td width="100%" align="center">
                                <table width="400" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td style="border-radius:3px;background:#ffffff" height="48" align="center">
                                            <a href="{$a->link}" style="color:#1073cb;font-family:\'Roboto\',Helvetica,Arial,sans-serif;text-decoration:none;font-weight:bold;font-size:18px;line-height:48px;display:block;width:350px" target="_blank">Register and receive Your 10 EUR →</a>
                                        </td>
                                    </tr></tbody></table></td>
                        </tr><tr><td width="100%" height="36"></td></tr><tr><td width="100%" align="center">
                                <table width="400" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td height="48" align="center">
                                            <p style="color:#ffffff;font-family:\'Roboto\',Helvetica,Arial,sans-serif;text-decoration:none;font-size:12px;line-height:16px;display:block;width:100%">
                                            * Credit available when you have created account at Lonet.Academy.
                                            </p>
                                        </td>
                                    </tr></tbody></table></td>
                        </tr></tbody></table></td>
            </tr><tr><td width="100%" height="56"></td></tr></tbody></table></td>
</tr><tr><td width="100%" align="center">
        <table style="border-bottom-left-radius:4px;border-bottom-right-radius:4px;padding-left:16px;padding-right:16px" width="600" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" align="center"><tbody><tr><td width="100%" height="56"></td></tr><tr><td style="text-align:center" width="100%" align="center"><span style="color:#1f2836;font-weight:bold;letter-spacing:1px;font-size:14px;line-height:14px;font-family:\'Roboto\',Helvetica,Arial,sans-serif;text-transform:uppercase">WHAT LANGUAGES CAN I LEARN WITH LONET.ACADEMY TUTORS?
                    </span>
                </td>
            </tr><tr><td width="100%" height="16"></td></tr><tr><td width="100%" align="center">
                    <table width="490" cellspacing="0" cellpadding="0" border="0" align="center"><tbody><tr><td style="text-align:left" align="center">
                                <a href="https://lonet.academy/language-teachers/english-tutor-online" style="color:#0087e0;font-weight:normal;font-size:18px;line-height:18px;text-decoration:none;font-family:\'Roboto\',Helvetica,Arial,sans-serif" target="_blank">English</a>
                            </td>
                            <td style="text-align:left" align="center">
                                <a href="https://lonet.academy/language-teachers/spanish-tutors-online" style="color:#0087e0;font-weight:normal;font-size:18px;line-height:18px;text-decoration:none;font-family:\'Roboto\',Helvetica,Arial,sans-serif" target="_blank">Spanish</a>
                            </td>
                            <td style="text-align:left" align="center">
                                <a href="https://lonet.academy/language-teachers/chinese-tutors-by-skype" style="color:#0087e0;font-weight:normal;font-size:18px;line-height:18px;text-decoration:none;font-family:\'Roboto\',Helvetica,Arial,sans-serif" target="_blank">Chinese</a>
                            </td>
                        </tr><tr><td height="16"></td></tr><tr><td style="text-align:left" align="center">
                                <a href="https://lonet.academy/language-teachers/italian-language-tutors" style="color:#0087e0;font-weight:normal;font-size:18px;line-height:18px;text-decoration:none;font-family:\'Roboto\',Helvetica,Arial,sans-serif" target="_blank">Italian</a>
                            </td>
                            <td style="text-align:left" align="center">
                                <a href="https://lonet.academy/language-teachers/arabic-tutors-online" style="color:#0087e0;font-weight:normal;font-size:18px;line-height:18px;text-decoration:none;font-family:\'Roboto\',Helvetica,Arial,sans-serif" target="_blank">Arabic</a>
                            </td>
                            <td style="text-align:left" align="center">
                                <a href="https://lonet.academy/language-teachers/russian-language-tutors" style="color:#0087e0;font-weight:normal;font-size:18px;line-height:18px;text-decoration:none;font-family:\'Roboto\',Helvetica,Arial,sans-serif" target="_blank">Russian</a>
                            </td>
                        </tr></tbody></table></td>
            </tr><tr><td width="100%" height="56"></td></tr></tbody></table></td>
</tr></tbody></table></td>
                    </tr><tr><td>
                                              </td>
                    </tr></tbody></table></td>
            </tr><tr><td><div style="height: 50px;"></div></td>
            </tr></tbody></table></td>
      </tr></tbody></table>';

$string['emailsignature'] = '<br/>
<p>Best regards,</p>
<p><img src="'.$CFG->wwwroot.'/theme/lonet/pix/emaillogo.png" alt="" width="100"/></p>
<p>Follow us on 
<a href="https://www.facebook.com/lonet.academy" target="_blank" style="vertical-align:middle;"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/icons/facebook.png" alt="facebook" /></a>
<a href="https://www.instagram.com/lonet.academy/" target="_blank" style="vertical-align:middle;"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/icons/insta.png" alt="instagram" /></a>
<a href="https://www.linkedin.com/company/lonet/" target="_blank" style="vertical-align:middle;"><img src="'.$CFG->wwwroot.'/theme/lonet/pix/icons/linkedin.png" alt="linkedin" /></a>
</p>
<p>Read <a href="https://lonet.academy/blog/" target="_blank">Lonet.Academy blog</a> articles about languages.</p>
<p><strong>Contact us:</strong><br/>
Tel/WA: +371 27 344 201<br/>
Web: <a href="https://lonet.academy/" target="_blank">https://lonet.academy</a>
</p>';
$string['profilepage'] = 'profile page';
$string['commissionperlesson'] = 'Commission Per Lesson';
$string['commissionperlesson_desc'] = 'This amount will be added to teacher\'s lesson price.';
$string['showpopup'] = 'Enable Popup';
$string['showpopup_desc'] = 'Whether to show popup window to leaving users.';
$string['minpayoutamount'] = 'Minimal Payout Amount';
$string['minpayoutamount_desc'] = 'Minimal amount that can be requested as payout.';
$string['minguardtime'] = 'Minimal Guard Time';
$string['minguardtime_desc'] = 'Stop all orders if time till lesson is less than selected amount.';

$string['editlessons'] = 'Edit Lessons';
$string['editschedule'] = 'Edit Schedule';
$string['weekdays'] = 'Working Days';
$string['workhours'] = 'Working Hours';
$string['breakstarttime'] = 'Break Start Time';
$string['breakendtime'] = 'Break End Time';
$string['starttime'] = 'Lesson Start Time';
$string['endtime'] = 'Lesson End Time';

$string['emptyrating'] = 'Default Rating';
$string['emptyrating_desc'] = 'Default Rating will be shown when teacher has not yet been rated.';

$string['viewalllanguageteachers'] = 'View All {$a} Language Teachers';
$string['notfound'] = 'Teacher profile not found.';
$string['lessonnotfound'] = 'Lesson not found.';
$string['notrated'] = 'Not rated yet';
$string['rate'] = 'Rate';
$string['youropinion'] = 'Your opinion is very important to us';
$string['rating'] = '<span class="text-green">Please rate the \'{$a->name}\' lesson with {$a->teacher}:</span>
<p class="rinfo"><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> <span class="rtext">Poor</span>
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> <span class="rtext">Moderate</span>
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> <span class="rtext">Good</span>
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span> <span class="rtext">Very good</span>
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span> <span class="rtext">Excellent</span></p>';
$string['notreviewed'] = 'Not reviewed yet';
$string['viewschedule'] = 'View Schedule';
$string['booklesson'] = 'Book a lesson';
$string['bookagain'] = 'Book Again';
$string['mostbooked'] = 'Most Popular';
$string['recommended'] = 'Learners also book';
$string['booklesson_extra'] = 'See prices';
$string['viewprofile'] = 'View profile';
$string['viewreviews'] = 'View Reviews';
$string['students'] = 'Students';
$string['student'] = 'Student';
$string['teachers'] = 'Teachers';
$string['teacher'] = 'Teacher';
$string['lessons'] = 'Lessons';
$string['giftcards'] = 'Gift Cards';
$string['nolessons'] = 'You don\'t have any scheduled lessons.';
$string['trialprice'] = 'Trial Lesson Price';
$string['price'] = 'Price';
$string['totalprice'] = 'Total Price';
$string['fortrial'] = 'for trial lesson';
$string['teachersince'] = 'Teacher Since';
$string['membersince'] = 'Member Since';
$string['viewteacherprofile'] = 'View Teacher Profile';
$string['viewuserprofile'] = 'View User Profile';
$string['backtoteacherprofile'] = 'Back to Teacher Profile';
$string['editprofile'] = 'Edit Profile';
$string['changepassword'] = 'Change Password';
$string['noeducationlisted'] = 'No education listed';
$string['nooccupationlisted'] = 'No occupation listed';
$string['professionalteacher'] = 'Professional Teacher';
$string['selectlesson'] = 'Please select lesson';
$string['selectlanguage'] = 'Please select language';
$string['singletriallesson'] = 'You can only book one trial lesson';
$string['selecttime'] = 'Please select available date and time';
$string['emptycart'] = 'Your cart is empty';
$string['registerteacher'] = 'Register as a Teacher';
$string['blockdays'] = 'Block Days';
$string['blockdates'] = 'Block Date Period';
$string['blocktimes'] = 'Block Time Period';
$string['blockdatetimes'] = 'Block Date & Time Period';
$string['days'] = 'Days';
$string['dates'] = 'Dates';
$string['times'] = 'Times';
$string['step'] = 'STEP';
$string['teaching'] = 'Teaching';
$string['learning'] = 'Learning';
$string['teaches'] = 'Teaches';
$string['speaks'] = 'Speaks';
$string['learns'] = 'Learns';
$string['with'] = 'with';
$string['lessonhistory'] = 'Lesson History';
$string['teachinghistory'] = 'Teaching History';
$string['learninghistory'] = 'Learning History';
$string['transactionhistory'] = 'Transaction History';
$string['requestpayout'] = 'Request Payout';
$string['confirmrequestpayout'] = 'Confirm & Request Payout';
$string['withdrawaltype'] = 'Withdrawal Type';
$string['withdrawaltypeaccount'] = 'Bank Transfer';
$string['withdrawaltypepaypal'] = 'PayPal';
$string['accountbank'] = 'Beneficiary bank name';
$string['accountname'] = 'Beneficiary name';
$string['accountnumber'] = 'Beneficiary account number';
$string['accountaddress'] = 'Beneficiary address';
$string['accountcountry'] = 'Country';
$string['accountswift'] = 'SWIFT code';
$string['paypalemail'] = 'PayPal Email';
$string['iknumber'] = 'IK (individuālā komersanta) reģistrācijas numurs';
$string['accountnumber_desc'] = 'Customer account number or IBAN, length up to 34 alphanumeric characters.';
$string['accountswift_desc'] = 'Bank SWIFT or BIC code - bank identification code consisting of 8 or 11 symbols, 1-6 symbols are letters. The remaining bank identifiers (BIK, SORT, ABA, Fedwire, MFO, CNAPS, IFSC and other codes) must be indicated in the field "Beneficiary bank name" after the bank name.';
$string['payment'] = 'Payment';
$string['paymentstatus_expired'] = 'Your payment session has expired.<br>Payment could not be completed.';
$string['paymentstatus_error'] = 'Your payment could not be completed.';
$string['paymentstatus_init_failed'] = 'Transaction initialization failed.';
$string['topayment'] = 'Continue to Payment';
$string['paywith'] = 'Pay with';
$string['paywithcard'] = 'Pay by Card';
$string['paywithpaypal'] = 'Pay with PayPal';
// $string['payfrombalance'] = 'Pay from Balance';
$string['payfrombalance'] = 'Use Lonet balance';
$string['usebalance'] = 'Use Available Balance';
$string['paidfrombalance'] = 'Paid From Balance';
$string['remainingamount'] = 'Remaining Amount';
$string['confirmbooking'] = 'Confirm Booking';
$string['confirmandpay'] = 'Confirm and go to Payment';
$string['introduction'] = 'Introduction';
$string['videourl'] = 'Video URL';
$string['videourl_desc'] = 'YouTube embed URL for landing page video.';
$string['createdat'] = 'Created At';
$string['updatedat'] = 'Updated At';
$string['agreewith'] = 'I have read and agree with {$a}.';
$string['reference'] = 'Reference';
$string['dateandtime'] = 'Date & Time';
$string['amount'] = 'Amount';
$string['receipt'] = 'Receipt';
$string['orderreceipt'] = 'Order Receipt';
$string['payoutreceipt'] = 'Payout Request Receipt';
$string['balance'] = 'Balance';
$string['currentbalance'] = 'Current Balance';
$string['reservedamount'] = 'Reserved Amount';
$string['badgereport'] = 'Badges';
$string['balancereport'] = 'Balance Report';
$string['searchreport'] = 'Search Report';
$string['testimonialreport'] = 'Testimonials';
$string['subscriberreport'] = 'Subscribers';
$string['languagereport'] = 'Languages';

$string['lessonarchive'] = 'Lesson Archive';
$string['from'] = 'from';
$string['to'] = 'to';
$string['aboutme'] = 'About Me';
$string['interestsandhobbies'] = 'Interests and Hobbies';

$string['error_lessonnotfound'] = 'Selected lesson was not found.';
$string['error_ordernotsaved'] = 'Your order request could not be saved.';

$string['lessonchangesinfo'] = 'Any changes made will not affect those lessons, which have already been confirmed.';
$string['schedulechangesinfo'] = 'Any changes made will not affect those lessons, which have already been confirmed.';
$string['editscheduleinfo'] = '<p>
By default the calendar shows all the days and time available for lessons requests.
<br>Please choose days and times below, which you would like to block and show them as unavailable.
<br>You also  have a possibility to unblock any of the blocked period in your calendar.
</p>';
$string['edit'] = 'Edit';
$string['savechange'] = 'Save Changes';
$string['block'] = 'Block';
$string['unblock'] = 'Unblock';
$string['thankyou'] = 'Thank you';
$string['areyousure'] = 'Are you sure you want to save changes?';
$string['areyousureblock'] = 'Are you sure you want to block this time?';
$string['areyousureunblock'] = 'Are you sure you want to unblock this time?';
$string['areyousuredelete'] = 'Are you sure you want to delete your account?';
$string['changessaved'] = 'The changes have been saved.';
$string['theywillupdatecalendar'] = 'They will update your calendar immediately.';
$string['calendarhasbeenupdated'] = 'The changes have been saved. Your calendar has been updated accordingly.';
$string['changenotallowed'] = 'The requested changes are not allowed by the system.';
$string['youhavelessons'] = 'You have confirmed lessons in the affected period. Please go to your calendar and proceed with manual changes.';

$string['waitingconfirmation'] = 'Waiting for Confirmation';
$string['timeremaining'] = 'Time Remaining';
$string['approved'] = 'Approved';
$string['confirmed'] = 'Confirmed';
$string['confirm'] = 'Confirm';
$string['confirmascompleted'] = 'Confirm as Completed';
$string['markcompleted'] = 'Mark as Completed';
$string['marknotcompleted'] = 'Mark as Not Completed';
$string['declined'] = 'Declined';
$string['decline'] = 'Decline';
$string['canceled'] = 'Canceled';
$string['expired'] = 'Expired';
$string['cancel'] = 'Cancel';
$string['canceledbylearner'] = 'Canceled by Learner';
$string['canceledbyteacher'] = 'Canceled by Teacher';
$string['completed'] = 'Completed';
$string['notcompleted'] = 'Not Completed';
$string['contactlearner'] = 'Contact Learner';
$string['contactteacher'] = 'Contact Teacher';
$string['language'] = 'Language';
$string['teacherreport'] = 'Teacher Report';
$string['orderreport'] = 'Order Report';
$string['cashreport'] = 'Cash Report';
$string['payoutreport'] = 'Payout Report';
$string['promoreport'] = 'Promo Codes';
$string['promocode'] = 'Promo Code';
$string['promocodenotfound'] = 'Promo Code not found.';
$string['promocodenotvalid'] = 'Promo Code is no longer valid.';
$string['apply'] = 'Apply';
$string['code'] = 'Code';
$string['type'] = 'Type';
$string['amounteuro'] = 'Amount, &euro;';
$string['discounteuro'] = 'Discount, &euro;';
$string['discountpercent'] = 'Discount, %';
$string['lessoncountperlearner'] = 'Max Lessons per Learner';
$string['lessoncount'] = 'Max Lessons';
$string['validthrough'] = 'Valid Through';
$string['isactive'] = 'Is Active';
$string['lessonid'] = 'Lesson ID';
$string['booknextlesson'] = 'Book Next Lesson';
$string['commission'] = 'Commission';
$string['available'] = 'available';
$string['payouttoteacher'] = 'Payout to Teacher';
$string['h1_teacher_list'] = 'Language Teachers Online';
$string['h1_teacher_list_group'] = 'Language Courses and Classes in Small Groups';
$string['languageteachers'] = 'Language Teachers';
$string['languagetutors'] = '{$a} Language Tutors Online'; //{$a} Language Private Online Tutors
$string['deletemyaccount'] = 'Delete My Account';
$string['youcannotdeleteaccount'] = 'You cannot delete your account at this time because you have scheduled lessons!';
$string['confirmdeletion'] = 'An email has been sent to you containing a link to confirm and complete your account deletion.';
$string['invaliddeletiontoken'] = 'Deletion token is invalid.';
$string['youraccountdeleted'] = 'Your account has been deleted.';
$string['addtowallet'] = 'Add To Wallet';

$string['whatisyourreasonfordecline'] = 'What is your reason for declining';
$string['whatisyourreasonforcancel'] = 'What is your reason for canceling';
$string['whatisyourreasonfornotcomplete'] = 'What is your reason for marking this lesson as not completed';

$string['lessonstatus_confirm'] = 'Lesson on {$a->date} at {$a->time} has been confirmed.';
$string['lessonstatus_decline'] = 'Lesson request on {$a->date} at {$a->time} has been declined.';
$string['lessonstatus_cancel'] = 'Lesson on {$a->date} at {$a->time} has been canceled.';
$string['lessonstatus_complete'] = 'Lesson on {$a->date} at {$a->time} has been marked as completed.';
$string['lessonstatus_notcomplete'] = 'Lesson on {$a->date} at {$a->time} has been marked as not completed.';

$string['popuptitle'] = 'Wait! Get your voucher';
$string['popupsubtitle'] = 'Free English Lessons';
$string['popupemailtitle'] = 'Leave your email:';
$string['popupbutton'] = 'Yes, I want free English lessons';

$string['leaveyourreview'] = 'leave your review';

$string['email_subscriber_subject'] = 'Free English Course on LONET';
$string['subscriber_title'] = 'Thank you for subscribing for<br><b>FREE English Course</b> on LONET !';
$string['hello'] = 'Hello';
$string['subscriber_thankyou'] = 'Thank you for visiting <a href="https://lonet.academy" style="color:#499306;text-decoration:none;"><b>Lonet.Academy</b></a>.';
$string['subscriber_news'] = 'Great news! Only till <b>31.08.2018</b> we are launching a FREE On-line English language course for NEW members of LONET. In order to assign You to the group, we need to test your level of English first.';
$string['subscriber_step1'] = 'Step 1: <b>Till 31.08.2018 register on LONET</b>: <a href="https://lonet.academy/login/signup.php" style="color:#499306;text-decoration:none;"><b>here</b></a>';
$string['subscriber_step2'] = 'Step 2: <b>Book the trial lesson</b> On-line with <a href="https://lonet.academy/teacher/3" style="color:#499306;text-decoration:none;"><b>Kristine Baltach</b></a>';
$string['subscriber_step3'] = 'Step 3: Wait for the Teacher’s confirmation on your email in 24 hours!';
$string['subscriber_lessonnote'] = 'Choose the “trial lesson” button and the day and time on the calendar, availabe and comfortable for You.  Then press the button “Confirm and go to payment”.';
$string['subscriber_paymentnote'] = '<b>For payment</b>, please use this PROMO CODE: <b>CHBAL03</b>';
$string['subscriber_footer'] = '
    <p>Welcome to LONET - Language Online Network !!! Don’t miss the opportunity and join LONET today! <span style="font-size: 18px;">☺</span></p>
    <p>In case you have doubts or any questions, don’t hesitate to contact us.</p>
';
$string['subscriber_signature'] = 'Lonet.Academy Team<br><br><a href="mailto:lonet@lonet.academy">lonet@lonet.academy</a><br><a href="tel:37127344201">+371 27 344 201</a><span style="font-size:12px;">10:00 - 22:00 (GMT+2)</span>';

$string['listpromo_en'] = 'To <strong>learn English</strong> is <strong>easy</strong> with the <strong>professional online English language Tutors and Teachers</strong> on LONET! Take several trial lessons, choose the best Tutor for you, book a 10 classes English course and You will notice the result.';
$string['listdesc_en'] = '
    <p class="text-center"><u>Learn English Language on Language Online Network</u></p>
    <p>
        <strong>Learn English online</strong> with the <strong>native speaking English Tutors and Teachers</strong> on LONET.
        Take <strong>English lessons by Skype</strong> and learn English remotely from any place in the world:
    </p>
    <p>
        <ul>
            <li>after the 1st trial lesson You will understand your goals, motivation and your level of English language knowledge. Decide if the <strong>language Tutor</strong> meets your needs and expectations and choose the most appropriate <strong>English Tutor</strong> for you;</li>
            <li>After 2 lessons with the <strong>best English Tutor</strong> you have chosen,  you will feel more comfortable <strong>speaking English</strong>, because our <strong>professional English language Tutors</strong> provide you the opportunity to speak a lot during the one-on-one <strong>English online lesson</strong>;</li>
            <li>After 3 lessons You will notice that you are becoming much more <strong>confident speaking English</strong> because the <strong>English language Tutors</strong> give you the best one-on-one <strong>English speaking practice by Skype</strong> in a real authentic context;</li>
            <li>After 5 <strong>English online lessons</strong> You will <strong>improve your English pronunciation</strong> and will <strong>speak English confidently</strong>;</li>
            <li>After an <strong>online English</strong> course of 10 lessons with the <strong>best English professional Tutors</strong> on LONET you will <strong>communicate in English</strong> clearly, will be able to understand English speakers and will be <strong>confident speaking English</strong>.</li>
        </ul>
    </p>
    <p class="text-center"><u>Choose The Best Private English Teacher For You</u></p>
    <p>There is a choice of <strong>English online Tutors</strong> for you:</p>
    <p>
        <ul>
            <li><strong>English Tutors</strong> with CELTA, TEFEL, TESOL and other professionsl teaching degrees from all over the world;</li>
            <li>UK <strong>English native speakers – professtional English language Tutors from the UK</strong>;</li>
            <li>USA <strong>English native speakers – Online English Tutors from the USA</strong>;</li>
            <li>Experienced and <strong>Certified Online English language Tutors</strong> from all over the world.</li>
        </ul>
    </p>
    <p class="text-center"><u>Imrove Your English Language Skills</u></p>
    <p>Take <strong>one-on-one English lessons by Skype</strong> with the native English speakers and You will improve your conversational language skills fast and easy. <strong>One-on-one English speaking practice</strong> is the best way to empower your confidence in English and improve your speaking and listening skills.</p>
    <p>The best <strong>professional English language Tutors</strong> on LONET will help you with the speciffic individual needs, such as:</p>
    <p>
        <ul>
            <li>academic writing in English;</li>
            <li>course of Business English, including:</li>
        </ul>
    </p>
    <p>
        business terminology in English, writing business proposals in English, business correspondence in English, professional profile on LinkedIn, CV, motivations letters in English, etc.
    </p>
    <p>
        <ul>
            <li>English for travelling;</li>
        </ul>
    </p>
    <p>All the lessons on LONET are one-on-one and are tailored according to your individual needs.  
    <p>Take advantage of <strong>English lessons online</strong> with the <strong>best professional Tutors by Skype</strong> today! 
    <p><strong>Learn English fast and easy</strong> from any place in the world!</p>
';

$string['h1_signup'] = 'Create Account On Lonet.Academy';

$string['meta_title_home'] = 'Online Language Tutors - Learn Languages Fast | Online courses on LONET';
$string['meta_description_home'] = 'Learn languages fast and easy Online. The best Language Tutors on lonet.academy! Choose a tutor. Book a trial lesson. And continue to learn a language online. One-on-one classes with the best native tutors.';

$string['meta_title_teacher'] = '{$a} - Online Language Tutor | Lonet.Academy';
$string['meta_description_teacher'] = '{$a->languages} tutor from {$a->location}. Learn {$a->languages} with {$a->name} by Skype | Language lessons on Lonet.Academy. Book your lesson with {$a->full_name} now!';
$string['h1_teacher'] = '{$a} - Online Language Tutor';

$string['listpromo_aa'] = '';
$string['listdesc_aa'] = '';
$string['meta_title_teacher_list_aa'] = '';
$string['meta_description_teacher_list_aa'] = '';
$string['listpromo_ab'] = '';
$string['listdesc_ab'] = '';
$string['meta_title_teacher_list_ab'] = '';
$string['meta_description_teacher_list_ab'] = '';
$string['listpromo_ae'] = '';
$string['listdesc_ae'] = '';
$string['meta_title_teacher_list_ae'] = '';
$string['meta_description_teacher_list_ae'] = '';
$string['listpromo_af'] = '';
$string['listdesc_af'] = '';
$string['meta_title_teacher_list_af'] = '';
$string['meta_description_teacher_list_af'] = '';
$string['listpromo_ak'] = '';
$string['listdesc_ak'] = '';
$string['meta_title_teacher_list_ak'] = '';
$string['meta_description_teacher_list_ak'] = '';
$string['listpromo_am'] = '';
$string['listdesc_am'] = '';
$string['meta_title_teacher_list_am'] = '';
$string['meta_description_teacher_list_am'] = '';
$string['listpromo_an'] = '';
$string['listdesc_an'] = '';
$string['meta_title_teacher_list_an'] = '';
$string['meta_description_teacher_list_an'] = '';
$string['listpromo_ar'] = '';
$string['listdesc_ar'] = '';
$string['meta_title_teacher_list_ar'] = '';
$string['meta_description_teacher_list_ar'] = '';
$string['listpromo_ar_ae'] = '';
$string['listdesc_ar_ae'] = '';
$string['meta_title_teacher_list_ar_ae'] = '';
$string['meta_description_teacher_list_ar_ae'] = '';
$string['listpromo_ar_bh'] = '';
$string['listdesc_ar_bh'] = '';
$string['meta_title_teacher_list_ar_bh'] = '';
$string['meta_description_teacher_list_ar_bh'] = '';
$string['listpromo_ar_dz'] = '';
$string['listdesc_ar_dz'] = '';
$string['meta_title_teacher_list_ar_dz'] = '';
$string['meta_description_teacher_list_ar_dz'] = '';
$string['listpromo_ar_eg'] = '';
$string['listdesc_ar_eg'] = '';
$string['meta_title_teacher_list_ar_eg'] = '';
$string['meta_description_teacher_list_ar_eg'] = '';
$string['listpromo_ar_iq'] = '';
$string['listdesc_ar_iq'] = '';
$string['meta_title_teacher_list_ar_iq'] = '';
$string['meta_description_teacher_list_ar_iq'] = '';
$string['listpromo_ar_jo'] = '';
$string['listdesc_ar_jo'] = '';
$string['meta_title_teacher_list_ar_jo'] = '';
$string['meta_description_teacher_list_ar_jo'] = '';
$string['listpromo_ar_kw'] = '';
$string['listdesc_ar_kw'] = '';
$string['meta_title_teacher_list_ar_kw'] = '';
$string['meta_description_teacher_list_ar_kw'] = '';
$string['listpromo_ar_lb'] = '';
$string['listdesc_ar_lb'] = '';
$string['meta_title_teacher_list_ar_lb'] = '';
$string['meta_description_teacher_list_ar_lb'] = '';
$string['listpromo_ar_ly'] = '';
$string['listdesc_ar_ly'] = '';
$string['meta_title_teacher_list_ar_ly'] = '';
$string['meta_description_teacher_list_ar_ly'] = '';
$string['listpromo_ar_ma'] = '';
$string['listdesc_ar_ma'] = '';
$string['meta_title_teacher_list_ar_ma'] = '';
$string['meta_description_teacher_list_ar_ma'] = '';
$string['listpromo_ar_om'] = '';
$string['listdesc_ar_om'] = '';
$string['meta_title_teacher_list_ar_om'] = '';
$string['meta_description_teacher_list_ar_om'] = '';
$string['listpromo_ar_qa'] = '';
$string['listdesc_ar_qa'] = '';
$string['meta_title_teacher_list_ar_qa'] = '';
$string['meta_description_teacher_list_ar_qa'] = '';
$string['listpromo_ar_sa'] = '';
$string['listdesc_ar_sa'] = '';
$string['meta_title_teacher_list_ar_sa'] = '';
$string['meta_description_teacher_list_ar_sa'] = '';
$string['listpromo_ar_sy'] = '';
$string['listdesc_ar_sy'] = '';
$string['meta_title_teacher_list_ar_sy'] = '';
$string['meta_description_teacher_list_ar_sy'] = '';
$string['listpromo_ar_tn'] = '';
$string['listdesc_ar_tn'] = '';
$string['meta_title_teacher_list_ar_tn'] = '';
$string['meta_description_teacher_list_ar_tn'] = '';
$string['listpromo_ar_ye'] = '';
$string['listdesc_ar_ye'] = '';
$string['meta_title_teacher_list_ar_ye'] = '';
$string['meta_description_teacher_list_ar_ye'] = '';
$string['listpromo_as'] = '';
$string['listdesc_as'] = '';
$string['meta_title_teacher_list_as'] = '';
$string['meta_description_teacher_list_as'] = '';
$string['listpromo_av'] = '';
$string['listdesc_av'] = '';
$string['meta_title_teacher_list_av'] = '';
$string['meta_description_teacher_list_av'] = '';
$string['listpromo_ay'] = '';
$string['listdesc_ay'] = '';
$string['meta_title_teacher_list_ay'] = '';
$string['meta_description_teacher_list_ay'] = '';
$string['listpromo_az'] = '';
$string['listdesc_az'] = '';
$string['meta_title_teacher_list_az'] = '';
$string['meta_description_teacher_list_az'] = '';
$string['listpromo_ba'] = '';
$string['listdesc_ba'] = '';
$string['meta_title_teacher_list_ba'] = '';
$string['meta_description_teacher_list_ba'] = '';
$string['listpromo_be'] = '';
$string['listdesc_be'] = '';
$string['meta_title_teacher_list_be'] = '';
$string['meta_description_teacher_list_be'] = '';
$string['listpromo_bg'] = '';
$string['listdesc_bg'] = '';
$string['meta_title_teacher_list_bg'] = '';
$string['meta_description_teacher_list_bg'] = '';
$string['listpromo_bh'] = '';
$string['listdesc_bh'] = '';
$string['meta_title_teacher_list_bh'] = '';
$string['meta_description_teacher_list_bh'] = '';
$string['listpromo_bi'] = '';
$string['listdesc_bi'] = '';
$string['meta_title_teacher_list_bi'] = '';
$string['meta_description_teacher_list_bi'] = '';
$string['listpromo_bm'] = '';
$string['listdesc_bm'] = '';
$string['meta_title_teacher_list_bm'] = '';
$string['meta_description_teacher_list_bm'] = '';
$string['listpromo_bn'] = '';
$string['listdesc_bn'] = '';
$string['meta_title_teacher_list_bn'] = '';
$string['meta_description_teacher_list_bn'] = '';
$string['listpromo_bo'] = '';
$string['listdesc_bo'] = '';
$string['meta_title_teacher_list_bo'] = '';
$string['meta_description_teacher_list_bo'] = '';
$string['listpromo_br'] = '';
$string['listdesc_br'] = '';
$string['meta_title_teacher_list_br'] = '';
$string['meta_description_teacher_list_br'] = '';
$string['listpromo_bs'] = '';
$string['listdesc_bs'] = '';
$string['meta_title_teacher_list_bs'] = '';
$string['meta_description_teacher_list_bs'] = '';
$string['listpromo_ca'] = '';
$string['listdesc_ca'] = '';
$string['meta_title_teacher_list_ca'] = '';
$string['meta_description_teacher_list_ca'] = '';
$string['listpromo_ce'] = '';
$string['listdesc_ce'] = '';
$string['meta_title_teacher_list_ce'] = '';
$string['meta_description_teacher_list_ce'] = '';
$string['listpromo_ch'] = '';
$string['listdesc_ch'] = '';
$string['meta_title_teacher_list_ch'] = '';
$string['meta_description_teacher_list_ch'] = '';
$string['listpromo_co'] = '';
$string['listdesc_co'] = '';
$string['meta_title_teacher_list_co'] = '';
$string['meta_description_teacher_list_co'] = '';
$string['listpromo_cr'] = '';
$string['listdesc_cr'] = '';
$string['meta_title_teacher_list_cr'] = '';
$string['meta_description_teacher_list_cr'] = '';
$string['listpromo_cs'] = '';
$string['listdesc_cs'] = '';
$string['meta_title_teacher_list_cs'] = '';
$string['meta_description_teacher_list_cs'] = '';
$string['listpromo_cu'] = '';
$string['listdesc_cu'] = '';
$string['meta_title_teacher_list_cu'] = '';
$string['meta_description_teacher_list_cu'] = '';
$string['listpromo_cv'] = '';
$string['listdesc_cv'] = '';
$string['meta_title_teacher_list_cv'] = '';
$string['meta_description_teacher_list_cv'] = '';
$string['listpromo_cy'] = '';
$string['listdesc_cy'] = '';
$string['meta_title_teacher_list_cy'] = '';
$string['meta_description_teacher_list_cy'] = '';
$string['listpromo_da'] = '';
$string['listdesc_da'] = '';
$string['meta_title_teacher_list_da'] = '';
$string['meta_description_teacher_list_da'] = '';
$string['listpromo_de'] = '';
$string['listdesc_de'] = '';
$string['meta_title_teacher_list_de'] = '';
$string['meta_description_teacher_list_de'] = '';
$string['listpromo_dv'] = '';
$string['listdesc_dv'] = '';
$string['meta_title_teacher_list_dv'] = '';
$string['meta_description_teacher_list_dv'] = '';
$string['listpromo_dz'] = '';
$string['listdesc_dz'] = '';
$string['meta_title_teacher_list_dz'] = '';
$string['meta_description_teacher_list_dz'] = '';
$string['listpromo_ee'] = '';
$string['listdesc_ee'] = '';
$string['meta_title_teacher_list_ee'] = '';
$string['meta_description_teacher_list_ee'] = '';
$string['listpromo_el'] = '';
$string['listdesc_el'] = '';
$string['meta_title_teacher_list_el'] = '';
$string['meta_description_teacher_list_el'] = '';
$string['listpromo_en'] = '';
$string['listdesc_en'] = '';
$string['meta_title_teacher_list_en'] = '';
$string['meta_description_teacher_list_en'] = '';
$string['listpromo_en_us'] = '';
$string['listdesc_en_us'] = '';
$string['meta_title_teacher_list_en_us'] = '';
$string['meta_description_teacher_list_en_us'] = '';
$string['listpromo_eo'] = '';
$string['listdesc_eo'] = '';
$string['meta_title_teacher_list_eo'] = '';
$string['meta_description_teacher_list_eo'] = '';
$string['listpromo_es'] = '';
$string['listdesc_es'] = '<!-- wp:heading -->

<h2>How Can I Learn Spanish Online?</h2>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Spanish is one of the most widely spoken languages in the world, with 460 million native speakers. Spain itself welcomes 84 million visitors in an average year – that’s almost twice the population of the country! And with good news around the world in relation to the roll out of corona virus vaccines, it looks like 2021 may indeed be the year that we get to enjoy the wonders of travel once more.</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>If you’re looking at heading to Spain for a holiday this year or next year, now is the time to start getting to grips with the language. Simply learning some basics will set you in good stead and is welcomed by people in all the tourist hot spots. If you like to venture off the beaten track to explore the culture, you might want to go into greater depth with your learning. But one thing is for sure – whether you know a little or a lot, you’ll feel far more prepared and far more comfortable if you can communicate, understand directions and read the menu while abroad.</p>

<!-- /wp:paragraph -->



<!-- wp:heading -->

<h2>Can I learn Spanish online for free?</h2>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>The internet has a <a href="http://www.bbc.co.uk/languages/spanish/" target="_blank" rel="noreferrer noopener">wealth of online resources to help you learn online basic Spanish</a>, but to learn the language completely for free would take an awful long time and a lot of dedication. Learning any language is a case of trial and error. It’s perfectly natural to say the wrong word, mispronounce something or make grammatical mistakes. It’s part of how we learn. But you will only improve if you know when and how you have gone wrong. Trying to teach yourself completely from scratch is like being taught by an unqualified teacher. So, <a href="https://lonet.academy/blog/learn-language-with-tutors-online/" target="_blank" rel="noreferrer noopener">the best way to learn Spanish is to take Spanish classes online</a> and use the free resources available to complement and enhance your learning.</p>

<!-- /wp:paragraph -->



<!-- wp:heading -->

<h2>How do online Spanish classes work?</h2>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Online Spanish classes work just like face-to-face classes. You can find Spanish lessons online for different levels of ability from beginner to advanced, and many online Spanish tutors will offer a variety of course according to your needs. You will be taught a range of words, phrases, grammar rules at each session and you’ll also have the opportunity to speak Spanish and listen to your tutor and other students. Spanish conversation classes online are a great way to improve your speaking and listening skills. Hearing the mistakes others make will hone your ear and help you improve your own speaking ability. And you’ll make friends with a similar interest. This sense of community is a great source of encouragement, particularly with the aspects of language learning which you find most difficult, and many students chat online in Spanish amongst themselves in between lessons which is sociable and a useful way to help you learn Spanish more quickly.</p>

<!-- /wp:paragraph -->



<p><!-- MailerLite Universal --><br>

<!-- End MailerLite Universal --></p>



<!-- wp:heading {"level":3} -->

<h3>Are there online Spanish classes for children and adolescents?</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>There are many tutors who specialize in teaching Spanish online to young people. This can be done as an extracurricular activity or to help them with GCSE and A Level Spanish. Of course, when looking for a teacher for young people, you’ll want to make sure the are fully vetted and have a track record of delivering results. Check out our list of online Spanish tutors to for access to a host of reputable online Spanish courses to suit all levels.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>Spanish classes on Skype</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>It’s well documented that 1-2-1 learning gives you the greatest access to your tutor’s teaching skills. 1-2-1 is the fastest way to learn Spanish online as your tutor will be totally focused on your learning. You can find online Spanish tutors who offer 1-2-1 teaching by searching the internet. If you choose this method, it’s recommended that you also find sites where you can interact with other learners to speak Spanish and to connect with like-minded people who will support you when the going gets tough.&nbsp; You should also use other free online learning resources to help you embed your learning.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>Preparation for Spanish exams DELE/SIELE</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Learning a language and preparing for an exam are two different skills. If you’re preparing for the DELE certificate or the SIELE (International Spanish Language Evaluation Service) exam, online Spanish lessons are a great way to polish your skills. Online Spanish tutors will help you improve your reading, writing, speaking and listening through lessons and can also help you understand how the exams work to give you confidence and peace of mind. You’ll get access to practice papers too so you’ll know just what to expect when it comes to the real thing.</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>There is no doubt that learning a new language is great for your confidence and for keeping your mind active. But it also <a href="https://lonet.academy/blog/career-opportunities-for-foreign-language-learners-the-future-of-work/" target="_blank" rel="noreferrer noopener">opens up new opportunities</a>. There are the obvious ones such as adding a new skill to your CV and working in Spanish speaking countries, but even if you only want to go on holiday to Spain and have no intention of living or working there, you can still gain added benefits from speaking the language. You’ll feel more confident to venture away from the major tourist areas and see the ‘real Spain’ and when it comes to travelling around the country, you’ll be able to read signs, understand announcements and converse with people who don’t speak English. Spanish language and culture are full of joy and passion. Being able to speak the language makes any trip to Spain more rewarding.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>Learn Spanish online with the best Spanish Tutors</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Our choice of experienced Spanish language tutors from all over the world provides you with the possibility to find&nbsp;<strong>the best Spanish language tutor</strong>&nbsp;for you. You can select and choose according to:</p>

<!-- /wp:paragraph -->



<!-- wp:list -->

<ul><li>your time zone,</li><li>personal motivation,</li><li>other preferences you might have (practising Spanish language for some specific events in your life),</li><li>language preference (for example, if you are a French speaker and you would like to find <a href="https://lonet.academy/language-teachers/spanish-tutors-online/1052" target="_blank" rel="noreferrer noopener">a Spanish tutor who speaks and understands French) </a></li><li>price expectation,</li><li>individual schedule and pace of learning,</li><li>specific needs (Spanish language for work in a specific industry),</li><li>and others (Spanish language for studies), ...</li></ul>

<!-- /wp:list -->



<!-- wp:paragraph -->

<p>Spanish language is&nbsp;<strong>the world’s second most spoken native language</strong>&nbsp;and the fourth most spoken language in the world. So, no surprise that Spanish is one of the most desirable&nbsp;<strong>foreign languages</strong>&nbsp; to learn by many. How to learn Spanish fast and easily? -  With your personal Spanish language tutor at Lonet.Academy by Skype from any place in the world.</p>

<!-- /wp:paragraph -->



<!-- wp:heading -->

<h2>Here are 4 Basic Steps To Learn Spanish Language Fast</h2>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Often known also as&nbsp;<strong>Castellano</strong>&nbsp;or Castillian, this is&nbsp;<strong><em>the native tongue of almost 500 million people</em></strong>&nbsp;in Spain and South America.&nbsp; Spanish is also a&nbsp;<strong>global language</strong>.&nbsp; In fact, it is one of the six&nbsp;<a rel="noreferrer noopener" href="https://www.un.org/en/sections/about-un/official-languages/index.html#:~:text=There%20are%20six%20official%20languages,%2C%20French%2C%20Russian%20and%20Spanish." target="_blank"><strong>languages of the United Nations</strong>.</a> Whether you are planning to travel to a Spanish speaking region or you want to follow Spanish telenovelas. Whether you love Spanish songs or simply want to acquire a beautiful&nbsp;<strong>second language</strong>, the question is how to learn Spanish fast? Here are some tips that will help you accelerate your learning curve to being as close to a native&nbsp;<strong>Español</strong>&nbsp;as possible.</p>

<!-- /wp:paragraph -->



<!-- wp:image {"id":2085,"sizeSlug":"full"} -->

<figure class="wp-block-image size-full"><img src="https://lonet.academy/blog/wp-content/uploads/2020/07/Spanish-language-04.png" alt="Learn Spanish language fast and easily. Steps recommended by Lonet.Academy Spanish tutors online. Online Spanish classes." class="wp-image-2085"><figcaption>How to learn Spanish fast? - Take individual online Spanish classes with the best Spanish tutors at Lonet.Academy</figcaption></figure>

<!-- /wp:image -->



<!-- wp:heading {"level":3} -->

<h3>1. Develop Your Spanish Vocabulary Bank  | Spanish tutors online </h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Did you know that just over 1,000 Spanish words are used most frequently to account for roughly 88% of spoken Spanish? Thus said, it is imperative to&nbsp;<strong><em>build your vocabulary in Spanish and know the basic words&nbsp;</em></strong>needed for day-to-day conversation.&nbsp; As Spanish has absorbed a great deal of vocabulary from other languages, you will most likely find words that are very similar to familiar terminologies used across the various lingua franca. Spanish has imported the vocabulary from the defunct Latin to Arabic and a host of European tongues and the&nbsp;<strong><a href="https://www.britannica.com/topic/Romance-languages" target="_blank" rel="noreferrer noopener">Romance language</a></strong>.</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>A nice and practical suggestion is to absorb Spanish in your daily life, identifying objects with their Spanish equivalent. You will find cognates in English such as "actor", "balance", "carbon" and words like "explosion", "radio" and "religion". These kind of words are really very similar to their English counterparts. </p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>But note that when these words are spoken, they will sound different in the Spanish language. Which brings us to our next important tip on&nbsp;<strong>how to learn Spanish fast</strong>:</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>2. Master Pronunciation of Spanish Words with Spanish tutors online</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>In learning&nbsp;<strong>Spanish as a foreign language</strong>, this is a very important point we must remember. There is a marked difference between the pronunciation of Spanish words in comparison to English. Although they might appear the same when spelled.</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>For instance, there are no long or short vowel sounds, only ah, eh, ee, oh, oo for the vowels A, E, I, O, U. Despite this, it is not a rule that vowels are abruptly read. Actual enunciation may entail it to be short or drawn out in a conversation.&nbsp; You can learn word for word pronunciation on many online Spanish flashcard apps.</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>Also, one must take into account that the pronunciation differs from one region to another, depending on the regional accent. Thus, it is really worth to distinguish which accent of Spanish you would like to learn in order to choose the right audio materials. The professional and individual Spanish online will help you to choose the proper audio learning materials. The tutor will explain to you the differences between the pronunciation in distinct areas of Spanish speaking world.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>3. Self-study and Learn the Sentences BUT DO NOT Fixate on the Grammar</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>Without underestimating the importance of grammar in Spanish, try to learn the most common Spanish sentences used in daily living.&nbsp; Although Spanish grammar is not similar to the English language grammar, there is no pressure for a learner to be perfect in grammar. Nevertheless, the basics are important, of course. Such as:</p>

<!-- /wp:paragraph -->



<!-- wp:list -->

<ul><li><a href="https://www.youtube.com/watch?v=v9ZqCrgQ_sg" target="_blank" rel="noreferrer noopener">gender of the nouns in Spanish language</a>;</li><li><a href="https://www.youtube.com/watch?v=WS27SpFRxeA" target="_blank" rel="noreferrer noopener">singular and plural forms</a>;</li><li><a href="https://www.youtube.com/watch?v=hfWcAgihqVw" target="_blank" rel="noreferrer noopener">conjugation of the verbs</a>&nbsp;in present tense and in future (<a href="https://www.youtube.com/watch?v=VUCYA0SC_Fw&amp;t=860s" target="_blank" rel="noreferrer noopener">futuro imperfecto</a>);</li><li>how to form&nbsp;<a href="https://www.youtube.com/watch?v=OBqeK8o0gzw" target="_blank" rel="noreferrer noopener">simple future form in Spanish</a>;</li><li><a href="https://www.youtube.com/watch?v=ECCzYbYmNgQ" target="_blank" rel="noreferrer noopener">word order in Spanish&nbsp;</a>language;</li><li>forms of&nbsp;<a href="https://www.youtube.com/watch?v=GCouOk34gDk" target="_blank" rel="noreferrer noopener">irregular verbs in Spanish language</a>;</li><li>difference between some specific verbs, for instance<a href="https://www.youtube.com/watch?v=edISRdcDBG0" target="_blank" rel="noreferrer noopener">&nbsp;"ser" and "estar"</a>.</li></ul>

<!-- /wp:list -->



<!-- wp:paragraph -->

<p>Try to learn as many of these as you can in order to familiarise yourself more to the nuances of the language. At the same time don\'t be afraid to make mistakes. Grammar must not be an obstacle to start the communication.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>4. Expose Yourself to Spanish Media | Spanish language on TV and social networks</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>For this step, you need not look further than the internet. Spanish is&nbsp;<strong>the third most used language on the internet</strong>.&nbsp;So, there is no shortage of shows, music videos, children’s shows, news and other forms of entertainment that you can follow.&nbsp;</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>This will train your ear to catch the language spoken at a normal or even faster pace plus aid you to coin phrases and sentences.&nbsp; It is also a simpler way to be acquainted with colloquial terms and slang unique to each Spanish speaking region.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":4} -->

<h4><strong>Practice Enunciating Spanish Phrases and Sentences</strong> with Spanish tutors online</h4>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>In an authentic conversation remember that Spanish speaking people speak  really fast. Thus a word in Spanish may sound differently when in a phrase or sentence and may be audibly distinct in fast Spanish conversation.&nbsp; Watching Spanish media subtitled in Spanish will enable you to catch that. Furthermore while reading and hearing the sounds simultaneously its easier for you to identify familiar vocabulary and hear how it is pronounced in a rapid speech.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":4} -->

<h4>Learn Spanish faster:&nbsp;Converse with Native Spanish Speakers as Often as You Can!</h4>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>The goal of every language learner is speaking as naturally as the native speaker.&nbsp; This can be achieved through practice.&nbsp; If having&nbsp;<strong>Spanish native tutors</strong>&nbsp;is not accessible to you, there are platforms to&nbsp;<strong>learn Spanish online</strong>&nbsp;which you can enlist to help you master the language.&nbsp;</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>However, it is very important to find a reliable and certified site in order not to waste valuable time, money and effort.&nbsp; It is crucial that a learner knows&nbsp;<strong>where to find Spanish tutors</strong>&nbsp;that will effectively improve speaking and listening ability.</p>

<!-- /wp:paragraph -->



<!-- wp:heading {"level":3} -->

<h3>Learn Spanish fast in order to work with the Spanish speaking markets.</h3>

<!-- /wp:heading -->



<!-- wp:paragraph -->

<p>The best Spanish tutors on Lonet.Academy will help you with the specific individual needs, such as:</p>

<!-- /wp:paragraph -->



<!-- wp:list -->

<ul><li>Lessons of business correspondence in Spanish;</li><li>Language online course of&nbsp;<strong>Business Spanish</strong>;</li><li><strong>Classes of business and commerce terminology in Spanish</strong>;</li><li>writing business proposals and offers in Spanish language;</li><li>professional profile or company’s presentation;</li><li>CV, motivations letters for Spanish job market, etc;</li><li><strong>Spanish for business</strong>&nbsp;trips and travelling.</li></ul>

<!-- /wp:list -->



<!-- wp:paragraph -->

<p>In this individualised platform, your learning experience is customised via one-on-one language instruction with&nbsp;<strong>Spanish tutors via Skype</strong>.&nbsp; You can move at your own pace and control the schedule as well as the learning process. There are instructors for every level of learning, so whether you are a beginner or someone wanting to level up on your language, Lonet.Academy is your best choice on&nbsp;<strong>how to learn Spanish fast.</strong></p>

<!-- /wp:paragraph -->



<!-- wp:paragraph {"align":"center"} -->

<p class="has-text-align-center">_______________________________________________________</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>Read Lonet.Academy blog how to learn languages. Related articles:</p>

<!-- /wp:paragraph -->



<!-- wp:image {"id":216,"sizeSlug":"large"} -->

<figure class="wp-block-image size-large"><a href="https://lonet.academy/blog/fun-ways-to-learn-spanish/" target="_blank" rel="noopener noreferrer"><img src="https://lonet.academy/blog/wp-content/uploads/2019/03/Spanish-Hola.jpg" alt="5 fun ways to learn Spanish language" class="wp-image-216"></a><figcaption><a href="https://lonet.academy/blog/fun-ways-to-learn-spanish/" target="_blank" rel="noreferrer noopener">5 fun ways to learn Spanish.</a></figcaption></figure>

<!-- /wp:image -->



<!-- wp:paragraph -->

<p> <a rel="noreferrer noopener" href="https://lonet.academy/blog/learn-spanish-language-for-work/" target="_blank">Learn Spanish to get good job </a>in international company! </p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p>Formula from <a rel="noreferrer noopener" href="https://lonet.academy/blog/how-to-learn-a-language-fast-and-easy/" target="_blank">Lonet.Academy on how to learn a language quickly</a>.</p>

<!-- /wp:paragraph -->



<!-- wp:paragraph -->

<p><a rel="noreferrer noopener" href="https://lonet.academy/blog/learn-languages-for-career-opportunities/" target="_blank">Learn a language and see what happens in your life</a>.</p>

<!-- /wp:paragraph -->



<!-- wp:image {"id":1877,"sizeSlug":"large"} -->

<figure class="wp-block-image size-large"><a href="https://lonet.academy/language-gift-cards" target="_blank" rel="noopener noreferrer"><img src="https://lonet.academy/blog/wp-content/uploads/2020/06/giftcard_lonetFin05-1024x609.png" alt="Buy a gift card for private language classes online at Lonet.Academy" class="wp-image-1877"></a><figcaption>Buy a gift card for private language classes online at Lonet.Academy. A gift of a knowledge is the best present you can give to your friends, family and colleagues! </figcaption></figure>';
$string['meta_title_teacher_list_es'] = '';
$string['meta_description_teacher_list_es'] = '';
$string['listpromo_et'] = '';
$string['listdesc_et'] = '';
$string['meta_title_teacher_list_et'] = '';
$string['meta_description_teacher_list_et'] = '';
$string['listpromo_eu'] = '';
$string['listdesc_eu'] = '';
$string['meta_title_teacher_list_eu'] = '';
$string['meta_description_teacher_list_eu'] = '';
$string['listpromo_fa'] = '';
$string['listdesc_fa'] = '';
$string['meta_title_teacher_list_fa'] = '';
$string['meta_description_teacher_list_fa'] = '';
$string['listpromo_ff'] = '';
$string['listdesc_ff'] = '';
$string['meta_title_teacher_list_ff'] = '';
$string['meta_description_teacher_list_ff'] = '';
$string['listpromo_fi'] = '';
$string['listdesc_fi'] = '';
$string['meta_title_teacher_list_fi'] = '';
$string['meta_description_teacher_list_fi'] = '';
$string['listpromo_fj'] = '';
$string['listdesc_fj'] = '';
$string['meta_title_teacher_list_fj'] = '';
$string['meta_description_teacher_list_fj'] = '';
$string['listpromo_fo'] = '';
$string['listdesc_fo'] = '';
$string['meta_title_teacher_list_fo'] = '';
$string['meta_description_teacher_list_fo'] = '';
$string['listpromo_fr'] = '';
$string['listdesc_fr'] = '';
$string['meta_title_teacher_list_fr'] = '';
$string['meta_description_teacher_list_fr'] = '';
$string['listpromo_fy'] = '';
$string['listdesc_fy'] = '';
$string['meta_title_teacher_list_fy'] = '';
$string['meta_description_teacher_list_fy'] = '';
$string['listpromo_ga'] = '';
$string['listdesc_ga'] = '';
$string['meta_title_teacher_list_ga'] = '';
$string['meta_description_teacher_list_ga'] = '';
$string['listpromo_gd'] = '';
$string['listdesc_gd'] = '';
$string['meta_title_teacher_list_gd'] = '';
$string['meta_description_teacher_list_gd'] = '';
$string['listpromo_gl'] = '';
$string['listdesc_gl'] = '';
$string['meta_title_teacher_list_gl'] = '';
$string['meta_description_teacher_list_gl'] = '';
$string['listpromo_gn'] = '';
$string['listdesc_gn'] = '';
$string['meta_title_teacher_list_gn'] = '';
$string['meta_description_teacher_list_gn'] = '';
$string['listpromo_gu'] = '';
$string['listdesc_gu'] = '';
$string['meta_title_teacher_list_gu'] = '';
$string['meta_description_teacher_list_gu'] = '';
$string['listpromo_gv'] = '';
$string['listdesc_gv'] = '';
$string['meta_title_teacher_list_gv'] = '';
$string['meta_description_teacher_list_gv'] = '';
$string['listpromo_ha'] = '';
$string['listdesc_ha'] = '';
$string['meta_title_teacher_list_ha'] = '';
$string['meta_description_teacher_list_ha'] = '';
$string['listpromo_he'] = '';
$string['listdesc_he'] = '';
$string['meta_title_teacher_list_he'] = '';
$string['meta_description_teacher_list_he'] = '';
$string['listpromo_hi'] = '';
$string['listdesc_hi'] = '';
$string['meta_title_teacher_list_hi'] = '';
$string['meta_description_teacher_list_hi'] = '';
$string['listpromo_ho'] = '';
$string['listdesc_ho'] = '';
$string['meta_title_teacher_list_ho'] = '';
$string['meta_description_teacher_list_ho'] = '';
$string['listpromo_hr'] = '';
$string['listdesc_hr'] = '';
$string['meta_title_teacher_list_hr'] = '';
$string['meta_description_teacher_list_hr'] = '';
$string['listpromo_ht'] = '';
$string['listdesc_ht'] = '';
$string['meta_title_teacher_list_ht'] = '';
$string['meta_description_teacher_list_ht'] = '';
$string['listpromo_hu'] = '';
$string['listdesc_hu'] = '';
$string['meta_title_teacher_list_hu'] = '';
$string['meta_description_teacher_list_hu'] = '';
$string['listpromo_hy'] = '';
$string['listdesc_hy'] = '';
$string['meta_title_teacher_list_hy'] = '';
$string['meta_description_teacher_list_hy'] = '';
$string['listpromo_hz'] = '';
$string['listdesc_hz'] = '';
$string['meta_title_teacher_list_hz'] = '';
$string['meta_description_teacher_list_hz'] = '';
$string['listpromo_ia'] = '';
$string['listdesc_ia'] = '';
$string['meta_title_teacher_list_ia'] = '';
$string['meta_description_teacher_list_ia'] = '';
$string['listpromo_id'] = '';
$string['listdesc_id'] = '';
$string['meta_title_teacher_list_id'] = '';
$string['meta_description_teacher_list_id'] = '';
$string['listpromo_ie'] = '';
$string['listdesc_ie'] = '';
$string['meta_title_teacher_list_ie'] = '';
$string['meta_description_teacher_list_ie'] = '';
$string['listpromo_ig'] = '';
$string['listdesc_ig'] = '';
$string['meta_title_teacher_list_ig'] = '';
$string['meta_description_teacher_list_ig'] = '';
$string['listpromo_ii'] = '';
$string['listdesc_ii'] = '';
$string['meta_title_teacher_list_ii'] = '';
$string['meta_description_teacher_list_ii'] = '';
$string['listpromo_ik'] = '';
$string['listdesc_ik'] = '';
$string['meta_title_teacher_list_ik'] = '';
$string['meta_description_teacher_list_ik'] = '';
$string['listpromo_io'] = '';
$string['listdesc_io'] = '';
$string['meta_title_teacher_list_io'] = '';
$string['meta_description_teacher_list_io'] = '';
$string['listpromo_is'] = '';
$string['listdesc_is'] = '';
$string['meta_title_teacher_list_is'] = '';
$string['meta_description_teacher_list_is'] = '';
$string['listpromo_it'] = '';
$string['listdesc_it'] = '';
$string['meta_title_teacher_list_it'] = '';
$string['meta_description_teacher_list_it'] = '';
$string['listpromo_iu'] = '';
$string['listdesc_iu'] = '';
$string['meta_title_teacher_list_iu'] = '';
$string['meta_description_teacher_list_iu'] = '';
$string['listpromo_ja'] = '';
$string['listdesc_ja'] = '';
$string['meta_title_teacher_list_ja'] = '';
$string['meta_description_teacher_list_ja'] = '';
$string['listpromo_jv'] = '';
$string['listdesc_jv'] = '';
$string['meta_title_teacher_list_jv'] = '';
$string['meta_description_teacher_list_jv'] = '';
$string['listpromo_ka'] = '';
$string['listdesc_ka'] = '';
$string['meta_title_teacher_list_ka'] = '';
$string['meta_description_teacher_list_ka'] = '';
$string['listpromo_kg'] = '';
$string['listdesc_kg'] = '';
$string['meta_title_teacher_list_kg'] = '';
$string['meta_description_teacher_list_kg'] = '';
$string['listpromo_ki'] = '';
$string['listdesc_ki'] = '';
$string['meta_title_teacher_list_ki'] = '';
$string['meta_description_teacher_list_ki'] = '';
$string['listpromo_kj'] = '';
$string['listdesc_kj'] = '';
$string['meta_title_teacher_list_kj'] = '';
$string['meta_description_teacher_list_kj'] = '';
$string['listpromo_kk'] = '';
$string['listdesc_kk'] = '';
$string['meta_title_teacher_list_kk'] = '';
$string['meta_description_teacher_list_kk'] = '';
$string['listpromo_kl'] = '';
$string['listdesc_kl'] = '';
$string['meta_title_teacher_list_kl'] = '';
$string['meta_description_teacher_list_kl'] = '';
$string['listpromo_km'] = '';
$string['listdesc_km'] = '';
$string['meta_title_teacher_list_km'] = '';
$string['meta_description_teacher_list_km'] = '';
$string['listpromo_kn'] = '';
$string['listdesc_kn'] = '';
$string['meta_title_teacher_list_kn'] = '';
$string['meta_description_teacher_list_kn'] = '';
$string['listpromo_ko'] = '';
$string['listdesc_ko'] = '';
$string['meta_title_teacher_list_ko'] = '';
$string['meta_description_teacher_list_ko'] = '';
$string['listpromo_kr'] = '';
$string['listdesc_kr'] = '';
$string['meta_title_teacher_list_kr'] = '';
$string['meta_description_teacher_list_kr'] = '';
$string['listpromo_ks'] = '';
$string['listdesc_ks'] = '';
$string['meta_title_teacher_list_ks'] = '';
$string['meta_description_teacher_list_ks'] = '';
$string['listpromo_ku'] = '';
$string['listdesc_ku'] = '';
$string['meta_title_teacher_list_ku'] = '';
$string['meta_description_teacher_list_ku'] = '';
$string['listpromo_kv'] = '';
$string['listdesc_kv'] = '';
$string['meta_title_teacher_list_kv'] = '';
$string['meta_description_teacher_list_kv'] = '';
$string['listpromo_kw'] = '';
$string['listdesc_kw'] = '';
$string['meta_title_teacher_list_kw'] = '';
$string['meta_description_teacher_list_kw'] = '';
$string['listpromo_ky'] = '';
$string['listdesc_ky'] = '';
$string['meta_title_teacher_list_ky'] = '';
$string['meta_description_teacher_list_ky'] = '';
$string['listpromo_la'] = '';
$string['listdesc_la'] = '';
$string['meta_title_teacher_list_la'] = '';
$string['meta_description_teacher_list_la'] = '';
$string['listpromo_lb'] = '';
$string['listdesc_lb'] = '';
$string['meta_title_teacher_list_lb'] = '';
$string['meta_description_teacher_list_lb'] = '';
$string['listpromo_lg'] = '';
$string['listdesc_lg'] = '';
$string['meta_title_teacher_list_lg'] = '';
$string['meta_description_teacher_list_lg'] = '';
$string['listpromo_li'] = '';
$string['listdesc_li'] = '';
$string['meta_title_teacher_list_li'] = '';
$string['meta_description_teacher_list_li'] = '';
$string['listpromo_ln'] = '';
$string['listdesc_ln'] = '';
$string['meta_title_teacher_list_ln'] = '';
$string['meta_description_teacher_list_ln'] = '';
$string['listpromo_lo'] = '';
$string['listdesc_lo'] = '';
$string['meta_title_teacher_list_lo'] = '';
$string['meta_description_teacher_list_lo'] = '';
$string['listpromo_lt'] = '';
$string['listdesc_lt'] = '';
$string['meta_title_teacher_list_lt'] = '';
$string['meta_description_teacher_list_lt'] = '';
$string['listpromo_lu'] = '';
$string['listdesc_lu'] = '';
$string['meta_title_teacher_list_lu'] = '';
$string['meta_description_teacher_list_lu'] = '';
$string['listpromo_lv'] = '';
$string['listdesc_lv'] = '';
$string['meta_title_teacher_list_lv'] = '';
$string['meta_description_teacher_list_lv'] = '';
$string['listpromo_mg'] = '';
$string['listdesc_mg'] = '';
$string['meta_title_teacher_list_mg'] = '';
$string['meta_description_teacher_list_mg'] = '';
$string['listpromo_mh'] = '';
$string['listdesc_mh'] = '';
$string['meta_title_teacher_list_mh'] = '';
$string['meta_description_teacher_list_mh'] = '';
$string['listpromo_mi'] = '';
$string['listdesc_mi'] = '';
$string['meta_title_teacher_list_mi'] = '';
$string['meta_description_teacher_list_mi'] = '';
$string['listpromo_mk'] = '';
$string['listdesc_mk'] = '';
$string['meta_title_teacher_list_mk'] = '';
$string['meta_description_teacher_list_mk'] = '';
$string['listpromo_ml'] = '';
$string['listdesc_ml'] = '';
$string['meta_title_teacher_list_ml'] = '';
$string['meta_description_teacher_list_ml'] = '';
$string['listpromo_mn'] = '';
$string['listdesc_mn'] = '';
$string['meta_title_teacher_list_mn'] = '';
$string['meta_description_teacher_list_mn'] = '';
$string['listpromo_mr'] = '';
$string['listdesc_mr'] = '';
$string['meta_title_teacher_list_mr'] = '';
$string['meta_description_teacher_list_mr'] = '';
$string['listpromo_ms'] = '';
$string['listdesc_ms'] = '';
$string['meta_title_teacher_list_ms'] = '';
$string['meta_description_teacher_list_ms'] = '';
$string['listpromo_mt'] = '';
$string['listdesc_mt'] = '';
$string['meta_title_teacher_list_mt'] = '';
$string['meta_description_teacher_list_mt'] = '';
$string['listpromo_my'] = '';
$string['listdesc_my'] = '';
$string['meta_title_teacher_list_my'] = '';
$string['meta_description_teacher_list_my'] = '';
$string['listpromo_na'] = '';
$string['listdesc_na'] = '';
$string['meta_title_teacher_list_na'] = '';
$string['meta_description_teacher_list_na'] = '';
$string['listpromo_nb'] = '';
$string['listdesc_nb'] = '';
$string['meta_title_teacher_list_nb'] = '';
$string['meta_description_teacher_list_nb'] = '';
$string['listpromo_nd'] = '';
$string['listdesc_nd'] = '';
$string['meta_title_teacher_list_nd'] = '';
$string['meta_description_teacher_list_nd'] = '';
$string['listpromo_ne'] = '';
$string['listdesc_ne'] = '';
$string['meta_title_teacher_list_ne'] = '';
$string['meta_description_teacher_list_ne'] = '';
$string['listpromo_ng'] = '';
$string['listdesc_ng'] = '';
$string['meta_title_teacher_list_ng'] = '';
$string['meta_description_teacher_list_ng'] = '';
$string['listpromo_nl'] = '';
$string['listdesc_nl'] = '';
$string['meta_title_teacher_list_nl'] = '';
$string['meta_description_teacher_list_nl'] = '';
$string['listpromo_nn'] = '';
$string['listdesc_nn'] = '';
$string['meta_title_teacher_list_nn'] = '';
$string['meta_description_teacher_list_nn'] = '';
$string['listpromo_no'] = '';
$string['listdesc_no'] = '';
$string['meta_title_teacher_list_no'] = '';
$string['meta_description_teacher_list_no'] = '';
$string['listpromo_nr'] = '';
$string['listdesc_nr'] = '';
$string['meta_title_teacher_list_nr'] = '';
$string['meta_description_teacher_list_nr'] = '';
$string['listpromo_nv'] = '';
$string['listdesc_nv'] = '';
$string['meta_title_teacher_list_nv'] = '';
$string['meta_description_teacher_list_nv'] = '';
$string['listpromo_ny'] = '';
$string['listdesc_ny'] = '';
$string['meta_title_teacher_list_ny'] = '';
$string['meta_description_teacher_list_ny'] = '';
$string['listpromo_oc'] = '';
$string['listdesc_oc'] = '';
$string['meta_title_teacher_list_oc'] = '';
$string['meta_description_teacher_list_oc'] = '';
$string['listpromo_oj'] = '';
$string['listdesc_oj'] = '';
$string['meta_title_teacher_list_oj'] = '';
$string['meta_description_teacher_list_oj'] = '';
$string['listpromo_om'] = '';
$string['listdesc_om'] = '';
$string['meta_title_teacher_list_om'] = '';
$string['meta_description_teacher_list_om'] = '';
$string['listpromo_or'] = '';
$string['listdesc_or'] = '';
$string['meta_title_teacher_list_or'] = '';
$string['meta_description_teacher_list_or'] = '';
$string['listpromo_os'] = '';
$string['listdesc_os'] = '';
$string['meta_title_teacher_list_os'] = '';
$string['meta_description_teacher_list_os'] = '';
$string['listpromo_pa'] = '';
$string['listdesc_pa'] = '';
$string['meta_title_teacher_list_pa'] = '';
$string['meta_description_teacher_list_pa'] = '';
$string['listpromo_pi'] = '';
$string['listdesc_pi'] = '';
$string['meta_title_teacher_list_pi'] = '';
$string['meta_description_teacher_list_pi'] = '';
$string['listpromo_pl'] = '';
$string['listdesc_pl'] = '';
$string['meta_title_teacher_list_pl'] = '';
$string['meta_description_teacher_list_pl'] = '';
$string['listpromo_ps'] = '';
$string['listdesc_ps'] = '';
$string['meta_title_teacher_list_ps'] = '';
$string['meta_description_teacher_list_ps'] = '';
$string['listpromo_pt'] = '';
$string['listdesc_pt'] = '';
$string['meta_title_teacher_list_pt'] = '';
$string['meta_description_teacher_list_pt'] = '';
$string['listpromo_pt_br'] = '';
$string['listdesc_pt_br'] = '';
$string['meta_title_teacher_list_pt_br'] = '';
$string['meta_description_teacher_list_pt_br'] = '';
$string['listpromo_qu'] = '';
$string['listdesc_qu'] = '';
$string['meta_title_teacher_list_qu'] = '';
$string['meta_description_teacher_list_qu'] = '';
$string['listpromo_rm'] = '';
$string['listdesc_rm'] = '';
$string['meta_title_teacher_list_rm'] = '';
$string['meta_description_teacher_list_rm'] = '';
$string['listpromo_rn'] = '';
$string['listdesc_rn'] = '';
$string['meta_title_teacher_list_rn'] = '';
$string['meta_description_teacher_list_rn'] = '';
$string['listpromo_ro'] = '';
$string['listdesc_ro'] = '';
$string['meta_title_teacher_list_ro'] = '';
$string['meta_description_teacher_list_ro'] = '';
$string['listpromo_ru'] = '';
$string['listdesc_ru'] = '';
$string['meta_title_teacher_list_ru'] = '';
$string['meta_description_teacher_list_ru'] = '';
$string['listpromo_rw'] = '';
$string['listdesc_rw'] = '';
$string['meta_title_teacher_list_rw'] = '';
$string['meta_description_teacher_list_rw'] = '';
$string['listpromo_sa'] = '';
$string['listdesc_sa'] = '';
$string['meta_title_teacher_list_sa'] = '';
$string['meta_description_teacher_list_sa'] = '';
$string['listpromo_sc'] = '';
$string['listdesc_sc'] = '';
$string['meta_title_teacher_list_sc'] = '';
$string['meta_description_teacher_list_sc'] = '';
$string['listpromo_sd'] = '';
$string['listdesc_sd'] = '';
$string['meta_title_teacher_list_sd'] = '';
$string['meta_description_teacher_list_sd'] = '';
$string['listpromo_se'] = '';
$string['listdesc_se'] = '';
$string['meta_title_teacher_list_se'] = '';
$string['meta_description_teacher_list_se'] = '';
$string['listpromo_sg'] = '';
$string['listdesc_sg'] = '';
$string['meta_title_teacher_list_sg'] = '';
$string['meta_description_teacher_list_sg'] = '';
$string['listpromo_si'] = '';
$string['listdesc_si'] = '';
$string['meta_title_teacher_list_si'] = '';
$string['meta_description_teacher_list_si'] = '';
$string['listpromo_sk'] = '';
$string['listdesc_sk'] = '';
$string['meta_title_teacher_list_sk'] = '';
$string['meta_description_teacher_list_sk'] = '';
$string['listpromo_sl'] = '';
$string['listdesc_sl'] = '';
$string['meta_title_teacher_list_sl'] = '';
$string['meta_description_teacher_list_sl'] = '';
$string['listpromo_sm'] = '';
$string['listdesc_sm'] = '';
$string['meta_title_teacher_list_sm'] = '';
$string['meta_description_teacher_list_sm'] = '';
$string['listpromo_sn'] = '';
$string['listdesc_sn'] = '';
$string['meta_title_teacher_list_sn'] = '';
$string['meta_description_teacher_list_sn'] = '';
$string['listpromo_so'] = '';
$string['listdesc_so'] = '';
$string['meta_title_teacher_list_so'] = '';
$string['meta_description_teacher_list_so'] = '';
$string['listpromo_sq'] = '';
$string['listdesc_sq'] = '';
$string['meta_title_teacher_list_sq'] = '';
$string['meta_description_teacher_list_sq'] = '';
$string['listpromo_sr'] = '';
$string['listdesc_sr'] = '';
$string['meta_title_teacher_list_sr'] = '';
$string['meta_description_teacher_list_sr'] = '';
$string['listpromo_sr_cr'] = '';
$string['listdesc_sr_cr'] = '';
$string['meta_title_teacher_list_sr_cr'] = '';
$string['meta_description_teacher_list_sr_cr'] = '';
$string['listpromo_sr_lt'] = '';
$string['listdesc_sr_lt'] = '';
$string['meta_title_teacher_list_sr_lt'] = '';
$string['meta_description_teacher_list_sr_lt'] = '';
$string['listpromo_ss'] = '';
$string['listdesc_ss'] = '';
$string['meta_title_teacher_list_ss'] = '';
$string['meta_description_teacher_list_ss'] = '';
$string['listpromo_st'] = '';
$string['listdesc_st'] = '';
$string['meta_title_teacher_list_st'] = '';
$string['meta_description_teacher_list_st'] = '';
$string['listpromo_su'] = '';
$string['listdesc_su'] = '';
$string['meta_title_teacher_list_su'] = '';
$string['meta_description_teacher_list_su'] = '';
$string['listpromo_sv'] = '';
$string['listdesc_sv'] = '';
$string['meta_title_teacher_list_sv'] = '';
$string['meta_description_teacher_list_sv'] = '';
$string['listpromo_sw'] = '';
$string['listdesc_sw'] = '';
$string['meta_title_teacher_list_sw'] = '';
$string['meta_description_teacher_list_sw'] = '';
$string['listpromo_ta'] = '';
$string['listdesc_ta'] = '';
$string['meta_title_teacher_list_ta'] = '';
$string['meta_description_teacher_list_ta'] = '';
$string['listpromo_te'] = '';
$string['listdesc_te'] = '';
$string['meta_title_teacher_list_te'] = '';
$string['meta_description_teacher_list_te'] = '';
$string['listpromo_tg'] = '';
$string['listdesc_tg'] = '';
$string['meta_title_teacher_list_tg'] = '';
$string['meta_description_teacher_list_tg'] = '';
$string['listpromo_th'] = '';
$string['listdesc_th'] = '';
$string['meta_title_teacher_list_th'] = '';
$string['meta_description_teacher_list_th'] = '';
$string['listpromo_ti'] = '';
$string['listdesc_ti'] = '';
$string['meta_title_teacher_list_ti'] = '';
$string['meta_description_teacher_list_ti'] = '';
$string['listpromo_tk'] = '';
$string['listdesc_tk'] = '';
$string['meta_title_teacher_list_tk'] = '';
$string['meta_description_teacher_list_tk'] = '';
$string['listpromo_tl'] = '';
$string['listdesc_tl'] = '';
$string['meta_title_teacher_list_tl'] = '';
$string['meta_description_teacher_list_tl'] = '';
$string['listpromo_tn'] = '';
$string['listdesc_tn'] = '';
$string['meta_title_teacher_list_tn'] = '';
$string['meta_description_teacher_list_tn'] = '';
$string['listpromo_to'] = '';
$string['listdesc_to'] = '';
$string['meta_title_teacher_list_to'] = '';
$string['meta_description_teacher_list_to'] = '';
$string['listpromo_tr'] = '';
$string['listdesc_tr'] = '';
$string['meta_title_teacher_list_tr'] = '';
$string['meta_description_teacher_list_tr'] = '';
$string['listpromo_ts'] = '';
$string['listdesc_ts'] = '';
$string['meta_title_teacher_list_ts'] = '';
$string['meta_description_teacher_list_ts'] = '';
$string['listpromo_tt'] = '';
$string['listdesc_tt'] = '';
$string['meta_title_teacher_list_tt'] = '';
$string['meta_description_teacher_list_tt'] = '';
$string['listpromo_tw'] = '';
$string['listdesc_tw'] = '';
$string['meta_title_teacher_list_tw'] = '';
$string['meta_description_teacher_list_tw'] = '';
$string['listpromo_ty'] = '';
$string['listdesc_ty'] = '';
$string['meta_title_teacher_list_ty'] = '';
$string['meta_description_teacher_list_ty'] = '';
$string['listpromo_ug'] = '';
$string['listdesc_ug'] = '';
$string['meta_title_teacher_list_ug'] = '';
$string['meta_description_teacher_list_ug'] = '';
$string['listpromo_uk'] = '';
$string['listdesc_uk'] = '';
$string['meta_title_teacher_list_uk'] = '';
$string['meta_description_teacher_list_uk'] = '';
$string['listpromo_ur'] = '';
$string['listdesc_ur'] = '';
$string['meta_title_teacher_list_ur'] = '';
$string['meta_description_teacher_list_ur'] = '';
$string['listpromo_uz'] = '';
$string['listdesc_uz'] = '';
$string['meta_title_teacher_list_uz'] = '';
$string['meta_description_teacher_list_uz'] = '';
$string['listpromo_ve'] = '';
$string['listdesc_ve'] = '';
$string['meta_title_teacher_list_ve'] = '';
$string['meta_description_teacher_list_ve'] = '';
$string['listpromo_vi'] = '';
$string['listdesc_vi'] = '';
$string['meta_title_teacher_list_vi'] = '';
$string['meta_description_teacher_list_vi'] = '';
$string['listpromo_vo'] = '';
$string['listdesc_vo'] = '';
$string['meta_title_teacher_list_vo'] = '';
$string['meta_description_teacher_list_vo'] = '';
$string['listpromo_wa'] = '';
$string['listdesc_wa'] = '';
$string['meta_title_teacher_list_wa'] = '';
$string['meta_description_teacher_list_wa'] = '';
$string['listpromo_wo'] = '';
$string['listdesc_wo'] = '';
$string['meta_title_teacher_list_wo'] = '';
$string['meta_description_teacher_list_wo'] = '';
$string['listpromo_xh'] = '';
$string['listdesc_xh'] = '';
$string['meta_title_teacher_list_xh'] = '';
$string['meta_description_teacher_list_xh'] = '';
$string['listpromo_yi'] = '';
$string['listdesc_yi'] = '';
$string['meta_title_teacher_list_yi'] = '';
$string['meta_description_teacher_list_yi'] = '';
$string['listpromo_yo'] = '';
$string['listdesc_yo'] = '';
$string['meta_title_teacher_list_yo'] = '';
$string['meta_description_teacher_list_yo'] = '';
$string['listpromo_za'] = '';
$string['listdesc_za'] = '';
$string['meta_title_teacher_list_za'] = '';
$string['meta_description_teacher_list_za'] = '';
$string['listpromo_zh'] = '';
$string['listdesc_zh'] = '';
$string['meta_title_teacher_list_zh'] = '';
$string['meta_description_teacher_list_zh'] = '';
$string['listpromo_zh_cn'] = '';
$string['listdesc_zh_cn'] = '';
$string['meta_title_teacher_list_zh_cn'] = '';
$string['meta_description_teacher_list_zh_cn'] = '';
$string['listpromo_zh_tw'] = '';
$string['listdesc_zh_tw'] = '';
$string['meta_title_teacher_list_zh_tw'] = '';
$string['meta_description_teacher_list_zh_tw'] = '';
$string['listpromo_zu'] = '';
$string['listdesc_zu'] = '';
$string['meta_title_teacher_list_zu'] = '';
$string['meta_description_teacher_list_zu'] = '';

$string['meta_title_consultation'] = 'Apply for Free Consultation | Lonet.Academy';
$string['meta_description_consultation'] = 'You will share your doubts and ask the questions you have and you will get the answers from Kristine, who is an expert in language teaching and learning on-line.';
$string['h1_consultation'] = 'Choose Your Best Language Tutor!';

$string['consultq1'] = 'Do you still have any doubts?';
$string['consultq2'] = 'Not sure how to choose a tutor for you?';
$string['consultq3'] = 'Not sure if online classes are good for you?';
$string['consultanswer'] = 'Talk to Kristine - the creator of Lonet.Academy!';
$string['applynow'] = 'Apply For Free Consultation Now';
$string['whatiget'] = 'What will I get during the consultation?';
$string['content_consultation'] = '
<ul>
    <li>You will share your doubts and <strong>ask the questions</strong> you have and you will <strong>get the answers</strong> from Kristine, who is an expert in language teaching and learning on-line.</li>
    <li>You will be able to <strong>see how the on-line class-room communication works</strong>.</li>
    <li>Kristine will reply to your questions about <strong>how-it-works</strong> on Lonet.Academy.</li>
    <li>You will <strong>get help in choosing the best tutor</strong> for you, because Kristine checks and interviews every tutor on Lonet.Academy personally. So, she will help you to <strong>make the first steps</strong> in choosing the most appropriate tutor for you.</li>
</ul>
';

$string['pleasesubmitinfo'] = 'Please submit the below information to sign up for the consultation';
$string['yourname'] = 'Your Name';
$string['youremail'] = 'Your E-Mail';
$string['languagetolearn'] = 'Language you want to learn';
$string['phonenumber'] = 'Phone Number (WA)';
$string['casewa'] = 'in case you prefer the communication by WA';
$string['skypeid'] = 'Skype ID';
$string['caseskype'] = 'in case you prefer the communication by Skype';
$string['pleasereadagree'] = 'Please read and agree with the privacy policy and terms and conditions on Lonet.Academy';
$string['haveread'] = 'I have read, understood and agree with the';
$string['withprivacy'] = 'privacy policy';
$string['withterms'] = 'terms and conditions';
$string['oflonet'] = 'of Lonet.Academy';

$string['thankyouforapplication'] = 'Thank you for Your application!';
$string['schedulesession'] = 'Schedule Your session with Kristine right now!';
$string['selecttimezone'] = 'Select timezone';
$string['yourtimezone'] = 'Your Timezone';
$string['fullybooked'] = 'At the moment, all consultation sessions with Kristine are booked.';
$string['willcontact'] = 'Kristine will contact you personally as soon as there is a slot available.';

$string['watchdemolesson'] = 'Watch Demo Lesson';

$string['ihaveaccount'] = 'I have account on Lonet.Academy<br>Enter';
$string['idonthaveaccount'] = 'I don\'t have account yet<br>Create one';

$string['badge_new'] = 'new';
$string['badge_bestprice'] = 'best price';
$string['badge_recommended'] = 'recommended';
$string['badge_specialoffer'] = 'special offer';
$string['badge_native'] = 'native';

$string['paypal_fee_message'] = '+7% additional payment commission applicable';

$string['lessoncount_label'] = 'Lessons completed';
$string['studentcount_label'] = 'Unique students';

$string['invite_page_title'] = 'Know a friend who would enjoy Lonet.Academy?';
$string['invite_page_subtitle'] = 'Invite a friend and when they take a lesson YOU will get EUR 10 on your balance in Lonet.Academy';
$string['invite_page_email_title'] = 'Invite your friends by email';
$string['invite_page_send_button'] = 'Send';
$string['invite_page_button_linkedin'] = 'Share on Linkedin';
$string['invite_page_button_twitter'] = 'Share on Twitter';
$string['invite_page_button_link'] = 'Copy Link';
$string['invite_page_referral_title'] = 'How Referrals Work';
$string['invite_page_referral_subtitle_1'] = 'Get your friends to sign up via your custom signup link.';
$string['invite_page_referral_subtitle_2'] = 'Your friend gets EUR 10 to spend on their first lesson on Lonet.Academy.';
$string['invite_page_referral_subtitle_3'] = 'You get EUR 10 when your friend takes a lesson on the site.';
$string['userprofile_featuretext'] = '<h3>Congratulations {$a}!<h3><h4>While others are only dreaming, You are already doing! Fall in love with language learning and make learning a part of your daily routine.</h4>';
$string['teacherprofile_featuretext'] = '<div style="text-align:center"><h5>If you really want to learn a foreign language, open new horizons for your personal growth and increase your life opportunities, you can do it!</h5>
<h5><strong>{$a} is intended to be your faithful companion on this challenging, but truly rewarding journey.</strong></h5>
<h5><strong>Fall in love with language learning.</strong></h5>
<h5><strong>Discover a new language. Hear it, read it, sing it, dance it, feel it, speak it…. </strong>just live it!</h5></div>';
$string['requestpayout_message'] = 'You have already requested payout this month. Please proceed with the next payout request next month';
$string['topheadermessage'] = '<h5 style="color:#499306;">CHALLENGE: <strong>SET YOUR 2023 LEARNING GOAL</strong><h5>';
$string['challenge_fieldlabel'] = 'How many lessons do you want to complete per week?';
$string['challenge_title'] = '2023 LEARNING CHALLENGE PROGRESS';
$string['challenge_value'] = 'You have completed {$a->outof} of {$a->total} lessons.';
$string['challenge_message'] = 'You\'re on track!';
$string['challenge_textlink1'] = '<p style="font-size:12px !important;">Follow your learning challenge progress in your <a href="/user/profile.php?id={$a}"><u>profile section</u></a></p>';
$string['challenge_textlink2'] = 'Set and fulfill your goal in 2023 and get a 50 EUR gift card from Lonet.Academy!';
$string['h1_landing_page'] = 'Welcome to Lonet.Academy!';
$string['landingq1'] = 'Thank you for registration!';
$string['landingq2'] = 'Next step - choose your tutor!';
$string['landingq3'] = 'And book your first lesson!';
$string['applyfreeconsulation_url'] = 'https://lonet.academy/language-tutor-consultation';
$string['landing_page_videolink'] = 'https://www.youtube.com/embed/EZVFHDqnUHQ';
$string['booklesson_url'] = 'https://lonet.academy/language-teachers';
$string['h1_howitworks_page'] = 'How it works';
$string['howitworks_image1_title'] = 'How to create an account?';
$string['howitworks_image2_title'] = 'How to book a lesson?';
$string['howitworks_image3_title'] = 'Where will the lesson take place?';
$string['howitworks_image4_title'] = 'How to reschedule a lesson?';
$string['howitworks_image1_content'] = '<ul>
            <li>Press the “REGISTER” button</li>
            <li>Complete all fields in the registration form</li>
            <li>After all fields are completed, press the button "Register" at the end of the form</li>
            <li>Go to your mailbox and confirm the registration by following a link sent to you by email</li>
            <li>You can add and correct the data in your profile under "Edit profile" section</li>
          </ul>
            <div class="col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" style="margin-top: 5px;">
                <div class="media-16x9">
                    <iframe src="https://www.youtube.com/embed/Vv2o-hZtK9I" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>';
$string['howitworks_image2_content'] = '<ul>
          <li>Press the “LOGIN” button</li>
          <li>Log in using your credentials (email and password) that you created while registering</li>
          <li>To view the list of language tutors:
            <ul>
              <li>scroll on the home page and find the language you want to learn or</li>
              <li>choose the language you want to learn in the search box or</li>
              <li>press a button “BOOK A LESSON” and select the language you want to learn</li>
            </ul>
          </li>
          <li>Check the information about each tutor by pressing the button "View Profile"</li>
          <li>Click on the button "Book a lesson" on the tutor\'s profile and
            <ul>
                <li>select the language (in case the tutor teaches more than one language)</li>
                <li>select the type of lesson (a trial lesson is always available as the first option) with the price and duration of the lesson indicated</li>
                <li>select the day and time available in the tutor\'s timetable, the green fields indicate the available hours</li>
            </ul>
          </li>
          <li>Click on the button "Confirm and go to payment"</li>
          <li>If you have a promotional code, insert it into the “Promo code” box</li>
          <li>Get acquainted with the terms and conditions of Lonet.Academy platform and continue with the payment by card or by PayPal
            <ul>
                <li>the amount paid to book your language lessons will be shown in your virtual wallet, you can see the balance in your virtual wallet on your profile page</li>
                <li>the funds will not be transferred to the tutor until the lesson has been completed</li>
                <li>if the lesson has not been completed, you can use the balance on your virtual wallet to book other lessons</li>
            </ul>
          </li>
          <li>You can book trial lessons with several tutors. Choose the best language tutor on Lonet.Academy for yourself!</li>
        </ul>';
$string['howitworks_image3_content'] = '<ul>
          <li>The lesson takes place on the platform which has been pre-agreed between you and your tutor before the lesson and is the most convenient option (for example, Skype or Zoom)</li>
          <li>After the payment for the lesson has been made, the tutor should confirm the requested lesson within 24 hours and you shall receive the requested lesson\'s confirmation from the tutor to your email address</li>
          <li>Before the lesson you can contact the tutor directly using the messaging tool on the platform in order to:
            <ul>
              <li>ask questions and clarify details</li>
              <li>share your Skype, Zoom contacts and decide on the online platform usage for the lesson</li>
              <li>answer tutor\'s questions that might arise about your language skills before the booked lesson</li>
            </ul>
          </li>
          <li>Please note you must not provide any additional personal information to your tutor if you don\'t wish and you are not obliged to provide such personal information as your phone number, address, surname, photo, working place etc.</li>
          <li>In case you have any concerns about the questions or information that your tutor asks you to provide, please do not hesitate to contact and inform Lonet.Academy <i>(lonet@lonet.academy, +34 604 13 9040)</i></li>
          <li>Connect to the lesson at the booked time on the decided platform and enjoy the lesson!</li>
        </ul>';
$string['howitworks_image4_content'] = '<ul>
          <li>If you wish to reschedule a lesson, you can discuss it personally with the tutor or you can cancel your already booked lesson on Lonet.Academy and book a new one. <a href="https://lonet.academy/terms-and-conditions" target="_blank">Terms and conditions are applied.</a></li>
          <li>There are several options when a lesson might not be completed and a new lesson could be scheduled afterwards:
            <ul>
              <li>If tutor has not confirmed or has canceled the lesson - your paid money for the lesson will be available in your virtual wallet and you can use it to book you next lessons</li>
              <li>If tutor did not connect to the lesson - indicate that tutor did not show up to the lesson in your profile under “Lesson history”, your paid money for the lesson will be available in your virtual wallet and you can use it to book you next lessons</li>
            </ul>
          </li>
        </ul>';
$string['scarcity_field'] = 'How many new students can you accept?';
$string['scarcity_field_option5'] = 'I can\'t accept new students at the moment';
$string['scarcity_field_option1'] = 'I can take only 1 new student';
$string['scarcity_field_option2'] = 'I can take 2 new students';
$string['scarcity_field_option3'] = 'I can take maximum 3 new students';
$string['scarcity_field_option4'] = 'I am fully available for new students';
$string['scarcity_field_tag5'] = '0 places left';
$string['scarcity_field_tag1'] = 'Only <b>1</b> place left';
$string['scarcity_field_tag2'] = 'Only <b>2</b> places left';
$string['scarcity_field_tag3'] = '<b>3</b> places left';
$string['scarcity_field_tag4'] = 'Available';
$string['scarcity_field_tooltip5'] = 'This tutor doesn\'t accept new students at the moment';
$string['scarcity_field_tooltip1'] = 'There is only one place left for a new student with this tutor';
$string['scarcity_field_tooltip2'] = 'There are places left for 2 new students with this tutor';
$string['scarcity_field_tooltip3'] = 'There are places left for 3 new students with this tutor';
$string['scarcity_field_tooltip4'] = 'This tutor is fully available for new students';
$string['nativelanguage'] = 'Native language';
$string['studentageyouteach'] = 'Works with : ';
$string['levelyouteach'] = 'Levels I teach : ';
$string['typeoflessons'] = 'Types of lessons : ';
$string['coursebooks'] = '<strong>Course books : </strong>';
$string['teachingmaterials'] = 'Teaching materials : ';
$string['teachingcertificates'] = '<strong>Certificates : </strong>';
$string['lessonplan'] = '<strong>My lesson plan : </strong>';
$string['onlinetools'] = 'Online tools I use for lessons : ';
$string['linkedinpage'] = '<strong>Linkedin page : </strong>';
$string['imagedescription'] = '<p>Does your photo look like this? If so, that\'s great!<br/><img src="/theme/lonet/pix/right_picture.png" alt"right_picture"></p><p>Please do not use photos like these:<br/><img src="/theme/lonet/pix/wrong_picture.png" alt"wrong_picture"></p>';
$string['sendnews'] = 'Send Newsletter';
$string['sendnewstitle'] = 'Newsletter title';
$string['sendnewsurl'] = 'Newsletter url';
$string['sendnewsdesc'] = 'Newsletter desc';
$string['send'] = 'Send';
/**************************Group lesson****************************/
$string['messageprovider:groupmessage'] = 'Group Message notifications';
$string['priceperperson'] = 'Price per person';
$string['maxamountstudent'] = 'Max amount of learners';
$string['minamountstudent'] = 'Min amount of learners';
$string['maxlearners'] = 'Max learners';
$string['priceperperson'] = 'Price per person';
$string['timeperiod'] = 'Time period';
$string['grouplessons'] = 'Group Lessons';
$string['grouplesson'] = 'Group Lesson';
$string['joinlesson'] = 'Join Lesson';
$string['indilessons'] = 'Individual Lessons';
$string['groupusers'] = 'Group Users';
$string['groupmsg'] = 'Group Message';
$string['msgtogroup'] = 'Message to the group';
$string['selectusererror'] = 'Please choose users.';
$string['errorgroupmsg'] = 'Please enter message.';
$string['blockdayerr'] = 'Check your calendar. This day/time is not available in your calendar at the moment. Please edit your calendar and try again.';
$string['filldetails'] = 'Please fill all the details.';
$string['subebook'] = 'Subscribe <b>to our newsletter</b> and get a free e-book <b>"How To Learn A Language In A Record Time"</b>';
$string['subscribe'] = 'Subscribe';
$string['email'] = 'Email';
$string['desclesson'] = 'Description of the lesson:';
$string['whatlearn'] = 'What learner will learn:';
$string['level'] = 'level';
$string['age'] = 'Age';					   
$string['place'] = 'Place';					   
$string['levelteach'] = 'Levels you teach';
$string['agestudent'] = 'Age of students';
$string['agestudentteach'] = 'Age of students you teach';
$string['addgrouplesson'] = 'Add a Group lesson';
$string['editgrouplesson'] = 'Edit Group lesson';
$string['maxattendees'] = 'Max Attendees';
$string['minattendees'] = 'Minimum Attendees';
$string['whatislesson'] = 'What is the lesson about:';
$string['whatulearn'] = 'What will you learn:';									   
$string['gl_metatitle_en'] = '{$a} Language Courses in Small Groups';									   
$string['gl_metatitle_lv'] = '{$a} valodas kursi nelielās grupās';									   
$string['gl_metatitle_ru'] = 'Курсы по {$a} языку в маленьких группах';									   
$string['gl_metatitle_es'] = 'Cursos de {$a} en grupos pequeños';									   
$string['askaquestion'] = 'Ask a question';									   
$string['bookmyplace'] = 'Book a place';									   
$string['noplaceleft'] = 'This lesson is fully booked';									   
$string['contactteacher'] = 'Contact Teacher';									   
$string['copylesson'] = 'Copy Lesson';									   
$string['native'] = 'Native';									   
$string['connectvia'] = 'Connect via:';									   
$string['skype'] = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
  <g clip-path="url(#clip0_1288_579)">
    <path d="M15.0608 24.5286C10.0773 24.5286 7.8004 21.99 7.8004 20.1279C7.79973 19.6837 7.98204 19.2588 8.30443 18.9533C8.62683 18.6477 9.06085 18.4884 9.50438 18.5128C11.6381 18.5128 11.08 21.7134 15.0608 21.7134C17.0958 21.7134 18.291 20.4885 18.291 19.3377C18.291 18.6462 17.8959 17.8559 16.5525 17.5398L12.1073 16.4187C8.53632 15.5099 7.914 13.5244 7.914 11.6821C7.914 7.85925 11.4109 6.47631 14.7398 6.47631C17.807 6.47631 21.452 8.17041 21.452 10.4621C21.452 11.45 20.6272 11.9784 19.669 11.9784C17.8465 11.9784 18.1527 9.42 14.4879 9.42C12.6654 9.42 11.7072 10.2745 11.7072 11.4697C11.7072 12.665 13.1247 13.07 14.3694 13.3416L17.6489 14.0825C21.2446 14.8925 22.2028 17.0015 22.2028 19.0216C22.2028 22.1283 19.7974 24.5286 15.0559 24.5286H15.0608ZM28.8211 17.9547C28.9635 17.1393 29.0346 16.313 29.0335 15.4852C29.0509 11.327 27.2239 7.37516 24.0449 4.69481C20.8658 2.01447 16.662 0.881544 12.5666 1.60144C11.3078 0.87669 9.88017 0.496774 8.42766 0.500021C5.44624 0.518234 2.69808 2.11612 1.20737 4.69818C-0.283335 7.28024 -0.292978 10.4592 1.18203 13.0502C0.358988 17.5726 1.80072 22.2116 5.04218 25.4708C8.28365 28.7299 12.9147 30.1969 17.4415 29.3986C18.6987 30.1227 20.1246 30.5026 21.5755 30.5C24.5554 30.4808 27.3019 28.8836 28.7923 26.3031C30.2827 23.7226 30.2936 20.5455 28.8211 17.9547Z" fill="#0078D7"/>
  </g>
  <defs>
    <clipPath id="clip0_1288_579">
      <rect width="30" height="30" fill="white" transform="translate(0 0.5)"/>
    </clipPath>
  </defs>
</svg>';									   
$string['zoom'] = '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
  <g clip-path="url(#clip0_1288_576)">
    <path d="M14.9997 30.5C23.2844 30.5 30 23.7838 30 15.4997C30 7.21561 23.2844 0.5 14.9997 0.5C6.71502 0.5 0 7.21561 0 15.4997C0 23.7838 6.71561 30.5 14.9997 30.5Z" fill="#2196F3"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.80204 19.7871H18.7227V12.5126C18.7227 11.4166 17.8345 10.5284 16.7386 10.5284H6.81787V17.803C6.81787 18.8989 7.70602 19.7871 8.80204 19.7871ZM20.0448 17.1422L24.0131 19.7871V10.5284L20.0454 13.1739L20.0448 17.1422Z" fill="white"/>
  </g>
  <defs>
    <clipPath id="clip0_1288_576">
      <rect width="30" height="30" fill="white" transform="translate(0 0.5)"/>
    </clipPath>
  </defs>
</svg>';									   
$string['meet'] = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="21" viewBox="0 0 25 21" fill="none">
  <path d="M0.46875 18.7688C0.46875 19.639 1.17966 20.3438 2.05557 20.3438H2.07838C1.18906 20.3438 0.46875 19.639 0.46875 18.7688Z" fill="#FBBC05"/>
  <path d="M14.1053 6.56247V10.6745L19.6491 6.20285V2.23124C19.6491 1.36106 18.9382 0.65625 18.0623 0.65625H6.05175L6.04102 6.56247H14.1053Z" fill="#FBBC05"/>
  <path d="M14.1051 14.7883H6.02746L6.01807 20.3441H18.0621C18.9394 20.3441 19.649 19.6393 19.649 18.7691V15.1834L14.1051 10.6763V14.7883Z" fill="#34A853"/>
  <path d="M6.05149 0.65625L0.46875 6.56247H6.0421L6.05149 0.65625Z" fill="#EA4335"/>
  <path d="M0.46875 14.788V18.7688C0.46875 19.6389 1.18906 20.3437 2.07838 20.3437H6.01795L6.02734 14.788H0.46875Z" fill="#1967D2"/>
  <path d="M6.0421 6.5625H0.46875V14.7879H6.02734L6.0421 6.5625Z" fill="#4285F4"/>
  <path d="M24.5235 17.3687V3.84997C24.211 2.0558 22.2432 4.11247 22.2432 4.11247L19.6504 6.20328V15.182L23.3619 18.1995C24.7019 18.3753 24.5235 17.3687 24.5235 17.3687Z" fill="#34A853"/>
  <path d="M14.105 10.6746L19.6502 15.183V6.20422L14.105 10.6746Z" fill="#188038"/>
</svg>';									   
$string['bluecheck'] = '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="26" viewBox="0 0 25 26" fill="none"><path d="M10.1137 12.4697C9.82077 12.1768 9.3459 12.1768 9.053 12.4697C8.76011 12.7626 8.76011 13.2374 9.053 13.5303L10.1137 12.4697ZM11.5278 14.9444L10.9974 15.4748C11.2903 15.7677 11.7652 15.7677 12.0581 15.4748L11.5278 14.9444ZM15.947 11.5859C16.2399 11.293 16.2399 10.8181 15.947 10.5252C15.6541 10.2323 15.1792 10.2323 14.8863 10.5252L15.947 11.5859ZM20.5 13C20.5 17.4183 16.9183 21 12.5 21V22.5C17.7467 22.5 22 18.2467 22 13H20.5ZM12.5 21C8.08172 21 4.5 17.4183 4.5 13H3C3 18.2467 7.25329 22.5 12.5 22.5V21ZM4.5 13C4.5 8.58172 8.08172 5 12.5 5V3.5C7.25329 3.5 3 7.75329 3 13H4.5ZM12.5 5C16.9183 5 20.5 8.58172 20.5 13H22C22 7.75329 17.7467 3.5 12.5 3.5V5ZM9.053 13.5303L10.9974 15.4748L12.0581 14.4141L10.1137 12.4697L9.053 13.5303ZM12.0581 15.4748L15.947 11.5859L14.8863 10.5252L10.9974 14.4141L12.0581 15.4748Z" fill="#170F83"></path></svg>';
$string['smalllessons'] = 'lessons';
$string['wanttojoin'] = 'Want to Join as an Educator?';
$string['becometutor'] = 'Are you a language Tutor?';
$string['becomecoach'] = 'Are you a language Coach?';
$string['becometrainer'] = 'Are you a language Trainer?';
$string['seebenefits'] = 'See benefits';
$string['becometutor_desc'] = 'Set your own schedule, share your knowledge, and earn income from anywhere. Join our platform for flexibility and freedom in your teaching career.';
$string['selecttutor'] = 'Selected language tutors, coaches and trainers for You';
$string['selecttutor_desc'] = 'Personalized language learning online. Pick a language  -  Choose a type of educator  -  Book a trial session';
$string['langgurantee'] = 'Your language progress is guaranteed!';
$string['langilearn'] = 'Language I learn';
$string['freeconsult'] = 'Free consultation';
$string['contactinfo'] = 'Contact Information';
$string['contactaddress'] = 'Address for notices and letters:';
$string['contactwhat'] = 'WhatsApp';
$string['email'] = 'Email';
$string['followus'] = 'Follow us on social media:';
$string['missionstatement'] = 'Mission statement';
$string['ourmissionis'] = 'OUR MISSION IS';
$string['tocreate'] = 'TO CREATE';
$string['for'] = 'FOR';
$string['by'] = 'BY';
$string['where'] = 'WHERE';
$string['asafe'] = 'A SAFE ENVIRONMENT';
$string['eduaroundwrld'] = 'learners & educators from around the world';
$string['easetouseinno'] = 'PROVIDING our easy-to-use innovative online platform';
$string['connect_engage'] = 'THEY CAN Connect, engage & transform together';
$string['corephilo'] = 'Infusion of positive psychology as the core philosophy';
$string['corephilo_desc'] = 'Embracing the principle that mindset is key to learning, Lonet starts integrating principles of positive psychology into its educational approach, enhancing the learning experience by focusing on strengths, motivation, resilience, and personalized learning paths.';
$string['lonetmission'] = 'Lonet.Academy mission and vision of personalized language learning';
$string['missionculture'] = 'On a mission to contribute to a culture of language learning';
$string['onamission_desc'] = 'Lonet was founded to democratize individual language learning across the globe. Leveraging innovative technology and teaching methods, it started as an online platform connecting passionate teachers with eager learners.
<br/>
<br/>
Today, we are on a mission of transforming personalized language learning. That intertwines curiosity, empowerment, discovery, engagement, and transformation threads. We aim to unlock the unique potential and foster a growth mindset within each individual. We facilitate a journey of personal growth through a holistic strengths-based approach.
<br/>
<br/>
We believe in the profound power of language learning as a powerful tool for connection
through clear communication, engagement, and understanding. Holistic personalized education fosters a sense of competence and self-efficacy and leads to holistic personal development and well-being.
<br/>
<br/>
We encourage educators to focus on their strengths and well-being. We recognize that this positivity can have a cascading effect on the entire educational community. Every interaction at Lonet is designed to inspire and motivate. It guides our community to new heights of success, positive transformation, holistic growth, and well-being.
';
$string['ourvisiondesc'] = 'We envision creating a global, powerful, and accessible educational online ecosystem. A safe space where individuals from every corner of the world can seamlessly connect with their ideal educational partners. 
<br/>
<br/>
At Lonet, we value diversity, inclusion, and equality. We envision a world where education knows no limits. At Lonet, learners and educators alike find their perfect match, fostering a lifelong journey of discovery, growth, and meaningful connections.';
$string['ourbelivedesc'] = 'We understand the individual needs of our global community and we offer tailored solutions that resonate with the diverse tapestry of learners.
<br/>
<br/>
With a positive outlook, Lonet serves as a trusted guide, providing direction in the intricate landscape of language acquisition. Lonet\'s coaches ignite confidence and empower learners to overcome challenges, fostering a motivational environment where every step is a celebration of progress. Lonet is not just an entity; it\'s a passionate advocate for the transformative power of learning mindset. 
<br/>
<br/>
We believe in the joy of exploration and discovery, the boundless possibilities of clear communication, and the profound impact of breaking down language barriers.';
$string['ourvision'] = 'Our vision';
$string['ourbelive'] = 'We Believe in the power of language learning';
$string['platformforlang'] = 'The best platform for language tutors and language coaches';
$string['platformforlangdesc'] = 'Lonet is the best platform for language tutors, a commission-free space for language tutors, providing online jobs for language educators.';
$string['benifitofpart'] = 'Benefits of being a part of Lonet';
$string['maximizeearn'] = 'Maximize your earnings';
$string['maximizeearndesc'] = 'Zero commission for tutors. You don\'t have to calculate any price deductions. The price you set is the amount you get. Clear and easy.';
$string['focuson'] = 'Focus on your purpose';
$string['focusondesc'] = 'Your purpose is to help people learn and grow! Marketing is our job. We take care of promotion, SEO and social media. Dedicate your energy to your purpose.';
$string['buildbrand'] = 'Build your professional brand';
$string['buildbranddesc'] = 'Create a strong personal brand on Lonet. Gather instant reviews and testimonials to attract more learners. Grow your reputation and professionalism.';
$string['growprof'] = 'Grow professionally';
$string['growprofdesc'] = 'Enjoy spam-free connections and requests. Connect with learners and fellow educators worldwide, share your ideas, and gain valuable insights.';
$string['enjoypay'] = 'Enjoy payment guarantee';
$string['enjoypaydesc'] = 'Feel safe about being paid. The payment is guaranteed. Lonet ensures safety, documentation flow, payment security, and transaction process.';
$string['growwithus'] = 'Grow your business with Us';
$string['growwithusdesc'] = 'Avoid big platform competition. We strive for fairness and loyalty. Scaling and gigantism is not our objective. Your well-being and prosperity are our mission.';
$string['joinlonet'] = 'Join Lonet.Academy as a';
$string['langcoach'] = 'Language Coach';
$string['ifyou'] = 'if you';
$string['arecoach'] = 'are a certified coach';
$string['holdquali'] = 'hold a coaching qualification';
$string['positivepsyco'] = 'positive psychology practitioner';
$string['langtutor'] = 'Language Tutor';
$string['holdteaching'] = 'hold a teaching certificate';
$string['areteacher'] = 'are a professional teacher';
$string['holddegree'] = 'hold a relevant degree';
$string['langtrainer'] = 'Language Trainer';
$string['arespeaker'] = 'are a native speaker';
$string['havetutexp'] = 'have tutoring experience';
$string['passionaboutlang'] = 'passionate about the language';
$string['wanttoapply'] = 'I want to apply!';
$string['lonetforedu'] = 'How Lonet works for educators';
$string['lonetforedudesc'] = 'Lonet makes it easy to share your passion for language and connect with learners worldwide.';
$string['applyanedu'] = 'Apply as an educator at Lonet';
$string['completeappli'] = 'Complete your application';
$string['setprofile'] = 'Set your profile';
$string['chooserole'] = 'Choose your role:';
$string['freeaccount'] = '🔥 Create your free account and begin your language teaching journey today!';
$string['langtutormsg'] = 'If you\'re a qualified or certified language teacher (with a professional language degree or a certificate like CELTA or TEFL), apply as a tutor.';
$string['langcoachmsg'] = 'If you hold a coaching certificate or language coaching diploma or you completed a course in positive psychology, apply as a language coach.';
$string['langtrainermsg'] = 'If you are a native speaker and you have experience in your native language tutoring, apply as a language trainer.';
$string['educapsvg'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
<path d="M10.1125 20.2976C9.58855 24.3057 9.27026 28.3786 9.16859 32.5052C14.7383 34.8306 20.0358 37.6779 24.9999 40.986C29.964 37.6779 35.2615 34.8306 40.8312 32.5052C40.7296 28.3786 40.4113 24.3058 39.8873 20.2977M10.1125 20.2976C8.42831 19.7315 6.72367 19.2098 5 18.7341C11.2417 14.359 17.9365 10.5862 25 7.5C32.0635 10.5862 38.7582 14.359 45 18.7341C43.2763 19.2099 41.5716 19.7315 39.8873 20.2977M10.1125 20.2976C15.2808 22.0348 20.2567 24.1907 25 26.7251C29.7432 24.1908 34.7191 22.0348 39.8873 20.2977M14.9028 29.6319C15.6994 29.6319 16.3452 28.9861 16.3452 28.1894C16.3452 27.3928 15.6994 26.747 14.9028 26.747C14.1061 26.747 13.4603 27.3928 13.4603 28.1894C13.4603 28.9861 14.1061 29.6319 14.9028 29.6319ZM14.9028 29.6319V22.5629C18.1559 20.5415 21.5258 18.6903 24.9999 17.0216M11.5229 39.234C13.7761 36.9808 14.9028 34.0276 14.9028 31.0743V28.1894" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
$string['checkcirclesvg'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M19.1667 25L23.0556 28.8889L30.8333 21.1111M42.5 25C42.5 34.665 34.665 42.5 25 42.5C15.335 42.5 7.5 34.665 7.5 25C7.5 15.335 15.335 7.5 25 7.5C34.665 7.5 42.5 15.335 42.5 25Z" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['profilesvg'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M11.6242 36.285C15.5746 34.0521 20.1385 32.7778 25 32.7778C29.8615 32.7778 34.4254 34.0521 38.3758 36.285M30.8333 21.1111C30.8333 24.3328 28.2217 26.9444 25 26.9444C21.7783 26.9444 19.1667 24.3328 19.1667 21.1111C19.1667 17.8894 21.7783 15.2778 25 15.2778C28.2217 15.2778 30.8333 17.8894 30.8333 21.1111ZM42.5 25C42.5 34.665 34.665 42.5 25 42.5C15.335 42.5 7.5 34.665 7.5 25C7.5 15.335 15.335 7.5 25 7.5C34.665 7.5 42.5 15.335 42.5 25Z" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['setrates'] = 'Set your rates:';
$string['setratesdesc'] = 'be a manager of your pricing policy. Lonet is a safe space where you avoid the price competition of big platforms.';
$string['setavail'] = 'Set your availability:';
$string['setavaildesc'] = 'be your own boss and time manager. You decide when you work. No minimum quantity of hours-to-be-done required.';
$string['managecal'] = 'Manage your calendar:';
$string['managecaldesc'] = 'enjoy the freedom of flexibility. Block and unblock time slots in line with other commitments in your life.';
$string['youallset'] = '🎉 You are all set! Forget about marketing and clients search - this is our job. Focus on educating and do what you love!';
$string['showcaseexp'] = 'Showcase your expertise:';
$string['showcaseexpdesc'] = 'fill out your Lonet profile with information about your:';
$string['scheduleinter'] = 'Schedule your interview';
$string['scheduleinterdesc'] = 'After completing your profile, you\'ll receive an email to schedule a brief online interview with Kristine, the founder of Lonet. This is a chance to discuss your approach to teaching and learn more about the platform.';
$string['education'] = 'Education:';
$string['educationdesc'] = 'degrees, certifications.';
$string['experience'] = 'Experience:';
$string['experiencedesc'] = 'teaching experience, areas of specialization, and unique skills.';
$string['yourapproch'] = 'Your approach:';
$string['yourapprochdesc'] = 'Your approach: methods and techniques, what is your specialty, and your unique selling point.';
$string['hearfrom'] = 'Hear from our happy teachers';
$string['hearfromdesc'] = 'Discover why educators love working with Lonet.Academy and its vibrant community of learners.';
$string['teacher1comment'] = 'Lonet.Academy is the most supportive platform I\'ve worked on. Flexible hours, great students, and I feel valued as an educator.';
$string['teacher2comment'] = 'The Lonet.Academy platform is user-friendly and intuitive. It simplifies everything from scheduling to payment, so I can focus on teaching.';
$string['teacher3comment'] = 'Lonet has given me the opportunity to build a successful online teaching career.';
$string['teacher4comment'] = 'I\'ve seen incredible progress in my students. The platform makes it easy to connect and provide effective support.';
$string['teacher5comment'] = 'The community of educators at Lonet.Academy is amazing!';
$string['teacher6comment'] = 'I\'m so glad I found Lonet.Academy! It\'s a great platform for new tutors to get started and share their passion for language.';
$string['thrivcommunity'] = 'A thriving community for educators and learners at Lonet';
$string['thrivcommunitydesc'] = 'Lonet empowers educators to focus on their strengths and well-being, fostering a positive community where every interaction inspires growth, transformation, and success for all.';
$string['growbrand'] = 'Grow your brand';
$string['growbranddesc'] = 'Build your reputation with a personalized profile, instant reviews, and a supportive community of fellow educators.';
$string['maximizeearn2desc'] = 'Lonet charges tutors and trainers no commission while connecting with motivated learners worldwide.';
$string['focuson2desc'] = 'Lonet\'s easy-to-use platform handles marketing, letting you focus on what you love—educating.';
$string['ready2join'] = 'Ready to join us?';
$string['ready2joindesc'] = 'Apply today and join our community of passionate language educators!';
$string['applynow'] = 'Apply now';
$string['customersay'] = 'Our customers say';
$string['excellent'] = 'Excellent';
$string['outof'] = 'out of';
$string['faq'] = 'Frequently Asked Questions';
$string['meta_title_becometutor'] = 'The Best Platform For Language Tutors and Language Coaches';
$string['meta_description_becometutor'] = 'Lonet is the best platform for language tutors, a commission-free space for language tutors, providing online jobs for language educators.';
$string['meta_title_consultation'] = 'How to choose a language tutor - free consultation on Lonet';
$string['meta_description_consultation'] = 'We will help you choose the best language tutor for you. Personalized language tutoring, coaching or training on Lonet.Academy.  Break language barriers and become fluent.';
$string['meta_title_aboutus'] = 'How to choose a language tutor - free consultation on Lonet';
$string['meta_description_aboutus'] = 'We will help you choose the best language tutor for you. Personalized language tutoring, coaching or training on Lonet.Academy.  Break language barriers and become fluent.';
$string['choosebesttutor'] = 'Choose your best language tutor!';
$string['checkfaq'] = 'Check our Frequently Asked Questions. Not finding an answer?';
$string['talkkristine'] = 'Talk to Kristine - the creator of Lonet.Academy!';
$string['applyfreeconsult'] = 'Apply for a free consultation now!';
$string['whatget'] = 'What you\'ll get during your consultation:';
$string['typeofeduc'] = 'All educators';
$string['langtutor'] = 'Language tutor';
$string['langcoach'] = 'Language coach';
$string['langtrainer'] = 'Language trainer';
$string['pendinglessons'] = 'Pending Lessons';
$string['pendingrequests'] = 'Pending Requests';
$string['backtoprofile'] = 'Back to Profile';
$string['trashicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M12.2837 7.5L11.9952 15M8.00481 15L7.71635 7.5M16.023 4.82547C16.308 4.86851 16.592 4.91456 16.875 4.96358M16.023 4.82547L15.1332 16.3938C15.058 17.3707 14.2434 18.125 13.2637 18.125H6.73631C5.75655 18.125 4.94198 17.3707 4.86683 16.3938L3.97696 4.82547M16.023 4.82547C15.0677 4.6812 14.1013 4.57071 13.125 4.49527M3.125 4.96358C3.40798 4.91456 3.69198 4.86851 3.97696 4.82547M3.97696 4.82547C4.93231 4.6812 5.89874 4.57071 6.875 4.49527M13.125 4.49527V3.73182C13.125 2.74902 12.3661 1.92853 11.3838 1.8971C10.9244 1.8824 10.463 1.875 10 1.875C9.53696 1.875 9.07565 1.8824 8.61618 1.8971C7.63388 1.92853 6.875 2.74902 6.875 3.73182V4.49527M13.125 4.49527C12.0938 4.41558 11.0516 4.375 10 4.375C8.94836 4.375 7.9062 4.41558 6.875 4.49527" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['scheduleicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M9.21875 10.0063V16.3195H15.5319" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.64062 25C7.64062 34.5883 15.4135 42.3611 25.0017 42.3611C34.59 42.3611 42.3628 34.5883 42.3628 25C42.3628 15.4117 34.59 7.63892 25.0017 7.63892C18.5764 7.63892 12.9662 11.1295 9.96421 16.3178" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M25.001 14.5833L25 25.0076L32.3606 32.3682" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['blockicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M37.3744 37.3744C44.2085 30.5402 44.2085 19.4598 37.3744 12.6256C30.5402 5.79146 19.4598 5.79146 12.6256 12.6256M37.3744 37.3744C30.5402 44.2085 19.4598 44.2085 12.6256 37.3744C5.79146 30.5402 5.79146 19.4598 12.6256 12.6256M37.3744 37.3744L12.6256 12.6256" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['uturnicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M18.75 18.75L31.25 6.25M31.25 6.25L43.75 18.75M31.25 6.25L31.25 31.25C31.25 38.1536 25.6536 43.75 18.75 43.75C11.8464 43.75 6.25 38.1536 6.25 31.25L6.25 25" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['pencilediticon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none"><path d="M14.5514 3.73889L15.9576 2.33265C16.5678 1.72245 17.5572 1.72245 18.1674 2.33265C18.7775 2.94284 18.7775 3.93216 18.1674 4.54235L9.31849 13.3912C8.87792 13.8318 8.33453 14.1556 7.73741 14.3335L5.5 15L6.16648 12.7626C6.34435 12.1655 6.6682 11.6221 7.10877 11.1815L14.5514 3.73889ZM14.5514 3.73889L16.75 5.93749M15.5 11.6667V15.625C15.5 16.6605 14.6605 17.5 13.625 17.5H4.875C3.83947 17.5 3 16.6605 3 15.625V6.87499C3 5.83946 3.83947 4.99999 4.875 4.99999H8.83333" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['trashicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none"><path d="M12.7837 7.5L12.4952 15M8.50481 15L8.21635 7.5M16.523 4.82547C16.808 4.86851 17.092 4.91456 17.375 4.96358M16.523 4.82547L15.6332 16.3938C15.558 17.3707 14.7434 18.125 13.7637 18.125H7.23631C6.25655 18.125 5.44198 17.3707 5.36683 16.3938L4.47696 4.82547M16.523 4.82547C15.5677 4.6812 14.6013 4.57071 13.625 4.49527M3.625 4.96358C3.90798 4.91456 4.19198 4.86851 4.47696 4.82547M4.47696 4.82547C5.43231 4.6812 6.39874 4.57071 7.375 4.49527M13.625 4.49527V3.73182C13.625 2.74902 12.8661 1.92853 11.8838 1.8971C11.4244 1.8824 10.963 1.875 10.5 1.875C10.037 1.875 9.57565 1.8824 9.11618 1.8971C8.13388 1.92853 7.375 2.74902 7.375 3.73182V4.49527M13.625 4.49527C12.5938 4.41558 11.5516 4.375 10.5 4.375C9.44836 4.375 8.4062 4.41558 7.375 4.49527" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['addicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none"><path d="M10.5 7.66667V10M10.5 10V12.3333M10.5 10H12.8333M10.5 10H8.16667M17.5 10C17.5 13.866 14.366 17 10.5 17C6.63401 17 3.5 13.866 3.5 10C3.5 6.13401 6.63401 3 10.5 3C14.366 3 17.5 6.13401 17.5 10Z" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['copyicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 37 36" fill="none"><path d="M10.1236 21.4473V27.4693H4.10156M9.74448 27.4733C7.67421 25.309 6.41129 22.4985 6.16764 19.5134C5.92399 16.5282 6.71443 13.5501 8.40633 11.0787C10.0982 8.60731 12.5886 6.793 15.4597 5.94019C18.3308 5.08737 21.4078 5.24795 24.1745 6.39498M9.73825 27.4666C7.51379 25.1417 6.22998 22.0748 6.13489 18.8586C6.03979 15.6423 7.14015 12.5049 9.22337 10.0527C11.3066 7.60042 14.2248 6.00732 17.4141 5.58119C20.6034 5.15507 23.8375 5.92617 26.4914 7.74551C29.1454 9.56485 31.0308 12.3033 31.7834 15.4317C32.536 18.5601 32.1024 21.8564 30.5663 24.6838C29.0302 27.5111 26.5007 29.6688 23.4666 30.7399C20.4324 31.8109 17.1089 31.7194 14.1383 30.483" stroke="#9CA3AF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['balanceicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M30 15.5694C26.4823 14.3288 22.4092 15.1153 19.5956 17.9289C15.6904 21.8342 15.6904 28.1658 19.5956 32.0711C22.4092 34.8847 26.4823 35.6712 30 34.4306M15 21.6667H26.6667M15 28.3333H26.6667M45 25C45 36.0457 36.0457 45 25 45C13.9543 45 5 36.0457 5 25C5 13.9543 13.9543 5 25 5C36.0457 5 45 13.9543 45 25Z" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['transactionicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 42 42" fill="none"><path d="M5.21875 6.00635V12.3195H11.5319" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M3.63281 21C3.63281 30.5883 11.4056 38.3611 20.9939 38.3611C30.5822 38.3611 38.355 30.5883 38.355 21C38.355 11.4117 30.5822 3.63892 20.9939 3.63892C14.5686 3.63892 8.95842 7.12946 5.9564 12.3178" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M21.001 10.5835L21 21.0078L28.3606 28.3684" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['editlessonicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M6.25 9.375H35.9375M6.25 18.75H26.5625M6.25 28.125H17.1875M28.125 26.5625L35.9375 18.75M35.9375 18.75L43.75 26.5625M35.9375 18.75V43.75" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
$string['lessonhistoryicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M10.1125 20.2976C9.58855 24.3057 9.27026 28.3786 9.16859 32.5052C14.7383 34.8306 20.0358 37.6779 24.9999 40.986C29.964 37.6779 35.2615 34.8306 40.8312 32.5052C40.7296 28.3786 40.4113 24.3058 39.8873 20.2977M10.1125 20.2976C8.42831 19.7315 6.72367 19.2098 5 18.7341C11.2417 14.359 17.9365 10.5862 25 7.5C32.0635 10.5862 38.7582 14.359 45 18.7341C43.2763 19.2099 41.5716 19.7315 39.8873 20.2977M10.1125 20.2976C15.2808 22.0348 20.2567 24.1907 25 26.7251C29.7432 24.1908 34.7191 22.0348 39.8873 20.2977M14.9028 29.6319C15.6994 29.6319 16.3452 28.9861 16.3452 28.1894C16.3452 27.3928 15.6994 26.747 14.9028 26.747C14.1061 26.747 13.4603 27.3928 13.4603 28.1894C13.4603 28.9861 14.1061 29.6319 14.9028 29.6319ZM14.9028 29.6319V22.5629C18.1559 20.5415 21.5258 18.6903 24.9999 17.0216M11.5229 39.234C13.7761 36.9808 14.9028 34.0276 14.9028 31.0743V28.1894" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['editprofileicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M35.1285 9.34723L38.6441 5.83161C40.1696 4.30613 42.6429 4.30613 44.1684 5.83161C45.6939 7.3571 45.6939 9.8304 44.1684 11.3559L22.0462 33.4781C20.9448 34.5795 19.5863 35.3891 18.0935 35.8338L12.5 37.5L14.1662 31.9065C14.6109 30.4137 15.4205 29.0552 16.5219 27.9538L35.1285 9.34723ZM35.1285 9.34723L40.625 14.8437M37.5 29.1667V39.0625C37.5 41.6513 35.4013 43.75 32.8125 43.75H10.9375C8.34866 43.75 6.25 41.6513 6.25 39.0625V17.1875C6.25 14.5986 8.34867 12.5 10.9375 12.5H20.8333" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['changepassicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M25.0009 30.8333V34.7222M13.3342 42.5H36.6675C38.8153 42.5 40.5564 40.7589 40.5564 38.6111V26.9444C40.5564 24.7967 38.8153 23.0556 36.6675 23.0556H13.3342C11.1864 23.0556 9.44531 24.7967 9.44531 26.9444V38.6111C9.44531 40.7589 11.1864 42.5 13.3342 42.5ZM32.7786 23.0556V15.2778C32.7786 10.9822 29.2964 7.5 25.0009 7.5C20.7053 7.5 17.2231 10.9822 17.2231 15.2778V23.0556H32.7786Z" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round"/></svg>';
$string['bigtrashicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none"><path d="M30.7091 18.75L29.988 37.5M20.012 37.5L19.2909 18.75M40.0576 12.0637C40.7701 12.1713 41.4801 12.2864 42.1875 12.4089M40.0576 12.0637L37.8329 40.9845C37.6451 43.4267 35.6086 45.3125 33.1592 45.3125H16.8408C14.3914 45.3125 12.3549 43.4267 12.1671 40.9845L9.9424 12.0637M40.0576 12.0637C37.6692 11.703 35.2531 11.4268 32.8125 11.2382M7.8125 12.4089C8.51995 12.2864 9.22994 12.1713 9.9424 12.0637M9.9424 12.0637C12.3308 11.703 14.7469 11.4268 17.1875 11.2382M32.8125 11.2382V9.32956C32.8125 6.87255 30.9153 4.82131 28.4596 4.74276C27.3109 4.70601 26.1576 4.6875 25 4.6875C23.8424 4.6875 22.6891 4.70601 21.5404 4.74276C19.0847 4.82131 17.1875 6.87255 17.1875 9.32956V11.2382M32.8125 11.2382C30.2345 11.039 27.6291 10.9375 25 10.9375C22.3709 10.9375 19.7655 11.039 17.1875 11.2382" stroke="#1F2937" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
$string['lonetlogo_btn'] = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none"><path d="M13.001 25.3681C19.8317 25.3681 25.3691 19.8307 25.3691 13C25.3691 6.16925 19.8317 0.631836 13.001 0.631836C6.17022 0.631836 0.632812 6.16925 0.632812 13C0.632812 19.8307 6.17022 25.3681 13.001 25.3681Z" fill="#CE1369"/><path d="M16.4154 9.85628V11.4229H11.5586V10.994L12.4609 10.871V4.76413L11.5586 4.62813V4.21228H14.072V4.62813L13.0572 4.76413V10.939H15.8844L15.9969 9.85628H16.4154Z" fill="white"/><path d="M22.4883 8.68463C22.4883 10.3062 21.6096 11.5589 19.75 11.5589C17.88 11.5589 17.0117 10.3088 17.0117 8.68463C17.0117 7.05002 17.88 5.83386 19.75 5.83386C21.62 5.83386 22.4883 7.05002 22.4883 8.68463ZM21.913 8.68463C21.913 8.09879 21.79 6.38571 19.75 6.38571C17.676 6.38571 17.5976 8.09879 17.5976 8.68463C17.5976 9.24694 17.676 10.9836 19.75 10.9836C21.79 10.9836 21.913 9.24694 21.913 8.68463Z" fill="white"/><path d="M10.238 15.6233C10.238 16.1751 10.238 19.0259 10.238 19.0259L11.2972 19.1383V19.5777H8.70534V19.1383L9.62857 19.0259V15.9502C9.62857 14.8334 9.16564 14.496 8.08549 14.598C7.12826 14.687 6.21549 15.4873 6.21549 15.4873V19.0363L7.12826 19.1488V19.5777H4.54688V19.1488L5.59564 19.0363V14.6425L4.54688 14.5405V14.1246H6.21549V15.0139C6.21549 15.0139 7.20672 13.9886 8.44641 13.9886C9.31472 13.9886 10.238 14.3156 10.238 15.6233Z" fill="white"/><path d="M16.3378 17.0094H12.2683C12.2683 17.9326 12.6292 19.1854 14.3423 19.1854C15.1975 19.1854 15.9769 18.7905 15.9769 18.7905L16.2018 19.1619C16.2018 19.1723 15.2655 19.7137 14.2298 19.7137C12.7417 19.7137 11.6484 18.6205 11.6484 16.795C11.6484 15.0139 12.7417 13.9886 14.1174 13.9886C15.3335 13.9886 16.3718 14.8439 16.3718 16.591C16.3692 16.8185 16.3378 17.0094 16.3378 17.0094ZM12.2787 16.5256H15.8069C15.8174 15.6573 15.5035 14.53 14.1043 14.53C12.7861 14.53 12.2787 15.6337 12.2787 16.5256Z" fill="white"/><path d="M19.84 19.5568C19.84 19.5568 19.343 19.7268 18.8487 19.7268C17.9124 19.7268 17.6666 19.2299 17.6666 18.1366V14.6085H16.7773V14.1246H17.6666L17.8915 12.728H18.2733V14.1246H19.7275V14.6085H18.2733V18.1366C18.2733 18.937 18.3413 19.1514 18.9272 19.2063C19.2777 19.2403 19.5235 19.1723 19.7615 19.1279L19.84 19.5568Z" fill="white"/></svg>';
$string['fbicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><g clip-path="url(#clip0_3056_53263)"><path d="M20 10C20 4.47715 15.5229 0 10 0C4.47715 0 0 4.47715 0 10C0 14.9912 3.65684 19.1283 8.4375 19.8785V12.8906H5.89844V10H8.4375V7.79688C8.4375 5.29063 9.93047 3.90625 12.2146 3.90625C13.3084 3.90625 14.4531 4.10156 14.4531 4.10156V6.5625H13.1922C11.95 6.5625 11.5625 7.3334 11.5625 8.125V10H14.3359L13.8926 12.8906H11.5625V19.8785C16.3432 19.1283 20 14.9912 20 10Z" fill="black"/></g><defs><clipPath id="clip0_3056_53263"><rect width="20" height="20" fill="white"/></clipPath></defs></svg>';
$string['instaicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 1.80078C12.6719 1.80078 12.9883 1.8125 14.0391 1.85937C15.0156 1.90234 15.543 2.06641 15.8945 2.20313C16.3594 2.38281 16.6953 2.60156 17.043 2.94922C17.3945 3.30078 17.6094 3.63281 17.7891 4.09766C17.9258 4.44922 18.0898 4.98047 18.1328 5.95313C18.1797 7.00781 18.1914 7.32422 18.1914 9.99219C18.1914 12.6641 18.1797 12.9805 18.1328 14.0313C18.0898 15.0078 17.9258 15.5352 17.7891 15.8867C17.6094 16.3516 17.3906 16.6875 17.043 17.0352C16.6914 17.3867 16.3594 17.6016 15.8945 17.7813C15.543 17.918 15.0117 18.082 14.0391 18.125C12.9844 18.1719 12.668 18.1836 10 18.1836C7.32813 18.1836 7.01172 18.1719 5.96094 18.125C4.98438 18.082 4.45703 17.918 4.10547 17.7813C3.64063 17.6016 3.30469 17.3828 2.95703 17.0352C2.60547 16.6836 2.39063 16.3516 2.21094 15.8867C2.07422 15.5352 1.91016 15.0039 1.86719 14.0313C1.82031 12.9766 1.80859 12.6602 1.80859 9.99219C1.80859 7.32031 1.82031 7.00391 1.86719 5.95313C1.91016 4.97656 2.07422 4.44922 2.21094 4.09766C2.39063 3.63281 2.60938 3.29688 2.95703 2.94922C3.30859 2.59766 3.64063 2.38281 4.10547 2.20313C4.45703 2.06641 4.98828 1.90234 5.96094 1.85937C7.01172 1.8125 7.32813 1.80078 10 1.80078ZM10 0C7.28516 0 6.94531 0.0117187 5.87891 0.0585938C4.81641 0.105469 4.08594 0.277344 3.45313 0.523437C2.79297 0.78125 2.23438 1.12109 1.67969 1.67969C1.12109 2.23438 0.78125 2.79297 0.523438 3.44922C0.277344 4.08594 0.105469 4.8125 0.0585938 5.875C0.0117188 6.94531 0 7.28516 0 10C0 12.7148 0.0117188 13.0547 0.0585938 14.1211C0.105469 15.1836 0.277344 15.9141 0.523438 16.5469C0.78125 17.207 1.12109 17.7656 1.67969 18.3203C2.23438 18.875 2.79297 19.2188 3.44922 19.4727C4.08594 19.7188 4.8125 19.8906 5.875 19.9375C6.94141 19.9844 7.28125 19.9961 9.99609 19.9961C12.7109 19.9961 13.0508 19.9844 14.1172 19.9375C15.1797 19.8906 15.9102 19.7188 16.543 19.4727C17.1992 19.2188 17.7578 18.875 18.3125 18.3203C18.8672 17.7656 19.2109 17.207 19.4648 16.5508C19.7109 15.9141 19.8828 15.1875 19.9297 14.125C19.9766 13.0586 19.9883 12.7188 19.9883 10.0039C19.9883 7.28906 19.9766 6.94922 19.9297 5.88281C19.8828 4.82031 19.7109 4.08984 19.4648 3.45703C19.2188 2.79297 18.8789 2.23438 18.3203 1.67969C17.7656 1.125 17.207 0.78125 16.5508 0.527344C15.9141 0.28125 15.1875 0.109375 14.125 0.0625C13.0547 0.0117188 12.7148 0 10 0Z" fill="black"/><path d="M9.99609 4.86328C7.16016 4.86328 4.85938 7.16406 4.85938 10C4.85938 12.8359 7.16016 15.1367 9.99609 15.1367C12.832 15.1367 15.1328 12.8359 15.1328 10C15.1328 7.16406 12.832 4.86328 9.99609 4.86328ZM9.99609 13.332C8.15625 13.332 6.66406 11.8398 6.66406 10C6.66406 8.16016 8.15625 6.66797 9.99609 6.66797C11.8359 6.66797 13.3281 8.16016 13.3281 10C13.3281 11.8398 11.8359 13.332 9.99609 13.332Z" fill="black"/><path d="M16.5391 4.6601C16.5391 5.32416 16 5.85932 15.3398 5.85932C14.6758 5.85932 14.1406 5.32025 14.1406 4.6601C14.1406 3.99603 14.6797 3.46088 15.3398 3.46088C16 3.46088 16.5391 3.99994 16.5391 4.6601Z" fill="black"/></svg>';
$string['linkedinicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M18.5195 0H1.47656C0.660156 0 0 0.644531 0 1.44141V18.5547C0 19.3516 0.660156 20 1.47656 20H18.5195C19.3359 20 20 19.3516 20 18.5586V1.44141C20 0.644531 19.3359 0 18.5195 0ZM5.93359 17.043H2.96484V7.49609H5.93359V17.043ZM4.44922 6.19531C3.49609 6.19531 2.72656 5.42578 2.72656 4.47656C2.72656 3.52734 3.49609 2.75781 4.44922 2.75781C5.39844 2.75781 6.16797 3.52734 6.16797 4.47656C6.16797 5.42187 5.39844 6.19531 4.44922 6.19531ZM17.043 17.043H14.0781V12.4023C14.0781 11.2969 14.0586 9.87109 12.5352 9.87109C10.9922 9.87109 10.7578 11.0781 10.7578 12.3242V17.043H7.79688V7.49609H10.6406V8.80078H10.6797C11.0742 8.05078 12.043 7.25781 13.4844 7.25781C16.4883 7.25781 17.043 9.23438 17.043 11.8047V17.043V17.043Z" fill="black"/></svg>';
$string['youtubeicon'] = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none"><path d="M19.8008 4.00006C19.8008 4.00006 19.6055 2.62115 19.0039 2.01569C18.2422 1.21881 17.3906 1.2149 17 1.16803C14.2031 0.964905 10.0039 0.964905 10.0039 0.964905H9.99609C9.99609 0.964905 5.79687 0.964905 3 1.16803C2.60938 1.2149 1.75781 1.21881 0.996094 2.01569C0.394531 2.62115 0.203125 4.00006 0.203125 4.00006C0.203125 4.00006 0 5.62116 0 7.23834V8.75397C0 10.3712 0.199219 11.9922 0.199219 11.9922C0.199219 11.9922 0.394531 13.3712 0.992187 13.9766C1.75391 14.7735 2.75391 14.7462 3.19922 14.8321C4.80078 14.9844 10 15.0313 10 15.0313C10 15.0313 14.2031 15.0235 17 14.8243C17.3906 14.7774 18.2422 14.7735 19.0039 13.9766C19.6055 13.3712 19.8008 11.9922 19.8008 11.9922C19.8008 11.9922 20 10.3751 20 8.75397V7.23834C20 5.62116 19.8008 4.00006 19.8008 4.00006ZM7.93359 10.5938V4.97272L13.3359 7.79303L7.93359 10.5938Z" fill="black"/></svg>';
$string['card_fee_message'] = '+3% is processing fee';