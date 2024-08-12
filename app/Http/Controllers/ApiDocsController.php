<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Route as RouteInstance;

class ApiDocsController extends Controller
{
    public function index()
    {
        // Captura todas as rotas definidas na aplicação
        $routes = collect(Route::getRoutes())->map(function (RouteInstance $route) {
            return [
                'uri' => $route->uri(),
                'method' => $route->methods()[0],
                'name' => $route->getName(),
                'action' => $route->getActionName(),
                'middleware' => $route->middleware(),
            ];
        });

        // Passa a lista de rotas para a view
        return view('welcome', compact('routes'));
    }
}
