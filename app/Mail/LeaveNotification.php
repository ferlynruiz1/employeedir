<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\LeaveRequest;

class LeaveNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $leave_request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LeaveRequest $leave_request)
    {
        $this->leave_request = $leave_request;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('elink.employeedirectory@gmail.com')->view('mail.leave.request');
    }
}
