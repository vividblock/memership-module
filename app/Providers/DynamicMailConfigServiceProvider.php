<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use App\Models\admin\admin_smtp_settings;

class DynamicMailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {      
        // if (!App::runningInConsole()) {
            if (Schema::hasTable('smtp_settings')) {
                $settings = admin_smtp_settings::first();

                if ($settings) {
                    Config::set('mail.mailers.smtp.host', $settings->host);
                    Config::set('mail.mailers.smtp.port', $settings->port);
                    Config::set('mail.mailers.smtp.username', $settings->username);
                    Config::set('mail.mailers.smtp.password', $settings->password);
                    Config::set('mail.mailers.smtp.encryption', $settings->protocol);
                    Config::set('mail.from.address', $settings->email);
                    Config::set('mail.default', 'smtp');
                    // Config::set('mail.from.name', $settings->mail_from_name);
                }
            }
        // }
    }
}
