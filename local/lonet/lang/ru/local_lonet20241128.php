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
$string['reviews'] = 'Отзывы';
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

$string['email_learnerwelcome_subject'] = 'Добро пожаловать в Lonet.Academy';
$string['email_learnerwelcome_html'] = '<table width="100%" border="0">
<tr><td align="center"><h2>{$a->firstname}, добро пожаловать в Lonet.Academy!</h2></td></tr>
<tr><td align="center" valign="top">
<a href="https://lonet.academy/vibraty-repetitora" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/ru_welcome.png" width="325" height="273" /></a>
</td></tr>
<tr><td align="center"><h3>Следующий шаг - выбери своего Lonet.Academy репетитора</h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/repetitor" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/ru_choose.png" width="150" height="40" /></a></td></tr>
<tr><td align="center"><h3 style="font-weight:normal">Если сомневаешься, или есть вопросы, <strong>запишись на бесплатную консультацию</strong></h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/konsultacija-skype-repetitor" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/ru_apply.png" width="150" height="40" /></a></td></tr>
</table>
<p>Хорошего дня!</p>
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

$string['email_paymentreceived_subject'] = 'Платеж произведен';
$string['email_paymentreceived_html'] = '
<p>Ваш платеж успешно произведен.</p>
<p>Номер платежа и номер заказа - <strong>{$a->reference}</strong>. Что бы посмотреть детали и распечатать подтверждение платежа, пожалуйста пройдите по ссылке: <a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">подтверждение платежа</a>.</p>
{$a->yourproducts}
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
<p>Пожалуйста, дождитесь подтверждения урока от учителя в течение 24 часов.</p>
<p>Если вы не получили подтверждение или отказ в течение более чем  24 часа, пожалуйста свяжитесь с <a href="https://lonet.academy/contact-us">поддержкой</a> на Lonet.Academy или сообщите о проблеме, ответом на данное электронное письмо.</p>';
$string['yourgiftcards'] = '
<p>Это замечательный выбор, который будет полезен и ценен всегда. Все устаревает и проходит, а знания остаются.</p>{$a}';

