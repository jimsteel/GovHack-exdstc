sql:
	python convert_csv_sql.py CSV/VBA-DataVic-Building-Permits-2009.csv > VBA.sql
	python convert_csv_sql.py CSV/VBA-DataVic-Building-Permits-2012.csv >> VBA.sql
	python convert_csv_sql.py CSV/VBA-DataVic-Building-Permits-2010.csv >> VBA.sql
	python convert_csv_sql.py CSV/VBA-DataVic-Building-Permits-2013.csv >> VBA.sql
	python convert_csv_sql.py CSV/VBA-DataVic-Building-Permits-2011.csv >> VBA.sql
	python convert_csv_sql.py CSV/VBA-DataVic-Building-Permits-2014-January-to-April.csv >> VBA.sql

sqlite:
	sqlite3 VBA.db < init_sqlite.sql
	sqlite3 VBA.db < VBA.sql

mysql:
	mysql -uroot -pexdstc vba < init_mysql.sql
	mysql -uroot -pexdstc vba < VBA.sql

clean:
	rm VBA.db
