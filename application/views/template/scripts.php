<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- Vendor js -->
<script src="<?=base_url('assets/admin/js/vendor.min.js')?>"></script>

<!-- third party js -->
<script src="<?=base_url()?>assets/admin/libs/autocomplete/jquery.autocomplete.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/autonumeric/autoNumeric-min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/bootstrap-table/bootstrap-table.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/c3/c3.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/chart-js/Chart.bundle.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/chartist/chartist.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/chartist/chartist-plugin-tooltip.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/cropper/cropper.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/custombox/custombox.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/d3/d3.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/dropify/dropify.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/dropzone/dropzone.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/flatpickr/flatpickr.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/footable/footable.all.min.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/fullcalendar/fullcalendar.min.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/gmaps/gmaps.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/hopscotch/hopscotch.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/ion-rangeslider/ion.rangeSlider.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/jquery-countdown/jquery.countdown.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/jquery-mapael/jquery.mapael.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/jquery-mockjax/jquery.mockjax.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/jquery-nice-select/jquery.nice-select.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/jquery-scrollto/jquery.scrollTo.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/jquery-tabledit/jquery.tabledit.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/jquery-toast/jquery.toast.min.js"></script>
<script src="<?=base_url("assets/admin/libs/jquery-ui/jquery-ui.min.js")?>"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/jquery-vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/jsgrid/jsgrid.min.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/justgage/justgage.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/katex/katex.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/ladda/ladda.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/ladda/spin.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/moment/moment.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/morris-js/morris.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/multiselect/jquery.multi-select.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/dataTables.bootstrap4.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/buttons.bootstrap4.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/datatables/buttons.html5.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/datatables/buttons.flash.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/datatables/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/dataTables.keyTable.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/datatables/dataTables.select.min.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/pdfmake/pdfmake.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/pdfmake/vfs_fonts.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/flot-charts/jquery.flot.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/flot-charts/jquery.flot.time.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/flot-charts/jquery.flot.selection.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/flot-charts/jquery.flot.crosshair.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/nestable2/jquery.nestable.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/parsleyjs/parsley.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/pdfmake/pdfmake.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/peity/jquery.peity.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/quill/quill.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/raphael/raphael.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/rickshaw/rickshaw.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/rwd-table/rwd-table.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/select2/select2.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/summernote/summernote-bs4.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/sweetalert2/sweetalert2.min.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/switchery/switchery.min.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/tablesaw/tablesaw.js"></script>-->
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/tippy-js/tippy.all.min.js"></script>
<script src="<?/*=base_url()*/?>assets/admin/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>-->
<script src="<?=base_url()?>assets/admin/libs/x-editable/bootstrap-editable.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/izitoast/iziToast.min.js"></script>
<script src="<?=base_url()?>assets/admin/libs/typeahead/typeahead.jquery.js"></script>
<!--<script src="<?/*=base_url()*/?>assets/admin/libs/typeahead/bloodhound.min.js"></script>-->
<!-- third party js ends -->
<script>
    var base_url = "<?php echo base_url() ?>";
</script>
<!-- Datatables init -->
<script src="<?=base_url()?>assets/admin/js/page.js"></script>

<!-- App js -->
<script src="<?=base_url()?>assets/admin/js/app.min.js"></script>

<!-- Extra js -->
<?php if(isset($js)):?>
    <?php foreach ($js as $extra => $url): ?>
        <?php if(isset($url)):?>
            <script src="<?=base_url("assets/admin/$url");?>"></script>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
