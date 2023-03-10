<?php

namespace Acelle\Console\Commands;

use Illuminate\Console\Command;
use Acelle\Model\Subdomain;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

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
        
        $subdomains = Subdomain::where('status','active')->get();
        foreach ($subdomains as $key => $subdomain) {
            SitemapGenerator::create('https://'.$subdomain->parent)
            ->writeToFile(public_path('sitemap-'.$subdomain->subdomain.'.xml'));
        }
        return 1;
         
    }
}
