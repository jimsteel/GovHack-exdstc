#!/usr/bin/python

#
#  Converts Building Activity CSV to SQL.
#
#  Usage:
#    % python convert.py CSV/VBA-DataVic-Building-Permits-2014-January-to-April.csv
#

import csv
import sys
import time

permit_stage_number=0
permit_date=1
Levy_return_year=2
Levy_return_month=3
Reported_Levy_amount=4
Calculated_Levy_amount=5
Reported_Cost_of_works=6
Calculated_Cost_of_works=7
Owner_sector=8
Owner_Builder_Flag=9
Site_street=10
Site_suburb=11
site_pcode=12
Allotment_Area=13
site_municipality=14
Municipal_Full_Name=15
Region=16
Sub_Region=17
Sub_Region1=18
Builder_suburb=19
Builder_state=20
Builder_pcode=21
Building_classification_1=22
Material_Code_Floor=23
Material_Code_Frame=24
Material_Code_Roof=25
Material_Code_Walls=26
dwellings_before_work=27
dwellings_after_work=28
Number_of_storeys=29
number_demolished=30
Floor_area=31
Nature_of_work=32
Multiple_Dwellings=33
cost_of_works_domestic=34
Permit_app_date=35
BACV_applicable_flag=36
Calculated_levy_BACV=37
solar_hot_water=38
rainwater_tank=39
est_cost_project=40
BASIS_Region=41
BASIS_SubRegion=42
BASIS_SubRegion1=43
BASIS_NOW=44
BASIS_BCA=45
BASIS_OwnershipSector=46
BASIS_OwnerBuilder=47

with open(sys.argv[1], 'rb') as csvfile:
	reader = csv.reader(csvfile, delimiter=',', quotechar='"')
	for row in reader:

		# Skip the first line (headers)
		if row[0] == "permit_stage_number":
			continue

		d = time.strptime(row[permit_date], "%d/%m/%Y")
		row[permit_date] = time.strftime("%Y-%m-%d", d)

		try:
			d = time.strptime(row[Permit_app_date], "%d/%m/%Y")
			row[Permit_app_date] = time.strftime("%Y-%m-%d", d)
		except:
			row[Permit_app_date] = "NULL"

		for i in xrange(0, len(row)):

			if i == Nature_of_work or i == Building_classification_1:
				row[i] = '"%s"' % (row[i])

			if any(c.isalpha() for c in row[i]):

				# Put quotes around strings
				if row[i].startswith('"') == False:
					if i != Site_street:
						row[i] = '"%s"' % (row[i])

			else:

				# Strip commas from numbers
				row[i] = row[i].replace(",", "")

				# Strip spaces
				row[i] = row[i].replace(" ", "")

			# Empty values
			if row[i] == "":
				row[i] = "NULL"

		row[Site_street] = '"%s"' % (row[Site_street])

		#print "%s %s %s %s, %s, %s" % (parsed_permit_date, parsed_permit_app_date, row[Allotment_Area], row[Site_street], row[Site_suburb], row[site_pcode])

		values = ", ".join(row)
		print "INSERT INTO vba VALUES (%s);" % (values)

