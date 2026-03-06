<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\View\ViewDecoratorInterface;

class View extends BaseConfig
{
    /**
     * The default renderer to use
     */
    public string $defaultRenderer = 'CodeIgniter\View\View';

    /**
     * Where to store the view files
     */
    public string $viewsDirectory = APPPATH . 'Views';

    /**
     * View file overrides folder (Required in CI4.7+)
     */
    public string $appOverridesFolder = APPPATH . 'Views/';

    /**
     * Save data between view calls
     */
    public bool $saveData = true;

    /**
     * Parser filters
     */
    public array $filters = [];

    /**
     * Parser plugins
     */
    public array $plugins = [];

    /**
     * View decorators
     */
    public array $decorators = [];
}