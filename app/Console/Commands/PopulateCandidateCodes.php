<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PopulateCandidateCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'candidates:populate-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates the unique QR check-in code for any candidate missing one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Finding candidates without a code...');
        
        $candidates = \App\Models\Candidate::whereNull('code')->get();
        
        if ($candidates->isEmpty()) {
            $this->info('All candidates already have a code!');
            return;
        }

        $bar = $this->output->createProgressBar(count($candidates));

        $bar->start();

        foreach ($candidates as $candidate) {
            $candidate->code = \Illuminate\Support\Str::uuid()->toString();
            $candidate->save();
            $bar->advance();
        }

        $bar->finish();
        
        $this->newLine();
        $this->info('Successfully populated codes for ' . count($candidates) . ' candidates!');
    }
}
