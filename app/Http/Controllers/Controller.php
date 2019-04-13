<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function view(string $viewName = null)
    {
        $fields = get_object_vars($this);
        unset($fields['middleware']);
        if ($viewName) {
            return view($viewName, $fields);
        }
        $className = explode("\\", static::class);
        $viewName = debug_backtrace()[1]['function'];
        // chek if view methodName have camelcase and transform into method_name
        if (preg_match('/[A-Z]/', $viewName)) {
            $viewName = $this->underscoreFilter($viewName);
        }
        $name = array_pop($className);
        $viewFolder = str_replace('Controller', '', $name);
        $viewFolder = $this->underscoreFilter($viewFolder);
        if (count($className) == 3) {
            return view(sprintf('%s.%s', $viewFolder, $viewName), $fields);
        }
        $viewSubfolder = $viewFolder;
        $viewFolder = array_pop($className);
        $viewFolder = $this->underscoreFilter($viewFolder);
        return view(sprintf('%s.%s.%s', $viewFolder, $viewSubfolder, $viewName), $fields);
    }

    private function underscoreFilter(string $str): string
    {
        $names = preg_split('/(?<=[a-z])(?=[A-Z])/u', $str);
        $result = '';
        foreach ($names as $name) {
            $result .= '_' . mb_strtolower($name);
        }
        return ltrim($result, '_');
    }
}
