<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Notifications\ExportReady;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyUserOfCompletedExport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $user;
    public $file;
    public $type;
    public $firstCreationDate;
    public $finalCreationDate;
    public $state;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $file, $type, $firstCreationDate, $finalCreationDate, $state)
    {
        $this->user = $user;
        $this->file = $file;
        $this->type = $type;
        $this->firstCreationDate = $firstCreationDate;
        $this->finalCreationDate = $finalCreationDate;
        $this->state = $state;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new ExportReady($this->file, $this->type, $this->firstCreationDate, $this->finalCreationDate, $this->state));
    }
}
