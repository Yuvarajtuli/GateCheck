<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="<?php echo $uiURL; ?>assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="<?php echo $uiURL; ?>bootstrap/js/popper.min.js"></script>
<script src="<?php echo $uiURL; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $uiURL; ?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo $uiURL; ?>assets/js/app.js"></script>
<script>
$(document).ready(function() {
    App.init();
});
</script>
<script src="<?php echo $uiURL; ?>plugins/highlight/highlight.pack.js"></script>
<script src="<?php echo $uiURL; ?>assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="<?php echo $uiURL; ?>assets/js/scrollspyNav.js"></script>
<script src="<?php echo $uiURL; ?>plugins/select2/select2.min.js"></script>
<script src="<?php echo $uiURL; ?>plugins/select2/custom-select2.js"></script>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="<?php echo $basicURL; ?>js/functions/alert.js"></script>
<script src="<?php echo $basicURL; ?>js/functions/urlPathFetch.js"></script>
<script src="<?php echo $basicURL; ?>js/functions/apicall.js"></script>
<script src="	https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="<?php echo $basicURL; ?>js/generalCustom.js"></script>
<script src="<?php echo $basicURL; ?>js/mainFormCustom.js"></script>
<script src="<?php echo $uiURL; ?>plugins/file-upload/file-upload-with-preview.min.js"></script>
<?php include_once '../../includes/js/a_parts/sweetAlertsJs.php'; ?>
    <script>
        let urlProtocall = getURLProtocall();
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        //Second upload
        var secondUpload = new FileUploadWithPreview('mySecondImage')
    </script>