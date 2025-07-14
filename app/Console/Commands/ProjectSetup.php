<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the project: key, migrate, npm, build, docs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating app key...');
        $this->call('key:generate');

        if ($this->confirm('Do you want to run `php artisan migrate:fresh --seed`?', false)) {
            $this->call('migrate:fresh', [
                '--seed' => true,
                '--force' => true,
                '--ansi' => true,
            ]);
        } else {
            $this->info('Skipped migration and seeding.');
        }

        $this->info('Installing npm dependencies...');
        passthru('npm install');

        $this->info('Building assets...');
        passthru('npm run build');

        $this->info('Generating API docs...');
        $this->call('scribe:generate');

        $this->info('✅ Project setup complete!');
    }
}
