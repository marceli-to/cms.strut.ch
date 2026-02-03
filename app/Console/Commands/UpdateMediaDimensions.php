<?php

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateMediaDimensions extends Command
{
    protected $signature = 'media:update-dimensions {--force : Update all records, not just those missing dimensions}';

    protected $description = 'Update width and height for all media records';

    public function handle(): int
    {
        $query = Media::query();

        if (!$this->option('force')) {
            $query->where(function ($q) {
                $q->whereNull('width')->orWhereNull('height');
            });
        }

        $media = $query->get();

        if ($media->isEmpty()) {
            $this->info('No media records to update.');
            return self::SUCCESS;
        }

        $this->info("Updating {$media->count()} media records...");

        $bar = $this->output->createProgressBar($media->count());
        $bar->start();

        $updated = 0;
        $failed = 0;

        foreach ($media as $item) {
            $path = Storage::disk('public')->path($item->file);

            if (file_exists($path) && $size = @getimagesize($path)) {
                $item->update([
                    'width' => $size[0],
                    'height' => $size[1],
                ]);
                $updated++;
            } else {
                $failed++;
                $this->newLine();
                $this->warn("Could not process: {$item->file}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Updated: {$updated}");
        if ($failed > 0) {
            $this->warn("Failed: {$failed}");
        }

        return self::SUCCESS;
    }
}
