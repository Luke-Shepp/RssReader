<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class FlushCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feeds:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear feed cache';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cacheDirectory = Config::get('feed.cache_dir', storage_path('framework/cache/'));
        $files = glob($cacheDirectory . '*');

        foreach ($files as $file) {
            try {
                unlink($file);
            } catch (\Exception $ex) {
                $this->error("Failed to remove: " . $file);
            }
        }

        $this->info("Cache purge finished.");

        return 0;
    }
}
