#!/usr/bin/python

#
# Gets latitude & longitude for an address
#

import geopy

from geopy.geocoders import GoogleV3
geolocator = GoogleV3()

address, (latitude, longitude) = geolocator.geocode("475 BEAVERS ROAD ,  NORTHCOTE   3070")

print address
print latitude
print longitude

