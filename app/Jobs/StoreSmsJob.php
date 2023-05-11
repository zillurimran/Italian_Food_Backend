<?php

namespace App\Jobs;

use App\Models\History;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels; 

class StoreSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public $title = '';
     public $body = '';
     public $numbers = '';
     public $user_id = '';
     public $group_id = '';
    public function __construct($title, $body, $numbers, $user_id, $group_id)
    {
     
        $this->title   = $title;
        $this->body    = $body;
        $this->numbers = $numbers;
        $this->user_id = $user_id;
        $this->group_id = $group_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach($this->numbers as $number)
        {
            $history = new History();
            $history->number  = $number; 
            $history->title   = $this->title;
            $history->body    = $this->body;
            $history->user_id = $this->user_id;
            $history->group_id = $this->group_id;
            $history->save();
        }
    }
}
