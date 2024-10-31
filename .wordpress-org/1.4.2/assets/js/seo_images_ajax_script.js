var _countImages = 0;
var _pagesImages = 1;
var _currentPage = 1;

jQuery(document).ready( function($){
  setTimeout(function(){
    $("#content-tmce").click();
  },1);

  function isGutenbergActive() {
    return document.body.classList.contains( 'block-editor-page' );
  }

  // Scrape headings
  $(window).on('load', function() {

    // // console.log('page load finished..');

    if( isGutenbergActive() ){
      jQuery('.hide_if_guten').hide();
      jQuery('#full').trigger('click');
      jQuery('#full').parent().prepend('<small>Full size only just for Gutenberg</small><br />')
      if( jQuery('.block-library-classic__toolbar').length > 0 ){
        jQuery('.notice-info-gutenberg').show();
      }
    }
    
    setTimeout(function(){ 
      // // console.log('Fire after 2 second..');
      // get iframe object

      if( isGutenbergActive() ) {
        var frame = jQuery('.block-editor-writing-flow')[0];
      } else {
        var frame = document.getElementById('content_ifr').contentWindow.document;
      }
      
      var h1_tags = frame.getElementsByTagName('h1');
      var h2_tags = frame.getElementsByTagName('h2');
      var h3_tags = frame.getElementsByTagName('h3');
      var h4_tags = frame.getElementsByTagName('h4');
      var h5_tags = frame.getElementsByTagName('h5');
      var h6_tags = frame.getElementsByTagName('h6');
      
      // for H1 tag
      if(!ckEmpty(h1_tags)) {
        var h1_count = h1_tags.length;
        var h1TextString = '';
        var h1IdString = '';
        
        // set unique id first 
        for (var l = 0; l < h1_tags.length; l++) {
          var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
          // // // console.log('randId =',randId);
          h1_tags[l].setAttribute("id", randId);
        }

        for (var i = 0; i < h1_tags.length; i++) {
          
          if( i == h1_tags.length - 1) {
            h1TextString = h1TextString + h1_tags[i].innerHTML; 
            h1IdString = h1IdString + h1_tags[i].id; 
          } else {
            h1TextString = h1TextString + h1_tags[i].innerHTML + ' | '; 
            h1IdString = h1IdString + h1_tags[i].id + ' | ';   
          }
        }
        // // // console.log('h1TextString: ',h1TextString);
        if(!ckEmpty(h1_count) && !ckEmpty(h1TextString)) {
          $('#h1_title').attr("data-h1count",h1_count);
          $('#h1_title').attr("data-h1id",h1IdString);
          $('#h1_title').val(h1TextString);
        }
      }
      // for H2 tag
      if(!ckEmpty(h2_tags)) {
        var h2_count = h2_tags.length;
        var h2TextString = '';
        var h2IdString = '';
        
        // set unique id first 
        for (var l = 0; l < h2_tags.length; l++) {
          var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
          // // // console.log('randId =',randId);
          h2_tags[l].setAttribute("id", randId);
        }
        
        for (var i = 0; i < h2_tags.length; i++) {
          if( i == h2_tags.length - 1) {
            h2TextString = h2TextString + h2_tags[i].innerHTML; 
            h2IdString = h2IdString + h2_tags[i].id; 
          } else {
            h2TextString = h2TextString + h2_tags[i].innerHTML + ' | '; 
            h2IdString = h2IdString + h2_tags[i].id + ' | ';  
          }
        }
        // // // console.log('h2TextString: ',h2TextString);
        if(!ckEmpty(h2_count) && !ckEmpty(h2TextString)) {
          $('#h2_title').attr("data-h2count",h2_count);
          $('#h2_title').attr("data-h2id",h2IdString);
          $('#h2_title').val(h2TextString);
        }
      }
      // for H3 tag
      if(!ckEmpty(h3_tags)) {
        var h3_count = h3_tags.length;
        var h3TextString = '';
        var h3IdString = '';
        
        // set unique id first 
        for (var l = 0; l < h3_tags.length; l++) {
          var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
          // // // console.log('randId =',randId);
          h3_tags[l].setAttribute("id", randId);
        }
        
        for (var i = 0; i < h3_tags.length; i++) {
          if( i == h3_tags.length - 1) {
            h3TextString = h3TextString + h3_tags[i].innerHTML;
            h3IdString = h3IdString + h3_tags[i].id;  
          } else {
            h3TextString = h3TextString + h3_tags[i].innerHTML + ' | '; 
            h3IdString = h3IdString + h3_tags[i].id + ' | ';   
          }
        }
        // // // console.log('h3TextString: ',h3TextString);
        if(!ckEmpty(h3_count) && !ckEmpty(h3TextString)) {
          $('#h3_title').attr("data-h3count",h3_count);
          $('#h3_title').attr("data-h3id",h3IdString);
          $('#h3_title').val(h3TextString);
        }
      }
      // for H4 tag
      if(!ckEmpty(h4_tags)) {
        var h4_count = h4_tags.length;
        var h4TextString = '';
        var h4IdString = '';
        
        // set unique id first 
        for (var l = 0; l < h4_tags.length; l++) {
          var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
          // // // console.log('randId =',randId);
          h4_tags[l].setAttribute("id", randId);
        }
        
        for (var i = 0; i < h4_tags.length; i++) {
          if( i == h4_tags.length - 1) {
            h4TextString = h4TextString + h4_tags[i].innerHTML; 
            h4IdString = h4IdString + h4_tags[i].id; 
          } else {
            h4TextString = h4TextString + h4_tags[i].innerHTML + ' | '; 
            h4IdString = h4IdString + h4_tags[i].id + ' | ';   
          }
        }
        // // // console.log('h4TextString: ',h4TextString);
        if(!ckEmpty(h4_count) && !ckEmpty(h4TextString)) {
          $('#h4_title').attr("data-h4count",h4_count);
          $('#h4_title').attr("data-h4id",h4IdString);
          $('#h4_title').val(h4TextString);
        }
      }
      // for H5 tag
      if(!ckEmpty(h5_tags)) {
        var h5_count = h5_tags.length;
        var h5TextString = '';
        var h5IdString = '';
        
        // set unique id first 
        for (var l = 0; l < h5_tags.length; l++) {
          var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
          // // // console.log('randId =',randId);
          h5_tags[l].setAttribute("id", randId);
        }
        
        for (var i = 0; i < h5_tags.length; i++) {
          if( i == h5_tags.length - 1) {
            h5TextString = h5TextString + h5_tags[i].innerHTML; 
            h5IdString = h5IdString + h5_tags[i].id; 
          } else {
            h5TextString = h5TextString + h5_tags[i].innerHTML + ' | ';
            h5IdString = h5IdString + h5_tags[i].id + ' | ';    
          }
        }
        // // // console.log('h5TextString: ',h5TextString);
        if(!ckEmpty(h5_count) && !ckEmpty(h5TextString)) {
          $('#h5_title').attr("data-h5count",h5_count);
          $('#h5_title').attr("data-h5id",h5IdString);
          $('#h5_title').val(h5TextString);
        }
      }
      // for H6 tag
      if(!ckEmpty(h6_tags)) {
        var h6_count = h6_tags.length;
        var h6TextString = '';
        var h6IdString = '';
        
        // set unique id first 
        for (var l = 0; l < h6_tags.length; l++) {
          var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
          // // // console.log('randId =',randId);
          h6_tags[l].setAttribute("id", randId);
        }
        
        for (var i = 0; i < h6_tags.length; i++) {
          if( i == h6_tags.length - 1) {
            h6TextString = h6TextString + h6_tags[i].innerHTML;
            h6IdString = h6IdString + h6_tags[i].id; 
          } else {
            h6TextString = h6TextString + h6_tags[i].innerHTML + ' | ';
            h6IdString = h6IdString + h6_tags[i].id + ' | ';    
          }
        }
        // // // console.log('h6TextString: ',h6TextString);
        if(!ckEmpty(h6_count) && !ckEmpty(h6TextString)) {
          $('#h6_title').attr("data-h6count",h6_count);
          $('#h6_title').attr("data-h6id",h6IdString);
          $('#h6_title').val(h6TextString);
        }
      } 
    }, 2000);
  });

  // Save post type 
  $("#savePostTypeFrm").submit(function(event){

    event.preventDefault();
    var formData = $(this).serialize();
    
    // // // console.log('formData >> ', formData);
    
    jQuery.ajax({
      type   : "POST",
      url    : ajax_object.ajaxurl,
      data   : {action: 'addPostTypeFlag', 'form_data': formData},
      beforeSend: function(){
        $(".loaderImageFallback").show();
      },
      success: function(result){
        // // // console.log('result >> ',result);
        location.reload();
        $(".loaderImageFallback").hide();
      },
      error: function(error){
        $(".loaderImageFallback").hide();
      }
    });
  
  });

  function ckEmpty(val) {
    if ( val == "" || val == null ) {
      return true;
    } else {
      return false;
    }
  }

  // Upload Image Media in editor
  $("#add_image_act").click(function(){

    $('.error-txt').remove();
    setTimeout(function(){
      $("#content-tmce").click();
    },1);

    // reset it first
    $("#h1_title").val('');
    $("#h2_title").val('');
    $("#h3_title").val('');
    $("#h4_title").val('');
    $("#h5_title").val('');
    $("#h6_title").val('');

    $("#h1_title").attr('data-h1id','');
    $("#h2_title").attr('data-h2id','');
    $("#h3_title").attr('data-h3id','');
    $("#h4_title").attr('data-h4id','');
    $("#h5_title").attr('data-h5id','');
    $("#h6_title").attr('data-h6id','');

    $('#h1_title').attr("data-h1count","");
    $('#h2_title').attr("data-h2count","");
    $('#h3_title').attr("data-h3count","");
    $('#h4_title').attr("data-h4count","");
    $('#h5_title').attr("data-h5count","");
    $('#h6_title').attr("data-h6count","");

    /*###############################################################
                              CODE SNIPPET
    ############################################################## */

    // get iframe object
    if( isGutenbergActive() ) {
      var frame = jQuery('.block-editor-writing-flow')[0];
    } else {
      var frame = document.getElementById('content_ifr').contentWindow.document;
    }
    
    var h1_tags = frame.getElementsByTagName('h1');
    var h2_tags = frame.getElementsByTagName('h2');
    var h3_tags = frame.getElementsByTagName('h3');
    var h4_tags = frame.getElementsByTagName('h4');
    var h5_tags = frame.getElementsByTagName('h5');
    var h6_tags = frame.getElementsByTagName('h6');
    
    // for H1 tag
    if(!ckEmpty(h1_tags)) {
      var h1_count = h1_tags.length;
      var h1TextString = '';
      var h1IdString = '';
      
      // set unique id first 
      for (var l = 0; l < h1_tags.length; l++) {
        var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
        // // // console.log('randId =',randId);
        h1_tags[l].setAttribute("id", randId);
      }

      for (var i = 0; i < h1_tags.length; i++) {

        if( i == h1_tags.length - 1) {
          h1TextString = h1TextString + h1_tags[i].innerHTML; 
          h1IdString = h1IdString + h1_tags[i].id; 
        } else {
          h1TextString = h1TextString + h1_tags[i].innerHTML + ' | '; 
          h1IdString = h1IdString + h1_tags[i].id + ' | ';   
        }
      }
      // // // console.log('h1TextString: ',h1TextString);
      if(!ckEmpty(h1_count) && !ckEmpty(h1TextString)) {
        $('#h1_title').attr("data-h1count",h1_count);
        $('#h1_title').attr("data-h1id",h1IdString);
        $('#h1_title').val(h1TextString);
      }
    }
    // for H2 tag
    if(!ckEmpty(h2_tags)) {
      var h2_count = h2_tags.length;
      var h2TextString = '';
      var h2IdString = '';
      
      // set unique id first 
      for (var l = 0; l < h2_tags.length; l++) {
        var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
        // // // console.log('randId =',randId);
        h2_tags[l].setAttribute("id", randId);
      }
      
      for (var i = 0; i < h2_tags.length; i++) {
        if( i == h2_tags.length - 1) {
          h2TextString = h2TextString + h2_tags[i].innerHTML; 
          h2IdString = h2IdString + h2_tags[i].id; 
        } else {
          h2TextString = h2TextString + h2_tags[i].innerHTML + ' | '; 
          h2IdString = h2IdString + h2_tags[i].id + ' | ';  
        }
      }
      // // // console.log('h2TextString: ',h2TextString);
      if(!ckEmpty(h2_count) && !ckEmpty(h2TextString)) {
        $('#h2_title').attr("data-h2count",h2_count);
        $('#h2_title').attr("data-h2id",h2IdString);
        $('#h2_title').val(h2TextString);
      }
    }
    // for H3 tag
    if(!ckEmpty(h3_tags)) {
      var h3_count = h3_tags.length;
      var h3TextString = '';
      var h3IdString = '';
      
      // set unique id first 
      for (var l = 0; l < h3_tags.length; l++) {
        var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
        // // // console.log('randId =',randId);
        h3_tags[l].setAttribute("id", randId);
      }
      
      for (var i = 0; i < h3_tags.length; i++) {
        if( i == h3_tags.length - 1) {
          h3TextString = h3TextString + h3_tags[i].innerHTML;
          h3IdString = h3IdString + h3_tags[i].id;  
        } else {
          h3TextString = h3TextString + h3_tags[i].innerHTML + ' | '; 
          h3IdString = h3IdString + h3_tags[i].id + ' | ';   
        }
      }
      // // // console.log('h3TextString: ',h3TextString);
      if(!ckEmpty(h3_count) && !ckEmpty(h3TextString)) {
        $('#h3_title').attr("data-h3count",h3_count);
        $('#h3_title').attr("data-h3id",h3IdString);
        $('#h3_title').val(h3TextString);
      }
    }
    // for H4 tag
    if(!ckEmpty(h4_tags)) {
      var h4_count = h4_tags.length;
      var h4TextString = '';
      var h4IdString = '';
      
      // set unique id first 
      for (var l = 0; l < h4_tags.length; l++) {
        var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
        // // // console.log('randId =',randId);
        h4_tags[l].setAttribute("id", randId);
      }
      
      for (var i = 0; i < h4_tags.length; i++) {
        if( i == h4_tags.length - 1) {
          h4TextString = h4TextString + h4_tags[i].innerHTML; 
          h4IdString = h4IdString + h4_tags[i].id; 
        } else {
          h4TextString = h4TextString + h4_tags[i].innerHTML + ' | '; 
          h4IdString = h4IdString + h4_tags[i].id + ' | ';   
        }
      }
      // // // console.log('h4TextString: ',h4TextString);
      if(!ckEmpty(h4_count) && !ckEmpty(h4TextString)) {
        $('#h4_title').attr("data-h4count",h4_count);
        $('#h4_title').attr("data-h4id",h4IdString);
        $('#h4_title').val(h4TextString);
      }
    }
    // for H5 tag
    if(!ckEmpty(h5_tags)) {
      var h5_count = h5_tags.length;
      var h5TextString = '';
      var h5IdString = '';
      
      // set unique id first 
      for (var l = 0; l < h5_tags.length; l++) {
        var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
        // // // console.log('randId =',randId);
        h5_tags[l].setAttribute("id", randId);
      }
      
      for (var i = 0; i < h5_tags.length; i++) {
        if( i == h5_tags.length - 1) {
          h5TextString = h5TextString + h5_tags[i].innerHTML; 
          h5IdString = h5IdString + h5_tags[i].id; 
        } else {
          h5TextString = h5TextString + h5_tags[i].innerHTML + ' | ';
          h5IdString = h5IdString + h5_tags[i].id + ' | ';    
        }
      }
      // // // console.log('h5TextString: ',h5TextString);
      if(!ckEmpty(h5_count) && !ckEmpty(h5TextString)) {
        $('#h5_title').attr("data-h5count",h5_count);
        $('#h5_title').attr("data-h5id",h5IdString);
        $('#h5_title').val(h5TextString);
      }
    }
    // for H6 tag
    if(!ckEmpty(h6_tags)) {
      var h6_count = h6_tags.length;
      var h6TextString = '';
      var h6IdString = '';
      
      // set unique id first 
      for (var l = 0; l < h6_tags.length; l++) {
        var randId = 'hd'+'_' + Math.random().toString(36).substr(2, 9);
        // // // console.log('randId =',randId);
        h6_tags[l].setAttribute("id", randId);
      }
      
      for (var i = 0; i < h6_tags.length; i++) {
        if( i == h6_tags.length - 1) {
          h6TextString = h6TextString + h6_tags[i].innerHTML;
          h6IdString = h6IdString + h6_tags[i].id; 
        } else {
          h6TextString = h6TextString + h6_tags[i].innerHTML + ' | ';
          h6IdString = h6IdString + h6_tags[i].id + ' | ';    
        }
      }
      // // // console.log('h6TextString: ',h6TextString);
      if(!ckEmpty(h6_count) && !ckEmpty(h6TextString)) {
        $('#h6_title').attr("data-h6count",h6_count);
        $('#h6_title').attr("data-h6id",h6IdString);
        $('#h6_title').val(h6TextString);
      }
    }
    /*###############################################################
                              CODE SNIPPET
    ############################################################## */
    $("#loader_curtain").show();
    // metabox fields
    var image_quant = $("input[name='image_quant']").val();
    var image_size = $('input[name="image_size"]:checked').val();
    var image_align = $('input[name="image_align"]:checked').val();
    var p_id = $("#p_id").val();
    var source = $('input[name="source"]:checked').val();
    
    // console.log('image_quant = ',image_quant);
    // console.log('image_size = ',image_size);
    // console.log('image_align = ',image_align);
    
    // search keywords
    var article_title = $("#article_title").val();
    var h1_title = $("#h1_title").val();
    var h2_title = $("#h2_title").val();
    var h3_title = $("#h3_title").val();
    var h4_title = $("#h4_title").val();
    var h5_title = $("#h5_title").val();
    var h6_title = $("#h6_title").val();

    // id attributes for headings
    var h1_id = $("#h1_title").attr('data-h1id');
    var h2_id = $("#h2_title").attr('data-h2id');
    var h3_id = $("#h3_title").attr('data-h3id');
    var h4_id = $("#h4_title").attr('data-h4id');
    var h5_id = $("#h5_title").attr('data-h5id');
    var h6_id = $("#h6_title").attr('data-h6id');

    // console.log('article_title = ',article_title);
    // console.log('h1_title = ',h1_title);
    // console.log('h2_title = ',h2_title);
    // console.log('h3_title = ',h3_title);
    // console.log('h4_title = ',h4_title);
    // console.log('h5_title = ',h5_title);
    // console.log('h6_title = ',h6_title);

    // console.log('h1_id = ',h1_id);
    // console.log('h2_id = ',h2_id);
    // console.log('h3_id = ',h3_id);
    // console.log('h4_id = ',h4_id);
    // console.log('h5_id = ',h5_id);
    // console.log('h6_id = ',h6_id);

    // stop for debug..
    // return false;
    
    //if(ckEmpty(article_title) || ckEmpty(image_quant) || ckEmpty(image_size) || ckEmpty(image_align) || ckEmpty(source)) {
    if(ckEmpty(article_title) || ckEmpty(image_size) || ckEmpty(image_align) ) {
      // // // console.log('a11');
      setTimeout(function(){ 
        $(".bug-holder").append('<span class="error-txt">All fields are required</span>');
        $("#loader_curtain").hide(); 
      }, 2000);
    } else {
       // // // console.log('a12');
      $('.error-txt').remove();
      
      var headings = {
        h1_title: h1_title,
        h2_title: h2_title,
        h3_title: h3_title,
        h4_title: h4_title,
        h5_title: h5_title,
        h6_title: h6_title,
      };

      var headings_id = {
        h1_id: h1_id,
        h2_id: h2_id,
        h3_id: h3_id,
        h4_id: h4_id,
        h5_id: h5_id,
        h6_id: h6_id,
      };
      
      if(ckEmpty(h1_title) && ckEmpty(h2_title) && ckEmpty(h3_title) && ckEmpty(h4_title) && ckEmpty(h5_title) && ckEmpty(h6_title)) {
        
        // if headings are not present
        setTimeout(function(){ 
          $("#loader_curtain").hide(); 
          alert('Atleast 1 heading should be present in Wordpress WYSIWYG Editor!');
        }, 2000);
        return false;
      }

      const creative_commons = jQuery('#creative_commons').is(':checked') ? 'creative_commons' : '';
      const show_author = jQuery('#show_author').is(':checked') ? 'show_author' : '';
      let source = jQuery('input[name=source]:checked').val();

      var formData = {
        action: "call_imageApi",
        p_id: p_id,
        article_title: article_title,
        image_quant: image_quant,
        image_size: image_size,
        image_align: image_align,
        headings: headings,
        headings_id: headings_id,
        source: source,
        creative_commons: creative_commons,
        show_author: show_author
      };

      jQuery.ajax({
          type   : "POST",
          url    : ajax_object.ajaxurl,
          data   : formData,
          dataType: 'json',
          context: this,
      }).fail( function( jqXHR, textStatus, errorThrown ){
        console.log( jqXHR, textStatus, errorThrown );
        setTimeout(function(){
          $("#loader_curtain").hide();
        }, 2000);
      }).done( function( data ){
        console.log( data );
        var error = data.error;
        var msg = data.msg;
        var error_msg = data.error_msg;
        var featured = data.featured;

        $("#loader_curtain").hide();
        // if error is true
        if( data.error == "true" ) {
          alert('There was an error, retry please');
        } else if( data.error == "no_credits" ) {
          alert( data.error_msg );
        } else if( data.error == "account_validation_pending") {
          alert( data.error_msg );
          $(".notice-info").hide();
          $(".seo_images-group").hide();
          $(".bug-holder").html( "<p style=\"margin: 12px 0px;\"><span class=\"red-sp\">Error:</span>" + data.error_msg + "</p>");
        } else if( data.error == "false" ) {
          let error_bugs = "";
          if(featured.length > 0) {
            jQuery('#postimagediv .inside').html(featured);
            jQuery('#postimagediv .inside #plupload-upload-ui').hide();
          }

          let featured_html = ``;

          /**
           * Featured image
           */
          const images = data.g_data_images;
          featured_html += `<div class="seo_images_featured_selection_group"><h3>Featured image</h3>`;
          featured_html += `<div class="seo_images_featured_selection_main">`;
          for( let i = 0; i < images.length; i++ ) {
            const src = images[ i ].replaceAll( "'", "\\'" );
            featured_html += `<div class="seo_images_featured_selection_container" data-image="`+ images[ i ] +`" style="background-image: url(`+ src +`)">
                            <div class="seo_images_featured_selection_selected">
                                <span class="dashicons dashicons-yes"></span>
                            </div>
                          </div>`;
          }
          featured_html += `</div>`;
          featured_html += `</div>`;

          /**
           * Body images
           */
          let html = ``;
          for( let i = 0; i < data.heading_val.length; i++ ) {
            const images = data.images_ar[ i ][ 0 ];
            html += `<div class="seo_images_selection_group"><h4>`+ data.heading_val[ i ].replaceAll( "+", " " ) +`</h4>`;
            _countImages += images.length;
            html += `<div class="seo_images_selection_main">`;
            for( let j = 0; j < images.length; j++ ) {
              const src = images[ j ].replaceAll( "'", "\\'" );
              html += `<div class="seo_images_selection_container" data-image="`+ images[ j ] +`" style="background-image: url(`+ src +`)">
                            <div class="seo_images_selection_selected">
                                <span class="dashicons dashicons-yes"></span>
                            </div>
                          </div>`;
            }
            html += `</div>`;
            html += `</div>`;
          }

          //let i = 1;
          if( source == undefined ) {
            if( jQuery('#seo_images_selection_source_1' ).is(':empty') ) {
              source = 'source_1';
            } else if( jQuery('#seo_images_selection_source_2' ).is(':empty') ) {
              source = 'source_2';
            } else if( jQuery('#seo_images_selection_source_3' ).is(':empty') ) {
              source = 'source_3';
            } else if( jQuery('#seo_images_selection_source_4' ).is(':empty') ) {
              source = 'source_4';
            } else {
              source = 'source_5';
            }
          }

          jQuery('#seo_images_selection_source_1').hide();
          jQuery('#seo_images_selection_source_2').hide();
          jQuery('#seo_images_selection_source_3').hide();
          jQuery('#seo_images_selection_source_4').hide();
          jQuery('#seo_images_selection_source_5').hide();
          jQuery("#seo_images_selection_" + source).html( html );
          jQuery("#seo_images_selection_" + source).show();
          jQuery(".seo_images-metabox-cvr").fadeOut();


          const l = jQuery('input[name=source]:not(:disabled)').length;
          html = ( l < 5 ? `<a id="show_more" href="javascript:void(0);" onclick="_seoImagesShowMore();">Show More</a>` : `` );
          html += `<div style="display: flex;justify-content: space-between;clear: both;align-items: center;align-content: center;margin-top: 8px;">
                            <input type="button" id="insert_selected" class="button button-primary" value="Insert Selected" />
                            <!-- <button type="button" id="fetch_more" class="button button-primary" onclick="` + ( l > 1 ? `_seoImagesNextSource()` : `_seoImagesReset()` ) + `">` +  ( l > 1 ? `Fetch More` : `Reset` ) + `</button> -->
                            <button type="button" id="fetch_more" class="button button-primary" onclick="` + ( source != 'source_5' ? `_seoImagesNextSource()` : `_seoImagesReset()` ) + `">` +  ( source != 'source_5' ? `Fetch More` : `Reset` ) + `</button>                            
                            <!-- <button type="button" class="button button-primary" onclick="_seoImagesReset();">Reset</button> -->
                      </div>`;
          jQuery('#seo_images_selection_buttons').html( featured_html + html );
        }
      });
    }
  });

  jQuery('body').on('click', '.seo_images_selection_container', function(){
    jQuery( this ).parent().find('.seo_images_selection_container').removeClass( 'selected' );
    jQuery( this ).parent().find('.seo_images_selection_container').find( '.seo_images_selection_selected' ).hide();
    jQuery( this ).addClass( 'selected' );
    jQuery( this ).find( '.seo_images_selection_selected' ).show();
  });

  jQuery('body').on('click', '.seo_images_featured_selection_container', function(){
    jQuery( this ).parent().find('.seo_images_featured_selection_container').removeClass( 'selected' );
    jQuery( this ).parent().find('.seo_images_featured_selection_container').find( '.seo_images_featured_selection_selected' ).hide();
    jQuery( this ).addClass( 'selected' );
    jQuery( this ).find( '.seo_images_featured_selection_selected' ).show();
  });

  jQuery('body').on('click', '#insert_selected', function(){
    let array = [];

    jQuery('.seo_images_featured_selection_group').each(function(){
      const featured_image = jQuery(this).find('.selected').data('image');
      let article_title = $("#article_title").val();
      let p_id = $("#p_id").val();
      jQuery.ajax({
        type: "POST",
        url: ajax_object.ajaxurl,
        //data: formData,
        data: {
          action: "set_featured_image",
          p_id: p_id,
          featured_image: featured_image,
          article_title: article_title,
        },
        dataType: 'json',
      }).fail(function(a, b, c){
        console.log('Ajax request fails');
        console.log( a );
        console.log( b );
        console.log( c );
      }).done(function( data ){
        console.log( data );
      });

    });

    jQuery('.seo_images_selection_group').each(function(){
      let element = [];
      element.push( jQuery(this).find('h4').text() );
      element.push( jQuery(this).find('.selected').data('image') );
      array.push( element );
    });

    var image_quant = $("input[name='image_quant']").val();
    var image_size = $('input[name="image_size"]:checked').val();
    var image_align = $('input[name="image_align"]:checked').val();
    var p_id = $("#p_id").val();
    const show_author = jQuery('#show_author').is(':checked') ? 'show_author' : '';

    var h1_title = $("#h1_title").val();
    var h2_title = $("#h2_title").val();
    var h3_title = $("#h3_title").val();
    var h4_title = $("#h4_title").val();
    var h5_title = $("#h5_title").val();
    var h6_title = $("#h6_title").val();

    var headings = {
      h1_title: h1_title,
      h2_title: h2_title,
      h3_title: h3_title,
      h4_title: h4_title,
      h5_title: h5_title,
      h6_title: h6_title,
    };

    // id attributes for headings
    var h1_id = $("#h1_title").attr('data-h1id');
    var h2_id = $("#h2_title").attr('data-h2id');
    var h3_id = $("#h3_title").attr('data-h3id');
    var h4_id = $("#h4_title").attr('data-h4id');
    var h5_id = $("#h5_title").attr('data-h5id');
    var h6_id = $("#h6_title").attr('data-h6id');

    var headings_id = {
      h1_id: h1_id,
      h2_id: h2_id,
      h3_id: h3_id,
      h4_id: h4_id,
      h5_id: h5_id,
      h6_id: h6_id,
    };

    $("#loader_curtain").show();
    jQuery.ajax({
      type: "POST",
      url: ajax_object.ajaxurl,
      //data: formData,
      data: {
        action: "insert_selected_imageApi",
        p_id: p_id,
        image_size: image_size,
        image_align: image_align,
        images: array,
        headings: headings,
        headings_id: headings_id,
        show_author: show_author,
      },
      dataType: 'json',
    }).fail(function(a, b, c){
      console.log('Ajax request fails');
      console.log( a );
      console.log( b );
      console.log( c );
    }).done(function( data ){
      console.log( data );
      var error = data.error;
      var msg = data.msg;
      var error_msg = data.error_msg;
      var featured = data.featured;

      let error_bugs = "";

      Object.entries( msg ).forEach(entry => {
        const [key, value] = entry;
        console.log( value );
        var h_id = value['heading_id'];
        var h_img = value['heading_image'];
        var ft_bug = '';
        if( key == 0 ) {
          ft_bug = value['featured_img_bug'];
        }

        if( h_id == '' ) {
          // Sono nella featured
          console.log( 'sono nella featured', value);
          return;
        }

        // if error is true
        if( error == "true" ) {
          $("#loader_curtain").hide();
          //alert(error_msg);
          alert('There was an error, retry please');
        } else if( error == "false" ) {
          $("#loader_curtain").hide();
          if (featured.length > 0) {
            jQuery('#postimagediv .inside').html(featured);
            jQuery('#postimagediv .inside #plupload-upload-ui').hide();
          }

          if(h_img == "no_image") {
            error_bugs += "400 Bad Request: \n";
            error_bugs += "For "+value['heading_title']+": No Response \n";
          } else {
            if( isGutenbergActive() ) {
              // NUOVO
              const rootClientId = jQuery('.block-editor-writing-flow').find("#"+h_id).data('block');
              const blocks = wp.data.select('core/block-editor').getBlocks();
              let i;
              for( i = 0; i < blocks.length; i++ ) {
                //console.log( 'i', i );
                if( blocks[i].clientId == rootClientId ) {
                  console.log('trovato nel blocco ' + i);
                  break;
                }
              }
              var name = 'core/image';

              let sizeSlug = 'thumbnail';
              let sizeWidth = '150';
              let sizeHeight = '150';
              switch( image_size ){
                case '300x300':
                  sizeSlug = 'medium';
                  sizeWidth = '300';
                  sizeHeight = '300';
                  break;
                case '1024x1024':
                  sizeSlug = 'large';
                  sizeWidth = '1024';
                  sizeHeight = '1024';
                  break;
                case 'full':
                  sizeSlug = 'full';
                  sizeWidth = '1024';
                  sizeHeight = '1024';
                  break;
              }
              insertedBlock = wp.blocks.createBlock(name, {
                align: image_align,
                url: h_img.slice(h_img.indexOf("src")).split('"')[1],
                caption: h_img.slice(h_img.indexOf("data-caption")).split('"')[1],
                alt: h_img.slice(h_img.indexOf("alt")).split('"')[1],
                title: h_img.slice(h_img.indexOf("title")).split('"')[1],
                //sizeSlug: sizeSlug,
                //width: sizeWidth,
                //height: sizeHeight
              });
              console.log('La i vale ' + i );
              console.log('insertedBlock: ' + insertedBlock );
              wp.data.dispatch('core/block-editor').insertBlock(insertedBlock, i + 1);

              var updatedAttributes = {
                width: sizeWidth, // Nuova larghezza desiderata in pixel
              };

              wp.data.dispatch('core/block-editor').updateBlockAttributes(insertedBlock, updatedAttributes);
            } else {
              var myHeading = $("#content_ifr").contents().find("#"+h_id);
              myHeading.after(h_img);
              $('#content-html').trigger('click');
              $('#content-tmce').trigger('click');
            }

          }
          if(!ckEmpty(ft_bug) && key == 0){
            error_bugs += "400 Bad Request: \n";
            error_bugs += "For setting featured image: No response \n";
          }

        }
      });
      if(!ckEmpty(error_bugs)){
        //alert(error_bugs);
        alert('There was an error, retry please');
      }

      // Salva bozza
      let _post_content = '';
      if( isGutenbergActive() ) {
        const b = wp.data.select("core/block-editor");
        const blocks = b.getBlocks();
        for( let i = 0; i < blocks.length; i++ ) {
          _post_content += blocks[0].attributes.content;
        }
      } else {
        const _post_content_iframe = jQuery('#content_ifr').contents();
        _post_content = _post_content_iframe.find('body').html();
      }

      /*
      jQuery.ajax({
        url: ajax_object.ajaxurl,
        dataType: 'json',
        type: 'POST',
        data: {
          action: 'seo_images_savePost',
          post_id: p_id,
          post_content: _post_content,
          nonce: ajax_object.seo_images_save_draft_nonce
        }
      }).fail(function(){
        console.log('Ajax request save draft fails');
      }).done(function( data ){
        console.log( data );
      });
      */

    });
  });

});

