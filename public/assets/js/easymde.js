$(function () {
  'use strict';

  if ($("#seoDescriptionEditor").length) {
    var seoEditor = new EasyMDE({
      element: $("#seoDescriptionEditor")[0]
    });
  }

  if ($("#descriptionEditor").length) {
    var descriptionEditor = new EasyMDE({
      element: $("#descriptionEditor")[0]
    });
  }


  if ($("#blogShortDescriptionEditor").length) {
    var descriptionEditor = new EasyMDE({
      element: $("#blogShortDescriptionEditor")[0]
    });
  }

  if ($("#contentEditor").length) {
    var descriptionEditor = new EasyMDE({
      element: $("#contentEditor")[0]
    });
  }


  if ($("#seoBlogdescriptionEditor").length) {
    var descriptionEditor = new EasyMDE({
      element: $("#seoBlogdescriptionEditor")[0]
    });
  }





});