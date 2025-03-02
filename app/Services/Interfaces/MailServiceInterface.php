<?php

namespace App\Services\Interfaces;

interface MailServiceInterface
{
    public function sendEmail($emails, $subject, $template, $data);
}
