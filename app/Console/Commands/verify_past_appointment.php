<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class verify_past_appointment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify_past_appointment:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'verficiar las citas pasadas y las nombra como tal';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

    }
}
