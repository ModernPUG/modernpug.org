<?php

namespace ModernPUG\Homepage\Console;

class RandomSkinCommand extends SkinCommand
{
    protected $signature = 'skin:random';

    protected $description = '스킨을 랜덤하게 바꿉니다';

    public function handle()
    {
        $skin_key = array_rand($this->getSkins());
        $this->changeSkin($skin_key);
    }
}
