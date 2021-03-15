<?php

namespace App\Http\Middleware;

use App\Exceptions\RedirectModuleException;
use Closure;

class RedirectModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $module = $request->user()->getModule();
        $path = explode('/', $request->path());
        $modules = $request->user()->getModules();

        if (!$request->ajax()) {

            if (count($modules)) {

                if (count($modules) < 9) {

                    $group = $this->getGroup($path, $module);

                    if ($group) {
                        if ($this->getModuleByGroup($modules, $group) === 0) {
                            return $this->redirectRoute($module);
                        }
                    }
                }
            }
        }

        return $next($request);
    }


    private function redirectRoute($module)
    {

        switch ($module) {

            case 'configuration':
                return redirect()->route('tenant.companies.create');
        }

        throw new  RedirectModuleException("");
    }



    private function getModuleByGroup($modules, $group)
    {

        $modules_x_group  = $modules->filter(function ($module, $key) use ($group) {
            return $module->value === $group;
        });

        return $modules_x_group->count();
    }


    private function getGroup($path, $module)
    {

        ///* Determinate type person */
        // elseif ($path[0] == "persons") {
        //     if ($path[1] == "suppliers") {
        //         $group = "purchases";
        //     } elseif ($path[1] == "customers") {
        //         $group = "documents";
        //     } else {
        //         $group = null;
        //     }
        // }

        ///* Module catalogs */
        // if ($path[0] == "documents") {
        //     $group = "documents";
        // } elseif ($path[0] == "dashboard") {
        //     $group = "documents";
        // } elseif ($path[0] == "persons") {
        //     if ($path[1] == "suppliers") {
        //         $group = "purchases";
        //     } elseif ($path[1] == "customers") {
        //         $group = "documents";
        //     } else {
        //         $group = null;
        //     }
        // }
        ///* Module configuration */
        if ($path[0] == "users") {
            $group = "establishments";
        } elseif ($path[0] == "establishments") {
            $group = "establishments";
        } elseif ($path[0] == "companies") {
            $group = "configuration";
        } elseif ($path[0] == "catalogs") {
            $group = "configuration";
        }
        ///* Module accounting */
        elseif ($path[0] == "account") {
            $group = "accounting";
        } else {
            $group = null;
        }
        return $group;
    }
}
