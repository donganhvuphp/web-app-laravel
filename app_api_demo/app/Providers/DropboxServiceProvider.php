<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Spatie\Dropbox\Client as DropboxClient;

class DropboxServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        Storage::extend(
            'dropbox',
            function ($app, $config) {
                $client = new DropboxClient(config('filesystems.disks.dropbox.key'));
                return new Filesystem(new DropboxAdapter($client));
            }
        );
    }
}
