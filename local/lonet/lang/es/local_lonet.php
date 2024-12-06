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
$string['location'] = 'Location';
$string['message'] = 'Message';
$string['messagesubject'] = 'Subject';
$string['minutes'] = 'minutes';
$string['notifications'] = 'Notifications';
$string['options'] = 'Options';
$string['preview'] = 'Preview';
$string['reviews'] = 'Reseñas';
$string['reminder'] = 'Reminder';
$string['save'] = 'Save';
$string['schedule'] = 'Schedule';
$string['scheduler'] = 'Scheduler';
$string['student'] = 'Student';
$string['students'] = 'Students';
$string['teacher'] = 'Teacher';
$string['learner'] = 'Estudiante';
$string['learners'] = 'Learners';

/* *********** E-mail templates ************ */
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

$string['email_learnerwelcome_subject'] = 'Bienvenido a Lonet.Academy';
$string['email_learnerwelcome_html'] = '<table width="100%" border="0">
<tr><td align="center"><h2>{$a->firstname}, ¡bienvenido a Lonet.Academy!</h2></td></tr>
<tr><td align="center" valign="top">
<a href="https://lonet.academy/find-your-language-tutor?lang=es" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/es_welcome.png" width="325" height="273" /></a>
</td></tr>
<tr><td align="center"><h3>El siguiente paso es elegir a su tutor de Lonet.Academy</h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/profesores-online" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/es_choose.png" width="150" height="40" /></a></td></tr>
<tr><td align="center"><h3 style="font-weight:normal">Si tiene dudas o preguntas, <strong>solicite una consulta gratuita</strong></h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/language-tutor-consultation?lang=es" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/es_apply.png" width="150" height="40" /></a></td></tr>
</table>
<p>¡Que tenga un buen día!</p>
<p>Christina Baltach</p>';

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

$string['yourlessons'] = '
<p>Please wait for the requested lessons confirmation from the tutor.</p>
<p>In case you will not get the confirmation or decline in 24 hours, please <a href="https://lonet.academy/contact-us">contact Lonet.Academy support</a> or reply to this email.</p>
';
$string['yourgiftcards'] = '<p>Please find below your Gift Card to Lonet.Academy classes online:</p>{$a}';
$string['cardvalue'] = 'Valor de la tarjeta';
$string['how_many_cards'] = 'Cuantas cartas';
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
<p>You have bought one of the best Christmas presents – A Gift Of Language!</p>
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

$string['email_lessonexpire_subject'] = 'Lección no confirmada';
$string['email_lessonexpire_html'] = '<p>Estimado(a) {$a->fullname},</p>
<p>Tenga en cuenta que su clase <strong>{$a->lessonname}</strong>,<strong>{$a->lessondate}</strong> a <strong>{$a->lessontime} NO ha sido confirmada</strong> por el profesor.</p>
<p><strong>El importe que usted pagó está disponible en su billetera virtual en el perfil.</strong>Puede usarlo para reservar cualquier otra clase en Lonet.Academy.</p>
<p>Intente continuar con la solicitud de la clase otra vez o elija cualquier otro profesor disponible. Utilice el botón &#34;Pagar desde el saldo&#34; (Payfrom balance) para reservar la siguiente clase.</p>
<p>Si tiene alguna pregunta o necesita ayuda, responda a este correo electrónico.</p>';

$string['email_lessondecline_subject'] = 'La solicitud de la clase ha sido denegada. Reservala otra vez.';
$string['email_lessondecline_html'] = '<p>Estimado(a) {$a->fullname},</p>
<p>Tenga en cuenta que su solicitud de la clase <strong>{$a->lessonname}</strong>, <strong>{$a->lessondate}</strong> a <strong>{$a->lessontime}</strong> <strong>ha sido denegada</strong> por el profesor.</p>
<p><strong>El importe que usted pagó está disponible en su billetera virtual en el perfil.</strong> Puede usarlo para reservar cualquier otra clase en Lonet.Academy.</p>
<p>Intente continuar con la solicitud de la clase otra vez o elija cualquier otro profesor disponible. Utilice el botón &#34;Pagar desde el saldo&#34; (Payfrom balance) para reservar la siguiente clase.</p>
<p>Si tiene alguna pregunta o necesita ayuda, responda a este correo electrónico.</p>';

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

