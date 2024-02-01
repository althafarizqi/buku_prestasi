<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class backupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Eksekusi backupDatabase.bat
        exec('cmd /c "' . public_path('backupDatabase.bat') . '"');
    }
}
