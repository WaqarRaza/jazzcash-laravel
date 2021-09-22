<?php namespace Waqar\Jazzcash;

class JazzCashServiceProvider extends \Illuminate\Support\ServiceProvider
{

  public function boot() {
    $this->loadViewsFrom(__DIR__, 'Waqarraza');
    $this->publishes([
        __DIR__ . '/config/jazzcash.php' => config_path('jazzcash.php'),
    ]);
  }

  public function register() {
    $this->mergeConfigFrom(
        __DIR__ . '/config/jazzcash.php', 'jazzcash'
    );
    if ($this->app instanceof \Illuminate\Foundation\Application) {
      $this->app->singleton('JazzCash', function () {
        return Jazzcash::getInstance();
      });
    }
  }
}
