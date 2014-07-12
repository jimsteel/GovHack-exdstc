



Converting the data (XLS -> CSV)
--------------------------------

[Building activity Excel files](https://www.data.vic.gov.au/tag/Building+Activity)

Convert to CSV:

* Install XQuartz (http://xquartz.macosforge.org/)
* Install Gnumeric (brew install gnumeric)

ssconvert file.xls file.csv


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

