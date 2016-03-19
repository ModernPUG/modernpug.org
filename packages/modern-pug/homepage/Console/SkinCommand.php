<?php

namespace ModernPUG\Homepage\Console;

use Illuminate\Console\Command;

class SkinCommand extends Command
{
    private $skins = [
        "original" => "ModernPUG\\OriginalSkin\\OriginalSkinServiceProvider",
        "redgoose" => "ModernPUG\\RedGooseSkin\\RedGooseSkinServiceProvider",
    ];

    protected function getSkins()
    {
        return $this->skins;
    }

    protected function removeNineCellsViews()
    {
        $this->rrmdir(resource_path('views/vendor/ncells'));
    }

    protected function changeSkin($skin_key)
    {
        if(!isset($this->skins[$skin_key])) {
            $this->error("$skin_key 스킨이 존재하지 않습니다.");
            exit;
        }
        $this->removeNineCellsViews();
        $this->call('vendor:publish', ['--provider' => $this->skins[$skin_key]]);
        $this->info("$skin_key 스킨으로 변경");
    }

    protected function rrmdir($dirPath)
    {
        if (!file_exists($dirPath)) {
            return;
        }

        $paths = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $dirPath,
                \FilesystemIterator::SKIP_DOTS
            ),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($paths as $path) {
            $path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
        }

        rmdir($dirPath);
    }
}