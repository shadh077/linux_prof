Управление пакетами и распостранение софта.

Управление пакетами на примере nginx+openssl:
- установил требуемые пакеты sudo yum install -y redhat-lsb-core wget rpmdevtools rpm-build createrepo yum-utils gcc
- создал пользователя sudo useradd builder -m, переключился на него
- скачал нужные пакеты:
    wget https://nginx.org/packages/mainline/centos/7/SRPMS/nginx-1.25.4-1.el7.ngx.src.rpm
    wget https://github.com/openssl/openssl/releases/download/openssl-3.2.1/openssl-3.2.1.tar.gz
- создал структуру каталогов rpmdev-setuptree
- "распаковал" пакет и исходный код в подготовленную директорию rpm -Uvh nginx-1.25.4-1.el7.ngx.src.rpm && tar -xzvf openssl-3.2.1.tar.gz
- включил поддержку openssl изменив vi rpmbuild/SPECS/nginx.spec добавив параметр --with-openssl=/home/build/openssl-3.2.1
- установил зависимости пакета yum-builddep rpmbuild/SPECS/nginx.spec
- запустил сборку пакета rpmbuild -bb rpmbuild/SPECS/nginx.spec
- установил собраный пакет командой sudo yum localinstall -y rpmbuild/RPMS/x86_64/nginx-1.25.4-1.el7.ngx.x86_64.rpm 


Распостранение софта:
Используем установленный ранее nginx
- создал каталог mkdir /usr/share/nginx/html/repo
- скопировал в созданый каталог собраный пакет cp rpmbuild/RPMS/x86_64/nginx-1.25.4-1.el7.ngx.x86_64.rpm /usr/share/nginx/html/repo/
  туда же добавил пакет mc-4.8.7-11
- инициализировал репозиторий createrepo /usr/share/nginx/html/repo/
- настроил листинг файлов в nginx добавив параметр autoindex on; в файл конфигурации /etc/nginx/conf.d/default.conf и перезапустил
- создал файл конфигццрации репозитория /etc/yum.repos.d/otus.repo с содержимым
  [otus]
  name=otus-linux
  baseurl=http://localhost/repo
  gpgcheck=0
  enabled=1
- установил пакет mc из локального репозитория командой sudo yum --disablerepo=* --enablerepo=otus -y install mc 