<button id="deviceIndentifierBtn">Get My device Identifier</button>
<p id="deviceIndentifier"></p>

<script src="{{ asset('js/userfingerprint.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('deviceIndentifierBtn').onclick = function(event) {
            getFingerPrint(function(fingerprintValue) {
                deviceIndentifier.innerHTML = fingerprintValue;
            });
        }
    });
</script>
