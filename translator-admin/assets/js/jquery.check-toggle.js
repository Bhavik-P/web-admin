jQuery(document).ready(function() {
  $('#tags').tagsInput({
    width: 'auto'
  });
  $('.toggle').toggles({easing:'linear',animate:500});
  $('#timepicker').timepicker({
    defaultTIme: false
  });
  $('#timepicker2').timepicker({
    showMeridian: false
  });
  $('#timepicker3').timepicker({
    minuteStep: 15
  });

  $('#datepicker').datepicker();
  $('#datepicker-inline').datepicker();
  $('#datepicker-multiple').datepicker({
    numberOfMonths: 3,
    showButtonPanel: true
  });
  $('.colorpicker-default').colorpicker({ format: 'hex' });
  $('.colorpicker-rgba').colorpicker();
  $('#my_multi_select1').multiSelect();
  $('#my_multi_select2').multiSelect({
    selectableOptgroup: true
  });

  $('#my_multi_select3').multiSelect({
    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
    afterInit: function(ms) {
      var that = this,
        $selectableSearch = that.$selectableUl.prev(),
        $selectionSearch = that.$selectionUl.prev(),
        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

      that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
        .on('keydown', function(e) {
          if (e.which === 40) {
            that.$selectableUl.focus();
            return false;
          }
        });

      that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e) {
          if (e.which == 40) {
            that.$selectionUl.focus();
            return false;
          }
        });
    },
    afterSelect: function() {
      this.qs1.cache();
      this.qs2.cache();
    },
    afterDeselect: function() {
      this.qs1.cache();
      this.qs2.cache();
    }
  });
  $('#spinner1').spinner();
  $('#spinner2').spinner({
    disabled: true
  });
  $('#spinner3').spinner({
    value: 0,
    min: 0,
    max: 10
  });
  $('#spinner4').spinner({
    value: 0,
    step: 5,
    min: 0,
    max: 200
  });
  $(".select2").select2({
    width: '100%'
  });
});