$string['emailsignature'] = '<br>
<p>Atentamente,</p>
<p><img src="https://lonet.academy/theme/lonet/pix/icons/logo_small.png" alt="" /></p>
<p>Lonet.Academyen <a href="https://www.facebook.com/lonet.academy" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/facebook.png" alt="facebook" />&nbsp;Facebook</a></p>
<p>Lonet.Academyen <a href="https://twitter.com/lonet_academy" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/twitter.png" alt="twitter" />&nbsp;Twitter</a></p>
<p>Lonet.Academyen <a href="https://www.linkedin.com/company/lonet/" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/linkedin.png" alt="linkedin" />&nbsp;LinkedIn</a></p>
<p><strong>Contactos:</strong><br/>
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

$string['editlessons'] = 'Editar lecciones';
$string['editschedule'] = 'Editar horario';
$string['weekdays'] = 'Working Days';
$string['workhours'] = 'Working Hours';
$string['breakstarttime'] = 'Break Start Time';
$string['breakendtime'] = 'Break End Time';
$string['starttime'] = 'Lesson Start Time';
$string['endtime'] = 'Lesson End Time';

$string['emptyrating'] = 'Default Rating';
$string['emptyrating_desc'] = 'Default Rating will be shown when teacher has not yet been rated.';

$string['viewalllanguageteachers'] = 'Ver todos los profesores de inglés';
$string['notfound'] = 'Teacher profile not found.';
$string['lessonnotfound'] = 'Lesson not found.';
$string['notrated'] = 'Not rated yet';
$string['rate'] = 'Rate';
$string['youropinion'] = 'Your opinion is very important to us';
$string['rating'] = '<span class="text-green">Please rate the \'{$a->name}\' lesson with {$a->teacher}:</span>
<br><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> poor
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> moderate
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> good
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span> very good
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span> excellent';
$string['notreviewed'] = 'Not reviewed yet';
$string['viewschedule'] = 'View Schedule';
$string['booklesson'] = 'Reserva la clase';
$string['bookagain'] = 'Reserva otra clase';
$string['mostbooked'] = 'Más popular';
$string['recommended'] = 'Las estudiantes también reservan';
$string['booklesson_extra'] = 'Ve precios';
$string['viewprofile'] = 'Ve perfil';
$string['viewreviews'] = 'Ve reseñas';
$string['students'] = 'Students';
$string['student'] = 'Student';
$string['teachers'] = 'Teachers';
$string['teacher'] = 'Professor (Tutor)';
$string['lessons'] = 'Lessons';
$string['giftcards'] = 'Gift Cards';
$string['nolessons'] = 'You don\'t have any scheduled lessons.';
$string['trialprice'] = 'Trial Lesson Price';
$string['price'] = 'precio';
$string['totalprice'] = 'Precio Total';
$string['fortrial'] = 'for trial lesson';
$string['teachersince'] = 'Teacher Since';
$string['membersince'] = 'Miembro desde';
$string['viewteacherprofile'] = 'Ver perfil del profesor';
$string['viewuserprofile'] = 'Ver perfil de usuario';
$string['backtoteacherprofile'] = 'Back to Teacher Profile';
$string['editprofile'] = 'Editar perfil';
$string['changepassword'] = 'Cambiar la contraseña';
$string['noeducationlisted'] = 'No education listed';
$string['nooccupationlisted'] = 'No occupation listed';
$string['professionalteacher'] = 'Professional Teacher';
$string['selectlesson'] = 'seleccione el tipo de lección';
$string['selectlanguage'] = 'Please select language of lesson';
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
$string['teaching'] = 'Enseñando';
$string['learning'] = 'Learning';
$string['teaches'] = 'Enseña';
$string['speaks'] = 'Habla';
$string['learns'] = 'Aprenda';
$string['with'] = 'with';
$string['lessonhistory'] = 'Historial de lecciones';
$string['teachinghistory'] = 'Teaching History';
$string['learninghistory'] = 'Learning History';
$string['transactionhistory'] = 'Historial de transacciones';
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
$string['payfrombalance'] = 'Pay from Balance';
$string['usebalance'] = 'Use Available Balance';
$string['paidfrombalance'] = 'Paid From Balance';
$string['remainingamount'] = 'Remaining Amount';
$string['confirmbooking'] = 'Confirm Booking';
$string['confirmandpay'] = 'Confirmar y Pagar';
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
$string['from'] = 'desde';
$string['to'] = 'to';
$string['aboutme'] = 'Acerca de mí';
$string['interestsandhobbies'] = 'Intereses y Hobbies';

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
$string['cancel'] = 'Cancelar';
$string['canceledbylearner'] = 'Canceled by Learner';
$string['canceledbyteacher'] = 'Canceled by Teacher';
$string['completed'] = 'Completed';
$string['notcompleted'] = 'Not Completed';
$string['contactlearner'] = 'Contactar al alumno';
$string['contactteacher'] = 'Contact Teacher';
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
$string['available'] = 'disponible';
$string['payouttoteacher'] = 'Payout to Teacher';
$string['h1_teacher_list'] = 'Language Teachers Online';
$string['h1_teacher_list_group'] = 'Cursos de idiomas en grupos pequeños';
$string['languageteachers'] = 'Language Teachers';
$string['languagetutors'] = 'Profesores particulares de {$a} online'; //{$a} Tutores privados en línea
$string['deletemyaccount'] = 'Borrar mi cuenta';
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
$string['subscriber_step2'] = 'Step 2: <b>Book the trial lesson</b> On-line with <a href="https://lonet.academy/teacher/3" style="color:#499306;text-decoration:none;"><b>Christina Baltach</b></a>';
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

