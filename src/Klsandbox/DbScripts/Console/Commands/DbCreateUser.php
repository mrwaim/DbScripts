<?php

namespace Klsandbox\DbScripts\Console\Commands;

use Hash;
use Illuminate\Console\Command;
use Schema;
use Symfony\Component\Console\Input\InputOption;

class DbCreateUser extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:createuser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user with username and password.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $userClass = config('auth.model');

        $list =  \Schema::getColumnListing('users');
        $list2 = array_filter($list, function ($e) {
            return $e != 'id' && !str_contains($e, 'password');
        });

        $user = new $userClass();
        $passWord = $this->secret('Password');

        $user->password = Hash::make($passWord);

        foreach ($list2 as $option)
        {
            if ($this->option($option))
            {
                $user->$option = $this->option($option);
            }
        }

        $user->save();
        $this->comment($user->id);
    }

    protected function getOptions()
    {
        $list =  Schema::getColumnListing('users');
        $list2 = array_filter($list, function ($e) {
            return $e != 'id' && !str_contains($e, 'password');
        });

        $map = array_map(function ($e) {
            return [$e, null, InputOption::VALUE_OPTIONAL, '(Optional) Value for column ' . $e, null];
        }, $list2);

        return $map;
    }
}
