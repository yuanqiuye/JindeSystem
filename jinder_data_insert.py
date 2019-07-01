#!/usr/bin/python
# -*- coding: UTF-8 -*-
import csv
import MySQLdb

db = MySQLdb.connect("localhost", "root", "", "TESTDB")

cursor = db.cursor()

with open("123.csv") as csvfile:
	rows = csv.reader(csvfile)
	for row in rows:
		if row[0].isdigit():
			sql = "INSERT INTO EMPLOYEE (data,number) VALUES ('"+row[0]+"-"+row[5]+"' , '"+row[2]+"')"
			print(row[0]+" "+row[5]+" "+row[2])
			try:
				cursor.execute(sql)
				db.commit()
			except:
				db.rollback()
db.close()

a=input("press enter to exit......")
