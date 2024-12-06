<?php
$string['pluginname'] = 'Lonet';
$string['pluginadministration'] = 'Lonet';
$string['modulename'] = 'Lonet';
$string['modulename_help'] = 'LONET.academy plugin';
$string['modulename_link'] = 'local/lonet/view';
$string['modulenameplural'] = 'Lonet';
$string['generalsettings'] = 'Iestatījumi';
$string['notsetup'] = 'Šis skolotājs vēl nav sastādījis nodarbību grafiku.';
$string['schedule'] = 'Grafiks';
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
$string['date'] = 'Datums';
$string['lessonname'] = 'Nodarbības nosaukums';
$string['length'] = 'Ilgums';
$string['location'] = 'Atrašanās vieta';
$string['message'] = 'Message';
$string['messagesubject'] = 'Subject';
$string['minutes'] = 'minutes';
$string['notifications'] = 'Notifications';
$string['options'] = 'Options';
$string['preview'] = 'Preview';
$string['reviews'] = 'Atsauksmes';
$string['reminder'] = 'Reminder';
$string['save'] = 'Save';
$string['schedule'] = 'Schedule';
$string['scheduler'] = 'Scheduler';
$string['student'] = 'Student';
$string['students'] = 'Studenti';
$string['teacher'] = 'Skolotājs';
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

$string['email_learnerwelcome_subject'] = 'Laipni lūdzam Lonet.Academy';
$string['email_learnerwelcome_html'] = '<table width="100%" border="0">
<tr><td align="center"><h2>{$a->firstname}, laipni lūdzam Lonet.Academy!</h2></td></tr>
<tr><td align="center" valign="top">
<a href="https://lonet.academy/izvelies-labako-privatskolotaju" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/lv_welcome.png" width="325" height="273" /></a>
</td></tr>
<tr><td align="center"><h3>Nākamais solis ir izvēlēties savu Lonet.Academy pasniedzēju</h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/valodu-kursi" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/lv_choose.png" width="150" height="40" /></a></td></tr>
<tr><td align="center"><h3 style="font-weight:normal">Ja rodas šaubas vai jautājumi, <strong>piesakies bezmaksas konsultācijai pie manis</strong></h3></td></tr>
<tr><td align="center"><a href="https://lonet.academy/ka-izveleties-labako-svesvalodas-skolotaju" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/mail_body/lv_apply.png" width="150" height="40" /></a></td></tr>
</table>
<p>Jauku dienu!</p>
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

$string['email_paymentreceived_subject'] = 'Maksājums saņemts';
$string['email_paymentreceived_html'] = '
<p>Jūsu maksājums ir veiksmīgi izpildīts.</p>
<p>Jūsu maksājuma un pasūtījuma reference ir <strong>{$a->reference}</strong>. <strong>Lai apskatītu vairāk informācijas, spiediet <a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">šeit</a>.</strong></p>
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
<p>Lūdzu sagaidiet pieprasīto nodarbību apstiprinājumu no skolotāja.</p>
<p>Gadījumā, ja nesaņemat apstiprinājumu vai noliegumu 24 stundu laikā, lūdzu <a href="https://lonet.academy/contact-us">sazinities ar Lonet.Academy atbalstu</a> vai atbildiet uz šo vēstuli.</p>
';
$string['yourgiftcards'] = '';//<p>Lūdzu, saņemiet jūsu karti:</p>{$a}
$string['cardvalue'] = 'Izvēlies kartes vērtību';
$string['how_many_cards'] = 'Karšu daudzums';
$string['email_requestreceived_subject'] = 'Lesson Request on Lonet.academy';
$string['email_requestreceived_html'] = '<p>Dear {$a->fullname},</p>
<br>
<p>Your order reference is <strong>{$a->reference}</strong>.</p>
{$a->yourproducts}
<p>Please wait for the requested lessons confirmation from the Teacher.</p>
<p>In case you will not get the confirmation or decline in 24 hours, please <a href="https://lonet.academy/contact-us">contact Lonet support</a> or reply to this email.</p>';

$string['email_giftcardconfirm_subject'] = 'Jūsu dāvanas karte';
$string['email_giftcardconfirm_html'] = '<p>Labdien {$a->fullname},</p>
<p>Apsveicam!</p>
<p>Tu esi iegādājies labāko Ziemassvētku Dāvanu, ko var uzdavināt Taviem draugiem un
mīļotiem – Zināšanas Dāvanu!</p>
{$a->yourproducts}
<p>Pasūtījuma numurs <strong>{$a->reference}</strong>. Maksājuma detaļus var apskatīt <strong><a href="https://lonet.academy/local/lonet/receipt.php?id={$a->link}">šeit</a></strong>.</p>';

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

$string['email_lessonconfirm_subject'] = 'Nodarbība apstiprināta';
$string['email_lessonconfirm_html'] = '
<p>Labdien {$a->fullname}!</p>
<br>
<p>Skolotājs {$a->teachername} ir apstiprinājis Jūsu <strong>{$a->lessonname}</strong> nodarbību <strong>{$a->lessondate}</strong>, plkst. <strong>{$a->lessontime}</strong>.</p>
<p>Jūs varat apskatīt vairāk informācijas savā <a href="https://lonet.academy/user/profile.php">profilā</a>.</p>
<p>Lūdzu sazinieties ar savu skolotāju caur saraksti savā profilā.</p>
<p>Ja Jums nepieciešama palīdzība, lūdzu atbildiet uz šo vēstuli.</p>
<br>
<p>Paldies!</p>
';

$string['email_lessonexpire_subject'] = 'Nodarbība nav apstiprināta';
$string['email_lessonexpire_html'] = '<p>Labdien {$a->fullname} !</p>
<p>Dažu iemesļu dēļ, skolotājs <strong>{$a->lessonname}</strong> NAV apstiprinājis Jūsu <strong>{$a->lessondate}</strong>, plkst. <strong>{$a->lessontime}</strong></p>
<p>Jūsu samaksātā summa ir pieejamā virtuālajā makā jūsu profilā. Lūdzam to izmantot, rezervējot nodarbību vēl reizi.</p>
<p>Rezervējot nodarbību pie apmaksas, lūdzu, izmantojiet pogu &#34;Maksāt no atlikuma&#34;/ &#34;Pay from balance&#34;.</p>
<p>Ja Jums nepieciešama palīdzība, lūdzu atbildiet uz šo vēstuli.</p>';

$string['email_lessondecline_subject'] = 'Jūsu pieprasījums tika atteikts. Veiciet klases rezervāciju vēlreiz.';
$string['email_lessondecline_html'] = '<p>Labdien {$a->fullname} !</p>
<p>Dažu iemesļu dēļ, skolotājs atteica Jūsu <strong>{$a->lessonname}</strong> nodarbības pieprasījumu <strong>{$a->lessondate}</strong>, plkst. <strong>{$a->lessontime}</strong></p>
<p>Jūsu samaksātā summa ir pieejamā virtuālajā makā jūsu profilā. Lūdzam to izmantot, rezervējot nodarbību vēl reizi. </p>
<p>Rezervējot nodarbību pie apmaksas, lūdzu, izmantojiet pogu &#34;Maksāt no atlikuma&#34;/ &#34;Pay from balance&#34;.</p>
<p>Ja Jums nepieciešama palīdzība, lūdzu atbildiet uz šo vēstuli.</p>';

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

$string['email_lessonfeedbackrequest_subject'] = 'Tava pieredze Lonet.Academy';
$string['email_lessonfeedbackrequest_html'] = '<p>Labdien {$a->firstname}!</p>
<p>
	<br>Vai Jums bija laba pieredze ar savu pasniedzēju <strong>{$a->teacherfullname}</strong> <strong>Lonet.Academy</strong>?
