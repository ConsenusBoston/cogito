window.addEventListener('leverJobsRendered', function () {
  jQuery(".lever-job").clone().appendTo("#new-list ul");

  var options = {
    valueNames: [
      'lever-job-title',
      { data: ['location'] },
      { data: ['department'] },
    ]
  };

  var jobList = new List('new-list', options);

  var locations = [];
  var departments = [];

  for (var i = 0; i < jobList.items.length; i++) {
    var item = jobList.items[i]._values;
    var location = item.location;
    if (jQuery.inArray(location, locations) == -1) {
      locations.push(location);
    }
    var department = item.department;
    if (jQuery.inArray(department, departments) == -1) {
      departments.push(department);
    }
  }

  locations.sort();
  departments.sort();
  for (var j = 0; j < locations.length; j++) {
    jQuery("#lever-jobs-filter .lever-jobs-filter-locations").append('<option>' + locations[j] + '</option>');
  }
  for (var j = 0; j < departments.length; j++) {
    jQuery("#lever-jobs-filter .lever-jobs-filter-departments").append('<option class=department>' + departments[j] + '</option>');
  }
  jQuery(".lever-jobs-filter-locations").select2({
    width: 'auto',
    placeholder: "View by Location",
    minimumResultsForSearch: Infinity
  });
  jQuery(".lever-jobs-filter-locations").hide();
  
  jQuery(".lever-jobs-filter-departments").select2({
    width: 'auto',
    placeholder: "View by Department",
    minimumResultsForSearch: Infinity
  });

  function showFilterResults() {
    jQuery('#new-list .list').show();
    jQuery('#lever-jobs-container').hide();
  }
  function hideFilterResults() {
    jQuery('#new-list .list').hide();
    jQuery('#lever-jobs-container').show();
  }

  hideFilterResults();

  jQuery('#lever-jobs-filter select').change(function () {

    var selectedFilters = {
      location: jQuery('#lever-jobs-filter select.lever-jobs-filter-locations').val(),
      department: jQuery('#lever-jobs-filter select.lever-jobs-filter-departments').val(),
    }

    //Filter the list
    jobList.filter(function (item) {
      var itemValue = item.values();
      for (var filterProperty in selectedFilters) {
        var selectedFilterValue = selectedFilters[filterProperty];
        if (selectedFilterValue !== null) {
          if (itemValue[filterProperty] !== selectedFilterValue) {
            return false;
          }
        }
      }
      return true;
    });

    if (jobList.visibleItems.length >= 1) {
      jQuery('#lever-no-results').hide();
    }
    else {
      jQuery('#lever-no-results').show();
    }
    jQuery('#lever-clear-filters').show();
    showFilterResults();

  });


  jQuery('.careers--open-jobs').on('click', '#lever-clear-filters', function () {
    jobList.filter();
    if (jobList.filtered == false) {
      hideFilterResults();
    }
    jQuery('#lever-jobs-filter select').prop('selectedIndex', 0);
    jQuery(".lever-jobs-filter-departments").val("").trigger('change');
    jQuery(".lever-jobs-filter-locations").val("").trigger('change');
    jQuery('#lever-no-results').hide();
    jQuery('#lever-clear-filters').hide();
    hideFilterResults();
  });

  setTimeout(function () {
    var anchor = window.location.hash;
    if (window.location.hash) {
      var element = jQuery(anchor);
      var verticalPositionOfElement = element.offset().top;
      jQuery(window).scrollTop(verticalPositionOfElement - 150);
    }
  }, 10);
})