function _seoImagesReset() {
  _countImages = 0;
  _pagesImages = 1;
  _currentPage = 1;
  jQuery('.seo_images-metabox-cvr').show();
  jQuery('#seo_images_selection_source_1').html('');
  jQuery('#seo_images_selection_source_2').html('');
  jQuery('#seo_images_selection_source_3').html('');
  jQuery('#seo_images_selection_source_4').html('');
  jQuery('#seo_images_selection_source_5').html('');
  jQuery('input[name=source]').attr( "disabled", false );
  jQuery('.seo_images_selection_buttons').html('');
}

function _seoImagesNextSource() {
  _currentPage++;
  _pagesImages++;
  jQuery('input[name=source]:checked').attr( "disabled",true );
  jQuery('input[name=source]:not(:disabled)').first().attr( "checked", true );
  jQuery('#add_image_act').trigger( 'click' );
}

function _seoImagesNextPage() {
  if( jQuery('.seo_images_selection_source:visible').next().html() != '' ) {
    jQuery('.seo_images_selection_source:visible').hide();
    jQuery('.seo_images_selection_source:visible').next().show();
  } else {
    jQuery('.seo_images_selection_source:visible').hide();
    jQuery('.seo_images_selection_source:visible').first().show();
  }
}

function _seoImagesShowMore() {
  const source_1 = jQuery('#seo_images_selection_source_1').html();
  const source_2 =jQuery('#seo_images_selection_source_2').html();
  const source_3 =jQuery('#seo_images_selection_source_3').html();
  const source_4 =jQuery('#seo_images_selection_source_4').html();
  const source_5 =jQuery('#seo_images_selection_source_5').html();
  let sources = [];

  if( source_1 != '' ) {
    jQuery('#seo_images_selection_source_1 .seo_images_selection_group').each(function(){
      if( sources[jQuery(this).find('h4').text()] === undefined ) {
        sources[jQuery(this).find('h4').text()] = '';
      }
      sources[jQuery(this).find('h4').text()] +=  jQuery(this).find('.seo_images_selection_main').html();
    });
    //jQuery('#seo_images_selection_source_1').show();
  }

  if( source_2 != '' ) {
    jQuery('#seo_images_selection_source_2 .seo_images_selection_group').each(function(){
      if( sources[jQuery(this).find('h4').text()] === undefined ) {
        sources[jQuery(this).find('h4').text()] = '';
      }
      sources[jQuery(this).find('h4').text()] +=  jQuery(this).find('.seo_images_selection_main').html();
    });
    //jQuery('#seo_images_selection_source_2').show();
  }

  if( source_3 != '' ) {
    jQuery('#seo_images_selection_source_3 .seo_images_selection_group').each(function(){
      if( sources[jQuery(this).find('h4').text()] === undefined ) {
        sources[jQuery(this).find('h4').text()] = '';
      }
      sources[jQuery(this).find('h4').text()] +=  jQuery(this).find('.seo_images_selection_main').html();
    });
  }

  if( source_4 != '' ) {
    jQuery('#seo_images_selection_source_4 .seo_images_selection_group').each(function(){
      if( sources[jQuery(this).find('h4').text()] === undefined ) {
        sources[jQuery(this).find('h4').text()] = '';
      }
      sources[jQuery(this).find('h4').text()] +=  jQuery(this).find('.seo_images_selection_main').html();
    });
  }

  if( source_5 != '' ) {
    jQuery('#seo_images_selection_source_5 .seo_images_selection_group').each(function(){
      if( sources[jQuery(this).find('h4').text()] === undefined ) {
        sources[jQuery(this).find('h4').text()] = '';
      }
      sources[jQuery(this).find('h4').text()] +=  jQuery(this).find('.seo_images_selection_main').html();
    });
  }

  jQuery('#seo_images_selection_source_1').html('');
  jQuery('#seo_images_selection_source_2').html('');
  jQuery('#seo_images_selection_source_3').html('');
  jQuery('#seo_images_selection_source_4').html('');
  jQuery('#seo_images_selection_source_5').html('');

  let html = ``;
  Object.entries( sources ).forEach(entry => {
    const [key, value] = entry;
    html += `<div class="seo_images_selection_group">`;
    html += `<h4>` + key + `</h4>`;
    html += `<div class="seo_images_selection_main">`;
    html += value;
    html += `</div>`;
    html += `</div>`;
  });

  jQuery('#seo_images_selection_source_1').html( html );
  jQuery('#seo_images_selection_source_1').show();
  jQuery('#show_more').hide();

}
