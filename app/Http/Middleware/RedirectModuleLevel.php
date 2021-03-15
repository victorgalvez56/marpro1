<?php

namespace App\Http\Middleware;

use Closure;

class RedirectModuleLevel
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
        $level = $request->user()->getLevel();
        $path = explode('/', $request->path());
        $levels = $request->user()->getLevels();

        if (!$request->ajax()) {
            if (count($levels)) {
                if (count($levels) < 13) {
                    $group = $this->getGroup($path, $level);
                    if ($group) {
                        if ($this->getLevelByGroup($levels, $group) === 0) {
                            return $this->redirectRoute($level);
                        }
                    }
                }
            }
        }
        return $next($request);
    }


    private function redirectRoute($level)
    {
        switch ($level) {
                // case 'catalogs':
                //     return redirect()->route('tenant.items.index');
        }
    }



    private function getLevelByGroup($levels, $group)
    {
        $levels_x_group  = $levels->filter(function ($module, $key) use ($group) {
            return $module->value === $group;
        });
        return $levels_x_group->count();
    }


    private function getGroup($path, $module)
    {
        $group = null;
        if (isset($path[1])) {
        } else {
            $group = null;
        }
        return $group;
    }
}
