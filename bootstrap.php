<?php

/**
 * @var $container \TightenCo\Jigsaw\Container
 * @var $events    \TightenCo\Jigsaw\Events\EventBus
 */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

use Illuminate\Cache\FileStore;
use Illuminate\Cache\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Facade;
use TightenCo\Jigsaw\Container;
use TightenCo\Jigsaw\File\Filesystem;
use Torchlight\Blade\BladeManager;
use Torchlight\Torchlight;
use Torchlight\TorchlightServiceProvider;

$events->afterBuild(App\Listeners\GenerateSitemap::class);
$events->afterBuild(App\Listeners\GenerateIndex::class);

$container->booted(function (Container $container) use ($events) {
    // Set the root if it doesn't exist yet.
    if (! Facade::getFacadeApplication()) {
        Facade::setFacadeApplication($container);
    }

    // Bind our Manager class, as this is what
    // the Torchlight Facade references.
    $provider = new TorchlightServiceProvider($container);
    $provider->bindManagerSingleton();

    // There is no `config` helper, so we bind in a callback
    // that references the configuration on this class.
    Torchlight::getConfigUsing(function ($key, $default) {
        $config = include __DIR__ . '/torchlight.php';
        return Arr::get($config, $key, $default);
    });

    // Laravel before 8.23.0 has a bug that adds extra spaces around components.
    // Obviously this is a problem if your component is wrapped in <pre></pre>
    // tags, which ours usually is.
    // See https://github.com/laravel/framework/blob/8.x/CHANGELOG-8.x.md#v8230-2021-01-19.
    BladeManager::$affectedBySpacingBug = true;

    // There is no `app()->environment` helper, so we need to tell Torchlight what
    // environment we're in. Hardcode the environment to a non "production" build
    // because this is a build tool. If a request fails while building the
    // production site, we need to notify the developer.
    $events->beforeBuild(function () {
        Torchlight::overrideEnvironment('build');
    });

    // Set an instantiated cache instance.
    Torchlight::setCacheInstance(
        new Repository(
            new FileStore(
                new Filesystem,
                $container['cwd'] . DIRECTORY_SEPARATOR . Torchlight::config('cache_path', 'torchlight_cache')
            )
        )
    );
});