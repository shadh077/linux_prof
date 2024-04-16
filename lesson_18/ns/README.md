Не получалось добавить запись в зону, из-за того, что сервис named и конфигурационные файлы на диске относились к разным контекстам безопасности.

На сервере, при помощи утилиты audit2why посмотрели причину отказа, командой cat /var/log/audit/audit.log | audit2why
```
type=AVC msg=audit(1713194594.384:1914): avc:  denied  { create } for  pid=5143 comm="isc-worker0000" name="named.ddns.lab.view1.jnl" scontext=system_u:system_r:named_t:s0 tcontext=system_u:object_r:etc_t:s0 tclass=file permissive=0
```
Вместо типа named_t используется тип etc_t.

Командой sudo semanage fcontext -l | grep named посмотрели правильный контекст, к которому должны относится файлы, это named_zone_t
Установили правильный контекст для файлов sudo chcon -R -t named_zone_t /etc/named

После стало возможным обновление зоны, в которую добавили запись www.ddns.lab. 60 A 192.168.50.15 и проверили при помощи dig (см. скриншот)
