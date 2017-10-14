<?php
namespace agoalofalife\postman\Console;

use agoalofalife\postman\Parser;
use Illuminate\Console\Command;

class ParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'postman:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands parse database and sends email';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() : void
    {
        Parser::parse();
    }
}