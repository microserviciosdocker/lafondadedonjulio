# La Fonda de don Julio

Sistema completo de gestión de pedidos para restaurante/fonda, con panel de administración, aplicaciones móviles para clientes y repartidores, e integraciones con WhatsApp y redes sociales.

## Estructura del Proyecto

```
LaFondadedonJulio/
├── backend/                 # Laravel 11 + Filament 3
│   ├── app/
│   ├── config/
│   ├── database/
│   └── ...
├── app-cliente/            # Flutter App Cliente
├── app-repartidor/         # Flutter App Repartidor
├── docker/                 # Configuración Docker
└── docs/                   # Documentación
```

## Tecnologías

### Backend
- Laravel 11
- Filament 3 (Panel Admin)
- PostgreSQL
- Redis
- Laravel Reverb (WebSockets)
- Laravel Sanctum (API Auth)

### Apps Móviles
- Flutter 3.x
- Firebase Cloud Messaging
- Google Maps API

### Integraciones
- Twilio WhatsApp API
- Facebook/Instagram Graph API

## Requisitos

- PHP 8.2+
- Composer
- Node.js 18+
- PostgreSQL 15+
- Redis 7+
- Flutter 3.x (para apps móviles)

## Instalación

### Backend

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan storage:link
```

### Configuración Inicial

1. Crear usuario administrador:
```bash
php artisan make:filament-user
```

2. Iniciar servidor de desarrollo:
```bash
php artisan serve
```

3. Iniciar WebSockets (en otra terminal):
```bash
php artisan reverb:start
```

## Panel de Administración

Acceder a: `http://localhost:8000/admin`

## API

La documentación de la API está disponible en: `http://localhost:8000/api/documentation`

## Licencia

Este proyecto es privado y de uso exclusivo para La Fonda de don Julio.