</p>
<p>
	<br>Lūdzu novērtējiet savu {$a->language} valodas nodarbību un {$a->button} par savu skolotāju un mācību procesu ar viņu. 
</p>
<p>
	<strong>Šis palīdzēs Jūsu skolotājam atrast jaunus studentus.</strong>
	<br>Šis <strong>palīdzēs citiem valodu apguvējiem izdarīt izvēli</strong>, meklējot labu {$a->language} valodas skolotāju.
</p> 
<p>
	<br>Šeit, Lonet.Academy, mēs patiesi cenšamies darīt visu, lai palīdzētu pasaulei mācīties svešvalodas viegli, efektīvi un patīkami.
</p> 
<p>
	<br>Mēs darām visu iespējamo, lai <strong>izvēlētos pieredzējušus valodu pasniedzējus un savienotu valodu apguvējus ar valodu privātskolotājiem visā pasaulē</strong>.
</p> 
<p>
	<br><strong>Tāpēc Jūsu pieredze Lonet.Academy mums ir ļoti svarīga!</strong> 
</p> 
<p>
	<br>Mēs ceram, ka Jums patīk valodas apguves process ar privātskolotāju Lonet.Academy platformā, un Jūs pastāstīsiet par mums Jūsu draugiem un kolēģiem!
</p>
<p>
	Seko Lonet.Academy <a href="https://www.facebook.com/lonet.academy"><img src="https://facebookbrand.com/wp-content/uploads/2016/05/flogo_rgb_hex-brc-site-250.png" width="16" height="16" style="margin-right: 5px;">Facebook</a>
	<br>Seko Lonet.Academy <a href="https://twitter.com/lonet_academy"><img src="https://abs.twimg.com/responsive-web/web/icon-ios.8ea219d08eafdfa44.png" width="16" height="16" style="margin-right: 5px;">Twitter</a>
	<br>Seko  Lonet.Academy <a href="https://www.linkedin.com/company/lonet/"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Linkedin.svg/220px-Linkedin.svg.png" width="16" height="16" style="margin-right: 5px;">LinkedIn</a>
	<br>Piesakies Lonet.Academy <a href="https://lonet.academy/blog">jaunumiem</a>
</p>
<p>
	Novēlam Jums brīnišķīgu dienu un lielisku ceļojumu valodu apguves pasaulē!
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
	<br>Epasts: <a href="mailto:lonet@lonet.academy">lonet@lonet.academy</a>
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
<p>Your payout request reference number <strong>{$a->reference} has been accepted and confirmed on {$a->date}</strong>.</p>
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
<p>Ar cieņu,</p>
<p><img src="https://lonet.academy/theme/lonet/pix/icons/logo_small.png" alt="" /></p>
<p>Seko Lonet.Academy <a href="https://www.facebook.com/lonet.academy" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/facebook.png" alt="facebook" />&nbsp;Facebook</a></p>
<p>Seko Lonet.Academy <a href="https://twitter.com/lonet_academy" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/twitter.png" alt="twitter" />&nbsp;Twitter</a></p>
<p>Seko Lonet.Academy <a href="https://www.linkedin.com/company/lonet/" target="_blank"><img src="https://lonet.academy/theme/lonet/pix/icons/linkedin.png" alt="linkedin" />&nbsp;LinkedIn</a></p>
<p>Lasi <a href="https://lonet.academy/blog/" target="_blank">Lonet.Academy bloga rakstus</a> par valodu apguvi.</p>
<p><strong>Sazinies ar mums:</strong><br/>
Tel/WA: +371 27 344 201<br/>
Web: <a href="https://lonet.academy/" target="_blank">https://lonet.academy</a>
</p>';



$string['profilepage'] = 'profile page';
$string['commissionperlesson'] = 'Komisija par stundu';
$string['commissionperlesson_desc'] = 'Šī summa tieks pieskaitīta skolotāja noteiktajai stundas cenai.';
$string['showpopup'] = 'Enable Popup';
$string['showpopup_desc'] = 'Whether to show popup window to leaving users.';
$string['minpayoutamount'] = 'Minimal Payout Amount';
$string['minpayoutamount_desc'] = 'Minimal amount that can be requested as payout.';
$string['minguardtime'] = 'Minimālais drošības laiks';
$string['minguardtime_desc'] = 'Pieteikties nodarbībai varēs tikai tad, ja līdz tai palicis vairāk laika nekā norādīts šeit.';

$string['editlessons'] = 'Rediģēt nodarbības';
$string['editschedule'] = 'Rediģēt grafiku';
$string['weekdays'] = 'Darba dienas';
$string['workhours'] = 'Darba stundas';
$string['breakstarttime'] = 'Pārtaukuma sākums';
$string['breakendtime'] = 'Pārtraukuma beigas';
$string['starttime'] = 'Stundu sākums';
$string['endtime'] = 'Stundu beigas';
$string['startdate'] = 'Stundu sākuma datums';
$string['enddate'] = 'Stundu beigu datums';

$string['emptyrating'] = 'Noklusējuma reitings';
$string['emptyrating_desc'] = 'Noklusējuma reitings tiks rādīts, ja skolotājam vēl nebūs novērtējumi';

