<?php

namespace App\Enums;

enum DeleteEntityType: string
{
    case Media = 'media';

    public function getModel(): array
    {
        return match($this) {
            self::Media => [
                'model' => 'Plank\Mediable\Media',
                'displayName' => 'basename',
            ],
        };
    }
}
