<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Card;

use DB;
use League\Flysystem\Exception;



class mtgjsonGetCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mtgjson:getCards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch cards from a given set using a locally provided json file.';

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
        $path = resource_path('AllSets-x.json');
        $skipped = '';

        $this->info("Open '$path'...");
        $jsonFile = file_get_contents($path);

        $this->info('Decoding JSON...');
        $JSONSets = json_decode($jsonFile, true);

        $this->info("Truncating 'cards' table...");
        DB::table('cards')->truncate();

        $setCount = count($JSONSets);
        $this->info("Starting to fetch cards from $setCount editions...");
        $bar = $this->output->createProgressBar($setCount);

        $cardCount = 0;

        foreach ($JSONSets as $JSONSet){
            $JSONCards = $JSONSet['cards'];
            $cardCount += count($JSONCards);
            //$JSONCards = $JSONSets['SOK']['cards']; //$JSONSet['cards'];

            foreach ($JSONCards as $JSONCard){

                $JSONCard['setCode'] = $JSONSet['code'];
                //$JSONCard['setCode'] = 'SOK'; //$JSONSet['code'];

                array_pushDown($JSONCard, 'meta', 'names'        );
                array_pushDown($JSONCard, 'meta', 'colors'       );
                array_pushDown($JSONCard, 'meta', 'colorIdentity');
                array_pushDown($JSONCard, 'meta', 'supertypes'   );
                array_pushDown($JSONCard, 'meta', 'types'        );
                array_pushDown($JSONCard, 'meta', 'subtypes'     );
                array_pushDown($JSONCard, 'meta', 'variations'   );
                array_pushDown($JSONCard, 'meta', 'hand'         );
                array_pushDown($JSONCard, 'meta', 'life'         );
                array_pushDown($JSONCard, 'meta', 'reserved'     );
                array_pushDown($JSONCard, 'meta', 'releaseDate'  );
                array_pushDown($JSONCard, 'meta', 'starter'      );
                array_pushDown($JSONCard, 'meta', 'loyalty'      );
                array_pushDown($JSONCard, 'meta', 'watermark'    );
                array_pushDown($JSONCard, 'meta', 'border'       );
                array_pushDown($JSONCard, 'meta', 'rulings'      );
                array_pushDown($JSONCard, 'meta', 'printings'    );
                array_pushDown($JSONCard, 'meta', 'legalities'   );

                array_rename($JSONCard, 'cmc', 'convertedManaCost');
                array_rename($JSONCard, 'multiverseid', 'multiverseID');

                array_forget($JSONCard, 'foreignNames');
                array_forget($JSONCard, 'originalText');
                array_forget($JSONCard, 'originalType');
                array_forget($JSONCard, 'source');

                if(isset($JSONCard['number']))
                    $JSONCard['numberNumeric'] = preg_replace('/\D/', '', $JSONCard['number']);
                else
                    $JSONCard['numberNumeric'] = 0;

                if(isset($JSONCard['number']))
                    $JSONCard['number'] = str_replace('a', '', $JSONCard['number']);

                if(Card::find($JSONCard['id']) === null)
                    Card::create($JSONCard);
                else
                    $skipped .= ("Skipped: ".$JSONCard['setCode']." - ".$JSONCard['number']."\n");
            }


            $bar->advance();
        }

        $bar->finish();
        $this->info("\r");

        $this->info($skipped);

        $this->info("Fetched $cardCount cards from the JSON file.");
    }
}
