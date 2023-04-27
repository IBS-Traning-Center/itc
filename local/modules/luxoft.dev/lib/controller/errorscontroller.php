<?php
declare(strict_types=1);

namespace Luxoft\Dev\Controller;

use Luxoft\Dev\Engine\Controller;

class ErrorsController extends Controller
{
    public function configureActions(): array
    {
        return [
            'addError' => [
                'prefilters' => []
            ],
        ];
    }

    public function addErrorAction($context) {

    }
}