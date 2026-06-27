# Instrucciones para Antigravity en este proyecto Laravel

## Objetivo
Trabajar de forma eficiente, segura y con bajo consumo de tokens en este proyecto Laravel.

## Reglas de contexto
- No leer todo el proyecto completo sin necesidad.
- No abrir carpetas pesadas como vendor, node_modules, storage/logs, public/build o backups, salvo que el usuario lo pida.
- Para entender el proyecto, revisar primero:
  - composer.json
  - package.json
  - routes/web.php
  - routes/api.php
  - app/Http/Controllers
  - app/Http/Middleware
  - app/Models
  - database/migrations
  - config/auth.php
  - config/session.php
  - config/cors.php
- Usar búsquedas específicas antes de abrir archivos grandes.
- Leer solo los archivos relacionados con la tarea actual.
- No pegar archivos completos en la respuesta salvo que sea estrictamente necesario.
- Responder con resumen, hallazgos y cambios puntuales.

## Reglas para seguridad Laravel
Cuando el usuario pida revisar seguridad:
1. Primero analizar en modo solo lectura.
2. Clasificar riesgos por criticidad: Crítico, Alto, Medio, Bajo.
3. Revisar:
   - autenticación
   - autorización
   - roles y permisos
   - CSRF
   - CORS
   - validaciones
   - SQL Injection
   - XSS
   - subida de archivos
   - sesiones y cookies
   - rate limiting
   - exposición de .env
   - debug en producción
   - dependencias vulnerables
4. No modificar archivos sin mostrar primero un plan.
5. Proponer cambios pequeños y verificables.
6. No mostrar claves, tokens, contraseñas ni valores sensibles del .env.

## Estilo de respuesta
- Ser directo y breve.
- No explicar teoría innecesaria.
- No repetir código completo si solo cambia una parte.
- Mostrar rutas de archivos modificados.
- Al final dar comandos concretos para probar.