$string['viewalllanguageteachers'] = 'Skatīt visus {$a} valodas skolotājus';
$string['notfound'] = 'Skolotāja profils netika atrasts.';
$string['lessonnotfound'] = 'Nodarbība netika atrasta.';
$string['notrated'] = 'Vēl nav novērtēts';
$string['rate'] = 'Novērtēt';
$string['youropinion'] = 'Your opinion is very important to us';
$string['rating'] = '<span class="text-green">Please rate the \'{$a->name}\' lesson with {$a->teacher}:</span>
<br><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> poor
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> moderate
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span><span class="fa fa-star" style="visibility: hidden;"></span> good
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star" style="visibility: hidden;"></span> very good
<br><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span> excellent';
$string['notreviewed'] = 'Vēl nav atsauksmju';
$string['viewschedule'] = 'Skatīt grafiku';
$string['booklesson'] = 'Rezervē nodarbību';
$string['bookagain'] = 'Pieraksties nākamajā nodarbībā';
$string['mostbooked'] = 'Populārākais';
$string['recommended'] = 'Izglītojamie arī rezervē';
$string['booklesson_extra'] = 'Apskati cenas';
$string['viewprofile'] = 'Apskati profilu';
$string['viewreviews'] = 'Apskati atsauksmes';
$string['students'] = 'Studenti';
$string['student'] = 'Students';
$string['teachers'] = 'Skolotāji';
$string['teacher'] = 'Skolotājs';
$string['lessons'] = 'Nodarbības';
$string['giftcards'] = 'Dāvanu kartes';
$string['nolessons'] = 'Jums nav nevienas plānotas nodarbības.';
$string['trialprice'] = 'Izmēģinājuma nodarbības cena';
$string['price'] = 'Cena';
$string['totalprice'] = 'Apmaksas summa';
$string['fortrial'] = 'par izmēģinājuma nodarbību';
$string['teachersince'] = 'Skolotājs no';
$string['membersince'] = 'Dalībnieks no';
$string['viewteacherprofile'] = 'Skatīt skolotāja profilu';
$string['viewuserprofile'] = 'Skatīt lietotāja profilu';
$string['backtoteacherprofile'] = 'Atgriezties uz skolotāja profilu';
$string['editprofile'] = 'Rediģēt profilu';
$string['changepassword'] = 'Nomainīt paroli';
$string['noeducationlisted'] = 'Izglītība nav norādīta';
$string['nooccupationlisted'] = 'Nodarbošanās nav norādīta';
$string['professionalteacher'] = 'Professional Teacher';
$string['selectlesson'] = 'Izvēlies nodarbību';
$string['selectlanguage'] = 'Izvēlies valodu';
$string['singletriallesson'] = 'You can only book one trial lesson';
$string['selecttime'] = 'Izvēlies pieejamo datumu un laiku';
$string['emptycart'] = 'Your cart is empty';
$string['registerteacher'] = 'Register as a Teacher';
$string['blockdays'] = 'Block Days';
$string['blockdates'] = 'Block Date Period';
$string['blocktimes'] = 'Block Time Period';
$string['blockdatetimes'] = 'Block Date & Time Period';
$string['days'] = 'Days';
$string['dates'] = 'Dates';
$string['times'] = 'Times';
$string['step'] = 'Solis';
$string['teaching'] = 'Teaching';
$string['learning'] = 'Learning';
$string['teaches'] = 'Māca';
$string['speaks'] = 'Runā';
$string['learns'] = 'Mācās';
$string['with'] = 'ar';
$string['lessonhistory'] = 'Nodarbību vēsture';
$string['teachinghistory'] = 'Teaching History';
$string['learninghistory'] = 'Learning History';
$string['transactionhistory'] = 'Darījumu vēsture';
$string['requestpayout'] = 'Request Payout';
$string['confirmrequestpayout'] = 'Confirm & Request Payout';
$string['withdrawaltype'] = 'Saņemšanas veids';
$string['withdrawaltypeaccount'] = 'Bankas pārskaitījums';
$string['withdrawaltypepaypal'] = 'PayPal';
$string['accountbank'] = 'Saņēmēja bankas nosaukums';
$string['accountname'] = 'Saņēmēja nosaukums';
$string['accountnumber'] = 'Saņēmēja konta numurs';
$string['accountaddress'] = 'Saņēmēja adrese';
$string['accountcountry'] = 'Saņēmēja valsts';
$string['accountswift'] = 'SWIFT kods';
$string['paypalemail'] = 'PayPal epasts';
$string['iknumber'] = 'IK (individuālā komersanta) reģistrācijas numurs';
$string['accountnumber_desc'] = 'Klienta konta numurs vai IBAN, garums līdz 34 burtu un ciparu zīmēm.';
$string['accountswift_desc'] = 'Bankas SWIFT jeb BIC kods - bankas identifikācijas kods, kas sastāv no 8 vai 11 simboliem, 1-6 simbols ir burti. Pārejos bankas identifikatorus (BIK, SORT, ABA, Fedwire, MFO, CNAPS, IFSC un citus kodus) jānorāda laukā “Saņēmēja bankas nosaukums un adrese” aiz bankas nosaukuma.';
$string['payment'] = 'Payment';
$string['paymentstatus_expired'] = 'You payment session has expired.<br>Payment could not be completed.';
$string['paymentstatus_error'] = 'You payment could not be completed.';
$string['paymentstatus_init_failed'] = 'Transaction initialization failed.';
$string['topayment'] = 'Continue to Payment';
$string['paywith'] = 'Maksā ar';
$string['paywithcard'] = 'Maksā ar bankas karti';
$string['paywithpaypal'] = 'Maksā ar PayPal';
$string['payfrombalance'] = 'Pay from Balance';
$string['usebalance'] = 'Izmanto pieejamo atlikumu';
$string['paidfrombalance'] = 'Apmaksāts no pieejamā atlikuma';
$string['remainingamount'] = 'Atlikusī apmaksas summa';
$string['confirmbooking'] = 'Confirm Booking';
$string['confirmandpay'] = 'Apstiprini un apmaksā';
$string['introduction'] = 'Introduction';
$string['videourl'] = 'Video URL';
$string['videourl_desc'] = 'YouTube embed URL for landing page video.';
$string['createdat'] = 'Created At';
$string['updatedat'] = 'Updated At';
$string['agreewith'] = 'lzlasīju un piekrītu {$a}.';
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

$string['lessonarchive'] = 'Nodarbību arhīvs';
$string['from'] = 'no';
$string['to'] = 'līdz';
$string['aboutme'] = 'Par mani';
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
$string['language'] = 'Valoda';
$string['teacherreport'] = 'Skolotāju atskaite';
$string['orderreport'] = 'Pirkumu atskaite';
$string['cashreport'] = 'Apgrozījuma atskaite';
$string['payoutreport'] = 'Pieprasītie maksājumi';
$string['promoreport'] = 'Promo kodi';
$string['promocode'] = 'Promo kods';
$string['promocodenotfound'] = 'Promo kods nav atrasts.';
$string['promocodenotvalid'] = 'Promo kods vairs nav aktīvs.';
$string['apply'] = 'Pielietot';
$string['code'] = 'Kods';
$string['type'] = 'Tips';
$string['amounteuro'] = 'Summa, &euro;';
$string['discounteuro'] = 'Atlaide, &euro;';
$string['discountpercent'] = 'Atlaide, %';
$string['lessoncountperlearner'] = 'Max Lessons per Learner';
$string['lessoncount'] = 'Max Lessons';
$string['validthrough'] = 'Valid Through';
$string['isactive'] = 'Is Active';
$string['lessonid'] = 'Lesson ID';
$string['booknextlesson'] = 'Book Next Lesson';
$string['commission'] = 'Commission';
$string['available'] = 'pieejams';
$string['payouttoteacher'] = 'Payout to Teacher';
$string['h1_teacher_list'] = 'Valodu on-line privātskolotāji';
$string['h1_teacher_list_group'] = 'Valodu kursi un nodarbības nelielās grupās';
$string['languageteachers'] = 'Valodu privātskolotāji';
$string['languagetutors'] = '{$a} valodas on-line privātskolotāji';
$string['onlinetutors'] = 'valodas on-line privātskolotāji';
$string['deletemyaccount'] = 'Dzēst manu kontu';
$string['youcannotdeleteaccount'] = 'You cannot delete your account at this time because you have scheduled lessons!';
$string['confirmdeletion'] = 'An email has been sent to you containing a link to confirm and complete your account deletion.';
$string['invaliddeletiontoken'] = 'Deletion token is invalid.';
$string['youraccountdeleted'] = 'Jūsu konts ir dzēsts.';
$string['addtowallet'] = 'Papildināt maku';

$string['whatisyourreasonfordecline'] = 'What is your reason for declining';
$string['whatisyourreasonforcancel'] = 'What is your reason for canceling';
$string['whatisyourreasonfornotcomplete'] = 'What is your reason for marking this lesson as not completed';

$string['lessonstatus_confirm'] = 'Lesson on {$a->date} at {$a->time} has been confirmed.';
$string['lessonstatus_decline'] = 'Lesson request on {$a->date} at {$a->time} has been declined.';
$string['lessonstatus_cancel'] = 'Lesson on {$a->date} at {$a->time} has been canceled.';
$string['lessonstatus_complete'] = 'Lesson on {$a->date} at {$a->time} has been marked as completed.';
$string['lessonstatus_notcomplete'] = 'Lesson on {$a->date} at {$a->time} has been marked as not completed.';

$string['popuptitle'] = 'Pagaidi! Pirms aiziesi, saņem savu vaučeru';
$string['popupsubtitle'] = 'Bezmaksas angļu valodas stundas';
$string['popupemailtitle'] = 'Ieraksti savu e-pasta adresi:';
$string['popupbutton'] = 'Jā, es gribu saņemt bezmaksas stundas';

$string['leaveyourreview'] = 'atstājiet atsauksmi';

