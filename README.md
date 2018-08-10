# tecnocalderas

Pasos para crear un módulo:

1. Crear carpeta con el nombre del módulo en `/modules`, ejemplo: `/modules/mimodulo`.
2. Dentro de la carpeta del módulo crear un archivo para cada acción, ejemplo: `/modules/mimodulo/miaccion.php`.
3. Agregar los permisos de acceso a cada acción del módulo en `/config/permisos.php`.
```php
$permisos = [
  'mimodulo' => [
    'miaccion' => [1] // id perfil separados por coma
  ]
];
```
4. Agregar link al menú de navegación para acceder al módulo en `/config/nav_links.php`.
```php
$nav_links = [
  ['titulo'=> 'Mi módulo', 'mod' => 'mimodulo', 'action' => 'miaccion', 'icono' => 'miicono']
];
```
iconos disponibles: https://feathericons.com