$string['cardvalue'] = 'Выбери стоимость карты';
$string['how_many_cards'] = 'Количество карт';
$string['email_requestreceived_subject'] = 'Lesson Request on Lonet.academy';
$string['email_requestreceived_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Your order reference is <strong>{$a->reference}</strong>.</p>
{$a->yourproducts}
<p>Please wait for the requested lessons confirmation from the Teacher.</p>
<p>In case you will not get the confirmation or decline in 24 hours, please <a href="https://lonet.academy/contact-us">contact Lonet support</a> or reply to this email.</p>';

$string['email_giftcardconfirm_subject'] = 'Ваша подарочная карта';
$string['email_giftcardconfirm_html'] = '<p>{$a->fullname},</p>
<p>Поздравляем!</p>
<p>Вы только что приобрели незаменимый подарок – подарок знаний!</p>
{$a->yourproducts}
<p>Номер вашего заказа <strong>{$a->reference}</strong>. Пройдите по <strong><a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">данной ссылке</a></strong>, что бы посмотреть
детали платежа.</p>';

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

$string['email_lessonconfirm_subject'] = 'Урок подтвержден';
$string['email_lessonconfirm_html'] = '<p>Ув. {$a->fullname},</p>
<br>
<p>С радостью сообщаем Вам, что <strong>{$a->lessonname}</strong> урок, в <strong>{$a->lessondate}</strong> в <strong>{$a->lessontime}</strong> подтвержден репетитором {$a->teachername}.</p>
<p>Вы можете отслеживать детали в <a href="https://lonet.academy/user/profile.php">своем профиле</a>.</p>
<p>Вы можете связаться с вашим репетитором через месенджер на сайте в вашем профиле.</p>
<p>Если у вас есть вопросы, или необходима помощь, пожалуйста, пишите ответом на данное письмо.</p>
<br>
<p>Желаем Вам успеха в изучении языка!</p>';

$string['email_lessonexpire_subject'] = 'Урок не подтвержден';
$string['email_lessonexpire_html'] = '<p>Ув. {$a->fullname},</p>
<p>Информируем Вас o том, что ваш запрос на занятие <strong>{$a->lessonname}</strong> в <strong>{$a->lessondate}</strong> в <strong>{$a->lessontime}</strong> часов <strong>НЕ был подтвержден</strong> преподавателем.</p>
<p><strong>Сумма, которую вы оплатили, находится в виртуальном кошельке в Вашем профиле.</strong> Пожалуйста, используйте данную сумму для бронирования урока еще раз. При бронировании используйте кнопку &#34;Оплатить с баланса&#34; (Pay from Balance).</p>
<p>Если у Вас возникли какие-либо вопросы, пожалуйста, ответьте на данное письмо.</p>';

$string['email_lessondecline_subject'] = 'Запрос отклонен. Зарезервируйте еще раз.';
$string['email_lessondecline_html'] = '<p>Ув. {$a->fullname},</p>
<p>Информируем Вас o том, что ваш запрос на занятие <strong>{$a->lessonname}</strong> в <strong>{$a->lessondate}</strong> в <strong>{$a->lessontime}</strong> часов <strong>был отклонен</strong> преподавателем.</p>
<p>По какой то причине <strong>преподаватель отклонил</strong> Ваш запрос.</p>
<p><strong>Сумма, которую вы оплатили, находится в виртуальном кошельке в Вашем профиле.</strong> Пожалуйста, используйте данную сумму для бронирования урока еще раз. При бронировании используйте кнопку &#34;Оплатить с баланса&#34; (Pay from Balance).</p>
<p>Если у Вас возникли какие-либо вопросы, пожалуйста, ответьте на данное письмо.</p>';

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

$string['email_lessonremindstudent_subject'] = 'Напоминание об уроке с репетитором от Lonet.Academy';
$string['email_lessonremindstudent_html'] = '
<p>Ув. {$a->fullname},</p>
<p>С радостью напоминаем Вам об уроке {$a->lessonname}, в {$a->lessondate} в {$a->lessontime} с репетитором {$a->teacherfullname}.</p>
<p>Для более детальной информации, пожалуйста перейдите на <a href="https://lonet.academy/user/profile.php">ваш профиль</a> на Lonet.Academy.</p>
<p>Желаем вам успехов в покорении языка!</p>
<p>Если вы не хотите получать такие напоминания, пожалуйста поменяйте настройки в <a href="https://lonet.academy/user/profile.php">вашем профиле</a>.</p>
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

$string['email_lessonremindteacher_subject'] = 'Напоминание об уроке от Lonet.Academy';
$string['email_lessonremindteacher_html'] = '
<p>Ув. {$a->fullname},</p>
<p>С радостью напоминаем Вам об уроке {$a->lessonname}, в {$a->lessondate} в {$a->lessontime} c {$a->studentfullname}.</p>
<p>Для более детальной информации, пожалуйста перейдите на <a href="https://lonet.academy/user/profile.php">ваш профиль</a> на Lonet.Academy.</p>
<br>
<p>Если вы не хотите получать такие напоминания, пожалуйста поменяйте настройки в <a href="https://lonet.academy/user/profile.php">вашем профиле</a>.</p>
';

$string['email_lessonstatusrequeststudent_subject'] = 'Запрос о статусе забронированного урока';
$string['email_lessonstatusrequeststudent_html'] = '<p>Ув. {$a->fullname},</p>
<br>
<p>
	Пожалуйста, подтвердите, был ли проведен урок "<strong>{$a->lessonname}</strong>" с репетитором <strong>{$a->teacherfullname}</strong>
	<br>{$a->lessondate} в {$a->lessontime}.
</p>
<p>
	{$a->complete} {$a->notcomplete}
</p>';

$string['email_lessonstatusrequestteacher_subject'] = 'Запрос о статусе забронированного урока';
$string['email_lessonstatusrequestteacher_html'] = '<p>Ув. {$a->fullname},</p>
<br>
<p>
	Пожалуйста, подтвердите, был ли проведен урок "<strong>{$a->lessonname}</strong>" с <strong>{$a->studentfullname}</strong>
	<br>{$a->lessondate} в {$a->lessontime}.
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
<p>С уважением,</p>
<p><img src="https://lonet.academy/theme/lonet/pix/icons/logo_small.png" alt="" /></p>
<p>Подпишись на</p>
<p>Lonet.Academy <a href="https://www.facebook.com/lonet.academy" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/facebook.png" alt="facebook" />&nbsp;Facebook</a></p>
<p>Lonet.Academy <a href="https://twitter.com/lonet_academy" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/twitter.png" alt="twitter" />&nbsp;Twitter</a></p>
<p>Lonet.Academy <a href="https://www.linkedin.com/company/lonet/" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/linkedin.png" alt="linkedin" />&nbsp;LinkedIn</a></p>
<p>Читай наши статьи в блоге <a href="https://lonet.academy/blog/" target="_blank">Lonet.Academy</a></p>
<p><strong>Kак связаться с нами:</strong><br/>
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

$string['viewalllanguageteachers'] = '{$a} язык. Другие репетиторы онлайн';
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
$string['notreviewed'] = 'Нет отзывов';
$string['viewschedule'] = 'View Schedule';
$string['booklesson'] = 'Забронируй урок';
$string['bookagain'] = 'Бронируй следующий урок';
$string['mostbooked'] = 'Самый популярный';
$string['recommended'] = 'Учащиеся также бронируют';
$string['booklesson_extra'] = 'Посмотри цены ';
$string['viewprofile'] = 'Посмотри профиль учителя ';
$string['viewreviews'] = 'Посмотри отзывы';
$string['students'] = 'Students';
$string['student'] = 'Student';
$string['teachers'] = 'Teachers';
$string['teacher'] = 'Teacher';
$string['lessons'] = 'Уроки';
$string['giftcards'] = 'Gift Cards';
$string['nolessons'] = 'You don\'t have any scheduled lessons.';
$string['trialprice'] = 'Trial Lesson Price';
$string['price'] = 'Цена';
$string['totalprice'] = 'Цена';
$string['fortrial'] = 'for trial lesson';
$string['teachersince'] = 'Teacher Since';
$string['membersince'] = 'Зарегистрирован с';
$string['viewteacherprofile'] = 'View Teacher Profile';
$string['viewuserprofile'] = 'View User Profile';
$string['backtoteacherprofile'] = 'Back to Teacher Profile';
$string['editprofile'] = 'Редактировать профиль';
$string['changepassword'] = 'Поменять пароль';
$string['noeducationlisted'] = 'Образование не указано';
$string['nooccupationlisted'] = 'Профессия не указана';
$string['professionalteacher'] = 'Professional Teacher';
$string['selectlesson'] = 'Выбери урок';
$string['selectlanguage'] = 'Выбери язык';
$string['singletriallesson'] = 'You can only book one trial lesson';
$string['selecttime'] = 'Выбери доступную дату и время';
$string['emptycart'] = 'Your cart is empty';
$string['registerteacher'] = 'Register as a Teacher';
$string['blockdays'] = 'Block Days';
$string['blockdates'] = 'Block Date Period';
$string['blocktimes'] = 'Block Time Period';
$string['blockdatetimes'] = 'Block Date & Time Period';
$string['days'] = 'Days';
$string['dates'] = 'Dates';
$string['times'] = 'Times';
$string['step'] = 'Шаг';
$string['teaching'] = 'Teaching';
$string['learning'] = 'Learning';
$string['teaches'] = 'Преподает';
$string['speaks'] = 'Говорит';
$string['learns'] = 'Учит';
$string['with'] = 'с';
$string['lessonhistory'] = 'История уроков';
$string['teachinghistory'] = 'Преподавание истории';
$string['learninghistory'] = 'История обучения';
$string['transactionhistory'] = 'История транзакций';
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
$string['paywith'] = 'Оплати с';
$string['paywithcard'] = 'Оплати картой';
$string['paywithpaypal'] = 'Оплати с PayPal';
$string['payfrombalance'] = 'Pay from Balance';
$string['usebalance'] = 'Используй доступный баланс';
$string['paidfrombalance'] = 'Оплачено с баланса';
$string['remainingamount'] = 'Оставшаяся сумма';
$string['confirmbooking'] = 'Confirm Booking';
$string['confirmandpay'] = 'Подтверди и оплати';
$string['introduction'] = 'Introduction';
$string['videourl'] = 'Video URL';
$string['videourl_desc'] = 'YouTube embed URL for landing page video.';
$string['createdat'] = 'Created At';
$string['updatedat'] = 'Updated At';
$string['agreewith'] = 'Я прочитал/-а и согласен/-на с {$a}.';
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
$string['from'] = 'от';
$string['to'] = 'to';
$string['aboutme'] = 'Обо мне';
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
$string['markcompleted'] = 'Урок прошел';
$string['marknotcompleted'] = 'Урок не прошел';
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
$string['available'] = 'доступный';
$string['payouttoteacher'] = 'Payout to Teacher';
$string['h1_teacher_list'] = 'Репетиторы Онлайн';
$string['h1_teacher_list_group'] = 'Языковые уроки в маленькой группе';
$string['languageteachers'] = 'Language Teachers';
$string['languagetutors'] = 'Скайп репетиторы по {$a} языку';
$string['deletemyaccount'] = 'Удалить мой аккаунт';
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

$string['popuptitle'] = 'ПОДОЖДИ!  ПОДПИШИСЬ НА ВАУЧЕР';
$string['popupsubtitle'] = 'БЕСПЛАТНЫЕ УРОКИ АНГЛИЙСКОГО ЯЗЫКА';
$string['popupemailtitle'] = 'Впиши свой адрес электронной почты:';
$string['popupbutton'] = 'ДА, Я ХОЧУ УЧИТЬСЯ БЕСПЛАТНО';

$string['leaveyourreview'] = 'leave your review';

$string['email_subscriber_subject'] = 'Free English Course on LONET';
$string['subscriber_title'] = 'Спасибо, что подписался на <b>Бесплатные Уроки Английского</b> языка на LONET :)';
$string['hello'] = 'Добрый день';
$string['subscriber_thankyou'] = 'Рады приветствовать Тебя в <a href="https://lonet.academy?lang=ru" style="color:#499306;text-decoration:none;"><b>Lonet.Academy</b></a>!';
$string['subscriber_news'] = 'Спешим сообщить, что всем новым пользователям сайта, которые присоединяются к LONET в августе, до 31.08.2018 предоставляем <b>бесплатные уроки английского</b> языка с профессиональным преподавателем On-line.';
$string['subscriber_step1'] = 'Шаг 1. <b>Регистрируйся</b> на сайте LONET до 31 августа: <a href="https://lonet.academy/login/signup.php?lang=ru" style="color:#499306;text-decoration:none;"><b>здесь</b></a>';
$string['subscriber_step2'] = 'Шаг 2. <b>Зарезервируй тестовый урок</b> (trial lesson) с преподавателем <a href="https://lonet.academy/teacher/3?lang=ru" style="color:#499306;text-decoration:none;"><b>Christina Baltach</b></a>';
$string['subscriber_step3'] = 'Шаг 3. Дождись подтверждения урока от преподавателя в течение 24 часа!';
$string['subscriber_lessonnote'] = ' Выбери кнопку “trial lesson”, в календаре выбери удобные для тебя день и время и бронируй урок “confirm and go to payment”';
$string['subscriber_paymentnote'] = 'Для оплаты используй <b>ПРОМО КОД</b>: CHBAL03';
$string['subscriber_footer'] = '
    <p>Преподаватель проведет бесплатный тестовый урок, что бы проверить Твой уровень английского, что бы определить соотвествующую группу для уроков. Также, преподаватель предоставит дальнейшую информацию о <b>бесплатном Online курсе английского для Тебя</b>.</p>
    <p>Если возникли сомнения или вопросы, свяжись с нами <span style="font-size: 18px;">☺</span></p>
    <p><b>Не упусти возможность</b> бесплатного онлайн курса английского и <b>присоединяйся</b> к LONET – Language Online Network <b>сегодня же!</b></p>
';
$string['subscriber_signature'] = 'Lonet.Academy<br><br><a href="mailto:lonet@lonet.academy">lonet@lonet.academy</a><br><a href="tel:37127344201">+371 27 344 201</a><span style="font-size:12px;">10:00 - 22:00 (GMT+2)</span>';

$string['listpromo_en'] = 'To <strong>learn English</strong> is <strong>easy</strong> with the <strong>professional online English language Tutors and Teachers</strong> on LONET! Take several trial lessons, choose the best Tutor for you, book a 10 classes English course and You will notice the result.';
$string['listdesc_en'] = '
<p class="text-center"><u>Занимайся английским языком Online на LONET - Language Online Network</u></p>
<p>
    <strong>Занятия иностранными языками с индивидуальным репетитором онлайн и изучение иностранного языка по скайпу</strong> – это не просто экономия времени и денег, а их эффективное использование для собственного развития, образования и <strong>изучения иностранных языков. </strong> Учи <strong>английский язык по Скайпу с лучшими Онлайн Репетиторами</strong> на Lonet.Academy! Выбери наиболее подходящего для тебя <strong>Репетитора по английскому</strong> в зависимости от твоих индивидуальных целей:
</p>
<p>
    <ul>
        <li>для практики разговорной речи и снятия языкового барьера идеально подходят индивидуальные <strong>уроки по Skype с носителем языка</strong> и <strong>профессиональным репетитором из США</strong>, Великобритании или Австралии;</li>
        <li>для отработки британского произношения и понимания на слух англоговорящих носителей языка, выбирай <strong>онлайн репетитора из Англии</strong>;</li>
        <li>собираешься переезжать в США или ведешь бизнес с партнерами в Штатах, подтяни свои знания <strong>американского английского с онлайн репетитором</strong> из США;</li>
        <li>поступаешь в университет, необходимо закрыть пробелы в грамматике английского или подготовиться в экзаменам по английскому, выбирай <strong>сертифицированного CELTA, TEFEL, TESOL репетитора</strong>, который поможет быстро подготовиться к любого рода тестам и экзаменам, используя качественные учебные материалы, эффективную методику преподавания от ведущих университетов, специализирующихся на преподавании английского языка.</li>
    </ul>
</p>
<p class="text-center"><u>Английский для начинающих Online по скайпу на LONET - Language Online Network</u></p>
<p>Если вы - начинающий изучать английский язык и предпочитаете чувствовать себя более комфортно, то выбирайте преподавателя, который говорит на вашем родном языке. Возьми пробные уроки с несколькими <strong>онлайн преподавателями</strong>, выбери <strong>лучшего репетитора</strong>, который понравился больше всего и продолжай <strong>занятия по английскому онлайн по скайпу</strong> с наиболее подходящим для тебя <strong>опытным репетитором</strong>. Вы начнете говорить уже с ПЕРВОГО занятия! <strong>Репетиторы английского языка</strong> на lonet.academy помогут вам развить правильную и БЕГЛУЮ разговорную речь и МЫШЛЕНИЕ на английском языке, натренируют 100% понимание вами на слух беглой речи носителей языка. Вы увидете ощутимый результат после каждого занятия английским языком. </p>
<p class="text-center"><u>Подтяни знания английского и путешествуй с комфортом</u></p>
<p>Хочешь путешествовать и общаться на английском языке с людьми по всему миру, подбери себе репетитора по английскому языку с похожими интересами и тренируй навык разговорной речи в настоящем контексте, который тебе интересен и полезен для использования в реальной жизни, путешествиях и поездках. Подтяни свои знания английского с репетитором на LONET и общайся на английском языке свободно в поездках по всему миру, заводи новые знакомства, контакты и друзей из разных стран и континентов. Подбери <strong>лучшего репетитора по английскому языку</strong> для себя на LONET, который поможет в <strong>практике английского для путешествий и поездок</strong>.</p>

<p class="text-center"><u>Занятия английским для детей и школьников с репетитором по скайпу</u></p>
<p><strong>Изучение иностранного языка онлайн по Skype</strong> идеально подходит и для детей! Прочитай отзывы некоторых родителей и, не откладывай на завтра! «Занимаясь онлайн, мы находимся в своей зоне комфорта, сын чувствует себя спокойно и уверенно, удобно и соответственно раскрепощается и не стесняется говорить на английском языке.» - говорят родители одного из ученика, который занимается <strong>английским языком с репетиром</strong> на LONET.
<br><a href="https://lonet.academy/blog/ru/english-lessons-by-skype/" target="_blank">читать полный отзыв</a></p>
<p>Забронируй пробные уроки для твоего ребенка на LONET уже сегодня и предоставь ему возможность <strong>заниматься английским языком по Skype</strong>, индивидуально с <strong>лучшими онлайн преподавателями и репетиторами, носителями английского</strong> языка.</p>
';

$string['h1_signup'] = 'СОЗДАТЬ ПРОФИЛЬ НА LONET.ACADEMY';

$string['meta_title_home'] = 'Репетиторы по Скайпу - Учить языки Онлайн | Лучшие репетиторы на LONET';
$string['meta_description_home'] = 'Учи иностранный язык по Скайпу с лучшими Онлайн Репетиторами на Lonet.Academy! Выбери Репетитора и возьми пробный урок. Онлайн уроки с носителем языка. Английский, испанский, арабский, китайский, итальянский и другие иностранные языки.';

$string['meta_title_teacher'] = '{$a} - репетитор по скайпу | Lonet.Academy';
$string['meta_description_teacher'] = 'Репетитор по {$a->languages_ru} языку из Латвии. Учить {$a->languages_lower} язык по Skype c {$a->full_name} | Бери частные уроки с репетитором на Lonet.Academy';
$string['h1_teacher'] = '{$a} - online репетитор по иностранному языку';

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
$string['listdesc_es'] = '';
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
$string['meta_description_consultation'] = 'You will share your doubts and ask the questions you have and you will get the answers from Christina, who is an expert in language teaching and learning on-line.';
$string['h1_consultation'] = 'Репетиторы по иностранному языку на твой выбор!';

$string['consultq1'] = 'Все еще сомневаешься?';
$string['consultq2'] = 'Не уверен/-а, как правильно выбрать репетитора?';
$string['consultq3'] = 'Ни разу не пробовал/-а уроки online? Сомневаешься, подойдут ли такие уроки для тебя?';
$string['consultanswer'] = 'Обсуди все эти вопросы с Кристиной - создательницей Lonet.Academy!';
$string['applynow'] = 'Запишись на бесплатную консультацию';
$string['whatiget'] = 'Что я получу во время консультации?';
$string['content_consultation'] = '
<ul>
    <li>поделись сомнениями и <strong>задай все интересующие тебя вопросы</strong> Кристине лично. Она - создатель Lonet.Academy, а также эксперт по учебе онлайн, сертифицированный преподаватель иностранного языка, филолог английского языка и опытный онлайн репетитор.</li>
    <li>во время консультации у вас будет <strong>возможность увидеть, как проходит коммуникация с учителем в онлайн среде</strong>, как демонстрируются учебные материалы и какие онлайн инструменты используются во время урока.</li>
    <li>Кристина ответит на ваши вопросы <strong>об использовании платформы Lonet.Academy</strong>, об условиях оплаты, отмены уроков и о других технических моментах, которые вас могут интересовать.</li>
    <li>вместе с Кристиной, вы <strong>сможете выбрать наиболее подходящего для ваших целей репетитора</strong>. Так как Кристина проверяет и проводит интервью с каждым преподавателем на Lonet.Academy лично, она <strong>поможет вам сделать первые шаги в выборе репетитора</strong> иностранного языка, учитывая ваш уровень знаний, пожелания, индивидуальные цели и предпочтения.</li>
</ul>
';

$string['pleasesubmitinfo'] = 'Пожалуйста, заполните ниже указанную информацию для записи на консультацию.';
$string['yourname'] = 'Ваше имя';
$string['youremail'] = 'Адрес электронной почты';
$string['languagetolearn'] = 'Язык, который вы хотите учить';
$string['phonenumber'] = 'WhatsApp (номер телефона)';
$string['casewa'] = 'если вы предпочитаете связь по вотсап';
$string['skypeid'] = 'Ваш Skype';
$string['caseskype'] = 'если вы предпочитаете связь по скайпу';
$string['pleasereadagree'] = 'Пожалуйста, прочитайте и согласитесь с политикой конфиденциальности и условиями использования платформы Lonet.Academy';
$string['haveread'] = 'Я прочитал, понял и согласен с';
$string['withprivacy'] = 'политикой конфиденциальности';
$string['withterms'] = 'условиями';
$string['oflonet'] = 'Lonet.Academy';

$string['thankyouforapplication'] = 'Спасибо за вашу заявку!';
$string['schedulesession'] = 'Выберете дату и время консультации с Кристиной прямо сейчас.';
$string['selecttimezone'] = 'Ваш часовой пояс';
$string['yourtimezone'] = 'Ваш часовой пояс';
$string['fullybooked'] = 'На ближайшее время все консультации с Кристиной полностью забронированы.';
$string['willcontact'] = 'Пожалуйста, подождите и Кристина свяжется с вами лично, как только будут распределены следующие сессии для консультаций. Большое спасибо и хорошего дня!';

$string['watchdemolesson'] = 'Watch Demo Lesson';

$string['ihaveaccount'] = 'I have account on Lonet.Academy<br>Enter';
$string['idonthaveaccount'] = 'I don\'t have account yet<br>Create one';

$string['badge_new'] = 'new';
$string['badge_bestprice'] = 'best price';
$string['badge_recommended'] = 'recommended';
$string['badge_specialoffer'] = 'special offer';
$string['badge_native'] = 'native';

$string['paypal_fee_message'] = '+7% дополнительная комиссия за транзакцию';

$string['lessoncount_label'] = 'Проведено уроков';
$string['studentcount_label'] = 'Кол-во учеников';

$string['invite_page_title'] = 'Вы знаете друга, которому понравится Lonet.Academy?';
$string['invite_page_subtitle'] = 'Пригласите друга, и когда он возьмет урок, ВЫ получите 10 евро на ваш баланс в Lonet.Academy.';
$string['invite_page_email_title'] = 'Пригласите друзей по электронной почте';
$string['invite_page_send_button'] = 'послать';
$string['invite_page_button_linkedin'] = 'Поделиться в Linkedin';
$string['invite_page_button_twitter'] = 'Поделиться в Твиттере';
$string['invite_page_button_link'] = 'Копировать ссылку';
$string['invite_page_referral_title'] = 'Как работают рефералы';
$string['invite_page_referral_subtitle_1'] = 'Предложите своим друзьям зарегистрироваться по вашей специальной ссылке для регистрации.';
$string['invite_page_referral_subtitle_2'] = 'Ваш друг получит 10 евро на свой первый урок в Lonet.Academy.';
$string['invite_page_referral_subtitle_3'] = 'Вы получаете 10 евро, когда ваш друг берет урок на сайте.';
$string['userprofile_featuretext'] = '<h3>Поздравляем {$a}!</h3><h4>Пока другие только мечтают, ты уже действуешь! Влюбись в процесс изучения языка и сделай его частью своей жизни.</h4>';
$string['teacherprofile_featuretext'] = '<div style="text-align:center"><h5>Если ты действительно хочешь заговорить на языке, открыть для себя новые горизонты и новые возможности в жизни, ты реально можешь это сделать!</h5>
<h5><strong>{$a} поможет тебе в этом и будет твоим верным сопровождающим в увлекательном пути изучения языка.</strong></h5>
<h5><strong>Полюби изучение языка! Выйди за рамки просто изучения языка, расширь границы знаний и восприятия мира.</strong></h5>
<h5>Не изучай язык, а живи им!</h5></div>';
$string['requestpayout_message'] = 'Вы уже запросили выплату в этом месяце. Пожалуйста, переходите к следующему запросу на выплату в следующем месяце';
$string['topheadermessage'] = '<h5 style="color:#499306;">ВЫЗОВ: <strong>УСТАНОВИ СВОЮ ЦЕЛЬ В ИЗУЧЕНИИ ЯЗЫКА В 2023 ГОДУ</strong><h5>';
$string['challenge_fieldlabel'] = 'Сколько уроков ты хотел/-a бы брать в неделю?';
$string['challenge_title'] = 'ТВОЙ ПРОГРЕСС В ИЗУЧЕНИЯ ЯЗЫКА ЗА 2023 ГОД';
$string['challenge_value'] = 'Выполнено {$a->outof} уроков из {$a->total}.';
$string['challenge_message'] = 'Ты на пути к цели!';
$string['challenge_textlink1'] = '<p style="font-size:12px !important;">Следи за своим прогрессом в обучении языка в <a href="/lonet/user/profile.php?id={$a}"><u>разделе своего профиля</u></a></p>';
$string['challenge_textlink2'] = 'Установи и достигни своей цели в 2023 году и получи подарочную карту на 50 EUR от Lonet.Academy!';
$string['h1_landing_page'] = 'Добро пожаловать в Lonet.Academy!';
$string['landingq1'] = 'Спасибо за регистрацию!';
$string['landingq2'] = 'Следующий шаг - выбери своего репетитора!';
$string['landingq3'] = 'И забронируй пробный урок!';
$string['applyfreeconsulation_url'] = 'https://lonet.academy/konsultacija-skype-repetitor';
$string['landing_page_videolink'] = 'https://www.youtube.com/embed/KwU2zbpt9lY';
$string['booklesson_url'] = 'https://lonet.academy/repetitor';
$string['h1_howitworks_page'] = 'Как это работает';
$string['howitworks_image1_title'] = 'Как создать профиль?';
$string['howitworks_image2_title'] = 'Как забронировать урок?';
$string['howitworks_image3_title'] = 'Где будет проходить урок?';
$string['howitworks_image4_title'] = 'Как перенести урок?';
$string['howitworks_image1_content'] = '<ul>
            <li>Создай свой Lonet.Academy профиль на странице «Регистрируйся»</li>
            <li>Заполни регистрационную форму данными о себе</li>
            <li>Затем нажми кнопку «Регистрируйся»</li>
            <li>После этого на твою электронную почту будет отправлена ссылка, которую нужно будет подтвердить</li>
            <li>Далее ты можешь внести изменения в настройки своего профиля в разделе "Edit profile"</li>
          </ul>
            <div class="col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" style="margin-top: 5px;">
                <div class="media-16x9">
                    <iframe src="https://www.youtube.com/embed/t1u1EF72BwU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>';
$string['howitworks_image2_content'] = '<ul>
          <li>Войди в свой профиль, нажав на кнопку “ВХОД”</li>
          <li>Для входа в свой профиль введи указанные при регистрации электронную почту и пароль</li>
          <li>Чтобы просмотреть список репетиторов:
            <ul>
              <li>на главной странице найди желаемый к изучению язык или</li>
              <li>выбери язык в поисковике или</li>
              <li>нажми на кнопку "ЗАБРОНИРУЙ УРОК" и выбери язык</li>
            </ul>
          </li>
          <li>Нажав на кнопку “Посмотри профиль учителя” ты увидишь информацию и описание о каждом репетиторе</li>
          <li>Нажми на кнопку "Забронируй урок" на профиле репетитора. Далее:
            <ul>
                <li>выбери изучаемый язык (некоторые репетиторы преподают несколько языков)</li>
                <li>выбери тип урока (пробный урок всегда присутствует в выборе) с ценой и длительностью урока</li>
                <li>выбери день и время урока в расписании репетитора. Зеленым полем обозначены доступные часы</li>
            </ul>
          </li>
          <li>Нажми на кнопку “Confirm and go to payment”.</li>
          <li>В случае, если у тебя есть промо-код, напиши его в поле “Promo code”</li>
          <li>Ознакомся с <a href="https://lonet.academy/terms-and-conditions" target="_blank">условиями использования платформы Lonet.Academy</a> и перейди к оплате картой или PayPal
            <ul>
                <li>оплаченная сумма за урок будет показана в личном виртуальном кошельке, виртуальный кошелек можно найти на странице своего профиля</li>
                <li>средства не будут переведены репетитору, пока урок не состоится</li>
                <li>если урок не состоялся, можно использовать остаток средств в виртуальном кошельке, чтобы забронировать любые другие уроки на платформе</li>
                <li>можно забронировать пробные уроки сразу с несколькими преподавателями.</li>
            </ul>
          </li>
          <li>Выбери для себя лучшего репетитора по иностранному языку на Lonet.Academy!</li>
        </ul>';
$string['howitworks_image3_content'] = '<ul>
          <li>Урок проходит на платформе, которая предварительно согласована между тобой и твоим репетитором перед уроком и является наиболее удобной для вас обоих (например, Skype или Zoom)</li>
          <li>После того, как оплата будет произведена, репетитор должен подтвердить забронированный урок в течение 24 часов и на твою электронную почту придет письмо с подтверждением от репетитора</li>
          <li>Перед уроком у тебя будет возможность связаться с репетитором, используя чат на платформе, чтобы:
            <ul>
              <li>задать интересующие тебя вопросы и уточнить детали урока</li>
              <li>поделится своими Skype, Zoom контактами и решить, какую платформу использовать для урока</li>
              <li>ответить на вопросы репетитора о своих языковых навыках и т.д..</li>
            </ul>
          </li>
          <li>Нет необходимости предоставлять дополнительную личную информацию преподавателю против своей воли. Ты не обязан/-а предоставлять такую информацию, как: номер телефона, адрес, фамилию, фотографии и т. д.</li>
          <li>Если возникнут какие-либо сомнения по поводу задаваемых преподавателем вопросов или любой личной информации, которую он/она просит предоставить, пожалуйста проинформируй об этом Lonet.Academy <i>(lonet@lonet.academy, +34 604 13 9040 (WhatsApp), +371 27344 201 (GSM))</i></li>
          <li>Присоединись к уроку в заранее забронированное время и наслаждайся!</li>
        </ul>';
$string['howitworks_image4_content'] = '<ul>
          <li>● Если хочешь перенести урок, ты можешь обсудить это лично со своим преподавателем или отменить уже забронированный урок на Lonet.Academy и забронировать новый. <a href="https://lonet.academy/terms-and-conditions" target="_blank">Условия использования платформы Lonet.Academy будут применены.</a></li>
          <li>Есть несколько вариантов, когда урок может быть не завершен, после чего новый урок может быть забронирован:
            <ul>
              <li>если репетитор не подтвердил или отменил урок - твои оплаченные средства за урок будут доступны в твоем виртуальном кошельке, и ты сможешь использовать их для бронирования следующих уроков</li>
              <li>если репетитор не явился на урок - укажи, что преподаватель не явился на урок в разделе «История урока», твой оплаченные средства за урок будут доступны в твоем виртуальном кошельке, и ты сможешь использовать их для бронирования следующих уроков</li>
            </ul>
          </li>
        </ul>';
$string['scarcity_field'] = 'Сколько новых студентов ты мог/-ла бы принять?';
$string['scarcity_field_option0'] = 'В данный момент я не могу принимать новых учеников';
$string['scarcity_field_option1'] = 'Я могу принять только 1 нового ученика';
$string['scarcity_field_option2'] = 'Я могу взять 2 новых ученика';
$string['scarcity_field_option3'] = 'Я могу принять максимум 3 новых ученика';
$string['scarcity_field_option4'] = 'Я полностью доступен для новых учеников';
$string['scarcity_field_tag0'] = 'Осталось 0 мест';
$string['scarcity_field_tag1'] = 'Осталось только 1 место';
$string['scarcity_field_tag2'] = 'Осталось всего 2 места ';
$string['scarcity_field_tag3'] = 'Осталось 3 места ';
$string['scarcity_field_tag4'] = 'Доступен';
$string['scarcity_field_tooltip0'] = 'Этот преподаватель не берет новых учеников на данный момент';
$string['scarcity_field_tooltip1'] = 'Осталось только 1 место для новых учеников';
$string['scarcity_field_tooltip2'] = 'Осталось только 2 места для новых учеников';
$string['scarcity_field_tooltip3'] = 'Осталось только 3 места для новых учеников';
$string['scarcity_field_tooltip4'] = 'Данный преподаватель свободен для новых учеников';
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
$string['grouplessons'] = 'Уроки в группе';
$string['grouplesson'] = 'Уроки в группе';
$string['joinlesson'] = 'Apúntate aquí';
$string['level'] = 'Уровень ';
$string['age'] = 'Возрастная группа';					   
$string['place'] = 'Место проведения';		
$string['language'] = 'Язык';
$string['date'] = 'Дата';
$string['time'] = 'Время';
$string['duration'] = 'Длительность ';
$string['length'] = 'Длительность ';
$string['maxattendees'] = 'Максимум учеников';
$string['minattendees'] = 'Минимум учеников';
$string['whatislesson'] = 'Тема урока:';
$string['whatulearn'] = 'Чему ты научишься на этом уроке:';									   
$string['bookmyplace'] = 'Забронируй место';									   
$string['noplaceleft'] = 'No place left';									   
$string['contactteacher'] = 'Свяжись с преподавателем';									   