$string['email_subscriber_subject'] = 'Free English Course on LONET';
$string['subscriber_title'] = 'Prieks, ka pierakstījies uz <b>angļu valodas bezmaksas</b> on-line <b>nodarbībām</b> LONET svešvalodu apmācības tīklā!';
$string['hello'] = 'Labdien';
$string['subscriber_thankyou'] = 'Paldies par Tavu izrādīto interesi mācīties svešvalodas On-line ar <a href="https://lonet.academy?lang=lv" style="color:#499306;text-decoration:none;"><b>Lonet.Academy</b></a> <span style="font-size: 18px;">☺</span>';
$string['subscriber_news'] = 'Ar prieku paziņojam, ka <b>līdz 31.08.2018</b> piedāvājam <b>BEZMAKSAS On-line angļu valodas nodarbības</b> jauniem LONET biedriem.';
$string['subscriber_step1'] = 'Solis 1: Līdz 31.08.2018 <b>reģistrējies LONET mājas lapā</b> un aizpildi savu profilu: <a href="https://lonet.academy/login/signup.php?lang=lv" style="color:#499306;text-decoration:none;"><b>šeit</b></a>';
$string['subscriber_step2'] = 'Solis 2: <b>Rezervē</b> testa (trial) On-line angļu valodas nodarbību ar pasniedzēju: <a href="https://lonet.academy/teacher/3?lang=lv" style="color:#499306;text-decoration:none;"><b>Christina Baltach</b></a>';
$string['subscriber_step3'] = 'Solis 3: Sagaidi nodarbības apstiprinājumu no pasniedzēja 24 stundu laikā! <span style="font-size: 18px;">☺</span>';
$string['subscriber_lessonnote'] = ' Izvēlies stundu “trial lesson”, kalendārā atzīmē Tev piemērotāko dienu un laiku, tad nospied pogu “confirm and go to payment”.';
$string['subscriber_paymentnote'] = 'Maksājumam izmanto šo PROMO KODU: <b>CHBAL03</b>';
$string['subscriber_footer'] = '
    <p>Ja rodas šaubas, neskaidrība vai jautājumi, lūdzu, nekavējoties dod mums ziņu. Droši raksti vai zvani <span style="font-size: 18px;">☺</span></p>
    <p>Gaidam Tevi angļu valodas nodarbībās! Laipni lūdzam LONET tīklā – Language Online Network</p>
';
$string['subscriber_signature'] = 'Lonet.Academy<br><br><a href="mailto:lonet@lonet.academy" style="color:#499306;text-decoration:none;">lonet@lonet.academy</a><br><a href="tel:37127344201" style="color:#499306;text-decoration:none;">+371 27 344 201</a><span style="font-size:12px;">10:00 - 22:00 (GMT+2)</span>';

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

$string['h1_signup'] = 'IZVEIDOT LONET.ACADEMY PROFILU';

$string['meta_title_home'] = 'Plaša Valodu Kursu Izvēlē Online -  Valodas Pasniedzēji | LONET';
$string['meta_description_home'] = 'Mācies valodu vieglu! Ar labākajiem online valodu pasniedzējiem! Izvēlies pasniedzēju un piesaka izmēģinājuma stundu. Izvēlies valodu kursus - individuālas nodarbības ar pasniedzējiem, kam tā ir dzimtā valoda.';

$string['meta_title_teacher'] = '{$a} - valodas privātskolotājs | Lonet.Academy';
$string['meta_description_teacher'] = '{$a->languages} valodas pasniedzējs no {$a->location}. Mācies {$a->languages_lower} valodu caur Skype. | {$a->languages} valodas kursi - privātstundas ar {$a->full_name}, Lonet.Academy';
$string['h1_teacher'] = '{$a} - svešvalodas privātskolotājs online';

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

$string['meta_title_consultation'] = 'Kā izvēlēties svešvalodas pasniedzēju? | Lonet.Academy';
$string['meta_description_consultation'] = 'Piesakies bezmaksas konsultācijai! Uzdod jautājumus par to, kā notiek svešvalodas apguve caur Skype un izvēlies labāko svešvalodas skolotāju Lonet.Academy platformā.';
$string['h1_consultation'] = 'Svešvalodas privātstundas online. Izvēlies labāko svešvalodas skolotāju!';

$string['consultq1'] = 'Vai Tevi māc šaubas, vai tas ir efektīvi – apgūt svešvalodu online?';
$string['consultq2'] = 'Neesi pārliecināts par to, kā izvēlēties sev piemērotāko valodas pasniedzēju?';
$string['consultq3'] = 'Neesi drošs, vai tiešsaistes apmācības ir domātas Tev?';
$string['consultanswer'] = 'Sazinies ar Kristīni, Lonet.Academy izveidotāju un idejas radītāju!';
$string['applynow'] = 'Piesakies bezmaksas konsultācijai';
$string['whatiget'] = 'Ko es iegūšu no konsultācijas?';
$string['content_consultation'] = '
<ul>
    <li>Pastāsti par savām šaubām, <strong>uzdod visus jautājumus</strong>, kas tevi interesē <strong>saistībā ar online apmācībām</strong>. Tu varēsi saņemt atbildes uz taviem jautājumiem. Kristīne ir pieredzējusi valodas pasniedzēja, kā arī pati ir ilgstoši apguvusi svešvalodas tiešsaistē. Viņa spēs izskaidrot <strong>detaļas un nianses, kas varētu tev būt svarīgi zināt</strong>.</li>
    <li>Varēsi iepazīties ar online valodu kursu apmācības platformu Lonet.Academy un izmēģināt <strong>kā tā darbojas</strong>. Kristīne atbildēs uz Taviem jautājumiem par to <strong>kā strādā Lonet.Academy</strong> un, ja nepieciešams nodemostrēs tās tehniskās funkcijas.</li>
    <li>Iegūsi <strong>visu nepieciešamo palīdzību valodas skolotāja izvēlē</strong>, jo Kristīne vada intervijas un iepazīst individuāli katru Lonet.Academy pasniedzēju. Līdz ar to viņa asistēs Tavām vēlmēm visatbilstošākā svešvalodas pasniedzēja izvēlē.</li>
</ul>
';

$string['pleasesubmitinfo'] = 'Lūdzu, zemāk, norādi nepieciešamo informāciju, lai reģistrētos bezmaksas konsultācijai';
$string['yourname'] = 'Vārds';
$string['youremail'] = 'E-pasts';
$string['languagetolearn'] = 'Valoda, ko vēlies apgūt';
$string['phonenumber'] = 'Mobilā tālruņa numurs (WA)';
$string['casewa'] = 'ja dod priekšroku saziņai caur WA';
$string['skypeid'] = 'Skype ID';
$string['caseskype'] = 'ja dod priekšroku saziņai caur Skype';
$string['pleasereadagree'] = 'Lūdzu izlasi un apstiprini Lonet.Academy privātuma politikas nosacījumus';
$string['haveread'] = 'Es iepazinos, saprotu un piekrītu';
$string['withprivacy'] = 'privātuma politikas nosacījumiem';
$string['withterms'] = 'Lonet.Academy lietošanas nosacījumiem';
$string['oflonet'] = '';

$string['thankyouforapplication'] = 'Paldies par reģistrāciju! Tavs pieteikums ir nosūtīts!';
$string['schedulesession'] = 'Izvēlies konsultācijas dienu un laiku';
$string['selecttimezone'] = 'Izvēlies laika zonu';
$string['yourtimezone'] = 'Tava laika zona';
$string['fullybooked'] = 'Tuvākajās dienās visi konsultācijām ar Kristīni atvēlētie laiki jau ir aizņemti';
$string['willcontact'] = 'Lūdzu, uzgaidiet un Kristīne sazinās ar Jums pa tiešo, tiklīdz atbrīvosies nākamā vieta konsultācijām. Paldies Jums! Un jauku dienu!';

