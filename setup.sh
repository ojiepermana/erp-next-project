# Grafana Permissions
sudo chown -R 472:472 ./data/app/grafana
sudo chmod -R 755 ./data/app/grafana

# Traefik Permissions
chmod 600 ./configuration/traefik/acme.json

# N8N
sudo chown -R 1000:1000 ./data/app/n8n
# sudo chmod -R 755 ./data/app/n8n
sudo chmod 600 ./data/app/n8n/config

docker compose restart