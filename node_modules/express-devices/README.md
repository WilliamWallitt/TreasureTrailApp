## express-devices

Know your user device.

## Installation

```
npm install express-devices
```

## Usage

```js
var devices = require('express-devices');
var app = require('express')();

app.use(devices());


app.get('/', function (req, res) {

	req.is_iphone  // true | false
	req.is_ipad    // true | false
	req.is_pod     // true | false
	req.is_android // true | false
	req.device     // 'iphone' | 'ipad' | 'ipod' | 'android'

});

```

## LICENSE
MIT