$string['watchdemolesson'] = 'Watch Demo Lesson';

$string['ihaveaccount'] = 'I have account on Lonet.Academy<br>Enter';
$string['idonthaveaccount'] = 'I don\'t have account yet<br>Create one';

$string['badge_new'] = 'new';
$string['badge_bestprice'] = 'best price';
$string['badge_recommended'] = 'recommended';
$string['badge_specialoffer'] = 'special offer';
$string['badge_native'] = 'native';

$string['paypal_fee_message'] = '+7% papildus darījuma komisija';

$string['lessoncount_label'] = 'Izpildītas stundas';
$string['studentcount_label'] = 'Studentu skaits';

$string['invite_page_title'] = 'Vai zināt draugu, kuram patiktu Lonet.Academy?';
$string['invite_page_subtitle'] = 'Uzaicini draugu un, kad viņš apmeklēs nodarbību, TU savā Lonet.Academy bilancē iegūsi EUR 10';
$string['invite_page_email_title'] = 'Uzaiciniet savus draugus pa e-pastu';
$string['invite_page_send_button'] = 'Sūtīt';
$string['invite_page_button_linkedin'] = 'Kopīgojiet vietnē Linkedin';
$string['invite_page_button_twitter'] = 'Kopīgojiet pakalpojumā Twitter';
$string['invite_page_button_link'] = 'Kopēt saiti';
$string['invite_page_referral_title'] = 'Kā darbojas novirzīšana';
$string['invite_page_referral_subtitle_1'] = 'Mudiniet savus draugus reģistrēties, izmantojot jūsu pielāgoto reģistrēšanās saiti.';
$string['invite_page_referral_subtitle_2'] = 'Jūsu draugs saņem EUR 10, ko tērēt pirmajai nodarbībai vietnē Lonet.Academy.';
$string['invite_page_referral_subtitle_3'] = 'Jūs saņemat EUR 10, kad jūsu draugs apmeklē nodarbību vietnē.';
$string['userprofile_featuretext'] = '<h3>Apsveicam {$a}!</h3><h4>Kamēr citi tikai domā un sapņo, Tu jau dari! Iemīlejies valodu apguves procesā un padari to par tavu ikdienas rutīnu.</h4>';
$string['teacherprofile_featuretext'] = '<div style="text-align:center"><h5>Ja tu patiesi vēlies apgūt kādu svešvalodu un pavērt jaunus horizontus savā pašizaugsmē, kā arī paplašināt iespējas dzīvē, tu vari to paveikt!</h5>
<h5><strong>{$a} būs tavs uzticamais kompanjons šajā izaicinājumā, kas patiesi atmaksāsies.</strong></h5>
<h5><strong>Iemīlēt valodas apmācību. Atklāt jaunu valodu. Sadzirdēt to, izlasīt, izdziedāt un izdejot. Sajust un brīvi runāt tajā.</strong></h5>
<h5>Vienkārši izdzīvot to!</h5></div>';
$string['requestpayout_message'] = 'Jūs jau esat pieprasījis izmaksu šajā mēnesī. Lūdzu, turpiniet ar nākamo izmaksas pieprasījumu nākamajā mēnesī';
$string['topheadermessage'] = '<h5 style="color:#499306;">IZAICINĀJUMS: <strong>UZSTĀDI SAVU MĒRĶI VALODU APGUVĒ 2023. GADĀ</strong><h5>';
$string['challenge_fieldlabel'] = 'Cik nodarbības nedēļā tu vēlies īstenot?';
$string['challenge_title'] = 'TAVS VALODU APGUVES IZAICINĀJUMS 2023. GADĀ';
$string['challenge_value'] = 'Ir izpildītas {$a->outof} stundas no {$a->total}.';
$string['challenge_message'] = 'Tu esi ceļā!';
$string['challenge_textlink1'] = '<p style="font-size:12px !important;">Seko savam valodu apguves izaicinājumam <a href="/user/profile.php?id={$a}"><u>sava profila sadaļā</u></a></p>';
$string['challenge_textlink2'] = 'Uzstādi un izpildi savu 2023. gada mērķi, un saņem 50 EUR dāvanu karti no Lonet.Academy!';
$string['h1_landing_page'] = 'Laipni lūdzam Lonet.Academy!';
$string['landingq1'] = 'Paldies par reģistrāciju!';
$string['landingq2'] = 'Nākamais solis - izvēlies savu pasniedzēju!';
$string['landingq3'] = 'Un rezervē savu pirmo nodarbību!';
$string['applyfreeconsulation_url'] = 'https://lonet.academy/ka-izveleties-labako-svesvalodas-skolotaju';
$string['landing_page_videolink'] = 'https://www.youtube.com/embed/kWUiK5fKT9Q';
$string['booklesson_url'] = 'https://lonet.academy/valodu-kursi';
$string['h1_howitworks_page'] = 'Kā tas darbojas';
$string['howitworks_image1_title'] = 'Kā izveidot profilu?';
$string['howitworks_image2_title'] = 'Kā rezervēt nodarbību?';
$string['howitworks_image3_title'] = 'Kur notiks nodarbība?';
$string['howitworks_image4_title'] = 'Kā pārcelt nodarbību?';
$string['howitworks_image1_content'] = '<ul>
            <li>Nospied uz “REĢISTRĒJIES”</li>
            <li>Reģistrācijas formā aizpildi visus aizpildāmos laukus</li>
            <li>Kad visi lauki ir aizpildīti, nospied pogu "Reģistrējies"</li>
            <li>Dodies uz savu epastu un apstiprini saņemto interneta adreses linku</li>
            <li>Sava profilā sadaļā "Rediģēt profilu" tu vienmēr varēsi labot un mainīt datus par sevi</li>
          </ul>
            <div class="col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" style="margin-top: 5px;">
                <div class="media-16x9">
                    <iframe src="https://www.youtube.com/embed/Vv2o-hZtK9I" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>';
$string['howitworks_image2_content'] = '<ul>
          <li>Pieslēdzies platformai, spiežot uz pogas “PIESLĒDZIES”</li>
          <li>Ievadi savu lietotājvārdu (e-pasta adresi) un paroli, kuru iestatīji reģistrējoties</li>
          <li>Lai apskatītu sarakstu ar valodas pasniedzējiem:
            <ul>
              <li>sākuma lapā izvēlies valodu, ko vēlies macīties vai</li>
              <li>ieraksti meklēšanas laukā valodu, ko vēlies mācīties vai</li>
              <li>dodies uz sadaļu “REZERVĒ NODARBĪBU” un izvēlies valodu, ko vēlies mācīties</li>
            </ul>
          </li>
          <li>Detalizēta informācija par katru pasniedzēju ir apskatāma, nospiežot uz pogas ‘’Skatīt profilu’’</li>
          <li>Nospied uz pogas “Rezervē nodarbību” uz pasniedzēja profila un
            <ul>
                <li>izvēlies valodu (gadījumā, ja pasniedzējs māca vairāk kā vienu valodu)</li>
                <li>izvēlies nodarbības veidu (izmēģinājuma nodarbība vienmēr ir norādīta kā pirmais variants) ar tās norādīto cenu un ilgumu</li>
                <li>atzīmē dienu un laiku, kas pieejams pasniedzēja darba grafikā. Lauki zaļā krāsā norāda uz pieejamajām stundām</li>
            </ul>
          </li>
          <li>Nospied uz pogas ‘’Confirm and go to payment”’</li>
          <li>Ja tev ir atlaižu kods, ievadi to “Promo code” lauciņā</li>
          <li>Iepazīsties ar <a href="https://lonet.academy/terms-and-conditions" target="_blank">Lonet.Academy platformas lietošanas noteikumiem</a> un turpini maksājumu ar bankas karti vai PayPal
            <ul>
                <li>ņem vērā, ka nodarbības maksājuma summa parādīsies tavā virtuālajā makā, un virtuālā maka bilance būs redzama tavā profilā</li>
                <li>līdzekļi netiks pārskaitīti pasniedzējam, kamēr nodarbība netiks veikta</li>
                <li>ja nodarbība netika veikta, tu varēsi izmantot sava virtuālā maka bilanci, lai rezervētu citas nodarbības</li>
            </ul>
          </li>
          <li>Tu vari rezervēt izmēģinājuma nodarbības pie varākiem pasniedzējiem. Izvēlies sev labāko valodas pasniedzēju Lonet.Academy platformā!</li>
        </ul>
        <div class="col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" style="margin-top: 5px;">
            <div class="media-16x9">
                <iframe src="https://www.youtube.com/embed/Vv2o-hZtK9I" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>';
