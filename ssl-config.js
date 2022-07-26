var path = require('path');
var fs = require('fs');


exports.crtSSL = fs.readFileSync(path.join(__dirname, './ssl/ssl.crt'), 'utf8').toString();
exports.keySSL = fs.readFileSync(path.join(__dirname, './ssl/ssl.key'), 'utf8').toString();