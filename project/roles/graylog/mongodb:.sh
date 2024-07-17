mongodb:
curl -fsSL https://pgp.mongodb.com/server-6.0.asc | sudo gpg -o /usr/share/keyrings/mongodb-server-6.0.gpg --dearmor

echo "deb [ arch=amd64,arm64 signed-by=/usr/share/keyrings/mongodb-server-6.0.gpg ] https://repo.mongodb.org/apt/ubuntu jammy/mongodb-org/6.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-6.0.list

apt-get update
apt-get install -y mongodb-org

systemctl daemon-reload
systemctl enable mongod.service
systemctl restart mongod.service

opensearch:
curl -o- https://artifacts.opensearch.org/publickeys/opensearch.pgp | sudo gpg --dearmor --batch --yes -o /usr/share/keyrings/opensearch-keyring
echo "deb [signed-by=/usr/share/keyrings/opensearch-keyring] https://artifacts.opensearch.org/releases/bundle/opensearch/2.x/apt stable main" | sudo tee /etc/apt/sources.list.d/opensearch-2.x.list
apt-get update

OPENSEARCH_INITIAL_ADMIN_PASSWORD=$(tr -dc A-Z-a-z-0-9_@#%^-_=+ < /dev/random  | head -c${1:-32}) 
export OPENSEARCH_INITIAL_ADMIN_PASSWORD=$5%Pqw4Linux
apt-get install opensearch=2.14.0

конфиг sudo nano /etc/opensearch/opensearch.yml

systemctl daemon-reload
systemctl enable opensearch.service
systemctl restart opensearch.service

graylog:
wget https://packages.graylog2.org/repo/packages/graylog-5.2-repository_latest.deb
dpkg -i graylog-5.2-repository_latest.deb
apt-get update && sudo apt-get install graylog-server 

sudo nano /etc/graylog/server/server.conf

Ae3p50OKYBOaWeruW5nUuWGdZrwltSYmNFej0VikraC00mP0rfvuvYrMXkcMl7s1zB9El5dfbOhZXoIP7m3gYqbtphfskpDY

11223ec84874e114bdadfb11b12098980c2bfc160abb7f621a338b71237f047d

systemctl enable graylog-server.service
systemctl start graylog-server.service
systemctl --type=service --state=active | grep graylog
