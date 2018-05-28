<?php

namespace App\Console\Commands;

use App\Card;

use Illuminate\Console\Command;

class mtgjsonGetImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtgjson:getImages {set}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch images for a given set via "magiccards.info".';

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
        $set = $this->argument('set');

        //ToDo: Check if `set` is listed as a set in the DB

        // Creating the path
        $path = "storage/app/card-images/$set";
        $this->info("Creating Location: '$path'");
        mkdir($path);
        $this->info('.done');

        // Fetch the Cards from the given Set
        $this->info("Fetching cards...");
            $cards = Card::where('setCode', $set)
                ->get()
                ->sortBy('numberNumeric');
            $cardCount = count($cards);
        $this->info("Done fetching $cardCount cards.");

        // Starting to fetch images from "magiccards.info"
        $this->info("Starting to fetch images from \"magiccards.info\"");
        $cardBar = $this->output->createProgressBar($cardCount);

        foreach ($cards as $card){
            file_put_contents(
                "$path/$card->imageName.jpg",
                file_get_contents($card->mciPath())
            );
            $cardBar->advance();
        }
        $cardBar->finish();
        $this->info("\r");

        $this->info("Fetched $cardCount images from \"magiccards.info\"");

    }
}
