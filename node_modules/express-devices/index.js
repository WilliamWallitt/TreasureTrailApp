function createMiddleware () {
	return function detectDevices (req, res, next) {
		var userAgent = (req.headers['user-agent'] || '').toLowerCase();
		req.device = detectDevice(userAgent);
		req['is_' + req.device] = true;
		next();
	}

	function detectDevice (userAgent) {
		switch (true) {
			case userAgent.indexOf('iphone')  !== -1: return 'iphone';
			case userAgent.indexOf('ipod')    !== -1: return 'ipod';
			case userAgent.indexOf('ipad')    !== -1: return 'ipad';
			case userAgent.indexOf('android') !== -1: return 'android';
			default:                                  return 'desktop';
		}
	}
}

module.exports = createMiddleware;
