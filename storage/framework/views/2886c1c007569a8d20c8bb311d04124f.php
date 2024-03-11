<button id="deviceIndentifierBtn">Get My device Identifier</button>
<p id="deviceIndentifier"></p>

<script src="<?php echo e(asset('js/userfingerprint.js')); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('deviceIndentifierBtn').onclick = function(event) {
            getFingerPrint(function(fingerprintValue) {
                deviceIndentifier.innerHTML = fingerprintValue;
            });
        }
    });
</script>
<?php /**PATH C:\Users\User\OneDrive - اكاديمية انس للفنون البصرية\Desktop\hr\resources\views/restrict_ip/userAdd.blade.php ENDPATH**/ ?>