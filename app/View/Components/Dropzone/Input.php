<?php

namespace App\View\Components\Dropzone;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
{
    public string $randomName = '';

    /**
     * Create the component instance.
     * @param string $formId
     * @param string $paramName
     * @param int $maxFileSize
     * @param int $maxFiles
     * @param string $acceptedFiles
     * @param $medias
     */
    public function __construct(
        public string $formId,
        public string $paramName,
        public int    $maxFileSize,
        public int    $maxFiles,
        public string $acceptedFiles,
        public        $medias,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropzone.input');
    }

    /**
     * @return string
     */
    public function generateRandomName(): string
    {
        if ($this->randomName !== '') {
            return $this->randomName;
        }
        return $this->randomName = Str::random();
    }
}
