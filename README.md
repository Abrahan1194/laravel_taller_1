# 🏢 Sistema de Gestión con Autenticación y Auditoría

Sistema web enterprise desarrollado en **Laravel 12** con **Materialize CSS** que incluye gestión de usuarios, productos, autenticación segura y auditoría completa de acciones.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Materialize](https://img.shields.io/badge/Materialize-1.0-ee6e73?style=for-the-badge&logo=material-design&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

---

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Requisitos](#-requisitos)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso](#-uso)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Roles y Permisos](#-roles-y-permisos)
- [Capturas de Pantalla](#-capturas-de-pantalla)
- [API de Auditoría](#-api-de-auditoría)
- [Contribuir](#-contribuir)
- [Licencia](#-licencia)

---

## ✨ Características

### 🔐 Autenticación
- Login seguro con validación de credenciales
- Control de sesiones con "Recordar sesión"
- Bloqueo de usuarios inactivos
- Logout seguro con invalidación de sesión

### 👥 Gestión de Usuarios
- CRUD completo de usuarios
- Asignación de roles (Super Admin, Gestor, Consulta)
- Activación/Desactivación de cuentas
- Protección contra auto-eliminación

### 📦 Gestión de Productos
- CRUD completo de productos
- Subida y gestión de imágenes
- Validación de formatos (JPG, PNG, GIF, WebP)
- Vista en tarjetas con diseño moderno

### 📋 Sistema de Auditoría
- Registro automático de todas las acciones (crear, editar, eliminar)
- Almacena valores anteriores y nuevos (JSON)
- Filtros por módulo, acción y rango de fechas
- Registro de IP y usuario responsable
- Acceso exclusivo para Super Administradores

### 🎨 Interfaz Moderna
- Diseño responsive con Materialize CSS
- Tipografía Inter (Google Fonts)
- Animaciones suaves y transiciones
- Sidebar con navegación categorizada
- Dashboard con estadísticas en tiempo real

---

## 📌 Requisitos

- **PHP** >= 8.2
- **Composer** >= 2.0
- **MySQL** >= 8.0 o **SQLite**
- **Node.js** >= 18 (opcional, para assets)
- **Git**

---

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/Jrestrepo18/sistema_gestion_laravel.git
cd sistema_gestion_laravel
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos

Editar el archivo `.env` con los datos de conexión:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_gestion
DB_USERNAME=root
DB_PASSWORD=tu_password
```

**Para SQLite (desarrollo rápido):**
```env
DB_CONNECTION=sqlite
# Comentar las demás variables DB_*
```

### 5. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

### 6. Crear enlace simbólico para storage

```bash
php artisan storage:link
```

### 7. Iniciar el servidor

```bash
php artisan serve
```

Acceder a: **http://localhost:8000**

---

## ⚙️ Configuración

### Variables de Entorno Importantes

| Variable | Descripción | Valor por defecto |
|----------|-------------|-------------------|
| `APP_NAME` | Nombre de la aplicación | Sistema de Gestión |
| `APP_ENV` | Entorno (local/production) | local |
| `APP_DEBUG` | Modo debug | true |
| `DB_CONNECTION` | Driver de base de datos | mysql |
| `SESSION_DRIVER` | Driver de sesiones | database |

---

## 🔑 Uso

### Credenciales por Defecto

| Rol | Email | Contraseña |
|-----|-------|------------|
| **Super Administrador** | jerorrpo@gmail.com | jero0312 |
| **Gestor de Inventario** | gestor@sistema.com | jero0312 |
| **Usuario Consulta** | jerorrpo11@gmail.com | jero0312 |

### Acciones por Módulo

| Módulo | Super Admin | Gestor | Consulta |
|--------|:-----------:|:------:|:--------:|
| Dashboard | ✅ | ✅ | ✅ |
| Ver productos | ✅ | ✅ | ✅ |
| Crear/Editar/Eliminar productos | ✅ | ✅ | ❌ |
| Gestión de usuarios | ✅ | ❌ | ❌ |
| Ver auditoría | ✅ | ❌ | ❌ |

---

## 📂 Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php        # Autenticación
│   │   ├── DashboardController.php   # Panel principal
│   │   ├── UserController.php        # CRUD Usuarios
│   │   ├── ProductController.php     # CRUD Productos
│   │   └── AuditController.php       # Historial de auditoría
│   └── Middleware/
│       ├── AdminMiddleware.php       # Protección Super Admin
│       └── EditorMiddleware.php      # Protección Gestor+
├── Models/
│   ├── User.php                      # Modelo de usuario
│   ├── Product.php                   # Modelo de producto
│   └── AuditLog.php                  # Modelo de auditoría
└── Traits/
    └── Auditable.php                 # Trait para logging automático

database/
├── migrations/                       # Migraciones de BD
└── seeders/
    └── AdminSeeder.php               # Usuarios iniciales

resources/views/
├── layouts/
│   └── app.blade.php                 # Layout principal
├── auth/
│   └── login.blade.php               # Página de login
├── dashboard.blade.php               # Dashboard
├── users/                            # Vistas de usuarios
├── products/                         # Vistas de productos
└── audit/
    └── index.blade.php               # Historial de auditoría

routes/
└── web.php                           # Rutas de la aplicación
```

---

## 👥 Roles y Permisos

### Super Administrador / Auditor
- ✅ Acceso completo al sistema
- ✅ Gestionar usuarios (crear, editar, desactivar)
- ✅ Asignar y cambiar roles
- ✅ Ver historial de auditoría completo
- ✅ CRUD completo de productos

### Gestor de Inventario (Editor)
- ✅ Crear, editar y eliminar productos
- ✅ Subir y actualizar imágenes
- ❌ No puede gestionar usuarios
- ❌ No puede ver auditoría

### Usuario Consulta (Viewer)
- ✅ Ver listado de productos
- ✅ Ver detalles de productos
- ❌ No puede crear ni editar
- ❌ No puede acceder a administración

---

## 📸 Capturas de Pantalla

### Login
Página de inicio de sesión con diseño moderno y fondo animado.

### Dashboard
Panel principal con tarjetas de estadísticas, actividad reciente y acciones rápidas.

### Gestión de Productos
Vista en tarjetas con imágenes, precios y acciones.

### Gestión de Usuarios
Tabla de usuarios con roles, estados y acciones.

### Historial de Auditoría
Registro completo de acciones con filtros y detalles.

---

## 📋 API de Auditoría

El sistema registra automáticamente las siguientes acciones:

| Acción | Descripción | Datos Almacenados |
|--------|-------------|-------------------|
| `create` | Creación de registro | Valores nuevos |
| `update` | Actualización | Valores anteriores y nuevos |
| `delete` | Eliminación | Valores eliminados |

### Campos del Registro

```json
{
  "user_id": 1,
  "action": "update",
  "module": "products",
  "record_id": 5,
  "old_values": {"name": "Antiguo", "price": 100},
  "new_values": {"name": "Nuevo", "price": 150},
  "ip_address": "192.168.1.1",
  "created_at": "2026-01-09 17:00:00"
}
```

---

## 🛠️ Comandos Útiles

```bash
# Limpiar caché
php artisan optimize:clear

# Regenerar autoload
composer dump-autoload

# Ver rutas
php artisan route:list

# Crear nuevo usuario admin
php artisan tinker
>>> User::create(['name'=>'Admin', 'email'=>'admin@test.com', 'password'=>bcrypt('password'), 'role'=>'super_admin', 'is_active'=>true])

# Resetear base de datos
php artisan migrate:fresh --seed
```

---

## 🤝 Contribuir

1. Fork el repositorio
2. Crear rama feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit cambios (`git commit -m 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear Pull Request

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

---

## 👨‍💻 Autor

Desarrollado con ❤️ por **Jeronimo Cardona Restrepo**

---

## 🙏 Agradecimientos

- [Laravel](https://laravel.com) - Framework PHP
- [Materialize CSS](https://materializecss.com) - Framework CSS
- [Inter Font](https://rsms.me/inter/) - Tipografía
- [Material Icons](https://fonts.google.com/icons) - Iconografía
