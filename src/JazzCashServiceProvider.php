<?php namespace Waqarraza\Jazzcashlaravel;

class JazzCashServiceProvider extends \Illuminate\Support\ServiceProvider
{

  public function boot() {
    $this->loadViewsFrom(__DIR__, 'Waqarraza');
    $this->publishes([
        __DIR__ . '/config/jazzcash.php' => config_path('jazzcash.php'),
    ]);
  }

  public function register() {
    if ($this->app instanceof \Illuminate\Foundation\Application) {
      $this->app->singleton('JazzCash', function () {
        return Jazzcash::getInstance();
      });
    }
  }
}
