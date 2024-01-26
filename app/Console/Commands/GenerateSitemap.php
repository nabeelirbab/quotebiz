<?php

namespace Acelle\Console\Commands;

use Illuminate\Console\Command;
use Acelle\Model\Subdomain;
use Acelle\Model\Post;
use Carbon\Carbon;
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
       
        foreach ($subdomains as $subdomain) {
        $sitemap = SitemapGenerator::create('https://' . $subdomain->parent)
            ->getSitemap();

        $posts = Post::where('subdomain', $subdomain->subdomain)
            ->get();
        if(count($posts) > 0 ){
            foreach ($posts as $post) {
                $url = 'https://' . $subdomain->parent.'/blog/'.$post->slug;

                $sitemap->add($url, Carbon::now());
            }
        }

        $sitemap->writeToFile(public_path("sitemap-{$subdomain->subdomain}.xml"));
    }

      $subdomains = Subdomain::where('status','inactive')->get();
       
        foreach ($subdomains as $subdomain) {
        $sitemap = SitemapGenerator::create('https://' . $subdomain->subdomain.'.quotebiz.io')
            ->getSitemap();

        $posts = Post::where('subdomain', $subdomain->subdomain)
            ->get();
        if(count($posts) > 0 ){
            foreach ($posts as $post) {
                $url = 'https://' . $subdomain->subdomain.'.quotebiz.io/blog/'.$post->slug;

                $sitemap->add($url, Carbon::now());
            }
        }

        $sitemap->writeToFile(public_path("sitemap-{$subdomain->subdomain}.xml"));
    }
        return 1;
         
    }
}
