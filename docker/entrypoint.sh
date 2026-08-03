#!/bin/bash
# ============================================================
#  SuiteCRM UNL – Entrypoint Docker
#  1. Espera a que MySQL esté disponible
#  2. Parchea config.php con la conexión al MySQL de Docker
#  3. Lanza Apache
# ============================================================

set -e

echo "=========================================="
echo "  SuiteCRM UNL – Iniciando contenedor"
echo "=========================================="

DB_HOST="${SUITECRM_DB_HOST:-mysql}"
DB_PORT="${SUITECRM_DB_PORT:-3306}"
DB_NAME="${SUITECRM_DB_NAME:-suitecrm8}"
DB_USER="${SUITECRM_DB_USER:-root}"
DB_PASS="${SUITECRM_DB_PASS:-root}"

CONFIG_FILE="/var/www/html/public/legacy/config.php"

# ----------------------------------------------------------
# 1. Esperar a que MySQL esté disponible
# ----------------------------------------------------------
echo "→ Esperando a MySQL en $DB_HOST:$DB_PORT..."
MAX_WAIT=120
WAITED=0
until mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" -p"$DB_PASS" --silent 2>/dev/null; do
    if [ $WAITED -ge $MAX_WAIT ]; then
        echo "✗ MySQL no respondió después de ${MAX_WAIT}s. Abortando."
        exit 1
    fi
    sleep 2
    WAITED=$((WAITED + 2))
done
echo "✓ MySQL disponible"

# ----------------------------------------------------------
# 2. Actualizar config.php con los datos de conexión Docker
# ----------------------------------------------------------
if [ -f "$CONFIG_FILE" ]; then
    echo "→ Actualizando config.php con conexión Docker..."

    # Reemplazar host de BD
    sed -i "s/'db_host_name' => '.*'/'db_host_name' => '$DB_HOST'/g" "$CONFIG_FILE"
    sed -i "s/'db_port' => '.*'/'db_port' => '$DB_PORT'/g" "$CONFIG_FILE"
    sed -i "s/'db_user_name' => '.*'/'db_user_name' => '$DB_USER'/g" "$CONFIG_FILE"
    sed -i "s/'db_password' => '.*'/'db_password' => '$DB_PASS'/g" "$CONFIG_FILE"
    sed -i "s/'db_name' => '.*'/'db_name' => '$DB_NAME'/g" "$CONFIG_FILE"

    echo "✓ config.php actualizado"
else
    echo "⚠  config.php no encontrado – SuiteCRM puede requerir instalación inicial"
fi

# ----------------------------------------------------------
# 3. Asegurar permisos correctos en directorios escribibles
# ----------------------------------------------------------
echo "→ Verificando permisos..."
chmod -R 775 \
    /var/www/html/public/legacy/cache \
    /var/www/html/public/legacy/custom \
    /var/www/html/public/legacy/upload \
    /var/www/html/logs \
    /var/www/html/tmp 2>/dev/null || true
chown -R www-data:www-data /var/www/html 2>/dev/null || true
echo "✓ Permisos OK"

# ----------------------------------------------------------
# 4. Iniciar Apache en foreground
# ----------------------------------------------------------
echo ""
echo "=========================================="
echo "  ✓ SuiteCRM UNL listo"
echo "  → Accede en: http://localhost:8080"
echo "=========================================="
exec apache2-foreground
