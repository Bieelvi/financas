<?php 

namespace Financas\Mail;

class Mail
{
    public function __construct(
        private string $to,
        private string $toName,
        private string $subject,
        private string $body,
        private string $isHtml,
        private string $from = 'bieelvii13@gmail.com', 
        private string $fromName = 'App Financas'
    ) {
        $this->to = $to;
        $this->toName = $toName;
        $this->subject = $subject;
        $this->body = $body;
        $this->isHtml = $isHtml;
        $this->from = $from;
        $this->fromName = $fromName;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getToName(): string
    {
        return $this->toName;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getIsHtml(): string
    {
        return $this->isHtml;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getFromName(): string
    {
        return $this->fromName;
    }
}