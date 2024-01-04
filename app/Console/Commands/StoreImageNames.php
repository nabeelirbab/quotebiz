<?php

namespace Acelle\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use Acelle\Model\Icon;
use File;

class StoreImageNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:image-names';

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
     * @return int
     */
    public function handle()
    {
        $folderPath = public_path('images/icons'); // Change this to the path of your images folder
        $imageNames = File::files($folderPath);
        foreach ($imageNames as $imageFile) {
           $imageName = pathinfo($imageFile, PATHINFO_FILENAME);
            $imageExtension = pathinfo($imageFile, PATHINFO_EXTENSION);
            Icon::create(['icon' => $imageName.'.'.$imageExtension]);
        }

        $this->info('Image names stored in the database successfully.');
    }
}
