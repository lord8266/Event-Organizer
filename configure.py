
conf  = {
	"name": "event_organizer",
	"db": "event_organizer",
	"tables":"conf/tables.sql",
	"restart": "sudo service apache2 restart;sudo service mysql restart",
	"hosts": "conf/event_organizer.conf",
    "copy":"sudo cp $1 /etc/apache2/sites-available/",
	"enable":"sudo a2dissite 000-default.conf;sudo a2ensite $1",
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
    s = "\n".join(conf['hosts'])
    s = s.replace("$1",os.path.join(os.getcwd(),conf['dir']) ).replace("$2",os.path.join(os.getcwd(),"logs"))
    os.makedirs("logs",exist_ok=True)
    open(f"{conf['name']}.conf",'w').write(s)

    # Temporary Will change soon
    dbconfig = conf["dbconfig"].format(username=user.username.password=user.password,db=conf["db"])
    open(os.path.join(conf['dir'],'server/dbconfig.php'),'w').write(php_config)

def write_hosts(conf):
    os.makedirs("logs",exist_ok=True)
    host_file = conf["host"].format(cwd=os.getcwd())
    open(f'{conf["name"]}.conf',"w").write(host_file)

def delete_tables(cursor):
    cursor.execute('show tables;')
    while 1:
        r = cursor.fetchone()
        if not r:
            break
        else:
            print("DROP TABLE",r[0])
            cursor.execute(f"DROP TABLE {r[0]}")

def create_tables(p,conf):
    username = p.username
    password =p.password
    conn = pymysql.connect('localhost',username,password,conf['db'])
    c = conn.cursor()
    delete_tables(c)

    for cmd in conf['tables']:
        c.execute(cmd)
    
    os.popen(conf['copy'].replace("$1",os.path.join(os.getcwd(),f"{conf['name']}.conf" ) ))
    os.popen(conf['enable'].replace("$1",f"{conf['name']}.conf" ) )
    os.popen(conf['restart'])


parser = argparse.ArgumentParser(description="useful thing")

parser.add_argument("-u", "--username", help="Your Username")
parser.add_argument("-p", "--password", help="Your Password")
parser.add_argument('--create', action='store_const', const=create, dest='cmd',default=create)
parser.add_argument('--update', action='store_const', const=create, dest='cmd',default=create)
p=parser.parse_args(sys.argv[1:])
p.cmd(p,config)
