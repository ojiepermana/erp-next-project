#!/bin/bash

# Stop all containers
docker compose down

# Backup current folder (excluding backup file itself)
tar --exclude='./ojie-erp-next.gzip' -czvf ojie-erp-next.gzip .

echo "Backup selesai: ojie-erp-next.gzip"

# Upload to Google Cloud Storage
gsutil cp ojie-erp-next.gzip gs://work-storages/project/

rm ojie-erp-next.gzip

docker compose up -d

echo "Backup berhasil di-upload ke Google Cloud Storage: gs://work-storages/project/ojie-erp-next.gzip"