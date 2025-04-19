#!/usr/bin/env bash
#
# create_views.sh
# Script para crear la estructura de carpetas y archivos Blade de Huellitas Unidas

set -e

# Carpeta base de vistas
BASE="resources/views"

# Layouts y componentes globales
mkdir -p "$BASE"/layouts
touch "$BASE"/layouts/app.blade.php
touch "$BASE"/layouts/admin.blade.php

mkdir -p "$BASE"/components
touch "$BASE"/components/alert.blade.php
touch "$BASE"/components/modal.blade.php
touch "$BASE"/components/pagination.blade.php

# Vistas públicas (guest)
mkdir -p "$BASE"/home
touch "$BASE"/home/index.blade.php

mkdir -p "$BASE"/animals
touch "$BASE"/animals/index.blade.php
touch "$BASE"/animals/show.blade.php

mkdir -p "$BASE"/auth
touch "$BASE"/auth/login.blade.php
touch "$BASE"/auth/register.blade.php

mkdir -p "$BASE"/errors
touch "$BASE"/errors/404.blade.php
touch "$BASE"/errors/500.blade.php

# Área de usuario autenticado
mkdir -p "$BASE"/profile
touch "$BASE"/profile/show.blade.php
touch "$BASE"/profile/edit.blade.php
touch "$BASE"/profile/password.blade.php

mkdir -p "$BASE"/animals/manage/partials
touch "$BASE"/animals/manage/index.blade.php
touch "$BASE"/animals/manage/create.blade.php
touch "$BASE"/animals/manage/edit.blade.php
touch "$BASE"/animals/manage/partials/_form.blade.php

mkdir -p "$BASE"/adoptions
touch "$BASE"/adoptions/index.blade.php
touch "$BASE"/adoptions/show.blade.php
touch "$BASE"/adoptions/evaluate.blade.php

mkdir -p "$BASE"/conversations
touch "$BASE"/conversations/index.blade.php
touch "$BASE"/conversations/show.blade.php

mkdir -p "$BASE"/ratings
touch "$BASE"/ratings/create.blade.php

mkdir -p "$BASE"/donations
touch "$BASE"/donations/create.blade.php
touch "$BASE"/donations/thanks.blade.php

mkdir -p "$BASE"/sponsors
touch "$BASE"/sponsors/index.blade.php
touch "$BASE"/sponsors/create.blade.php

mkdir -p "$BASE"/reports
touch "$BASE"/reports/create.blade.php
touch "$BASE"/reports/thanks.blade.php

# Panel Admin / Moderador
mkdir -p "$BASE"/admin
touch "$BASE"/admin/dashboard.blade.php

mkdir -p "$BASE"/admin/animals
touch "$BASE"/admin/animals/index.blade.php
touch "$BASE"/admin/animals/show.blade.php

mkdir -p "$BASE"/admin/users
touch "$BASE"/admin/users/index.blade.php
touch "$BASE"/admin/users/show.blade.php

mkdir -p "$BASE"/admin/reports
touch "$BASE"/admin/reports/index.blade.php
touch "$BASE"/admin/reports/show.blade.php

mkdir -p "$BASE"/admin/donations
touch "$BASE"/admin/donations/index.blade.php
touch "$BASE"/admin/donations/show.blade.php

# Vistas adicionales de ayuda y contenido
mkdir -p "$BASE"/help
touch "$BASE"/help/guide.blade.php
touch "$BASE"/help/faq.blade.php

mkdir -p "$BASE"/policy
touch "$BASE"/policy/privacy.blade.php
touch "$BASE"/policy/terms.blade.php

echo "✅ Estructura de carpetas y archivos Blade creada con éxito."

