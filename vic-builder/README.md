Query 5 most expensive car parks:
  select Allotment_Area,Site_street,Site_suburb from vba WHERE Allotment_Area != 0 AND Building_classification_1 LIKE "%7A%" ORDER BY Reported_Cost_of_works DESC LIMIT 5;

Query 5 most expensive developments:
  select Allotment_Area,Site_street,Site_suburb from vba ORDER BY Reported_Cost_of_works DESC LIMIT 5;



Converting the data (XLS -> CSV)
--------------------------------

[Building activity Excel files](https://www.data.vic.gov.au/tag/Building+Activity)

Convert to CSV:

* Install XQuartz (http://xquartz.macosforge.org/)
* Install Gnumeric (brew install gnumeric)

% ssconvert file.xls file.csv


Geocoding
---------

>>> import geopy
>>> from geopy.geocoders import GoogleV3
>>> geolocator = GoogleV3()
>>> address, (latitude, longitude) = geolocator.geocode("475 BEAVERS ROAD ,  NORTHCOTE   3070")
>>> print address
Beavers Road, Northcote VIC 3070, Australia
>>> print latitude
-37.7659143
>>> print longitude
144.9917278


CherryPy
--------

% sudo apt-get install python-setuptools
% sudo easy_install cherrypy

mod_python
----------

% apt-get install libapache2-mod-python

% sudo vi /etc/apache2/sites-available/000-default.conf
Added:
               AddHandler mod_python .py
                PythonHandler mod_python.publisher
                PythonDebug On


#!/usr/bin/python

def index(req):
  return "Test successful";



