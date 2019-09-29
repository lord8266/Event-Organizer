
import argparse
import sys
import pymysql
import os
import subprocess
import json

if os.geteuid() != 0: #check root
    subprocess.call(['sudo', 'python3', *sys.argv])
    sys.exit()

def update_conf(p,data):
    s = "\n".join(data['hosts'])
    s = s.replace("$1",os.getcwd() ).replace("$2",os.path.join(os.getcwd(),"logs"))
    os.makedirs("logs",exist_ok=True)
    open(f"{data['name']}.conf",'w').write(s)

    # Temporary Will change soon
    php_config = f"""<?php
    $db_host = 'localhost';
    $db_name = '{data["db"]}';
    $db_username = '{p.username}';
    $db_password = '{p.password}';
    ?>"""
    open('server/dbconfig.php','w').write(php_config)




def delete_all_tables(cursor):
    cursor.execute('show tables;')
    while 1:
        r = cursor.fetchone()
        if not r:
            break
        else:
            print("DROP TABLE",r[0])
            cursor.execute(f"DROP TABLE {r[0]}")
    
def create(p,data):
    username = p.username
    password =p.password
    conn = pymysql.connect('localhost',username,password,data['db'])
    c = conn.cursor()
    delete_all_tables(c)

    for t,cmd in data['tables'].items():
        print(f"CREATE TABLE {t}")
        c.execute(cmd)
    update_conf(p,data)
    os.popen(data['copy'].replace("$1",os.path.join(os.getcwd(),f"{data['name']}.conf" ) ))
    os.popen(data['enable'].replace("$1",f"{data['name']}.conf" ) )
    os.popen(data['restart'])

data = json.loads(open("config.json").read())
parser = argparse.ArgumentParser(description="useful thing")
parser.add_argument("-u", "--username", help="Your Username")
parser.add_argument("-p", "--password", help="Your Password")
parser.add_argument('-c','--create', action='store_const', const=create, dest='cmd',default=create)
p=parser.parse_args(sys.argv[1:])
p.cmd(p,data)
