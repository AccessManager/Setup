<?php

namespace AccessManager\Setup\Commands;


use Illuminate\Console\Command;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Class FreshAssetsCommand
 * @package AccessManager\Setup
 */
class FreshAssetsCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = "assets:fresh";

    /**
     * @var string
     */
    protected $description = "takes care of copying assets into public folder.";

    /**
     * Delete old assets folder under public directory if exists, and create new with
     * Assets folder provided with this package.
     *
     * @param Filesystem $fs
     */
    public function handle( Filesystem $fs )
    {
        $assetsPath = public_path('assets');

        if( $fs->exists($assetsPath) )
        {
            $this->line("Removing existing 'assets' directory.");
            $fs->remove($assetsPath);
        }
        $this->line("populating 'assets' directory.");
        $fs->mirror( __DIR__ . '/../Assets', $assetsPath);
    }
}