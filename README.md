# 🍸 Cocktail Management Application

Aplicación web desarrollada con **Laravel** para la gestión de cócteles, autenticación de usuarios y pruebas automatizadas con cobertura de código.  
El proyecto sigue buenas prácticas de arquitectura, testing y documentación, orientado a estándares profesionales y mantenibilidad a largo plazo.

---

## 📌 Tabla de Contenidos

1. [Descripción General](#descripción-general)
2. [Stack Tecnológico](#stack-tecnológico)
3. [Instalación del Proyecto](#instalación-del-proyecto)
4. [Configuración del Entorno](#configuración-del-entorno)
5. [Ejecución de la Aplicación](#ejecución-de-la-aplicación)
6. [Estructura del Proyecto](#estructura-del-proyecto)
7. [Flujo de la Aplicación](#flujo-de-la-aplicación)
8. [Decisiones Técnicas](#decisiones-técnicas)
9. [Autenticación y Seguridad](#autenticación-y-seguridad)
10. [Testing y Cobertura](#testing-y-cobertura)
11. [Buenas Prácticas Aplicadas](#buenas-prácticas-aplicadas)

---

## 📖 Descripción General

Esta aplicación permite:

- Registro y autenticación de usuarios
- Acceso protegido a la sección de cócteles
- Gestión de datos mediante Eloquent ORM
- Visualización global de información compartida (ej. contador de cócteles)
- Ejecución de pruebas automatizadas con alta cobertura

El objetivo principal es demostrar **capacidad técnica, estructura de proyecto, testing robusto y toma de decisiones fundamentadas**, más que solo funcionalidad.

---

## 🧰 Stack Tecnológico

- **PHP 8.2+**
- **Laravel 10**
- **Laravel Breeze** (autenticación)
- **Blade** (renderizado de vistas)
- **MySQL / SQLite** (según entorno)
- **PHPUnit** (testing)
- **Xdebug / PCOV** (code coverage)

---

## ⚙️ Instalación del Proyecto

### 1️⃣ Clonar el repositorio

```bash
git clone <repositorio>
cd cocktail-app
### 2️⃣ Instalar dependencias PHP

```bash
composer install
```

### 3️⃣ Crear archivo de entorno

```bash
cp .env.example .env
```

### 4️⃣ Generar clave de aplicación

```bash
php artisan key:generate
```

## 🛠️ Configuración del Entorno

Configura la base de datos en el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cocktails
DB_USERNAME=root
DB_PASSWORD=
```

Para **testing** se recomienda **SQLite en memoria**:

```env
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

## ▶️ Ejecución de la Aplicación

### Migraciones

```bash
php artisan migrate
```

### Servidor de desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en:

```
http://127.0.0.1:8000
```

## 🗂️ Estructura del Proyecto

```text
app/
 ├── Http/
 │   ├── Controllers/
 │   └── Middleware/
 ├── Models/
 │   └── Cocktail.php
 ├── Providers/
 │   ├── AppServiceProvider.php
 │   └── RouteServiceProvider.php

routes/
 ├── web.php
 └── auth.php

resources/
 ├── views/
 │   ├── cocktails/
 │   └── auth/

tests/
 ├── Feature/
 │   ├── Auth/
 │   │   ├── AuthenticationTest.php
 │   │   └── RegistrationTest.php
 │   └── CocktailTest.php
 └── Unit/
```

## 🔄 Flujo de la Aplicación

- Registro, autenticación y acceso a cócteles protegidos por middleware `auth`.
- Redirecciones centralizadas mediante `RouteServiceProvider::HOME`.
- Datos globales compartidos con View Composer.

## 🧠 Decisiones Técnicas

- Laravel Breeze para autenticación ligera y testeable.
- Uso de Providers para centralizar configuración.
- RefreshDatabase para aislamiento total en tests.

## 🧪 Testing y Cobertura

```bash
php artisan test
php artisan test --coverage
```

Requiere Xdebug o PCOV.

## 👨‍💻 Autor

Brian Rincon  
Desarrollador Web / Ingeniero Mecatrónico
