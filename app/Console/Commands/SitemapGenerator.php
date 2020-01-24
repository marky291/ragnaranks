<?php

namespace App\Console\Commands;

use App\Listings\Listing;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

/**
 * Class GenerateSitemap
 *
 * @package App\Console\Commands
 */
class SitemapGenerator extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0))
            ->add(Url::create('/listing/create')->setPriority(0.6)->setChangeFrequency('weekly'))
            ->add(Url::create('/login')->setPriority(0.6)->setChangeFrequency('weekly'))
            ->add(Url::create('/register')->setPriority(0.6)->setChangeFrequency('weekly'));

        foreach (Listing::all() as $listing)
        {
            if (! $sitemap->hasUrl("/listing/{$listing->slug}")) {
                $sitemap->add(Url::create("/listing/{$listing->slug}")->setPriority(0.8)->setLastModificationDate($listing->updated_at));
            }
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
