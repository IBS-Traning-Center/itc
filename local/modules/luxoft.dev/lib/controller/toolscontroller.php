<?php
declare(strict_types=1);

namespace Luxoft\Dev\Controller;

use Luxoft\Dev\Engine\Controller;

class ToolsController extends Controller
{
    public function configureActions(): array
    {
        return [
            'notificationSession' => [
                'prefilters' => []
            ],
        ];
    }

    public function notificationSessionAction()
    {

    }
}