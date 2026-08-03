#!/bin/bash
# ============================================================
#  SuiteCRM UNL – Init SQL Script
#  Importa el dump principal de SuiteCRM UNL si la BD está vacía
#  Este script se ejecuta automáticamente al iniciar MySQL por primera vez
# ============================================================

set -e

DUMP_FILE="/docker-entrypoint-initdb.d/suitecrm_dump.sql"
DB_NAME="suitecrm8"

echo "→ [Init] Verificando si la BD '$DB_NAME' necesita datos..."

# Contar tablas existentes
TABLE_COUNT=$(mysql -u root -proot "$DB_NAME" -e "SHOW TABLES;" 2>/dev/null | wc -l || echo "0")

if [ "$TABLE_COUNT" -lt "10" ]; then
    if [ -f "$DUMP_FILE" ]; then
        echo "→ [Init] Importando dump principal: $DUMP_FILE"
        mysql -u root -proot "$DB_NAME" < "$DUMP_FILE"
        echo "✓ [Init] Dump importado correctamente"
    else
        echo "⚠  [Init] No se encontró el dump en: $DUMP_FILE"
        echo "   Asegúrate de que suitecrm_dump.sql esté en el directorio docker/init/"
    fi
else
    echo "✓ [Init] BD '$DB_NAME' ya contiene $TABLE_COUNT tablas – saltando importación"
fi
