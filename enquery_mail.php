<?php
require_once("includes/initialize.php");
$usermail = User::get_UseremailAddress_byId(1);
$ccusermail = User::field_by_id(1, 'optional_email');
$sitename = Config::getField('sitename', true);

$eventmail = User::gethall_email_byId(1);


foreach ($_POST as $key => $val) {
  $$key = $val;
}

if ($_POST['action'] == "frm_inquiry"):
  $body = '
      <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
          <tr>
              <td><p>Dear Sir,</p></td>
          </tr>
          <tr>
              <td>
                  <p>
                      <span style="color:#0065B3; font-size:14px; font-weight:bold">Inquiry message</span><br />
                      The details provided are:
                  </p>
                  <p>
                      <strong>Name</strong> : ' . $name . '<br />		
                      <strong>E-mail</strong> : ' . $email . '<br />		
                      <strong>Phome</strong> : ' . $phone . '<br />		
                      <strong>Message</strong>: ' . $message . '<br />
                  </p>
              </td>
          </tr>
          <tr>
              <td>
                  <p>Thank you,<br />
                  ' . $name . '
                  </p>
              </td>
          </tr>
      </table>
    ';

  $mail = new PHPMailer();
  $mail->SetFrom($email, $name);
  $mail->AddReplyTo($email, $name);
  $mail->AddAddress($usermail, $sitename);
  if (!empty($ccusermail)) {
      $rec = explode(';', $ccusermail);
      if ($rec) {
          foreach ($rec as $row) {
              $mail->AddCC($row, $sitename);
          }
      }
  }

  $mail->Subject = ' Inquiry mail from ' . $name;
  $mail->MsgHTML($body);

  if (!$mail->Send()) {
      echo json_encode(array("action" => "unsuccess", "message" => "We could not sent your Inquiry at the time. Please try again later."));
  } else {
      echo json_encode(array("action" => "success", "message" => "Your Inquiry has been successfully sent."));
  }
endif;





if ($_POST['action'] == "frm_event"):
   $body = '
        <table width="100%" border="0" cellpadding="0" style="font:12px Arial, serif;color:#222;">
            <tr>
                <td><p>Dear Sir,</p></td>
            </tr>
            <tr>
                <td>
                    <p>
                        <span style="color:#0065B3; font-size:14px; font-weight:bold">Event Booking Inquiry </span><br />
                        The details provided are:
                    </p>
                    <p>
                        <strong>Name</strong> : ' . $fname . ' ' . $mname . ' ' .$lname . '<br />		
                        <strong>Organization</strong>: ' . $organization . '<br />
                        <strong>Address</strong>: ' . $address . '<br />
                        <strong>Phone</strong>: ' . $phone . '<br />
                        <strong>E-mail Address</strong>: ' . $email . '<br />
                        <strong>Hall Name</strong>: ' . $hallname . '<br />
                        <strong>Event Name</strong>: ' . $eventname . '<br />
                        <strong>Date</strong>: ' . $date . '<br />
                        <strong>Total Person</strong>: ' . $totalperson . '<br />
                        <strong>Message</strong>: ' . $message . '<br />
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Thank you,<br />
                    ' . $fname . ' ' . $mname . ' ' .$lname . '
                    </p>
                </td>
            </tr>
        </table>
  ';

  $mail = new PHPMailer();
  $mail->SetFrom($email, $name);
  $mail->AddReplyTo($email, $name);
  $mail->AddAddress($eventmail, $sitename);
  if (!empty($ccusermail)) {
      $rec = explode(';', $ccusermail);
      if ($rec) {
          foreach ($rec as $row) {
              $mail->AddCC($row, $sitename);
          }
      }
  }

  $mail->Subject = ' Inquiry mail from ' . $name;
  $mail->MsgHTML($body);

  if (!$mail->Send()) {
      echo json_encode(array("action" => "unsuccess", "message" => "We could not sent your Inquiry at the time. Please try again later."));
  } else {
      echo json_encode(array("action" => "success", "message" => "Your Inquiry has been successfully sent."));
  }
endif;

?>