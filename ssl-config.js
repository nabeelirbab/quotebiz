var path = require('path');
var fs = require('fs');


exports.crtSSL = fs.readFileSync(path.join(__dirname, '../../../../etc/letsencrypt/live/quotebiz.io/cert.pem'), 'utf8').toString();
exports.keySSL = fs.readFileSync(path.join(__dirname, '../../../../etc/letsencrypt/live/quotebiz.io/privkey.pem'), 'utf8').toString();