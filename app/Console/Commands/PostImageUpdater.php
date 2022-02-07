<?php

namespace App\Console\Commands;

use App\Services\Blog\PreviewUpdater;
use Illuminate\Console\Command;

class PostImageUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '파싱한 이미지의 미리보기 이미지를 구해옵니다';

    /**
     * @param PreviewUpdater $previewUpdater
     */
    public function handle(PreviewUpdater $previewUpdater): void
    {
        $previewUpdater->update();
    }
}
