jQuery(document).ready(function(i){var o=null;function p(){o&&o.modal("show"),i(".cd-popup").removeClass("is-visible")}i(".cd-popup-trigger").on("click",function(e){e.preventDefault(),i(".cd-popup.cd-popup-login").addClass("is-visible"),0<i(".modal:visible").length&&(o=i(".modal:visible")).modal("hide")}),i(".cd-popup").on("click",function(e){(i(e.target).is(".cd-popup-close")||i(e.target).is(".cd-popup"))&&(e.preventDefault(),p())}),i(document).keyup(function(e){"27"==e.which&&p()})});