$string['h1_signup'] = 'Crear cuenta en Lonet.Academy';

$string['meta_title_home'] = 'Online Language Tutors - Learn Languages Fast | Online courses on LONET';
$string['meta_description_home'] = 'Learn languages fast and easy Online. The best Language Tutors on lonet.academy! Choose a tutor. Book a trial lesson. And continue to learn a language online. One-on-one classes with the best native tutors.';

$string['meta_title_teacher'] = '{$a} - Online Language Tutor | Lonet.Academy';
$string['meta_description_teacher'] = '{$a->languages} tutor from {$a->location}. Learn {$a->languages} with {$a->name} by Skype | Language lessons on Lonet.Academy. Book your lesson with {$a->full_name} now!';
$string['h1_teacher'] = '{$a} - profesor particular de idiomas online';

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

$string['meta_title_consultation'] = 'Solicitar una consulta gratuita | Lonet.Academy';
$string['meta_description_consultation'] = 'You will share your doubts and ask the questions you have and you will get the answers from Christina, who is an expert in language teaching and learning on-line.';
$string['h1_consultation'] = '¡Elige tu mejor tutor de idiomas!';

$string['consultq1'] = '¿Aún tienes dudas?';
$string['consultq2'] = '¿No estás seguro de cómo elegir un tutor para ti?';
$string['consultq3'] = '¿No estás seguro si las clases en línea son buenas para ti?';
$string['consultanswer'] = '¡Habla con Christina, la creadora de Lonet.Academy!';
$string['applynow'] = 'SOLICITAR UNA CONSULTA GRATIS';
$string['whatiget'] = 'What will I get during the consultation?';
$string['content_consultation'] = '
<ul>
    <li>You will share your doubts and <strong>ask the questions</strong> you have and you will <strong>get the answers</strong> from Christina, who is an expert in language teaching and learning on-line.</li>
    <li>You will be able to <strong>see how the on-line class-room communication works</strong>.</li>
    <li>Christina will reply to your questions about <strong>how-it-works</strong> on Lonet.Academy.</li>
    <li>You will <strong>get help in choosing the best tutor</strong> for you, because Christina checks and interviews every tutor on Lonet.Academy personally. So, she will help you to <strong>make the first steps</strong> in choosing the most appropriate tutor for you.</li>
</ul>
';

