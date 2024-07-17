MySQL Server

This role is useful to install MySQL Server. It helps also: 1. secure the root account with password 2. remove test databases 3. add one or more databases 4. create users in the database 5. configure the databases for master-slave replication 6. install new mysql engines
Requirements

This role requires Ansible 1.4 or higher.
Role Variables

The variables that can be passed to this role and a brief description about them are as follows:

  # The port for mysql server to listen
  mysql_port: 3306

  # The bind address for mysql server
  mysql_bind_address: "0.0.0.0"

  # The root DB password
  mysql_root_db_pass: secret

  # A list that has all the databases to be
  # created and their replication status:
  mysql_db:
       - name: example_db1
         replicate: yes
       - name: example_db2
         replicate: no

  # A list of the mysql users to be created
  # and their password and privileges:
  mysql_users:
       - name: user1
         pass: verystrong
         priv: "*.*:ALL"

  # If the database is replicated the users
  # to be used for replication:
  mysql_repl_user:
    - name: repl
      pass: verystrong

  # The role of this server in replication:
  mysql_repl_role: master

  # A unique id for the mysql server (used in replication):
  mysql_db_id: 7

  # If you want to install new engine set this variables:
  # for RedHat-like systems
  mysql_extra_packages_rh:
    - engine_package_name
  # for Debian-like systems
  mysql_extra_packages_deb:
    - engine_package_name
  mysql_add_engine: true
  mysql_engines:
    - name: example_engine
      soname: example_engine.so
      service: example_engine_service

Examples

1) Install MySQL Server and set the root password, but don’t create any database or users.

  - hosts: all
    roles:
    - { role: mysql, mysql_root_db_pass: secret, mysql_db: none, mysql_users: none }

2) Install MySQL Server and create 2 databases and 2 users.

  - hosts: all
    roles:
     - { role: mysql,
               mysql_db: [{ name: example_db1 },
                          { name: example_db2 }],
               mysql_users: [{ name: user1, pass: verystrong, priv: "*.*:ALL" },
                             { name: user2, pass: verystrongtoo }] }

Note: If users are specified and password/privileges are not specified, then default values are set.

3) Install MySQL Server and create 2 databases and 2 users and configure the database as replication master with one database configured for replication.

  - hosts: all
    roles:
     - { role: mysql,
               mysql_db: [{ name: example_db1, replicate: yes },
                          { name: example_db2, replicate: no }],
               mysql_users: [{ name: user1, pass: verystrong, priv: "*.*:ALL" },
                             { name: user2, pass: verystrongtoo }],
               mysql_repl_user: [{ name: repl, pass: verystrong }] }

4) A fully installed/configured MySQL Server with master and slave replication.

  - hosts: master
    roles:
     - { role: mysql,
               mysql_db: [{ name: example_db1 },
                          { name: example_db1 }],
               mysql_users: [{ name: user1, pass: verystrong, priv: "*.*:ALL" },
                             { name: user2, pass: verystrongtoo }],
               mysql_db_id: 8 }

  - hosts: slave
    roles:
     - { role: mysql,
               mysql_db: none,
               mysql_users: none,
               mysql_repl_role: slave,
               mysql_repl_master: master_host,
               mysql_db_id: 9,
               mysql_repl_user: [{ name: repl, pass: verystrong }] }

5) Add new engine to MySQL Server

  - hosts: all
    roles:
     - { role: mysql,
               mysql_add_engine: true,
               mysql_engines: [{ name: example_engine, soname: example_engine.so, service: example_engine_service }] }

Note: When configuring the full replication please make sure the master is configured via this role and the master is available in inventory and facts have been gathered for master. The replication tasks assume the database is new and has no data.