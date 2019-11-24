<?php

namespace App\Console\Commands;

use App\Notifications\NotifyUserOfPair;
use App\Pair;
use App\User;
use Illuminate\Console\Command;

class PickPairs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pick';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns everyone a secret santa';

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
        $pairs = Pair::count();

        if(($pairs < 1 && config('santa.dates.pulled')->isPast()) || config('app.env') !== 'production')
        {
            $users = User::players()->get();

            // Is there an even number of players?
            $is_odd = count($users) % 2 !== 0;

            // Store each user ID once it is picked
            $picked = [];

            foreach($users as $user)
            {
                $tries = 0;
                $max_tries = 5;

                do
                {
                    $found = User::players()->whereNotIn('id', $picked)->where('id', '<>', $user->id)->inRandomOrder()->first();
                    $tries++;
                }
                while (!isset($found->id) && $tries <= $max_tries);

                if($tries === $max_tries && $is_odd)
                {
                    // Out of players
                    $found = User::players()->inRandomOrder()->first();
                    $this->info('An odd number of players was found, someone was picked twice.');
                }

                array_push($picked, $found->id);

                $pair = Pair::create([
                    'user_id' => $user->id,
                    'pair_id' => $found->id
                ]);

                $user->notify(new NotifyUserOfPair($pair));

                sleep(1);
            }
        }
    }
}
