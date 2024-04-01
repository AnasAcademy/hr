<button id="deviceIdentifierBtn">Get My device Identifier</button>
<p id="deviceIdentifier"></p>

<script src="{{ asset('js/userfingerprint.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('deviceIdentifierBtn').onclick = function(event) {
            getFingerPrint(function(fingerprintValue) {
                deviceIdentifier.innerHTML = fingerprintValue;
            });
        }
    });
</script>
