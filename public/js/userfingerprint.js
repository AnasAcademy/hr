// Create a new script element
var script = document.createElement("script");
script.src ="//cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@2/dist/fingerprint2.min.js";

// Append the script tag to the document's head
document.head.appendChild(script);

function getFingerPrint(callback) {
    Fingerprint2.get(function (components) {
        var values = components.map(function (component) {
            return component.value;
        });
        var fingerprintValue = Fingerprint2.x64hash128(values.join(""), 31);
        callback(fingerprintValue);
    });
}
