<button id="deviceIdentifierBtn">Get My device Identifier</button>
<p id="deviceIdentifier"></p>

<script src="<?php echo e(asset('js/userfingerprint.js')); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('deviceIdentifierBtn').onclick = function(event) {
            getFingerPrint(function(fingerprintValue) {
                deviceIdentifier.innerHTML = fingerprintValue;
            });
        }
    });
</script>
<?php /**PATH C:\Users\User\OneDrive - اكاديمية انس للفنون البصرية\Desktop\hr\resources\views/restrict_ip/userAdd.blade.php ENDPATH**/ ?>