<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DemoLoginSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(MobileRegisterSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(PageDemoSeeder::class);
        $this->call(SubProfileSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(PromoVideoSeeder::class);
        $this->call(WatermarkLogoSeeder::class);
        $this->call(LandingPageSeeder::class);
        $this->call(ReferralSettingsSeeder::class);
        $this->call(JwPlayerSeeder::class);
        
    }
}

