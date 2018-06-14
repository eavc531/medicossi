<?php

namespace App\Console\Commands;
use App\User;
use App\medico;
use Illuminate\Console\Command;

class deleteUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'borra los usuarios donde confirmation code = 1';

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
        //User::where('confirmation_code',1)->delete();
        $user = medico::find(11);
        $user->lastName = 'Briceño Graterol';
        $user->save();
        //Log::info("Usuarios  con confirmation_code = 1, Borrados");
         $this->info('comando ejecutado1');
    }
}
