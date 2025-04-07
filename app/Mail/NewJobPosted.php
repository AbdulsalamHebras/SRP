<?php
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewJobPosted extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $company;

    public function __construct($job, $company)
    {
        $this->job = $job;
        $this->company = $company;
    }

    public function build()
    {
        return $this->subject('وظيفة جديدة من ' . $this->company->name)
                    ->view('Jobs.details');
    }
}
