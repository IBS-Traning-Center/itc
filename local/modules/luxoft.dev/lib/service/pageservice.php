<?php
declare(strict_types=1);

namespace Luxoft\Dev\Service;

class PageService
{
    public static PageService $instance;
    protected array $breadcrumbs = [];
    protected array $meta = [];
    protected array $menu = [];

    public static function getInstance(): PageService
    {
        if (!isset(self::$instance)) {
            self::$instance = new PageService();
        }
        return self::$instance;
    }

    public function addBreadcrumb(string $name, string $link = ''): void
    {
        $this->breadcrumbs[] = [
            'NAME' => $name,
            'LINK' => $link,
        ];
    }

    public function setBreadcrumbs(array $breadcrumbs): void
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }

    public function clearBreadcrumbs(): void
    {
        $this->breadcrumbs = [];
    }


    public function addMeta(string $name, string $content): void
    {
        $this->meta[] = [
            'NAME' => $name,
            'CONTENT' => $content,
        ];
    }

    public function getMeta(): array
    {
        return $this->meta;
    }

    public function clearMeta(): void
    {
        $this->meta = [];
    }


    public function getMenu() : array
    {
        return $this->menu;
    }

    public function setMenu(array $menu) : void
    {
        $this->menu = $menu;
    }

    public function clearMenu() : void
    {
        $this->menu = [];
    }
}