<?php

namespace agoalofalife\postman\Console;

use Illuminate\Console\Command;
use ModePostEmailSeeder;
use StatusesSeeder;

class SeederCommand extends Command
{
    protected $seeds = [
        ModePostEmailSeeder::class,
        StatusesSeeder::class
    ];

    protected $seedersPath = __DIR__.'/../../database/seeds/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'postman:seed';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill tables';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle() : void
    {
        $this->info('Seeding data into the database');

        foreach ($this->seeds as $seed) {
            if (!class_exists($seed)) {
                require_once $this->seedersPath . $seed .'.php';
            }
            (new $seed())->run();
        }
    }
}