$string['howitworks_image3_content'] = '<ul>
          <li>Nodarbība notiek tev un tavam pasniedzējam ērtākajā platformā, par kuru būsiet vienojušies pirms pašas nodarbības (piemēram, Skype vai Zoom platforma)</li>
          <li>24 stundu laikā pēc maksāšanas veikšanas pasniedzējam ir jāapstiprina nodarbība. Tālāk šis apstiprinājums tiks nosūtīts uz tavu e-pastu</li>
          <li>Pirms nodarbības tev ir iespēja sazināties ar pasniedzēju, izmantojot Lonet.Academy ziņapmaiņas funkciju, lai:
            <ul>
              <li>uzdotu jebkādus jautājumus un noskaidrotu detaļas</li>
              <li>padalītos ar saviem Skype, Zoom kontaktiem un vienotos, kuru platformu izmantot nodarbībai</li>
              <li>atbildētu uz pasniedzēja jautājumiem par tavām valodas zināšanām un līmeni pirms nodarbības</li>
            </ul>
          </li>
          <li>Ņem vērā, ka nav nepieciešams sniegt pasniedzējam personīgo informāciju par sevi pret savu gribu, un tāda informācija kā tālruņa numurs, adrese, uzvārds, foto, darba vieta nav obligāti iesniedzama</li>
          <li>Ja tev rodas bažas vai šaubas par pasniedzēja uzdotajiem jautājumiem vai informāciju, ko pasniedzējs jautā, lūdzu, nekavējoties informē Lonet.Academy <i>(lonet@lonet.academy, +371 27 344 201)</i></li>
          <li>Pieslēdzies nodarbībai iepriekš rezervētajā laikā un izbaudi to!</li>
        </ul>';
$string['howitworks_image4_content'] = '<ul>
          <li>Ja vēlies pārcelt nodarbību, apspried to personīgi ar savu pasniedzēju vai arī atcel jau rezervēto nodarbību Lonet.Academy platformā un rezervē jaunu nodarbību. <a href="https://lonet.academy/terms-and-conditions" target="_blank">Lonet.Academy platformas lietošanas noteikumi tiks piemēroti.</a></li>
          <li>Pastāv vairākas iespējas, kad nodarbība var netikt pabeigta, un jauna nodarbība var tikt rezervēta:
            <ul>
              <li>ja pasniedzējs nav apstiprinājis vai ir atcēlis nodarbību - tavi iemaksātie līdzekļi par nodarbību būs pieejami tavā virtuālajā makā un tu tos varēsi izmantot, lai rezervētu nākamās nodarbības</li>
              <li>ja pasniedzējs neierodas uz nodarbību - norādi, ka pasniedzējs neieradās uz nodarbību sava profila sadaļā “Nodarbību vēsture”, tavi iemaksātie līdzekļi par nodarbību būs pieejami tavā virtuālajā makā un tu tos varēsi izmantot, lai rezervētu nākamās nodarbības</li>
            </ul>
          </li>
        </ul>';
