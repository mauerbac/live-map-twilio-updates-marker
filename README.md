#Live Map

This app uses [Twilio SMS](http://twilio.com/) to send location codes, which updates a Google map. The locations codes correspond to a longitude and latitude. The map will drop a marker on this location.<br>

[Check it out!](http://mattsauerbach.com/livemap/) - My working example...with Demo!

## Usage
In this example, Project Cookie updates their selling locations throughout Northwestern's Campus.

![Example](http://mattsauerbach.com/livemap/img/img1.png)

## Installation

Step-by-step on how to deploy, configure and develop this app.

### Create Credentials

1) Create [Twilio](http://twilio.com/) account or use existing. Buy a new phone number. 

2) Create a Google Maps Developer Key from your [Google Oauth Dashboard](https://code.google.com/apis/console).

### Setup MySQL Database

1) Create new MySQL Database

2) Use table.sql for setup 

###Configuration 

1) Enter credentials in constants.php

2) Add Google API Developer Key to map.php (Line 53) 

```html
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=xxxxxAPI KEY HERExxxxx&sensor=false">
```