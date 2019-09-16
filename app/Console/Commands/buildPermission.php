<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;


class buildPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'build permission table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        $nameList = $routes->getRoutesByName();

        foreach($nameList as $routeName => $route){
            if(preg_match('/^passport/',$routeName)){
                continue;
            }
            $permission = [
                'name' => $routeName,
                'alias_name' => '',
                'uri' => $route->uri
            ];
            if(preg_match('/^api/',$route->uri)){
                $permission['guard_name'] = 'api';
            } else {
                $permission['guard_name'] = 'web';
            }
            Permission::firstOrCreate($permission);
        }
    }
}
