<?php

namespace App\Services\Mail;

use App\Mail\MailNotify;
use App\Services\Interfaces\MailServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    public function sendEmail($emails, $subject, $template, $data)
    {
        try {
            Mail::to($emails)->send(new MailNotify($template, $subject, $data));

            return true;
        } catch (\Exception $exception) {
            Log::error('Send email : ' . $exception->getMessage());
            Log::error('Email subject : ' . $subject);
            Log::error('Email template : ' . $template);
            Log::error('Email data : ' . json_encode($data));

            throw new \Exception($exception->getMessage());
        }
    }
}
