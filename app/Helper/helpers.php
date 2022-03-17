<?php

use Illuminate\Support\Facades\Mail;

// $ip = $_SERVER['REMOTE_ADDR'];

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
}

// multi-dimensional in_array
function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) return true;
    }
    return false;
}