$string['pleasesubmitinfo'] = 'Envíe la siguiente información para inscribirse en la consulta';
$string['yourname'] = 'Nombre';
$string['youremail'] = 'Correo electrónico';
$string['languagetolearn'] = 'Idioma que deseas aprender';
$string['phonenumber'] = 'Numero de telefono';
$string['casewa'] = 'en caso de que prefiera la comunicación por WA';
$string['skypeid'] = 'Identificación del skype';
$string['caseskype'] = 'en caso de que prefieras la comunicación por Skype';
$string['pleasereadagree'] = 'Lea y acepte la política de privacidad y los términos y condiciones de Lonet.Academy';
$string['haveread'] = 'He leído, entendido y acepto la';
$string['withprivacy'] = 'política de privacidad';
$string['withterms'] = 'términos y condiciones';
$string['oflonet'] = 'of Lonet.Academy';

$string['thankyouforapplication'] = 'Thank you for Your application!';
$string['schedulesession'] = 'Schedule Your session with Christina right now!';
$string['selecttimezone'] = 'Select timezone';
$string['yourtimezone'] = 'Your Timezone';
$string['fullybooked'] = 'At the moment all consultation sessions with Christina are fully booked';
$string['willcontact'] = 'Christina will contact you personally as soon as there is an available time. Thank you! Have a wonderful day!';

$string['watchdemolesson'] = 'Ve lección de demostración';

$string['ihaveaccount'] = 'Tengo una cuenta en Lonet.Academy<br>Entrar ';
$string['idonthaveaccount'] = 'Todavía no tengo cuenta<br>Crear una';

$string['badge_new'] = 'NUEVO/A';
$string['badge_bestprice'] = 'best price';
$string['badge_recommended'] = 'recommended';
$string['badge_specialoffer'] = 'special offer';
$string['badge_native'] = 'NATIVO/A';

$string['paypal_fee_message'] = '+7% additional payment commission applicable';

$string['lessoncount_label'] = 'Clases acabadas';
$string['studentcount_label'] = 'Alumnos';