$string['scarcity_field'] = 'Cik daudz jaunu studentu tu varētu pieņemt?';
$string['scarcity_field_option0'] = 'Šobrīd nevaru pieņemt jaunus studentus';
$string['scarcity_field_option1'] = 'Es varu pieņemt tikai 1 jaunu studentu';
$string['scarcity_field_option2'] = 'Es varu pieņemt 2 jaunus studentus';
$string['scarcity_field_option3'] = 'Varu pieņemt ne vairāk kā 3 jaunus studentus';
$string['scarcity_field_option4'] = 'Esmu pilnībā pieejams jauniem studentiem';
$string['scarcity_field_tag0'] = 'Palikušas 0 vietas';
$string['scarcity_field_tag1'] = 'Palikusi tikai 1 vieta';
$string['scarcity_field_tag2'] = 'Palikušas tikai 2 vietas';
$string['scarcity_field_tag3'] = 'Palikušas 3 vietas';
$string['scarcity_field_tag4'] = 'Pieejams';
$string['scarcity_field_tooltip0'] = 'Šis pasniedzējs uz doto brīdi ir pilnībā aizņemts un nepieņem jaunus studentus';
$string['scarcity_field_tooltip1'] = 'Šis pasniedzējs var paņemt tikai 1 jaunu studentu';
$string['scarcity_field_tooltip2'] = 'Šis pasniedzējs var paņemt tikai 2 jaunus studentus';
$string['scarcity_field_tooltip3'] = 'Šis pasniedzējs var paņemt tikai 3 jaunus studentus';
$string['scarcity_field_tooltip4'] = 'Šis pasniedzējs pieņem jaunus studentus';
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
$string['grouplessons'] = 'Grupas nodarbība';
$string['grouplesson'] = 'Grupas nodarbība';
$string['joinlesson'] = 'Pievienojies nodarbībai';
$string['level'] = 'Līmenis';
$string['age'] = 'Vecuma grupa';					   
$string['place'] = 'Vieta';		
$string['duration'] = 'Ilgums';
$string['length'] = 'Ilgums';
$string['time'] = 'Laiks';
$string['maxattendees'] = 'Maksimālais dalībnieku skaits';
$string['minattendees'] = 'Minimālais dalībnieku skaits';
$string['whatislesson'] = 'Nodarbības tēma:';
$string['whatulearn'] = 'Ko tu iemācīsies šajā nodarbībā:';									   
$string['bookmyplace'] = 'Rezervē vietu';									   
$string['noplaceleft'] = 'No place left';									   
$string['contactteacher'] = 'Sazinies ar pasniedzēju';									   
$string['listpromo_lv'] = '<h1>Latviešu valodas privātstundas caur Skype. | Latviešu valodas privātskolotāji online. </h1>
<!-- wp:paragraph -->
<p>Vai Tev ir kādreiz biju vēlme iemācīties <a rel="noreferrer noopener" aria-label=" (opens in a new tab)" href="https://valoda.lv/valsts-valoda/vesture/" target="_blank">vienu no senākajām valodām Eiropā</a>? Viena no šīm valodām ir latviešu valoda. Daudzi cilvēki to apgūst dēļ tās unikalitātes, jo tā nav līdzīga nevienai valodai. Mūsdienās ir vērojami kādi aizguvumi no vācu un krievu valodas. Pēc Latvijas neatkarības iegūšanas ievērojami ir palielinājies vārdu aizguvums no anļu valodas. Citi dod priekšroku latviešu valodas privātstundām, lai varētu valodu izmantot ceļošanai vai darbam. Lonet.Academy <strong>latviešu valodas privātskolotāji</strong> piedāvā <strong>latviešu valodas privātstundas tiešsaitē (latviešu valoda online)</strong>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Latviešu valoda nāk no indoeiropiešu valodas saimes, baltu
valodas grupas. Tās saknes sniedzās pat sanskritā. </p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Latviešu valoda online | Privātstundas tiešsaitē</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mūsdienās latvieši, kas runā latviski Latvijā ir vairāk kā
1,38 miljoni, vismaz 100&nbsp;000 tūkstoši ārzemēs (Zviedrijā, Vācijā,
Lielbritānijā, Kanādā, Krievijā u.c.) dzīvojošie latvieši. Neskatoties uz šiem
skaitļiem ir vēl daudz tādu, kuri ir iemācījušies latviešu valodu kā otro
valodu un izmanto to savās darba vietās vai priekš ceļojuma mērķiem. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Lonet.Academy piedāvā Tev <strong>latviešu valodas privātstundas</strong>, ja tu vēlies uzsākt vai turpināt apgūt valodu. Latviešu valodas zināšanas stirpinās tavu piederību Latvijai, palīdzēs iepazīt labāk Latvijas kultūru. Daudzos gadījumos atvieglos arī remigrācijas procesu. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/login/signup.php" target="_blank" rel="noreferrer noopener">Reģistrējies Lonet.Academy</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/ka-izveleties-labako-svesvalodas-skolotaju" target="_blank" rel="noreferrer noopener">Piesakies bezmaksas konsultācijai</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/valodu-kursi-davanu-kartes" target="_blank" rel="noreferrer noopener">Pērc Lonet.Academy dāvanu karti</a></p>
<!-- /wp:paragraph -->';									   
$string['listdesc_lv'] = '
<!-- wp:heading -->
<h2>Cómo aprender letón rápidamente y por dónde empezar.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Antes de embarcarte en un curso intensivo de letón con un profesor nativo de letón por Webinar; de dejamos algunos consejos útiles sobre lo que podrías hacer tú mismo:</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3><a href="https://www.omniglot.com/writing/latvian.htm" target="_blank" rel="noreferrer noopener">Aprender el alfabeto letón.</a></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Como la lengua letona utiliza el alfabeto latino, es fácil de recordar. Se distingue porque incluye marcas diacríticas para formar sus 33 letras. La familiarización con las letras y los signos diacríticos ayudará mucho a enunciar correctamente los textos letones.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Conocer las palabras.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Aprender las palabras básicas que se utilizan en el trato diario es un buen comienzo para construir tu vocabulario en letón. El dominio de estos fundamentos resolverá el problema de cómo aprender letón rápidamente, ya que un buen vocabulario es una buena base para una comunicación eficaz en cualquier aprendizaje de idiomas.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Aquí tienes algunos ejemplos de palabras básicas de la vida cotidiana en inglés y sus equivalentes en letón:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Hola o buenas tardes - Sveiki o Labdien (que literalmente significa laba diena - buen día)</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Sí - Jā (ā - sonido largo "a")</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>No - Nē (ē - sonido largo "e")</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Por favor - Lūdzu</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Gracias - Paldies / Paldies Jums (literalmente significa "gracias a ti")</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Ok / Fine - Labi (literalmente significa "bien")</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Lo siento - Atvainojiet</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Me llamo - Mani sauc (literalmente significa "me llaman")</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Los profesores nativos de letón online te guiarán en el difícil viaje de aprender las primeras frases y palabras. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/blog/learn-language-with-tutors-online/" target="_blank" rel="noreferrer noopener">Por estas razones deberías considerar la posibilidad de aprender el idioma tomando clases de letón con un profesor nativo online.</a></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Aprender la lengua letona. La distintiva pronunciación letona.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Aunque la gramática puede ser un problema a la hora de hablar letón con fluidez; la preocupación debe centrarse más en la pronunciación correcta de las palabras, ya que el letón se basa en la longitud de las vocales y las consonantes. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Tienes que ser consciente del ritmo, la entonación y la inflexión correctos para que no te malinterpreten. Los profesores profesionales nativos de letón serán tu mejor ayuda para aprender la pronunciación letona de la forma más eficaz.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Por cierto, <a href="https://lonet.academy/blog/learn-languages-it-will-make-you-happy/" target="_blank" rel="noreferrer noopener">¿sabías que aprender un idioma te hace feliz?</a> Aprende letón y encuentra los nuevos colores de la vida.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Compra un regalo para tu mejor amigo, colega o familiar.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/language-gift-cards" target="_blank" rel="noreferrer noopener">¡Regala la tarjeta regalo de Lonet.Academy!</a> Para clases individuales de letón online.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Aprende frases comunes en letón y cómo decirlas correctamente.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Para mejorar tu capacidad de hablar letón, empieza a practicar las palabras y frases por tu cuenta. <a href="https://www.loecsen.com/en/learn-latvian" target="_blank" rel="noreferrer noopener">Hay numerosos recursos interactivos en Internet</a> que te ayudarán a enriquecer tus conocimientos de las acciones. Suelen venir con texto, audio y complementos de opción múltiple que puedes emplear para el autoaprendizaje.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>La buena noticia es que el acento (el sress) en las palabras del idioma letón está siempre en la primera sílaba (en la primera vocal). Y las palabras se leen (se pronuncian) igual que se escriben.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Las frases cotidianas, como las que aparecen a continuación, son un buen punto de partida.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Hasta luego - Uzredzēšanos / u z r e dz e e sh a n o s / (ē - sonido largo /e/ )</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Gracias / ¡Muchas gracias! - Paldies / Liels paldies (¡significa literalmente "muchas gracias"!</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Gracias por tu ayuda - Paldies par palīdzību</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>No entiendo - Es nesaprotu</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Lo tengo - Es sapratu</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>No sé - Es nezinu</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Practica la lengua letona conversando con profesores de letón por webinar.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Como ya hemos dicho, la creciente popularidad del aprendizaje del letón como segunda lengua ha provocado un número desproporcionado de hablantes no nativos respecto a los nativos. Si tienes acceso a un tutor letón nativo en tu localidad, una clase particular es la forma más idónea de practicar y aprender letón correctamente.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Un método cada vez más popular es contratar a un profesor particular de letón online. </p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>¿Cómo puedes estar seguro de que estás aprendiendo correctamente?</h4>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>En Lonet.Academy te ofrecemos la solución perfecta para aprender letón con nuestras clases particulares online con profesores nativos</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>En Lonet.Academy contamos con tutores nativos de letón por webinar que están bien preparados y tienen experiencia en la enseñanza. Nuestros instructores están cualificados para encargarse de un curso intensivo de letón o de letón para principiantes. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Puedes aprender y mejorarte a tu propio ritmo y tiempo, sin tener que preocuparte por la competencia de tu profesor.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Letonia es un país con una inmensa cultura musical y sonora, con obras culturales en letón ancladas en la "Memoria del Mundo" de la UNESCO.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>El aprendizaje de esta parte histórica de la lingüística es también un complemento maravilloso para las personas que desean ampliar sus horizontes culturales.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Tanto si estás planeando viajar a Letonia; como si estás aprendiendo latviešu valoda como segunda lengua o enriqueciendo tu conocimiento personal; en Lonet.Academy te ofrecemos todo lo que necesitas</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a rel="noreferrer noopener" href="https://lonet.academy/language-tutor-consultation" target="_blank">¡Solicita una consulta gratuita ahora!</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Toma clases de letón con tutores de letón online.<br>Aprende la hermosa y melódica lengua letona con un tutor profesional nativo en línea .</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Los tutores de idiomas profesionales con experiencia saben por dónde empezar y cómo avanzar.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Hay muchas razones; por las que,  <a href="https://www.youtube.com/watch?v=6JzZkI3OgrI" target="_blank" rel="noreferrer noopener">tomar clase de letón con un profesor nativo </a>es mucho más eficaz, emocionante y fácil respeto a estudiar por cuenta propria.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Éstas son algunas de ellas: los tutores de idiomas profesionales con experiencia saben por dónde empezar y cómo avanzar.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Los tutores de lengua letona son capaces de crear un plan de estudios estructurado y establecer los objetivos e hitos realistas del proceso de aprendizaje. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Esto te ayudará a evitar la sensación de agobio y frustración. La mejor manera de practicar las habilidades conversacionales en letón es tomar clases particulares con tutores nativos de Letonia. Porque los profesores de idiomas profesionales saben cómo corregir los errores mientras te hacen sentir cómodo, respetado y seguro.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Practica con los profesores particulares individuales de letón online.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Aprende en tu zona de confort y verás qué rápido notas el progreso. De hecho, es la mejor manera de entrenar tus habilidades conversacionales de forma auténtica y de romper las barreras del habla. Es mucho más eficaz aprender la melodía, los sonidos y la pronunciación del letón con los tutores de letón online.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>La lengua letona es muy melódica y hermosa. Te enamorarás de los sonidos y la entonación de los hablantes nativos de letón. Los profesores nativos de letón te harán sumergirte en la rica y antigua vida cultural de Letonia; así, aprendiendo la lengua letona con un profesor nativo de letón no sólo adquirirás las habilidades y conocimientos lingüísticos. Sino que también podrás sentir la cultura letona, la historia, la literatura letona, el folclore, la música, el arte y otros patrimonios nacionales del pueblo letón.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>No lo dudes. Toma tu lección de prueba de lengua letona ahora mismo y comienza el increíble viaje de aprender la lengua letona.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Mira algunos perfiles de nuestros profesores de letón online:</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a rel="noreferrer noopener" href="https://lonet.academy/profesores-online/clases-particulares-leton/225" target="_blank">Profesor</a><a href="https://lonet.academy/profesores-online/clases-particulares-leton/225" target="_blank" rel="noreferrer noopener">a</a><a rel="noreferrer noopener" href="https://lonet.academy/profesores-online/clases-particulares-leton/225" target="_blank"> de letón - Ingura Lipšāne;</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/profesores-online/clases-particulares-leton/37" target="_blank" rel="noreferrer noopener">Ieva Pukite - tutora de letón onlin</a><a href="https://lonet.academy/language-teachers/latvian-tutors-online/37" target="_blank" rel="noreferrer noopener">e</a><a rel="noreferrer noopener" href="https://lonet.academy/language-teachers/latvian-tutors-online/37" target="_blank">;</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/profesores-online/clases-particulares-leton/817" target="_blank" rel="noreferrer noopener">Rosie Blumentale - profesor de idioma letón que habla también español;</a></p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Aprende letón en línea y ahorra tiempo y dinero.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>No importa si eres principiante o si ya hablas algo de letón. Aprende la lengua letón o repásala con profesores nativos de letón online. Tomar las clases individuales de letón con un profesor particular de letón en línea, de hecho, te ahorrará tiempo y dinero.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>¿Estás pensando en mudarte a Letonia?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Empieza a aprender letón ya, con antelación. Te ayudará a evitar la sensación de frustración cuando llegues a Letonia.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Además, los letones están muy orgullosos de su cultura y su patrimonio, incluida la singular y hermosa lengua letona.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4>¡Dedica tu tiempo a aprender letón y viaja a los Países Bálticos!</h4>
<!-- /wp:heading -->

