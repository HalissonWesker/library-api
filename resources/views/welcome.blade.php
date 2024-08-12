<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentação da API</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
            color: #333;
        }
        h1, h2 {
            color: #444;
        }
        .method {
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: bold;
        }
        .method-get {
            background-color: #28a745;
        }
        .method-post {
            background-color: #007bff;
        }
        .method-put {
            background-color: #ffc107;
        }
        .method-delete {
            background-color: #dc3545;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .auth-required {
            color: #e83e8c;
        }
        .auth-public {
            color: #17a2b8;
        }
    </style>
</head>
<body>
    <h1>Documentação da API</h1>

    @php
        $groupedRoutes = $routes->groupBy(function($route) {
            return explode('@', $route['action'])[0];
        })->map(function($routes) {
            return $routes->groupBy(function($route) {
                return in_array('auth:api', $route['middleware']) ? 'Authenticated' : 'Public';
            })->reverse(); 
        })->reverse();
    @endphp

    @foreach ($groupedRoutes as $controller => $authGroups)
        <h2>Endpoints do {{ class_basename($controller) }}</h2>

        @foreach ($authGroups as $authType => $routes)
            <h3 class="{{ $authType == 'Authenticated' ? 'auth-required' : 'auth-public' }}">
                Endpoints {{ $authType == 'Authenticated' ? 'Autenticados' : 'Públicos' }}
            </h3>

            <table>
                <thead>
                    <tr>
                        <th>Método</th>
                        <th>URI</th>
                        <th>Nome</th>
                        <th>Ação</th>
                        <th>Middleware</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($routes->reverse() as $route)
                        <tr>
                            <td>
                                <span class="method method-{{ strtolower($route['method']) }}">
                                    {{ $route['method'] }}
                                </span>
                            </td>
                            <td>{{ $route['uri'] }}</td>
                            <td>{{ $route['name'] ?? '-' }}</td>
                            <td>{{ $route['action'] }}</td>
                            <td>{{ implode(', ', $route['middleware']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>