$string['invite_page_title'] = 'Conoce a una amiga que disfrutaría de Lonet.Academy?';
$string['invite_page_subtitle'] = 'Invita a un amigo y cuando tome una lección, TÚ recibirás 10 EUR en tu saldo en Lonet.';
$string['invite_page_email_title'] = 'Invita a tus amigos por correo electrónico';
$string['invite_page_send_button'] = 'Enviar';
$string['invite_page_button_linkedin'] = 'Compartir en Linkedin';
$string['invite_page_button_twitter'] = 'Compartir en Twitter';
$string['invite_page_button_link'] = 'Copiar link';
$string['invite_page_referral_title'] = 'Cómo funcionan las referencias';
$string['invite_page_referral_subtitle_1'] = 'Haga que sus amigos se registren a través de su enlace de registro personalizado.';
$string['invite_page_referral_subtitle_2'] = 'Tu amiga recibe 10 euros para gastar en su primera lección en Lonet.Academy.';
$string['invite_page_referral_subtitle_3'] = 'Obtienes 10 euros cuando tu amiga toma una lección en el sitio.';
$string['userprofile_featuretext'] = '<h3>¡Felicidades {$a}!</h3><h4>Mientras otros sólo lo están soñando, ¡Tú ya lo estás haciendo! Enamórate del aprendizaje de idiomas y hazlo parte de tu vida.</h4>';
$string['teacherprofile_featuretext'] = '<div style="text-align:center"><h5>If you really want to learn a foreign language, open new horizons for your personal growth and increase your life opportunities, you can do it!</h5>
<h5><strong>{$a} is intended to be your faithful companion on this challenging, but truly rewarding journey.</strong></h5>
<h5><strong>Fall in love with language learning.</strong></h5>
<h5><strong>Discover a new language. Hear it, read it, sing it, dance it, feel it, speak it…. </strong>just live it!</h5></div>';
$string['requestpayout_message'] = 'Ya solicitó el pago de este mes. Continúe con la próxima solicitud de pago el próximo mes';
$string['topheadermessage'] = '<h5 style="color:#499306;">DESAFÍO: <strong>FIJA TU META DE APRENDIZAJE DEL AÑO 2023</strong><h5>';
$string['challenge_fieldlabel'] = '¿Cuántas clases quieres hacer por semana?';
$string['challenge_title'] = 'EL PROGRESO DE TU DESAFÍO DEL AÑO 2023';
$string['challenge_value'] = 'Has completado {$a->outof} clases de {$a->total}.';
$string['challenge_message'] = '¡Estás en camino!';
$string['challenge_textlink1'] = '<p style="font-size:12px !important;">Sigue el progreso del desafió <a href="/user/profile.php?id={$a}"><u>en tu perfil</u></a></p>';
$string['challenge_textlink2'] = '¡Fija y cumple tu meta en 2023 y recibe una tarjeta de regalo de 50 EUR de Lonet.Academy!';
$string['h1_landing_page'] = '¡Bienvenido a Lonet.Academy!';
$string['landingq1'] = '¡Gracias por registrarte!';
$string['landingq2'] = '¡El siguiente paso es elegir a tu tutor!';
$string['landingq3'] = '¡Y reserva tu primera clase!';
$string['applyfreeconsulation_url'] = 'https://lonet.academy/language-tutor-consultation?lang=es';
$string['landing_page_videolink'] = 'https://www.youtube.com/embed/EZVFHDqnUHQ';
$string['booklesson_url'] = 'https://lonet.academy/profesores-online';
$string['h1_howitworks_page'] = '¿Cómo funciona?';
$string['howitworks_image1_title'] = '¿Cómo crear una cuenta?';
$string['howitworks_image2_title'] = '¿Cómo reservar una clase?';
$string['howitworks_image3_title'] = '¿Dónde será la clase?';
$string['howitworks_image4_title'] = '¿Cómo reprogramar una clase?';
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
$string['scarcity_field_option0'] = 'I can\'t accept new students at the moment';
$string['scarcity_field_option1'] = 'I can take only 1 new student';
$string['scarcity_field_option2'] = 'I can take 2 new students';
$string['scarcity_field_option3'] = 'I can take maximum 3 new students';
$string['scarcity_field_option4'] = 'I am fully available for new students';
$string['scarcity_field_tag0'] = '0 places left';
$string['scarcity_field_tag1'] = 'Only 1 place left';
$string['scarcity_field_tag2'] = 'Only 2 places left';
$string['scarcity_field_tag3'] = '3 places left';
$string['scarcity_field_tag4'] = 'Available';
$string['scarcity_field_tooltip0'] = 'This tutor doesn\'t accept new students at the moment';
$string['scarcity_field_tooltip1'] = 'There is only one place left for a new student with this tutor';
$string['scarcity_field_tooltip2'] = 'There are places left for 2 new students with this tutor';
$string['scarcity_field_tooltip3'] = 'There are places left for 3 new students with this tutor';
$string['scarcity_field_tooltip4'] = 'This tutor is fully available for new students';
$string['nativelanguage'] = 'Native language';
$string['studentageyouteach'] = 'I teach : ';
$string['levelyouteach'] = 'Levels I teach : ';
$string['typeoflessons'] = 'Types of lessons : ';
$string['coursebooks'] = '<strong>Course books : </strong>';
$string['teachingmaterials'] = 'Teaching materials : ';
$string['teachingcertificates'] = '<strong>Certificates : </strong>';
$string['lessonplan'] = '<strong>My lesson plan : </strong>';
$string['onlinetools'] = 'Online tools I use for lessons : ';
$string['linkedinpage'] = '<strong>Linkedin page : </strong>';
/******************Group Lesson**************************/
$string['grouplessons'] = 'Clase en grupo';
$string['grouplesson'] = 'Clase en grupo';
$string['joinlesson'] = 'Apúntate aquí';
$string['language'] = 'Idioma';
$string['level'] = 'Nivel';
$string['age'] = 'Edad';					   
$string['place'] = 'Sitio';		
$string['date'] = 'Fecha';
$string['time'] = 'Hora';
$string['duration'] = 'Duración';
$string['length'] = 'Duración';
$string['maxattendees'] = 'Máximo de participantes';
$string['minattendees'] = 'Minimo de participantes';
$string['whatislesson'] = 'El tema de la clase:';
$string['whatulearn'] = 'Qué vamos a aprender en esta clase:';									   
$string['bookmyplace'] = 'Reserva tu plazo';									   
$string['noplaceleft'] = 'No place left';									   
$string['contactteacher'] = 'Contacta con el/la profesor(a)';	
$string['teacher_breadcrumb_all_teachers']='todos los profesores';								   