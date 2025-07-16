<?php

namespace App\Helpers\Interfaces;

interface IFile {

    const TYPE = [
        'image' => 'FILE::TYPE::IMAGE',
        'sound' => 'FILE::TYPE::SOUND',
        'video' => 'FILE::TYPE::VIDEO',
        'document' => 'FILE::TYPE::DOCUMENT',
    ];
}
