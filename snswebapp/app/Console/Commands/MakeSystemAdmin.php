<?php

namespace App\Console\Commands;

use App\Models\Users;
use App\Models\Roles;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeSystemAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:system-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        $this->info("Start");

        $users = Users::where(['role_id' => Roles::SYSTEM])->first();
        if (is_null($users)) {
            $users = new Users();
        }

        $users->role_id = Roles::SYSTEM;
        $users->name = __('strings.roles.system');
        $users->name_kana = null;
        $users->email = $this->ask(__('strings.email'));
        $users->password = Hash::make($this->ask(__('strings.password')));
        $users->save();
    }
}