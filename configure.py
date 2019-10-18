
conf  = {
	"name": "event_organizer",
	"db": "event_organizer",
	"tables":"conf/tables.sql",
	"restart": "sudo service apache2 restart;sudo service mysql restart",
	"hosts": "conf/event_organizer.conf",
    "copy":"sudo cp {hosts_file} /etc/apache2/sites-available/",
	"enable":"sudo a2dissite 000-default.conf;sudo a2ensite {hosts_file}",
	"dir":"www",
    "dbconfig":"conf/dbconfig.php"
}

import argparse
import sys
import pymysql
import os
import subprocess
import json

if os.geteuid() != 0: #check root
    subprocess.call(['sudo', 'python3', *sys.argv])
    sys.exit()

def write_dbconfig(user,conf):
    dbconfig = conf["dbconfig"].format(username=user.username,password=user.password,db=conf["db"])
    open(os.path.join(conf['dir'],'server/dbconfig.php'),'w').write(dbconfig)

def write_hosts(conf):
    os.makedirs("logs",exist_ok=True)
    host_file = conf["hosts"].format(cwd=os.getcwd())
    open(f'event_organizer.conf',"w").write(host_file)

def delete_tables(cursor):
    cursor.execute('show tables;')
    for cmd in cursor.fetchall():
        print("DROP TABLE",cmd[0])
        cursor.execute(f"DROP TABLE {cmd[0]}")

def create_tables(p,conf):
    username = p.username
    password =p.password
    conn = pymysql.connect('localhost',username,password,conf['db'])
    c = conn.cursor()
    delete_tables(c)

    for cmd in conf['tables'].split('\n'):
        c.execute(cmd)

def new_install(p,conf):
    create_tables(p,conf)
    write_dbconfig(p,conf)
    write_hosts(conf)
    os.popen(conf['copy'].format(hosts_file="event_organizer.conf" ) )
    os.popen(conf['enable'].format(hosts_file="event_organizer.conf" ) )
    os.popen(conf['restart'])

parser = argparse.ArgumentParser(description="useful thing")
parser.add_argument("-u", "--username", help="Your Username")
parser.add_argument("-p", "--password", help="Your Password")
parser.add_argument('--create', action='store_const', const=new_install, dest='cmd',default=new_install)
parser.add_argument('--update', action='store_const', const=new_install, dest='cmd',default=new_install)
p=parser.parse_args(sys.argv[1:])

conf["hosts"] = open(conf["hosts"]).read()
conf["tables"] = open(conf["tables"]).read()
conf["dbconfig"] = open(conf["dbconfig"]).read()
p.cmd(p,conf)