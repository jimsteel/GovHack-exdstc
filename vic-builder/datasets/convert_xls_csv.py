#!/usr/bin/python

#
#  Converts CSV to SQL.
#
#  Usage:
#    % python convert.py CSV/VBA-DataVic-Building-Permits-2014-January-to-April.csv
#

import csv

STREET=10
SUBURB=11
POSTCODE=12
ALLOTMENT=13

FILE=sys.argv[0]

with open(FILE, 'rb') as csvfile:
	reader = csv.reader(csvfile, delimiter=',', quotechar='"')
	for row in reader:
		print row[ALLOTMENT],row[STREET],", ",row[SUBURB]," ",row[POSTCODE]

