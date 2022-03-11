<?php

use Illuminate\Support\Facades\Mail;

// send mail helper
function SendMail($data)
{
    // mail log
    $newMail = new \App\Models\MailLog();
    $newMail->from = 'onenesstechsolution@gmail.com';
    $newMail->to = $data['email'];
    $newMail->subject = $data['subject'];
    $newMail->blade_file = $data['blade_file'];
    $newMail->payload = json_encode($data);
    $newMail->save();

    // send mail
    Mail::send($data['blade_file'], $data, function ($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject($data['subject'])->from('onenesstechsolution@gmail.com', env('APP_NAME'));
    });

    dd('mail sent');
}