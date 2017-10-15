<?php
namespace agoalofalife\postman\Console;

use Illuminate\Console\Command;

class AssetsConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'postman:assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-publish the postman assets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() : void
    {
        $this->call('vendor:publish', [
            '--tag' => 'postman-assets',
            '--force' => true,
        ]);
    }
}