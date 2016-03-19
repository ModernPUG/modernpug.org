<?php

namespace ModernPUG\Homepage\Console;

class ChangeSkinCommand extends SkinCommand
{
    protected $signature = 'skin:change {skin_key}';

    protected $description = '스킨을 바꿉니다';

    public function fire()
    {
        $skin_key = $this->argument('skin_key');

        $this->removeNineCellsViews();

        $this->changeSkin($skin_key);
    }
}
