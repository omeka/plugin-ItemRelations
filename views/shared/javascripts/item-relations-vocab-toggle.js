jQuery(document).ready(function () {
  var $ = jQuery;

  $(".relVocabHead").each(function(element) {
    var curVocab = $(this).data("vocab");
    var rowClass = "relVocab_"+curVocab;
    var rowCount = $("."+rowClass).size();
    $("th", this).append(
      " <a href='#' class='relVocabShowHideBtn' data-vocab='"+curVocab+"'>"+
      "["+relVocabShowHide +" ("+rowCount+")]"+
      "</a>"
    );
    // $("."+rowClass).toggle();
  });

  $(".relVocabShowHideBtn").click(function(e) {
    e.preventDefault();
    var curVocab = $(this).data("vocab");
    var rowClass = "relVocab_"+curVocab;
    $("."+rowClass).toggle();
  });

  var allShowHide = false;
  $(".relVocabRow").hide();

  var colspan = $(".relVocabHead th").first().attr('colSpan');
  $("#relVocabTable tbody").prepend(
    "<tr><th colspan='"+colspan+"'>"+
    "<a href='#' id='relVocabShowHideAllBtn'>["+relVocabShowHideAll+"]</a>"+
    "</th></tr>"
  );

  $("#relVocabShowHideAllBtn").click(function(e){
    e.preventDefault();
    allShowHide = !allShowHide;
    if (allShowHide) { $(".relVocabRow").show() } else { $(".relVocabRow").hide(); }
  });

});