<!-- wp:heading {"level":4} -->
<h4>¡Explora una de las regiones más interesantes de Europa!</h4>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>¿Tu hijo empieza a ir a una escuela en Letonia?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ayúdale a aprender el letón forma rápida y ftomando clases de letón  con un profesor particular nativo online. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Los profesores nativos de letón son, profesionales con experiencia, conocen el programa escolar y podrán ayudar a tu hijo a centrarse en el material y el vocabulario específicos, para que cumpla los requisitos escolares.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Ahorra tiempo.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Utiliza la tecnología y ahorra tiempo tomando clases de letón en línea. Ya no necesitas ir a los cursos presenciales estándar. Toma clases particulares de letón por Skype, Zoom, Google Meet.... desde cualquier lugar, ya sea tu oficina, tu casa, la cafetería o cualquier otro sitio. </p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>El tiempo es valioso y ya no es necesario dedicarlo al camino, a los atascos, a la búsqueda de aparcamiento y al regreso. Utiliza la tecnología que hoy está disponible y es asequible para todos.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Ahorra  dinero.</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>No es una sorpresa que las clases particulares online de letón sean menos caras que las clases presenciales estándar. Hay varias razones por las que los profesores de idiomas on-line pueden ofrecer mejores precios que sus competidores presenciales.</p>
<!-- /wp:paragraph -->

<!-- wp:heading -->
<h2>Cursos individuales de letón por Skype, Zoom, Google Meet...</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3>¿Necesitas hablar letón para tu trabajo? ¿O te vas a mudar a Letonia?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sea cual sea la razón por la que quieres aprender letón, toma clases individuales con profesores de letón en línea. Los profesores de idiomas de Lonet.Academy son profesores nativos de letón, profesionales y con experiencia. Te ayudarán a aprender letón rápida y fácilmente. Se centran en tus necesidades individuales y crean un programa de estudios a medida. De acuerdo con el sector y la terminología que puedas necesitar para tu trabajo, negocio u otro propósito específico.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Las clases se imparten por Skype o en un aula online de webinar.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lo que hace que sea muy cómodo para ambos. Para el tutor y para el alumno. Toma clases particulares de lengua letona desde cualquier lugar del mundo.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Lonet.Academy está diseñada para conectar a los tutores de idiomas y a los estudiantes de idiomas de todo el mundo.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Aprende la lengua letona para los negocios, el trabajo y los estudios.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Con un profesor particular de letón en línea, ¡verás el resultado tan rápido!</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Aprendiendo idiomas online ahorras tu dinero<br>En primer lugar, los profesores de letón online no tienen gastos de alquiler de locales. Utilizan tecnología gratuita y pueden impartir las clases en línea desde sus propios locales o cualquier otro lugar disponible para ellos.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>En segundo lugar, los profesores que imparten clases de letón en línea no tienen gastos de transporte, aparcamiento y otros gastos de desplazamiento relacionados con su práctica docente.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Además, son más flexibles con sus políticas de cancelación debido a los puntos mencionados anteriormente, lo que los hace más competitivos y favorables al alumno en comparación con los profesores y tutores presenciales estándar.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Además, los tutores online no tienen que gastar en papel, libros, copias y otros materiales y herramientas que impliquen papel. Más bien utilizan recursos en línea y material a medida transferible electrónicamente, como archivos PDF, presentaciones, material de vídeo, grabaciones de audio, etc…</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Reserva tus clases con profesores particulares de letón online en Lonet.Academy.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="https://lonet.academy/how-it-works" target="_blank" rel="noreferrer noopener">Paga rápida y fácilmente con tarjeta o PayPal y elige el día y la hora más adecuados para tus estudios de idiomas.</a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>¡Bienvenido a Lonet.Academy!</p>
<!-- /wp:paragraph -->';